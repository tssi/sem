"use strict";
define(['app','api'], function (app) {
    app.register.controller('StudentController',['$scope','$rootScope','$uibModal','api', function ($scope,$rootScope,$uibModal,api) {
		$scope.index = function(){
			$rootScope.__MODULE_NAME = 'Inquiry';
			$scope.init = function(){
			$scope.Student={};
			$scope.families=[];
			$scope.hasBasicInfo=false;
			$scope.hasContactInfo=false;
			$scope.ActiveStep=1;
			};
			$scope.init();
			$scope.Departments=[];
			api.GET('educ_levels',function success(response){
				console.log(response.data);
				$scope.Departments=response.data;	
			});
			$scope.Steps = [
				{id:1, description:"Basic Information"},
				{id:2, description:"Contact Information"},
				{id:3, description:"Confirmation"}
			];
			$scope.YearLevels=[];
			api.GET('year_levels',function success(response){
				console.log(response.data);
				$scope.YearLevels = response.data;
			});
			$scope.Countries=[];
			api.GET('countries',function success(response){
				$scope.Countries = response.data;
			});
			$scope.Provinces=[];
			api.GET('provinces',function success(response){
				$scope.Provinces = response.data;
			});
			$scope.Cities=[];
			api.GET('cities',function success(response){
				$scope.Cities = response.data;
			});
			$scope.Religions=[];
			api.GET('religions',function success(response){
				$scope.Religions = response.data;
			});
			$scope.Citizenships=[];
			api.GET('citizenships',function success(response){
				$scope.Citizenships = response.data;
			});
			$scope.nextStep = function(){
			if($scope.ActiveStep===1){
				$scope.basicInfo();
			}
			if($scope.ActiveStep===2){
				$scope.contactInfo();
			}
			if($scope.ActiveStep===3){
				$scope.sendInfo();
			};
			if($scope.ActiveStep<$scope.Steps.length){
				$scope.ActiveStep++;
			}
			};
			$scope.prevStep = function(){
				if($scope.ActiveStep>1){
					$scope.ActiveStep--;
				};
			};
			$scope.getId = function(department){
				$scope.educID=department.id;
				//console.log($scope.educID);
			};
			$scope.getGender=function(gender){
				$scope.gender = gender;
			};
			$scope.updateStep=function(step){
				$scope.ActiveStep = step.id;
			};
			$scope.basicInfo=function(){
				$scope.Student.educ_level_id=$scope.educID;
				$scope.Student.year_level_id=$scope.level;
				$scope.Student.first_name=$scope.firstName;
				$scope.Student.middle_name=$scope.middleName;
				$scope.Student.last_name=$scope.lastName;
				$scope.Student.suffix_name=$scope.suffix;
				$scope.Student.gender=$scope.gender;
				$scope.Student.birthday=$scope.birthday;
				$scope.Student.birthplace=$scope.birthPlace;
				$scope.Student.religion=$scope.religion;
				$scope.Student.citizenship=$scope.citizenship;
				$scope.Student.family=$scope.families;
				$scope.Student.prev_school=$scope.prevSchool;
				$scope.hasBasicInfo = true;
			};
			$scope.contactInfo=function(){
				$scope.Student.contact_numbers=[];
				var landline = {type:'landline', number:$scope.landline};
				var mobile = {type:'mobile', number:$scope.mobile};
				$scope.Student.contact_numbers.push(landline);
				$scope.Student.contact_numbers.push(mobile);
				var current = {	type:'current',
								country:$scope.currentCountry,
								province:$scope.currentProvince,
								city:$scope.currentCity,
								barangay:$scope.currentBrgy,
								address:$scope.currentAddrs,
								};
				var permanent = {type:'permanent',
								country:$scope.homeCountry,
								province:$scope.homeProvince,
								city:$scope.homeCity,
								barangay:$scope.homeBrgy,
								address:$scope.homeAddrs,
								};
				$scope.Student.addresses=[];
				$scope.Student.addresses.push(current);
				$scope.Student.addresses.push(permanent);
				$scope.hasContactInfo = true;
			};
			$scope.sameAsCurrent = function(){
				var country = $scope.currentCountry;
				$scope.homeCountry = country;
				$scope.homeProvince = angular.copy($scope.currentProvince);
				$scope.homeCity = angular.copy($scope.currentCity);
				$scope.homeBrgy = angular.copy($scope.currentBrgy);
				$scope.homeAddrs = angular.copy($scope.currentAddrs);
			}
			$scope.addFamily = function(){
				var family={
							type:$scope.relationship,
							name:$scope.parentName,
							occupation:$scope.occupation
						   };
				$scope.families.push(family);
				$scope.relationship=null;
				$scope.parentName=null;
				$scope.occupation=null;
			};
			$scope.removeFamily = function(index){
				$scope.families.splice(index, 1);
			};
			$scope.sendInfo = function(){
				$scope.SavingInquiry  = true;
				api.POST('students',$scope.Student,function success(response){
					$scope.SavingInquiry  = false;
					$scope.openModal();
				});
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
							$scope.clearField();
							$scope.clearField2();
						});
			}
			$scope.clearField=function(){
				$scope.educID = null;
				$scope.level = null;
				$scope.firstName = null;
				$scope.middleName = null;
				$scope.lastName = null;
				$scope.suffix = null;
				$scope.gender = null;
				$scope.birthday = null;
				$scope.birthPlace = null;
				$scope.families=[];
				$scope.religion = null;
				$scope.citizenship = null;
				$scope.prevSchool=null;
			};
			$scope.clearField2=function(){
				$scope.landline = null;
				$scope.mobile = null;
				$scope.currentCountry = null;
				$scope.currentProvince = null;
				$scope.currentCity = null;
				$scope.currentBrgy = null;
				$scope.currentAddrs = null;
				$scope.homeCountry = null;
				$scope.homeProvince = null;
				$scope.homeCity = null;
				$scope.homeBrgy = null;
				$scope.homeAddrs = null;
			};
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


