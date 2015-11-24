"use strict";
define(['app','api'], function (app) {
    app.register.controller('AssesmentController',['$scope','$rootScope','api', function ($scope,$rootScope,api) {
		$scope.index = function(){
			$scope.init = function(){
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
				$scope.SelectedDiscount={};
				$scope.ActiveDiscount={};
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
				$scope.hasAdjustmentInfo = false;
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
				$scope.$watch('ActiveScheme',function(){
					$scope.hasSchemeInfo = $scope.ActiveScheme.id;
					$scope.hasAdjustmentInfo = $scope.hasAdjustmentInfo || $scope.ActiveScheme.interest_charge;
				});
				$scope.$watch('TotalDiscount',function(){
					$scope.hasAdjustmentInfo = $scope.hasAdjustmentInfo || $scope.TotalDiscount;	
				});
				function updateHasInfo(){
					$scope.hasInfo = $scope.hasStudentInfo || $scope.hasLevelInfo || $scope.hasSectionInfo || $scope.hasSchemeInfo || $scope.hasAdjustmentInfo;
				};
			};
			$scope.init();
			$scope.Steps = [
				{id:1, title:"Student", description:"Select Student"},
				{id:2, title:"Level", description:"Select Level"},
				{id:3, title:"Section", description:"Select Section"},
				{id:4, title:"Payment Scheme", description:"Select Payment Scheme"},
				{id:5, title:"Discount", description:"Select Discount"},
				{id:6, title:"Confirmation", description:"Confirmation"}
			];
			$scope.Students=[];
			api.GET('students',function success(response){
				console.log(response.data);
				$scope.Students = response.data;
			});
			$scope.YearLevels=[];
			var data={limit:13};
			api.GET('year_levels',data,function success(response){
				console.log(response.data);
				$scope.YearLevels = response.data;
			});
			$scope.Sections=[];
			api.GET('sections',function success(response){
				console.log(response.data);
				$scope.Sections = response.data;
			});
			$scope.Tuitions=[];
			$scope.PaymentSchemes=[];
			$scope.Discounts=[];
			api.GET('tuition',function success(response){
				console.log(response.data);
				$scope.Tuitions = response.data;
			});
			$scope.nextStep = function(){
			if($scope.ActiveStep===1){
				$scope.ActiveStudent = $scope.SelectedStudent;
				$scope.ActiveOrder = null;
				
				console.log($scope.ActiveStudent,$scope.YearLevels);
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
					if(t.year_level_id===$scope.ActiveLevel.id && t.program===$scope.ActiveSection.program){
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
				
				
							
			};
			if($scope.ActiveStep===4){
				$scope.ActiveScheme= $scope.SelectedScheme;
				
			}
			if($scope.ActiveStep===5){
				$scope.ActiveDiscount= $scope.SelectedDiscount;
				$scope.TotalDiscount = 0;
				$scope.TotalAdjustment = 0;
				$scope.TotalAmount=0;
				for(var i in $scope.ActiveDiscount.fees_applicable){
					var d = $scope.ActiveDiscount.fees_applicable[i];
					for(var t in $scope.ActiveTuition.fees){
						var f = $scope.ActiveTuition.fees[t];
						var amount = 0;
						if(f.id===d || d==='all'){
							if($scope.ActiveDiscount.type==='percent'){
								amount=($scope.ActiveDiscount.amount/100) * f.amount;
							}
							if($scope.ActiveDiscount.type==='peso'){
								amount=$scope.ActiveDiscount.amount;
							}
							//console.log($scope.ActiveDiscount.type,amount,f.amount);
							$scope.TotalDiscount = $scope.TotalDiscount + amount;
						}
					}
				}
				$scope.TotalDiscount = $scope.TotalDiscount*-1;
				$scope.TotalAdjustment = $scope.TotalDiscount + $scope.ActiveScheme.interest_charge;
				$scope.TotalAmount=$scope.TotalDue + $scope.TotalAdjustment;
			}
			if($scope.ActiveStep===6){
				$scope.Assesment={
								  student:$scope.ActiveStudent.id,
								  tuition:$scope.ActiveTuition.id,
								  scheme:$scope.ActiveScheme.id,
								  discount:$scope.ActiveDiscount.id,
								  totals:{
										  gross:$scope.TotalDue,
										  charges:$scope.ActiveScheme.interest_charge,
										  discounts:$scope.TotalAdjustment,
										  net:$scope.TotalAmount
										 }
								};
				api.POST('assessments',$scope.Assesment,function success(response){
					console.log(response);
					$scope.init();
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
			$scope.setSelecetedStudent=function(student){
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
					$scope.SelectedDiscount={};
					$scope.ActiveDiscount={};
					$scope.TotalDiscount=null;
				}	
			};
		};
    }]);
});


