"use strict";
define(['app','api'], function (app) {
    app.register.controller('AssesmentController',['$scope','$rootScope','$uibModal','api', function ($scope,$rootScope,$uibModal,api) {
		$scope.index = function(){
			bootstrap();
			$scope.init = function(){
				initAssessment();
				initDataSource();
			};
			$scope.init();
			$scope.nextStep = function(){
				if($scope.ActiveStep===1){
					$scope.ActiveStudent = $scope.SelectedStudent;
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
				}
				if($scope.ActiveStep===2){
					$scope.ActiveLevel = $scope.SelectedLevel;
					getSections($scope.ActiveLevel);
				}
				if($scope.ActiveStep===3){
					$scope.CustomizedScheds = [];
					$scope.ActiveSection = $scope.SelectedSection;
					$scope.Subjects = [];
					angular.forEach($scope.Curriculum.subjects, function(sub){
						if($scope.ActiveSection.program_id!=='MIXED'){
							if(sub.year_level_id==$scope.ActiveSection.year_level_id)
								$scope.Subjects.push(sub);
						}else
							$scope.Subjects.push(sub);
					});
					getFees();
					getSchedules();
					$scope.TotalDue=0;	
				};
				
				if($scope.ActiveStep===4){
					$scope.HasSched = true;
					if($scope.ActiveSection.program_id=='MIXED'){
						$scope.ActiveSchedule = {};
						$scope.ActiveSchedule['schedule_details'] = $scope.CustomizedScheds;
					}
				};
				
				if($scope.ActiveStep===5){
					$scope.ActiveScheme= $scope.SelectedScheme;
					
					//$scope.TotalAmount=$scope.TotalDue + $scope.ActiveScheme.variance_amount;
					//$scope.TotalAdjustment = $scope.ActiveScheme.variance_amount;
				}
				if($scope.ActiveStep===6){
					$scope.ActiveDiscounts= [];
					for(var i in $scope.Discounts){
						var dsc =$scope.Discounts[i];
						if($scope.SelectedDiscounts[dsc.id]){
							$scope.ActiveDiscounts.push(dsc);
						}
					}
					$scope.TotalDiscount = 0;
					$scope.TotalAdjustment = 0;
					$scope.TotalAmount=0;
					/* for(var index in $scope.ActiveDiscounts){
						var discount  = $scope.ActiveDiscounts[index];
							discount.computed_amount = 0;
							discount.fees_amount = [];
						for(var i in discount.fees_applicable){
							var d = discount.fees_applicable[i];
							for(var t in $scope.ActiveTuition.fee_breakdowns){
								var f = $scope.ActiveTuition.fee_breakdowns[t];
								var amount = 0;
								
								if(f.id===d || d==='all'){
									if(discount.type==='percent'){
										amount=(discount.amount/100) * f.amount;
									}
									if(discount.type==='peso'){
										amount=discount.amount;
									}
									discount.fees_amount.push(amount);
									if( d==='all'){
										discount.fees_applicable[t]=f.id;
									}
									discount.computed_amount = discount.computed_amount + amount;
									$scope.TotalDiscount = $scope.TotalDiscount + amount;
								}
							}
						}
						$scope.ActiveDiscounts[index]= discount;
					} */
					
					angular.forEach($scope.ActiveDiscounts, function(dsc){
						if(dsc.type=='peso'){
							if($scope.ActiveScheme.scheme_id=='CASH'){
								$scope.TotalAmount = $scope.ActiveScheme.total_amount-dsc.amount;
								$scope.ActiveScheme.schedule[0].amount = $scope.ActiveScheme.total_amount-dsc.amount;
							}else{
								var total = 0;
								angular.forEach($scope.ActiveScheme.schedule, function(sched,index){
									if(sched.billing_period_id!='UPONNROL')
										total += sched.amount;
								});
								total = total - dsc.amount;
								var sched_amount = total/($scope.ActiveScheme.schedule.length-1);
								
								angular.forEach($scope.ActiveScheme.schedule, function(sched){
									if(sched.billing_period_id!='UPONNROL')
										sched.amount = sched_amount;
									$scope.TotalAmount += sched.amount;
								});
								
							}
							$scope.TotalDiscount+=dsc.amount;
						}
					});
					
					/* $scope.TotalDiscount = $scope.TotalDiscount*-1;
					$scope.TotalAdjustment = $scope.TotalDiscount + $scope.ActiveScheme.variance_amount;
					$scope.TotalAmount=$scope.TotalDue + $scope.TotalAdjustment; */
					/* console.log($scope.ActiveScheme.schedule);
					$scope.$watchCollection('ActiveScheme.schedule', function(newVal,oldval){
						console.log(newVal);
					}); */
				}
				
				if($scope.ActiveStep===7){
					
					/* var schedules = [];
					for(var i in $scope.ActiveScheme.schedule){
						var sched = $scope.ActiveScheme.schedule[i]
						var amount  = sched.amount;
						for(var j in sched.bill_months){
							var bill_month = sched.bill_months[j];
							var due_date = sched.due_dates[j];
							var schedule = {bill_month:bill_month,due_date:due_date,amount:amount};
							schedules.push(schedule);
						}
					}
					var adjustments = [];
					if($scope.ActiveScheme.variance_amount!=0){
						var adjustment = {};
						if($scope.ActiveScheme.variance_amount>0){
							adjustment = {item:$rootScope._APP.SPL_TRNX.INTEREST,amount:amount};
						}else{
							adjustment = {item:$rootScope._APP.SPL_TRNX.DISCOUNT,amount:amount};
						}
						adjustments.push(adjustment);
					}
					for(var j in $scope.ActiveDiscounts){
						var discount = $scope.ActiveDiscounts[j];
						for(var k in discount.fees_amount){
							var item_code = discount.fees_applicable[k];
							var amount = discount.fees_amount[k];
							var adjustment = {item:{code:item_code,flag:'-'},amount:amount};
							adjustments.push(adjustment);
						}
					}
					
					$scope.Assesment={
									  student:$scope.ActiveStudent.id,
									  sy:$rootScope._APP.ACTIVE_SY,
									  section_id:$scope.ActiveSection.id,
									  tuition_id:$scope.ActiveTuition.id,
									  scheme_id:$scope.ActiveScheme.id,
									  schedules:schedules,
									  adjustments:adjustments,
									  totals:{
											  gross:$scope.TotalDue,
											  net:$scope.TotalAmount
											 }
									};
					if($scope.ActiveScheme.variance_amount>=0){
							$scope.Assesment.totals.charges = $scope.ActiveScheme.variance_amount;
							$scope.Assesment.totals.discounts = $scope.TotalDiscount;
					}
					if($scope.ActiveScheme.variance_amount<0){
						$scope.Assesment.totals.charges = 0;
						$scope.Assesment.totals.discounts = $scope.TotalAdjustment;
					}
					$scope.AssesmentSaving = true;
					api.POST('assessments',$scope.Assesment,function success(response){
						$scope.openModal();
					}); */
					
					$scope.ActiveStudent.payment_scheme = $scope.ActiveScheme.scheme_id;
					$scope.ActiveStudent.assessment_total = $scope.TotalAmount + $scope.TotalDiscount;
					$scope.ActiveStudent.year_level_id = $scope.ActiveSection.year_level_id;
					$scope.ActiveStudent.outstanding_balance = $scope.TotalAmount;
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
					api.POST('assessments',$scope.Assessment, function success(response){
						initAssessment();
						initDataSource();
					});
				}
				if($scope.ActiveStep<$scope.Steps.length){
					$scope.ActiveStep++;
				}
			};
			$scope.prevStep = function(){
				if($scope.ActiveStep>1){
					$scope.ActiveStep--;
				};
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
				$scope.SelectedStudent = {
										 id:student.id,
										 name:student.first_name+" "+student.middle_name+" "+student.last_name+" "+student.suffix_name,
										 yearlevel:student.year_level_id,
										 department_id:student.department_id,
										 student_id:student.student_id
				                         };
			};
			$scope.filterYearLevel = function(yearlevel){
				return yearlevel.order >= $scope.ActiveOrder && yearlevel.order <= $scope.ActiveOrder+1 || yearlevel.id=='IR';
			}
			$scope.setSelectedLevel=function(yearLevel){
				$scope.SelectedLevel = {
										id: yearLevel.id,
										educ_level_id: yearLevel.educ_level_id,
										name: yearLevel.name
									   };
			};
			$scope.setSelectedSection=function(section){
				$scope.SelectedSection = section;
			};
			$scope.setSelectedScheme=function(paymentScheme){
				$scope.SelectedScheme=paymentScheme;
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
			$scope.openModal=function(){
				var modalInstance = $uibModal.open({
						animation: true,
						size:'sm',
						templateUrl: 'successModal.html',
						controller: 'SuccessModalController',
					});
					modalInstance.result.then(function () {
					  
					}, function (source) {
						$scope.init();
					});
			}
			
			$scope.SearchStudent = function(){
				$scope.Search = 1;
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
				api.GET('students',data,success,error);
			}
			
			$scope.ClearSearch = function(){
				$scope.Search = 0;
				$scope.SearchWord = '';
				$scope.Students = '';
				api.GET('students',data, function success(response) {
					$scope.Students = response.data;
				});
			}
			
			$scope.AddSched = function(subject,index,sec){
				subject.section_id = sec.id;
				$scope.CustomizedScheds.push(subject);
				$scope.sec.schedule_details.splice(index,1);
			}
			
			$scope.removeSched = function(subject,index){
				$scope.CustomizedScheds.splice(index,1);
				$scope.sec.schedule_details.push(subject);
			}
			
			$scope.setActiveOpt = function(opt){
				$scope.Students = '';
				$scope.NoInquiries = 0;
				$scope.ActiveOpt = opt;
				getStudents();
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
			
			function getFees(){
				var data = {year_level_id:$scope.ActiveSection.year_level_id}
				api.GET('tuitions',data, function success(response){
					$scope.ActiveTuition = response.data[0];
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
				});
			}
			
			function getBillingPeriods(){
				api.GET('billing_periods', function success(response){
					$scope.BillingPeriods = response.data;
				});
			}
			
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
										if(sec.year_level_id==sub.year_level_id)
											details.push({'subject':sub.name,'subject_id':sub.code,'no_sched':true,'year_level_id':sub.year_level_id});
									});
									sec.schedule_details = details;
								}
							});
							$scope.LoadingSec = false;
						});
					}
				}, function error(response){
					$scope.ActiveSchedule = {};
					var details = [];
					angular.forEach($scope.Subjects, function(sub){
						details.push({'subject':sub.name,'subject_id':sub.code,'no_sched':true});
					});
					$scope.ActiveSchedule.schedule_details = details;
					console.log($scope.ActiveSchedule);
				});
			}
			
			function getCurriculum(dept){
				var data ={
					esp: 2020.25,
					department_id:dept
				}
				api.GET('curriculums',data, function success(response){
					$scope.Curriculum = response.data[0];
				});
			}
		};
    }]);
	app.register.controller('SuccessModalController',['$scope','$rootScope','$timeout','$uibModalInstance','api', function ($scope,$rootScope,$timeout, $uibModalInstance, api){
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


