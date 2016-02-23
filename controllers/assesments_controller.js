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
				}
				if($scope.ActiveStep===3){
					$scope.ActiveSection = $scope.SelectedSection;
					$scope.ActiveTuition = null;
					for(var i in $scope.Tuitions){
						var t = $scope.Tuitions[i];
						if(t.year_level_id===$scope.ActiveLevel.id && t.program_id===$scope.ActiveSection.program_id){
							$scope.ActiveTuition=t;
							break;
						}
					};
					$scope.TotalDue=0;	
					for(var i in $scope.ActiveTuition.fees){
						var a = $scope.ActiveTuition.fees[i]
						$scope.TotalDue = $scope.TotalDue + a.amount;
					};
					$scope.PaymentSchemes=$scope.ActiveTuition.schemes;
					$scope.Discounts=$scope.ActiveTuition.discounts;
					$scope.TotalAmount=$scope.TotalDue;
				};
				if($scope.ActiveStep===4){
					$scope.ActiveScheme= $scope.SelectedScheme;
					$scope.TotalAmount=$scope.TotalDue + $scope.ActiveScheme.variance_amount;
					$scope.TotalAdjustment = $scope.ActiveScheme.variance_amount;
				}
				if($scope.ActiveStep===5){
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
					for(var index in $scope.ActiveDiscounts){
						var discount  = $scope.ActiveDiscounts[index];
							discount.computed_amount = 0;
							discount.fees_amount = [];
						for(var i in discount.fees_applicable){
							var d = discount.fees_applicable[i];
							for(var t in $scope.ActiveTuition.fees){
								var f = $scope.ActiveTuition.fees[t];
								var amount = 0;
								
								if(f.id===d || d==='all'){
									if(discount.type==='percent'){
										amount=(discount.amount/100) * f.amount;
									}
									if(discount.type==='peso'){
										amount=discount.amount;
									}
									discount.fees_amount.push(amount);
									discount.computed_amount = discount.computed_amount + amount;
									$scope.TotalDiscount = $scope.TotalDiscount + amount;
								}
							}
						}
					}
					$scope.TotalDiscount = $scope.TotalDiscount*-1;
					$scope.TotalAdjustment = $scope.TotalDiscount + $scope.ActiveScheme.variance_amount;
					$scope.TotalAmount=$scope.TotalDue + $scope.TotalAdjustment;
				}
				if($scope.ActiveStep===6){
					var schedules = [];
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
			$scope.setSelectedStudent=function(student){
				$scope.SelectedStudent = {
										 id:student.id,
										 name:student.first_name+" "+student.middle_name+" "+student.last_name+" "+student.suffix_name,
										 yearlevel:student.year_level_id
				                         };
			};
			$scope.filterYearLevel = function(yearlevel){
				return yearlevel.order >= $scope.ActiveOrder && yearlevel.order <= $scope.ActiveOrder+2;
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
			function bootstrap(){
				$rootScope.__MODULE_NAME = 'Assessment';
				$scope.Steps = [
					{id:1, title:"Student", description:"Select Student"},
					{id:2, title:"Level", description:"Select Level"},
					{id:3, title:"Section", description:"Select Section"},
					{id:4, title:"Payment Scheme", description:"Select Payment Scheme"},
					{id:5, title:"Discount", description:"Select Discount"},
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
					if($scope.TotalDiscount&&$scope.hasScheduleInfo)
						computePaymentSchedule();
					
				});
			}
			function initAssessment(){
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
				};
			function initDataSource(){
				$scope.Students=[];
				$scope.YearLevels=[];
				$scope.Sections=[];
				$scope.Tuitions=[];
				$scope.PaymentSchemes=[];
				$scope.Discounts=[];
				api.GET('students',function success(response){
					$scope.Students = response.data;
				});
				api.GET('year_levels',function success(response){
					$scope.YearLevels = response.data;
				});
				api.GET('sections',function success(response){
					$scope.Sections = response.data;
				});
				api.GET('tuitions',function success(response){
					$scope.Tuitions = response.data;
				});
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
	
});


