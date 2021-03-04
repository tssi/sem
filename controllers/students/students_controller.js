"use strict";
define(['app','api'], function (app) {
    app.register.controller('StudentController',['$scope','$rootScope','$filter','$uibModal','api', function ($scope,$rootScope,$filter,$uibModal,api) {
		$scope.index = function(){
			$rootScope.__MODULE_NAME = 'Inquiry';
			$scope.init = function(){
				$scope.Student={};
				$scope.families=[];
				$scope.hasBasicInfo=false;
				$scope.hasContactInfo=false;
				$scope.ActiveStep=1;
				$scope.Countries=['Philippines'];
				$scope.Provinces=['Batangas'];
				$scope.Cities=['Balayan'];
			};
			$scope.init();
			$scope.Departments=[];
			api.GET('departments',function success(response){
				$scope.Departments=response.data;	
			});
			$scope.Steps = [
				{id:1, description:"Basic Information"},
				{id:2, description:"Contact Information"},
				{id:3, description:"Confirmation"}
			];
			$scope.YearLevels=[];
			api.GET('year_levels',{limit:'less'},function success(response){
				$scope.YearLevels = response.data;
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
			
			$scope.setActiveDept = function(dept){
				$scope.ActiveDepartment = dept;
			}
			
			$scope.getGender=function(gender){
				$scope.gender = gender;
			};
			$scope.updateStep=function(step){
				$scope.ActiveStep = step.id;
			};
			$scope.basicInfo=function(){
				$scope.Student.department_id=$scope.ActiveDepartment.id;
				$scope.Student.year_level_id=$scope.level.id;
				$scope.Student.first_name=$scope.firstName;
				$scope.Student.middle_name=$scope.middleName;
				$scope.Student.last_name=$scope.lastName;
				$scope.Student.suffix_name=$scope.suffix;
				$scope.Student.gender=$scope.gender;
				$scope.Student.birthday=$filter('date')($scope.birthday,'yyyy-MM-dd');
				$scope.Student.birthplace=$scope.birthPlace;
				$scope.Student.citizenship=$scope.citizenship;
				$scope.Student.prev_school=$scope.prevSchool;
				$scope.Student.civil_status=$scope.civilStatus;
				$scope.hasBasicInfo = true;
			};
			$scope.contactInfo=function(){
				$scope.Student.landline=$scope.landline;
				$scope.Student.mobile=$scope.mobile;
				$scope.Student.c_country=$scope.currentCountry,
				$scope.Student.c_province=$scope.currentProvince,
				$scope.Student.c_city=$scope.currentCity,
				$scope.Student.c_barangay=$scope.currentBrgy,
				$scope.Student.c_address=$scope.currentAddrs,
				
				$scope.Student.country=$scope.homeCountry,
				$scope.Student.province=$scope.homeProvince,
				$scope.Student.city=$scope.homeCity,
				$scope.Student.barangay=$scope.homeBrgy,
				$scope.Student.address=$scope.homeAddrs,
				$scope.Student.g_first_name = $scope.gfirstName;
				$scope.Student.g_middle_name = $scope.gmiddleName;
				$scope.Student.g_last_name = $scope.glastName;
				$scope.Student.g_suffix = $scope.gsuffix;
				$scope.Student.g_rel = $scope.grel;
				$scope.Student.g_contact_no = $scope.gcontact;
				$scope.Student.g_occupation = $scope.goccu;
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
				$scope.InquirySaving  = true;
				api.POST('inquiries',$scope.Student,function success(response){
					$scope.InquirySaving  = false;
					$scope.openModal();
					$scope.clearField();
					$scope.clearField2();
				});
			}
			$scope.openModal=function(){
				var modalInstance = $uibModal.open({
					animation: true,
					size:'sm',
					templateUrl: 'successModal.html',
					controller: 'SuccessModalController',
				});
				modalInstance.result.then(function (source) {
					$scope.init();
				}, function (source) {
					$scope.init();
				});
			}
			$scope.clearField=function(){
				$scope.ActiveDepartment = null;
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
				$scope.civilStatus=null;
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
				$scope.gfirstName = null;
				$scope.glastName = null;
				$scope.gmiddleName = null;
				$scope.gsuffix = null;
				$scope.grel = null;
				$scope.gcontact = null;
				$scope.goccu = null;
				
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


