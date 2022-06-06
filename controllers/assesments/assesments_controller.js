"use strict";
define(['app','api'], function (app) {
    app.register.controller('AssesmentController',['$scope','$rootScope','$uibModal','api', '$filter', function ($scope,$rootScope,$uibModal,api,$filter) {
		$scope.index = function(){
			bootstrap();
			$scope.init = function(){
				
				$rootScope.$watch('_APP', function(data){
					if(data){
						$scope.ActiveSy  =  data.ACTIVE_SY;
						$scope.Defaults  =  data.DEFAULT_;
						/*angular.forEach(data, function(item){
							switch(item.sys_key){
								case 'ACTIVE_SY': $scope.ActiveSy = item.sys_value; break;
								case 'DEFAULT_': $scope.Defaults = JSON.parse(item.sys_value); break;
							}
						});*/
						//console.log($scope.Defaults.SEMESTER);
						//console.log($scope.ActiveSy);
						$scope.ActiveSem = $scope.Defaults.SEMESTER
						$scope.ActiveEsp = $scope.ActiveSy+($scope.ActiveSem.id/100);
						console.log($scope.ActiveEsp);
						initAssessment();
						initDataSource();
						$scope.Disabled = 1;
						$scope.ShowInfo = 0;
						//Declared Modules Ebooks
						$scope.Module = 4950;
					}
				});
			};
			$scope.init();
			$scope.nextStep = function(){
				if($scope.ActiveStep===1){
					api.GET('assessments',{student_id:$scope.SelectedStudent.id,status:['ACTIV','NROLD'],esp:$scope.ActiveEsp},function success(response){
						$scope.Assessment = response.data[0];
						$scope.ReAssess($scope.SelectedStudent);
					}, function error(response){
						$scope.ActiveStudent = $scope.SelectedStudent;
						//console.log($scope.ActiveStudent);
						$scope.ActiveDept = $scope.ActiveStudent.department_id;
						$scope.YearLevels.push({'id':'IR','description':'Irregular','name':'Irregular','order':-1,'department_id':$scope.ActiveDept});
						
						$scope.ActiveOrder = null;
						for(var i in $scope.YearLevels){
							var y = $scope.YearLevels[i];
							if(y.id === $scope.ActiveStudent.yearlevel){
								$scope.ActiveOrder=y.order;
								break;
							}
						};
						$scope.Disabled = 1;
					});
					
				}
				if($scope.ActiveStep===2){
					getReservations();
					getSponsorships();
					$scope.ActiveLevel = $scope.SelectedLevel;
					if($scope.ActiveLevel.id=='IR')
						$scope.ActiveStudent.program_id = 'MIXED';
					getCurriculum($scope.ActiveLevel.department_id);
					getSections($scope.ActiveLevel);
					$scope.Disabled = 1;
				}
				if($scope.ActiveStep===3){
					$scope.CustomizedScheds = [];
					$scope.ActiveSection = $scope.SelectedSection;
					$scope.Subjects = [];
					angular.forEach($scope.Curriculum, function(curri){
						angular.forEach(curri.subjects, function(sub){
							sub.sec_id = curri.section_id;
							if($scope.ActiveSection.program_id!=='MIXED'){
								if(sub.year_level_id==$scope.ActiveSection.year_level_id)
									$scope.Subjects.push(sub);
							}else{
								//if(sub.year_level_id==$scope.ActiveSection.year_level_id&&$scope.ActiveDept=='SH')
									$scope.Subjects.push(sub);
							}
						});
						
					});
					getFees();
					getSchedules();
					$scope.TotalDue=0;	
					$scope.ShowInfo = 1;
				};
				
				if($scope.ActiveStep===4){
					$scope.ActiveTab.id = 2;
					$scope.HasSched = true;
					if($scope.ActiveSection.program_id=='MIXED'){
						$scope.ActiveSchedule = {};
						$scope.ActiveSchedule['schedule_details'] = $scope.CustomizedScheds;
						ComputeSubjects();
					}
					$scope.Disabled = 1;
				};
				
				if($scope.ActiveStep===5){
					$scope.ActiveTab.id = 3;
					$scope.ActiveScheme = angular.copy($scope.SelectedScheme);
					if(!$scope.ActiveStudent.special_case){
						$scope.PaymentTotal = 0;
						$scope.TotalAmount = 0;
						var total = 0;
						if($scope.Reservations.length){
							angular.forEach($scope.Reservations, function(res){
								total += res.amount;
								$scope.PaymentTotal+=res.amount;
							});
							$scope.AdvancePayment = {amount:-total};
						}
						if($scope.Sponsorship!==''){
							total+=$scope.Sponsorship.amount;
							$scope.PaymentTotal+=$scope.Sponsorship.amount;
						}
						
						for(var i in $scope.ActiveScheme.schedule){
							var sched = $scope.ActiveScheme.schedule[i];
							if(sched.amount<=total){
								total-=sched.amount;
								sched.amount = 0;
							}else{
								sched.amount-= total;
								total = 0;
							}
							$scope.TotalAmount+= sched.amount;
						}
						for(var i in $scope.ActiveScheme.schedule){
							var sched = $scope.ActiveScheme.schedule[i];
							if(sched.billing_period_id=='UPONNROL'&&sched.amount==0){
								sched.amount = 1;
								var zero = true;
							}else if(sched.billing_period_id!='UPONNROL'&&sched.amount>0&&zero){
								sched.amount-=1;
								break;
							}
							if(sched.amount==0)
								sched.status = 'PAID';
						};
					}
					//console.log($scope.ActiveScheme.schedule);
				}

				
				if($scope.ActiveStep===6){
					
					for(var i in $scope.Discounts){
						var dsc =$scope.Discounts[i];
						if($scope.SelectedDiscounts[dsc.id]){
							$scope.ActiveDiscounts.push(dsc);
						}
					}
					if($scope.PaymentTotal)
						$scope.ActiveStudent.payment_total = $scope.PaymentTotal;
					if($scope.ActiveScheme.variance_amount)
						$scope.ActiveStudent.discount_amount = $scope.ActiveScheme.variance_amount;
					
					$scope.ActiveStudent.payment_scheme = $scope.ActiveScheme.scheme_id;
					$scope.ActiveStudent.assessment_total = $scope.TotalAmount-$scope.ActiveScheme.variance_amount;
					$scope.ActiveStudent.year_level_id = $scope.ActiveSection.year_level_id;
					$scope.ActiveStudent.outstanding_balance = $scope.TotalAmount;
					$scope.ActiveStudent.section_id = $scope.ActiveSection.id;
					$scope.ActiveStudent.subsidy_status = $scope.ActiveScheme.subsidy_status;
					$scope.ActiveStudent.esp = $scope.ActiveEsp;
					$scope.ActiveStudent.module_balance = $scope.Module;
					$scope.ActiveStudent.status = 'ACTIV';
					$scope.Assessment = {
						assessment:$scope.ActiveStudent,
						paysched:$scope.ActiveScheme.schedule,
						fees:$scope.ActiveTuition.fee_breakdowns
					};
					if($scope.ActiveSection.program_id=='MIXED')
						$scope.Assessment.schedule = $scope.CustomizedScheds;
					else
						$scope.Assessment.schedule = $scope.ActiveSchedule.schedule_details;
					if($scope.ActiveDiscounts.length){
						$scope.Assessment.discounts = $scope.ActiveDiscounts;
						$scope.Assessment.assessment.discount_amount = $scope.TotalDiscount;
					}
					
					//console.log($scope.Assessment); return;
					api.POST('assessments',$scope.Assessment, function success(response){
						$scope.AssessmentId = response.data.id;
						$scope.openModal();
					});
				}
				if($scope.ActiveStep<$scope.Steps.length){
					$scope.ActiveStep++;
				}
			};
			
			$scope.openModal=function(){
				var modalInstance = $uibModal.open({
					animation: true,
					size:'sm',
					templateUrl: 'successAssessModal.html',
					controller: 'SuccessAssessModalController',
					resolve:{
						assessmentId:function(){
							return $scope.AssessmentId;
						}
					}
				});
				modalInstance.result.then(function (source) {
					
				}, function (source) {
					initAssessment();
					initDataSource();
					$scope.Disabled = 1;
				});
			}
			
			$scope.prevStep = function(){
				if($scope.ActiveStep>1)
					$scope.ActiveStep--;
				switch($scope.ActiveStep){
					case 1: $scope.init(); break;
					case 2: $scope.ActiveLevel=''; break;
					case 5:
						if($scope.ActiveSection.program_id=='MIXED')
							getFees();
						break;
					case 6: $scope.ActiveDiscounts=[]; $scope.SelectedDiscount = {}; break;
				}
			};
			$scope.updateStep=function(step){
				$scope.ActiveStep = step.id;
			};

			$scope.openClearance = function(student){
				var modalInstance = $uibModal.open({
						animation: true,
						size:'sm',
						templateUrl: 'clearanceModal.html',
						controller: 'ClearanceModalController',
						
					});
					modalInstance.result.then(function () {
					  
					}, function (source) {
						$scope.init();
					});
			}
			$scope.ReAssess = function(stud){
				var modalInstance = $uibModal.open({
					templateUrl: 'ReAssessModal.html',
					controller: 'ReAssessModalController',
					resolve:{
						student:function(){
							return stud;
						},
						assId:function(){
							return $scope.Assessment.id;
						},
						ass:function(){
							return $scope.Assessment;
						}
					}
					
				});
				modalInstance.result.then(function (action) {
					//console.log(student); return;
					var data = $scope.Assessment;
					data.status = 'ARCHV';
					if(action=='reassess'){
						api.POST('assessments',data, function success(response){
							$scope.ActiveStudent = $scope.SelectedStudent;
							$scope.ActiveDept = $scope.ActiveStudent.department_id;
							$scope.YearLevels.push({'id':'IR','description':'Irregular','name':'Irregular','order':-1,'department_id':$scope.ActiveDept});
							$scope.ActiveOrder = null;
							for(var i in $scope.YearLevels){
								var y = $scope.YearLevels[i];
								if(y.id === $scope.ActiveStudent.yearlevel){
									$scope.ActiveOrder=y.order;
									break;
								}
							};
							$scope.Disabled = 1;
						});
					}else{
						initAssessment();
						initDataSource();
						$scope.Disabled = 1;
					}
				}, function (source) {
					
				});
			}
			$scope.setSelectedStudent=function(student){
				$scope.Disabled = 0;
				$scope.SelectedStudent = {
										 id:student.id,
										 name:student.first_name+" "+student.middle_name+" "+student.last_name+" ",
										 yearlevel:student.year_level_id,
										 department_id:student.department_id,
										 student_id:student.student_id,
										 program_id:student.program_id,
										 subsidy_status:student.subsidy_status
				                         };
				if(student.suffix)
					$scope.SelectedStudent.name += student.suffix;
			};
			
			
			
			$scope.filterYearLevel = function(yearlevel){
				
				if($scope.ActiveOpt=='Old')
					return yearlevel.order >= $scope.ActiveOrder && yearlevel.order <= $scope.ActiveOrder+1 || yearlevel.id=='IR';
				else
					return yearlevel.order === $scope.ActiveOrder || yearlevel.id=='IR';
					
			}
			
			$scope.setSelectedLevel=function(yearLevel){
				$scope.Disabled = 0;
				$scope.SelectedLevel = {
										id: yearLevel.id,
										educ_level_id: yearLevel.educ_level_id,
										name: yearLevel.name,
										department_id:yearLevel.department_id
									   };
			};
			$scope.setSelectedSection=function(section){
				$scope.Disabled = 0;
				$scope.SelectedSection = section;
			};
			$scope.setSelectedScheme=function(paymentScheme){
				$scope.Disabled = 0;
				$scope.SelectedScheme = paymentScheme;
			};
			$scope.setSelectedDiscount=function(discount){
				$scope.SelectedDiscount=discount;
			};
			$scope.resetField=function(field){
				if(field==='student'){
					$scope.SelectedStudent={};
					$scope.ActiveStudent={};
				}	
				if(field==='level'){
					$scope.SelectedLevel={};
					$scope.ActiveLevel={};
				}	
				if(field==='section'){
					$scope.SelectedSection={};
					$scope.ActiveSection={};
					$scope.ActiveTuition={};
				}
				if(field==='scheme'){
					$scope.SelectedScheme={};
					$scope.ActiveScheme={};
				}	
				if(field==='discount'){
					$scope.SelectedDiscounts={};
					$scope.ActiveDiscounts=[];
					$scope.TotalDiscount=null;
				}	
			};
			$scope.filterStudent=function(student){
				var searchBox = $scope.searchStudent;
				var keyword = new RegExp(searchBox,'i');	
				var test = keyword.test(student.first_name) || keyword.test(student.id);
				return !searchBox || test;
			};
			$scope.clearSearchStudent=function(){
				$scope.searchStudent=null;
			};
			$scope.toggleSelectDiscount=function(id){
				$scope.SelectedDiscounts[id] = !$scope.SelectedDiscounts[id]; 
			}
			
			$scope.SearchStudent = function(){
				$scope.NoStudent = false;
				$scope.Students = '';
				var data = {
					keyword:$scope.SearchWord,
					fields:['first_name','middle_name','last_name','id'],
					limit:'less',
				}
				var success = function(response){
					if(response.meta.code)
						$scope.NoStudent = true;
					$scope.Students = response.data;
				}
				var error = function(response){
					
				}
				if($scope.ActiveOpt=='New')
					api.GET('inquiries',data,success,error);
				else
					api.GET('students',data,success,error);
			}
			
			$scope.ClearSearch = function(){
				$scope.SearchWord = '';
				$scope.Students = '';
				api.GET('students', function success(response) {
					$scope.Students = response.data;
				});
			}
			
			$scope.selectSec = function(sec){
				$scope.sec = sec;
			}
			
			$scope.AddSched = function(subject,index,sec){
				subject.section_id = sec.id;
				console.log($scope.sec);
				$scope.CustomizedScheds.push(subject);
				$scope.sec.details.splice(index,1);
				if($scope.Disabled==1)
					$scope.Disabled = 0;
			}
			
			$scope.removeSched = function(subject,index){
				$scope.CustomizedScheds.splice(index,1);
				$scope.sec.details.push(subject);
				if($scope.Disabled==1)
					$scope.Disabled = 0;
			}
			
			$scope.setActiveOpt = function(opt){
				$scope.Students = '';
				$scope.NoInquiries = 0;
				$scope.ActiveOpt = opt;
				getStudents();
			}
			
			$scope.setActiveTab = function(tab){
				$scope.ActiveTab = tab;
			}
			
			function getReservations(){
				api.GET('reservations',{account_id:$scope.ActiveStudent.id},function success(response){
					var advances = 0;
					var reserves = [];
					for(var i in response.data){
						var res = response.data[i];
						//console.log(res);
						switch(res.field_type){
							case 'RSRVE': res.description = 'Reservation'; reserves.push(res); break;
							case 'ADVTP': advances+=res.amount; break;
						}
					}
					if(advances>0)
						reserves.push({amount:advances,description:'AdvancePayment'});
					
					$scope.Reservations = reserves;
				},function error(response){
					$scope.Reservations = '';
				});
			}
			
			function getSponsorships(){
				var data = {account_id:$scope.ActiveStudent.id,ref_no:'SPO',sy:$scope.ActiveSy,};
				api.GET('ledgers', data, function success(response){
					$scope.Sponsorship = response.data[0];
				},function error(response){
					$scope.Sponsorship = '';
				});
			}
			
			function bootstrap(){
				$rootScope.__MODULE_NAME = 'Assessment';
				$scope.Steps = [
					{id:1, title:"Student", description:"Select Student"},
					{id:2, title:"Level", description:"Select Level"},
					{id:3, title:"Section", description:"Select Section"},
					{id:4, title:"Schedule", description:"Select Schedule"},
					{id:5, title:"Payment Scheme", description:"Select Payment Scheme"},
					//{id:6, title:"Discount", description:"Select Discount"},
					{id:6, title:"Confirmation", description:"Confirmation"}
				];
				
				$scope.$watch('hasStudentInfo',updateHasInfo);
				$scope.$watch('hasLevelInfo',updateHasInfo);
				$scope.$watch('hasSectionInfo',updateHasInfo);
				$scope.$watch('hasSchemeInfo',updateHasInfo);
				$scope.$watch('hasAdjustmentInfo',updateHasInfo);
				
				$scope.$watch('ActiveStudent', function(){
					$scope.hasStudentInfo = $scope.ActiveStudent.id;
				});
				$scope.$watch('ActiveLevel',function(){
					$scope.hasLevelInfo = $scope.ActiveLevel.id;
				});
				$scope.$watch('ActiveSection',function(){
					$scope.hasSectionInfo = $scope.ActiveSection.id;
				});
				$scope.$watchGroup(['ActiveScheme','TotalDiscount'],function(){
					$scope.hasScheduleInfo = $scope.hasSchemeInfo = $scope.ActiveScheme.id;
					$scope.hasAdjustmentInfo = $scope.ActiveScheme.variance_amount || $scope.TotalDiscount;
					//if($scope.TotalDiscount&&$scope.hasScheduleInfo)
						//computePaymentSchedule();
					
				});
			}
			function initAssessment(){
				//console.log('dumaan');
				$scope.ActiveTuition = '';
				$scope.SearchWord = '';
				$scope.Options = ['Old','New'];
				$scope.ActiveOpt = 'Old';
				$scope.Student={};
				$scope.hasBasicInfo=false;
				$scope.hasContactInfo=false;
				$scope.ActiveStep=1;
				$scope.SelectedStudent={};
				$scope.ActiveStudent={};
				$scope.SelectedLevel={};
				$scope.ActiveLevel={};
				$scope.SelectedSection={};
				$scope.ActiveSection={};
				$scope.SelectedScheme={};
				$scope.ActiveScheme={};
				$scope.ActiveDiscounts=[];
				$scope.SelectedDiscounts={};
				$scope.ActiveSchedule = {};
				$scope.ActiveOrder = null;
				$scope.TotalAmount = 0;
				$scope.TotalDue = 0;
				$scope.TotalAdjustment = 0;
				$scope.TotalDiscount = 0;
				$scope.hasInfo = false;
				$scope.hasStudentInfo = false;
				$scope.hasLevelInfo = false;
				$scope.hasSectionInfo = false;
				$scope.hasSchemeInfo = false;
				$scope.hasScheduleInfo = false;
				$scope.hasAdjustmentInfo = false;
				$scope.AssesmentSaving = false;
				$scope.HasSched = false;
				$scope.Tabs = [{id:1,description:'Fees'},{id:2,description:'Class Schedule'},{id:3,description:'Payment Schedule'},{id:4,description:'Adjustments'},];
				$scope.ActiveTab = {id:1,description:'Fee Breakdown'};
			};
			function initDataSource(){
				/* $scope.Students=[];
				$scope.YearLevels=[];
				$scope.Sections=[]; */
				$scope.Sections = [];
				$scope.Tuitions=[];
				$scope.PaymentSchemes=[];
				$scope.Discounts=[];
				getBillingPeriods();
				getStudents();
				getYearLevels();
			}	
			
			function ComputeSubjects(){
				var subjects = [];
				angular.forEach($scope.CustomizedScheds,function(sub){
					subjects.push(sub.subject_id);
				});
				api.GET('fee_tuihr_subjects',{subject_id:subjects,limit:'less'},function success(response){
					var tuition = 0;
					angular.forEach(response.data, function(sub){
						tuition += sub.tuition_hr*$scope.ActiveTuition.tuition_per_hr;
						console.log(sub.tuition_hr*$scope.ActiveTuition.tuition_per_hr);
					});
					$scope.TotalDue+=tuition;
					$scope.ActiveTuition.fee_breakdowns.push({fee_id:'TUI',amount:tuition,description:'Tuition Fee',order:1});
					getSpecialFees(subjects);
				})
				
			}
			
			
			//computes for special subjects
			function getSpecialFees(subjects){
				api.GET('fee_special_subjects',{subject_id:subjects,limit:'less'}, function success(response){
					var fees = [];
					angular.forEach(response.data,function(sub){
						fees.push(sub.fee_id);
					});
					angular.forEach($scope.OrigFees, function(fee){
						if(fees.indexOf(fee.fee_id)!==-1){
							$scope.TotalDue+=fee.amount;
							$scope.ActiveTuition.fee_breakdowns.push(fee);
						}
						
					});
					
					IrregPaymentScheme();
				},function error(response){
					IrregPaymentScheme();
				});
				
			}
			
			//get first assessment as regular when assessing irreg
			function getFirstAssess(){
				var data = {esp:$scope.ActiveSy+.25, student_id:$scope.ActiveStudent.id};
				api.GET('assessments',data, function success(response){
					//$scope.FirstAssess = response.data[0];
					computeAdjustment(response.data[0]);
				});
			}
			
			//compute for fee adjustment
			function computeAdjustment(ass){
				api.GET('fee_tuihr_subjects', {subject_id:ass['subjects'],limit:'less'}, function(response){
					var tuition = 0;
					angular.forEach(response.data, function(sub){
						tuition += sub.tuition_hr*$scope.ActiveTuition.tuition_per_hr;
					});
					$scope.ActiveStudent['first'] = tuition;
					tuition = tuition+$scope.TotalAmount+$scope.InitialFee;
					$scope.ActiveStudent['total_adjustment']=tuition;
					$scope.ActiveStudent['difference'] = ass['assessment_total']-tuition;
					$scope.ActiveStudent['special_case'] = true;
					$scope.ActiveStudent['misc']=$scope.InitialFee;
					api.GET('account_schedules',{account_id:$scope.ActiveStudent.id},function success(response){
						var scheds = response.data;
						var order = 0;
						var divisor = 0;
						angular.forEach(scheds, function(sched){
							if($scope.ActiveStudent.month==sched.bill_month)
								order = sched.order;
						});
						angular.forEach(scheds, function(sched){
							if(order<=sched.order)
								divisor++;
						});
						var dist = Math.abs($scope.ActiveStudent['difference']/divisor);
						angular.forEach(scheds, function(sched){
							console.log(sched);
							if(sched.order==order)
								sched.transaction_type_id='INIPY';
							if(sched.order>=order){
								if($scope.ActiveStudent.difference<0)
									sched.due_amount+=dist;
								else
									sched.due_amount-=dist;
							}
						});
						$scope.TotalAdjustment = 0;
						angular.forEach(scheds, function(sched){
							$scope.TotalAdjustment+=sched.due_amount;
							angular.forEach($scope.BillingPeriods, function(bill){
								if(bill.id==sched.bill_month)
									sched.description = bill.name;
							});
						});
						$scope.PaymentSchemes = [{name:'Irregular Payment Scheme',total_amount:$scope.TotalAmount,schedule:scheds}];
						
					});
				});
			}
			
			//computes for irregular student
			function IrregPaymentScheme(){
				$scope.TotalAmount=$scope.TotalDue;
				var uponnrol = 0;
				console.log($scope.ActiveTuition.fee_breakdowns);
				angular.forEach($scope.ActiveTuition.fee_breakdowns, function(fee){
					if(fee.type=='MSC'){
						uponnrol+=fee.amount;
						console.log(fee);
					}
				});
				var assess_date = new Date();
				var year = assess_date.getFullYear();
				var nextMonth = assess_date.getMonth()+2;
				var day = 1;
				//console.log(day);
				var lastDate = '';
				angular.forEach($scope.ActiveTuition.schemes, function(sc){
					if(sc.scheme_id=='MONT')
						lastDate = new Date(sc.schedule[sc.schedule.length-1].due_dates);
				});
				//for irregular only 5 months
				var lastMonth = lastDate.getMonth()-4;
				//console.log($scope.ActiveTuition.schemes);
				//console.log(lastDate.getMonth());
				if(lastMonth==0)
					lastMonth = 12;
				if($scope.ActiveSem.id==45)
					lastMonth = lastDate.getMonth()+1;
				var count = 1;
				var schedules = [];
				for(var i=nextMonth-1;i!=lastMonth;i++){
					if(i==13)
						i=1;
					count++;
				}
				//console.log(nextMonth,lastMonth);
				if($scope.ActiveSem.id==45){
					if($scope.IsIrreg){
						if($scope.InitialFee<=$scope.TotalDue)
							uponnrol+=$scope.InitialFee;
						else
							uponnrol=$scope.TotalAmount;
					}
					if($scope.ActiveOpt=='Old'&&!$scope.IsIrreg){
						if($scope.InitialFee<=$scope.TotalDue)
							uponnrol+=$scope.InitialFee;
						else
							uponnrol=$scope.TotalAmount;
						var first = {};
						var mo_short = new Date();
						mo_short = mo_short.toLocaleString('en-us', { month: 'short' });
						$scope.ActiveStudent['month']=mo_short+year;
						$scope.ActiveStudent['month']=$scope.ActiveStudent.month.toUpperCase();
						
						console.log($scope.ActiveStudent.month);
						getFirstAssess();
					}
				}
				
				if($scope.InitialFee>=$scope.TotalAmount){
					var sched = {
						billing_period_id : 'UPONNROL',
						amount : uponnrol,
						description : 'Initial Payment'
					};
					sched.billing_period_id = sched.billing_period_id.toUpperCase();
					schedules.push(sched);
				}else{
					var distribute = ($scope.TotalAmount-uponnrol)/(count-1);
					count = 1;
					for(var i=nextMonth-1;i!=lastMonth+1;i++){
						if(i==13){
							i=1;
							year++;
						}
						var due_date = new Date(year+'-'+i+'-'+day);
						//console.log(due_date);
						var mo = due_date.toLocaleString('en-us', { month: 'short' });
						var sched = {
							amount:distribute,
							due_dates:year+'-'+i+'-'+day,
							billing_period_id:mo+year
						};
						if(count==1){
							sched.amount = uponnrol;
							sched.billing_period_id = 'UPONNROL';
						}
						sched.billing_period_id = sched.billing_period_id.toUpperCase();
						///console.log(sched.billing_period_id);
						//console.log(mo);
						angular.forEach($scope.BillingPeriods, function(bill){
							if(sched.billing_period_id==bill.id)
								sched.description = bill.name;
						});
						schedules.push(sched);
						count++;
					}
				}
				$scope.PaymentSchemes = [{name:'Irregular Payment Scheme',total_amount:$scope.TotalAmount,schedule:schedules}];
				//console.log($scope.PaymentSchemes);
				//console.log(schedules);
			}
			
			function computePaymentSchedule(){
				var totalDiscount = angular.copy($scope.TotalDiscount)*-1;
				var schedule = angular.copy($scope.SelectedScheme.schedule);
				//Deduct discount
				for(var index in schedule){
					var bill = schedule[index];
					if(totalDiscount>bill.amount){
						totalDiscount = totalDiscount - bill.amount;
						bill.amount = 0;
					}else if(totalDiscount<=bill.amount){
						bill.amount =  bill.amount - totalDiscount;
						totalDiscount = 0;
					}
					schedule[index]=bill;
					if(!totalDiscount) break;
				}
				//Collect adjusted and reset amount
				var __amounts = [];
				for(var index in schedule){
					var bill = schedule[index];
					if(bill.amount){
						__amounts.push(bill.amount);
						bill.amount=0;
						schedule[index] = bill;
					}
				}
				//Assign collected amounts
				for(var index in __amounts){
					schedule[index].amount  = __amounts[index];
				}
				$scope.ActiveScheme.schedule = schedule;
			}
			function updateHasInfo(){
				$scope.hasInfo = $scope.hasStudentInfo || $scope.hasLevelInfo || $scope.hasSectionInfo || $scope.hasSchemeInfo || $scope.hasAdjustmentInfo;
			};
			
			function getStudents(){
				if($scope.ActiveOpt=='Old'){
					api.GET('students', function success(response){
						$scope.Students = response.data;
					});
				}else{
					api.GET('inquiries', function success(response){
						$scope.NoInquiries = 0;
						$scope.Students = response.data;
					}, function error(response){
						$scope.NoInquiries = 1;
					});
				}
			}
			
			
			
			function getSections(filter){
				var data = {};
				if(filter.id!='IR'){
					data = {limit:'less',year_level_id:$scope.ActiveLevel.id};
					if(filter.department_id=='SH'&&$scope.ActiveStudent.program_id!=null&&$scope.ActiveStudent.program_id!='HSBED')
						data.program_id = $scope.ActiveStudent.program_id;
				}else{
					data = {limit:'less',department_id:$scope.ActiveStudent.department_id};
					if($scope.ActiveStudent.yearlevel=='GX')
						data.department_id = 'SH';
				}
				//console.log($scope.ActiveStudent);
				api.GET('sections',data, function success(response){
					//console.log(response.data);
					$scope.Sections = response.data;
					
				});
			}
			function getYearLevels(){
				var data = {limit:'less'};
				api.GET('year_levels',data, function success(response){
					$scope.YearLevels = response.data;
				});
			}
			
			//getting applicable fee depending on year level
			function getFees(){
				var data = {year_level_id:$scope.ActiveSection.year_level_id,sy:$scope.ActiveSy}
				api.GET('tuitions',data, function success(response){
					$scope.ActiveTuition = response.data[0];
					if($scope.ActiveSection.program_id=='MIXED'){
						calculateIrreg();
					}else{
						calculateReg();
					}
				});
			}
			
			//fees if irreg
			function calculateIrreg(){
				var breakdown = [];
					$scope.OrigFees = $scope.ActiveTuition.fee_breakdowns;
					$scope.InitialFee = 0;
					angular.forEach($scope.ActiveTuition.fee_breakdowns, function(fee){
						if($scope.ActiveSem.id==45&&($scope.IsIrreg||$scope.ActiveOpt=='Old')){
							//console.log($scope.IsIrreg);
							if(fee.type=='MSC'){
								if(fee.fee_id=='REG'){
									$scope.TotalDue += fee.amount;
									breakdown.push(fee);
								}
								$scope.InitialFee+=fee.amount;
							}
						}else{
							if(fee.type=='MSC'){
								breakdown.push(fee);
								$scope.TotalDue += fee.amount;
							}
						}
					});
					$scope.TotalAmount=$scope.TotalDue;
					$scope.ActiveTuition.fee_breakdowns = breakdown;
			}
			
			//fees if regular student
			function calculateReg(){
				for(var i in $scope.ActiveTuition.fee_breakdowns){
						var a = $scope.ActiveTuition.fee_breakdowns[i]
						$scope.TotalDue += a.amount;
					};
					$scope.PaymentSchemes=$scope.ActiveTuition.schemes;
					$scope.Discounts=$scope.ActiveTuition.discounts;
					$scope.TotalAmount=$scope.TotalDue; 
					angular.forEach($scope.ActiveTuition.schemes, function(scheme){
						angular.forEach(scheme.schedule, function(sched){
							angular.forEach($scope.BillingPeriods, function(per){
								if(per.id==sched.billing_period_id)
									sched.description = per.name;
							});
						});
					});
			}
			
			
			function getBillingPeriods(){
				var data = 
				api.GET('billing_periods',{sy:$scope.ActiveSy,limit:'99'}, function success(response){
					$scope.BillingPeriods = response.data;
				});
			}
			
			
			//getting schedules
			function getSchedules(){
				console.log($scope.ActiveStudent);
				$scope.LoadingSec = true;
				if($scope.ActiveSection.program_id!='MIXED')
					var data = {section_id:$scope.ActiveSection.id,esp:$scope.ActiveSy};
				else
					var data = {limit:'less'};
				if($scope.ActiveStudent.department_id=='SH'&&$scope.ActiveSection.program_id=='MIXED')
					data.esp = $scope.ActiveEsp;
				if(($scope.ActiveStudent.yearlevel=='GX'||$scope.ActiveStudent.department_id=='SH')&&$scope.ActiveSection.program_id!=='MIXED'){
					data.esp = $scope.ActiveEsp;
				}
				console.log($scope.ActiveStudent,$scope.ActiveEsp,data);
				api.GET('schedules',data, function success(response){
					if(response.data.length==1&&$scope.ActiveSection.program_id!=='MIXED'){
						$scope.ActiveSchedule = response.data[0];
						angular.forEach($scope.ActiveSchedule.schedule_details,function(sched){
							sched.section_id = $scope.ActiveSection.id;
							sched.sched = '';
							for(var i=0;i<sched.days.length;i++){
								var day = sched.days[i];
								var time = sched.times[i];
								var grading = sched.gradings[i];
								sched.sched += grading+'-' +day+' '+time;
								if(i<sched.days.length-1)
									sched.sched += ' | ';
							}
						}); 
						console.log($scope.ActiveSchedule);
					}else{
						var scheds = response.data;
						angular.forEach(scheds, function(item){
							angular.forEach(item.schedule_details,function(sched){
								sched.sched = '';
								for(var i=0;i<sched.days.length;i++){
									var day = sched.days[i];
									var time = sched.times[i];
									sched.sched += day+' '+time;
									if(i<sched.days.length-1)
										sched.sched += ' | ';
								}
							}); 
						});
						console.log(scheds);
						if($scope.ActiveLevel.id=='IR'){
							angular.forEach($scope.Sections, function(sec){
								var details = [];
								angular.forEach(scheds, function(sched){
									if(sec.id==sched.section_id){
										sec.schedule = sched;
									}
								});
								console.log(sec);
								angular.forEach($scope.Subjects, function(sub){
									if(sub.sec_id.indexOf(sec.id)!==-1&&sub.year_level_id==sec.year_level_id){
										var subject_data = {'subject':sub.name,'subject_id':sub.code};
										console.log(sec);
										if(sec.schedule.id)
											subject_data.schedule_id = sec.schedule.id;
										details.push(subject_data);
									}
								});
								sec.details = details;
							});
							angular.forEach($scope.Sections, function(sec){
								if(sec.program_id!=='MIXED'){
									angular.forEach(sec.schedule.schedule_details, function(sched){
										angular.forEach(sec.details, function(det){
											if(det.subject_id==sched.subject_id){
												det.sched = sched.sched;
											}
										});
									});
								}
							});
							console.log($scope.Sections);
						}
					}
					$scope.LoadingSec = false;
					
				}, function error(response){
					$scope.ActiveSchedule = {};
					
					if($scope.ActiveLevel.id=='IR'){
						angular.forEach($scope.Sections, function(sec){
							var details = [];
							angular.forEach($scope.Subjects, function(sub){
								if(sub.sec_id.indexOf(sec.id)!==-1&&sub.year_level_id==sec.year_level_id){
									details.push({'subject':sub.name,'subject_id':sub.code,'no_sched':true});
								}
							});
							sec.details = details;
						});
					}else{
						var details = [];
						angular.forEach($scope.Subjects, function(sub){
							console.log(sub);
							if(sub.sec_id.indexOf($scope.ActiveSection.id)!==1&&sub.year_level_id==$scope.ActiveSection.year_level_id){
								details.push({'subject':sub.name,'subject_id':sub.code,'no_sched':true});
							}
						});
						$scope.ActiveSchedule.schedule_details = details;
						
					}
					console.log($scope.ActiveSchedule);
					$scope.LoadingSec = false;
					
				});
			}
			
			
			//triggers when no avail sched
			function getCurriculum(dept){
				var data ={
					esp: $scope.ActiveSy+($scope.ActiveSem.id/100),
					department_id:dept,
				}
				//data.esp=2020.25;
				if($scope.ActiveStudent.yearlevel=='GX')
					data.department_id = 'SH';
				if(dept!='SH')
					data.esp = $scope.ActiveSy+.25;
				api.GET('curriculums',data, function success(response){
					$scope.Curriculum = response.data;
					checkIrreg();
				});
			}
			
			
			//check if irregular in first sem
			function checkIrreg(){
				$scope.IsIrreg = 0;
				var data = {esp:$scope.ActiveSy+.1,student_id:$scope.ActiveStudent.id};
				api.GET('classlist_irregulars',data, function success(response){
					$scope.IsIrreg = 1;
				}, function error(response){
					$scope.IsIrreg = 0;
				});
			}
			
			
		};
    }]);
	app.register.controller('SuccessAssessModalController',['$scope','$rootScope','$timeout','$uibModalInstance','api','assessmentId', function ($scope,$rootScope,$timeout, $uibModalInstance, api,assessmentId){
		$scope.AssessmentId = assessmentId;
		$rootScope.__MODAL_OPEN = true;
		$timeout(function(){
			$scope.ShowButton = true;
		},333);
		//Dismiss modal
		$scope.dismissAssesment = function(){
			$rootScope.__MODAL_OPEN = false;
			document.getElementById('PrintAssess').submit();
			$uibModalInstance.dismiss('ok');
		};
	}]);

	app.register.controller('ClearanceModalController',['$scope','$rootScope','$timeout','$uibModalInstance','api', function ($scope,$rootScope,$timeout, $uibModalInstance, api){
		$rootScope.__MODAL_OPEN = true;
		$timeout(function(){
			$scope.ShowButton = true;
		},333);
		//Dismiss modal
		$scope.dismissModal = function(){
			$rootScope.__MODAL_OPEN = false;
			$uibModalInstance.dismiss('ok');
		};
	}]);
	app.register.controller('ReAssessModalController',['$scope','$rootScope','$timeout','$uibModalInstance','api', 'student','assId','ass',	
	function ($scope,$rootScope,$timeout, $uibModalInstance, api,student,assId,ass){
		$scope.ActiveStudent = student;
		//console.log(student);
		$rootScope.__MODAL_OPEN = true;
		$scope.AssessmentId = assId;
		$scope.ActiveAssessment=ass;
		$scope.Cancel = function(){
			$uibModalInstance.close();
			$rootScope.__MODAL_OPEN = false;
		}
		
		$scope.Action = function(action){
			if(action=='reassess')
				$uibModalInstance.close(action);
			else{
				document.getElementById('PrintAssess').submit();
				$uibModalInstance.close(action);
			}
			$rootScope.__MODAL_OPEN = false;
		}
		
	}]);
	
});

