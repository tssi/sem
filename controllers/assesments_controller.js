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
			$scope.ActiveOrder = null;
			};
			$scope.init();
			$scope.Steps = [
				{id:1, description:"Select Student"},
				{id:2, description:"Select Level"},
				{id:3, description:"Select Section"},
				{id:4, description:"Select Payment Scheme"},
				{id:5, description:"Select Discount"},
				{id:6, description:"Confirmation"}
			];
			$scope.Students=[];
			api.GET('students',function success(response){
				console.log(response.data);
				$scope.Students = response.data;
			});
			$scope.YearLevels=[];
			api.GET('year_levels',function success(response){
				console.log(response.data);
				$scope.YearLevels = response.data;
			});
			$scope.Sections=[];
			api.GET('sections',function success(response){
				console.log(response.data);
				$scope.Sections = response.data;
			});
			$scope.PaymentSchemes=[];
			$scope.Tuitions=[];
			api.GET('tuition',function success(response){
				console.log(response.data);
				$scope.Tuitions = response.data;
				$scope.PaymentSchemes=$scope.Tuitions[0].schemes;
				
			});
			$scope.Discounts=[];
			$scope.Tuitions=[];
			api.GET('tuition',function success(response){
				console.log(response.data);
				$scope.Tuitions = response.data;
				$scope.Discounts=$scope.Tuitions[0].discounts;
				
			});
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
			//if($scope.ActiveStep===3){
				//$scope.sendInfo();
			//};
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
		};
    }]);
});


