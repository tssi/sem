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
						console.log($scope.Defaults.SEMESTER);
						console.log($scope.ActiveSy);
						$scope.ActiveSem = $scope.Defaults.SEMESTER
						initAssessment();
						initDataSource();
						$scope.Disabled = 1;
						$scope.ShowInfo = 0;
					}
				});
				//console.log($rootScope);
			};
			$scope.init();
			$scope.nextStep = function(){
				if($scope.ActiveStep===1){
					$scope.ActiveStudent = $scope.SelectedStudent;
					console.log($scope.ActiveStudent);
					$scope.ActiveDept = $scope.ActiveStudent.department_id;
					$scope.YearLevels.push({'id':'IR','description':'Irregular','name':'Irregular','order':-1,'department_id':$scope.ActiveDept});
					getCurriculum($scope.ActiveStudent.department_id);
					$scope.ActiveOrder = null;
					for(var i in $scope.YearLevels){
						var y = $scope.YearLevels[i];
						if(y.id === $scope.ActiveStudent.yearlevel){
							$scope.ActiveOrder=y.order;
							break;
						}
					};
					$scope.Disabled = 1;
				}
				if($scope.ActiveStep===2){
					getReservations();
					$scope.ActiveLevel = $scope.SelectedLevel;
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
					console.log($scope.ActiveScheme);
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
					console.log($scope.ActiveScheme.schedule);
				}
				if($scope.ActiveStep===6){
					$scope.ActiveTab.id = 4;
					$scope.ActiveDiscounts= [];
					for(var i in $scope.Discounts){
						var dsc =$scope.Discounts[i];
						if($scope.SelectedDiscounts[dsc.id]){
							$scope.ActiveDiscounts.push(dsc);
						}
					}
					
					
				}
				
				if($scope.ActiveStep===7){
					if($scope.PaymentTotal)
						$scope.ActiveStudent.payment_total = $scope.PaymentTotal;
					if($scope.ActiveScheme.variance_amount)
						$scope.ActiveStudent.discount_amount = $scope.ActiveScheme.variance_amount;
					
					$scope.ActiveStudent.payment_scheme = $scope.ActiveScheme.scheme_id;
					$scope.ActiveStudent.assessment_total = $scope.ActiveTuition.assessment_total;
					$scope.ActiveStudent.year_level_id = $scope.ActiveSection.year_level_id;
					$scope.ActiveStudent.outstanding_balance = $scope.TotalAmount;
					$scope.ActiveStudent.section_id = $scope.ActiveSection.id;
					$scope.ActiveStudent.esp = $scope.ActiveSy;
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
					//console.log($scope.Assessment.assessment); return;
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
					initAssessment();
					initDataSource();
					$scope.Disabled = 1;
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
			$scope.setSelectedStudent=function(student){
				$scope.Disabled = 0;
				$scope.SelectedStudent = {
										 id:student.id,
										 name:student.first_name+" "+student.middle_name+" "+student.last_name+" ",
										 yearlevel:student.year_level_id,
										 department_id:student.department_id,
										 student_id:student.student_id,
										 program_id:student.program_id
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
										name: yearLevel.name
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
				$scope.Students = '';
				var data = {
					keyword:$scope.SearchWord,
					fields:['first_name','middle_name','last_name','id'],
					limit:'less',
				}
				var success = function(response){
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
			
			$scope.AddSched = function(subject,index,sec){
				subject.section_id = sec.id;
				$scope.CustomizedScheds.push(subject);
				$scope.sec.schedule_details.splice(index,1);
				if($scope.Disabled==1)
					$scope.Disabled = 0;
			}
			
			$scope.removeSched = function(subject,index){
				$scope.CustomizedScheds.splice(index,1);
				$scope.sec.schedule_details.push(subject);
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
					angular.forEach(response.data, function(res,i,array){
						switch(res.field_type){
							case 'RSRVE': res.description = 'Reservation'; reserves.push(res); break;
							case 'ADVTP': advances+=res.amount; break;
						}
						if(i===array.length-1){
							res.amount = advances;
							res.description = 'Advance Payment';
							reserves.push(res);
						}
					});
					console.log(reserves);
					
					$scope.Reservations = reserves;
				},function error(response){
					$scope.Reservations = '';
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
					{id:6, title:"Discount", description:"Select Discount"},
					{id:7, title:"Confirmation", description:"Confirmation"}
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
						if(fee.fee_id=='REG'){
							$scope.ActiveTuition.fee_breakdowns.push(fee);
							$scope.TotalDue+=fee.amount;
						}
					});
					
					IrregPaymentScheme();
				},function error(response){
					IrregPaymentScheme();
				});
				
			}
			
			//computes for irregular student
			
			function IrregPaymentScheme(){
				$scope.TotalAmount=$scope.TotalDue;
				var uponnrol = 0;
				angular.forEach($scope.ActiveTuition.fee_breakdowns, function(fee){
					if(fee.type=='MSC')
						uponnrol+=fee.amount;
				});
				var assess_date = new Date('2021-01-15');
				var year = assess_date.getFullYear();
				var nextMonth = assess_date.getMonth()+2;
				var day = assess_date.getDate();
				var lastDate = '';
				angular.forEach($scope.ActiveTuition.schemes, function(sc){
					if(sc.scheme_id=='MONT')
						lastDate = new Date(sc.schedule[sc.schedule.length-1].due_dates);
				});
				var lastMonth = lastDate.getMonth()+1;
				var count = 1;
				var schedules = [];
				for(var i=nextMonth-1;i!=lastMonth;i++){
					if(i==13)
						i=1;
					count++;
				}
				var distribute = ($scope.TotalAmount-uponnrol)/(count-1);
				count = 1;
				for(var i=nextMonth-1;i!=lastMonth+1;i++){
					if(i==13){
						i=1;
						year++;
					}
					var due_date = new Date(year+'-'+i+'-'+day);
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
					angular.forEach($scope.BillingPeriods, function(bill){
						if(sched.billing_period_id==bill.id)
							sched.description = bill.name;
					});
					schedules.push(sched);
					count++;
				}
				$scope.PaymentSchemes = [{name:'Irregular Payment Scheme',total_amount:$scope.TotalAmount,schedule:schedules}];
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
				if(filter.id!='IR')
					var data = {limit:'less',year_level_id:$scope.ActiveLevel.id};
				else
					var data = {program_id:'MIXED',department_id:$scope.ActiveDept};
				api.GET('sections',data, function success(response){
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
						var breakdown = [];
						$scope.OrigFees = $scope.ActiveTuition.fee_breakdowns;
						angular.forEach($scope.ActiveTuition.fee_breakdowns, function(fee){
							if(fee.type=='MSC'){
								breakdown.push(fee);
								$scope.TotalDue += fee.amount;
							}
						});
						$scope.TotalAmount=$scope.TotalDue;
						$scope.ActiveTuition.fee_breakdowns = breakdown;
					}else{
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
				});
			}
			
			
			
			function getBillingPeriods(){
				var data = 
				api.GET('billing_periods',{sy:$scope.ActiveSy}, function success(response){
					$scope.BillingPeriods = response.data;
				});
			}
			
			
			//getting schedules
			function getSchedules(){
				
				if($scope.ActiveSection.program_id!='MIXED')
					var data = {section_id:$scope.ActiveSection.id};
				else
					var data = {limit:'less'}
				api.GET('schedules',data, function success(response){
					if(response.data.length==1){
						$scope.ActiveSchedule = response.data[0];
						angular.forEach($scope.ActiveSchedule.schedule_details,function(sched){
							
						});
					}else{
						$scope.LoadingSec = true;
						$scope.ClassSchedules = response.data;
						var filter = {department_id:$scope.ActiveDept,limit:'less'}
						api.GET('sections',filter, function success(response){
							$scope.Sections = response.data;
							angular.forEach($scope.ClassSchedules, function(sched){
								angular.forEach($scope.Sections, function(sec){
									if(sec.id==sched.section_id){
										sec.schedule_details = sched.schedule_details;
									}
								})
							});
							angular.forEach($scope.Sections, function(sec){
								if(!sec.schedule_details){
									var details = [];
									angular.forEach($scope.Subjects, function(sub){
										if($scope.ActiveDept!='SH'&&sec.year_level_id==sub.year_level_id)
											details.push({'subject':sub.name,'subject_id':sub.code,'no_sched':true,'year_level_id':sub.year_level_id});
										if($scope.ActiveDept=='SH'&&sub.sec_id.indexOf(sec.id)!==-1&&sec.year_level_id==sub.year_level_id)
											details.push({'subject':sub.name,'subject_id':sub.code,'no_sched':true,'year_level_id':sub.year_level_id});
									});
									sec.schedule_details = details;
								}
							});
							console.log($scope.Sections);
							console.log($scope.Subjects);
							$scope.LoadingSec = false;
						});
					}
					
				}, function error(response){
					$scope.ActiveSchedule = {};
					var details = [];
					angular.forEach($scope.Subjects, function(sub){
						if($scope.ActiveDept=='SH'&&sub.sec_id.indexOf($scope.ActiveSection.id)!==-1&&$scope.ActiveSection.year_level_id==sub.year_level_id)
							details.push({'subject':sub.name,'subject_id':sub.code,'no_sched':true});
						if($scope.ActiveDept!='SH')
							details.push({'subject':sub.name,'subject_id':sub.code,'no_sched':true});
					});
					$scope.ActiveSchedule.schedule_details = details;
					console.log($scope.ActiveSchedule);
				});
			}
			
			
			//triggers when no avail sched
			function getCurriculum(dept){
				var data ={
					esp: $scope.ActiveSy+($scope.ActiveSem.id/100),
					department_id:dept
				}
				if(dept!='SH')
					data.esp = $scope.ActiveSy+.25;
				api.GET('curriculums',data, function success(response){
					$scope.Curriculum = response.data;
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
	
});


