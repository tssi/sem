"use strict";
define(['app','api'],function(app){
	app.register.controller('CollegeInquiryController',['$scope','$rootScope','$uibModal','api',
	function($scope,$rootScope,$uibModal,api){
		$scope.init = function(){
			$rootScope.__MODULE_NAME = 'College Inquiry';
			$scope.Steps = [
				{id:1, description:"Basic Information"},
				{id:2, description:"Contact Information"},
				{id:3, description:"Confirmation"}
			];
			$scope.ActiveStep = 1;
			api.GET('educ_levels',function success(response){
				$scope.Departments=response.data;	
			});
			api.GET('year_levels',function success(response){
				$scope.YearLevels = response.data;
			});
			api.GET('countries',function success(response){
				$scope.Countries = response.data;
			});
			api.GET('provinces',function success(response){
				$scope.Provinces = response.data;
			});
			api.GET('cities',function success(response){
				$scope.Cities = response.data;
			});
			api.GET('religions',function success(response){
				$scope.Religions = response.data;
			});
			api.GET('citizenships',function success(response){
				$scope.Citizenships = response.data;
			});
			api.GET('programs',function success(response){
				$scope.Programs = response.data;
			});
			api.GET('college_curriculums',function success(response){
				$scope.Curriculums = response.data;
			});
			$scope.NoInfo = true;
			$scope.Student = {};
		};
		
		$scope.NextStep = function(){
			if($scope.ActiveStep===1){
				$scope.basicInfo();
			}
			if($scope.ActiveStep===2){
				$scope.contactInfo();
			}
			if($scope.ActiveStep===3){
				$scope.sendInfo();
			};
			
			if($scope.ActiveStep<$scope.Steps.length)
				$scope.ActiveStep++;
			
			console.log($scope.Student);
		};
		$scope.PrevStep = function(){
			$scope.ActiveStep--;
		};
		$scope.SetActiveDept = function(dept){
			$scope.ActiveDept = dept;
		};
		$scope.getGender=function(gender){
			$scope.gender = gender;
		};
		$scope.updateStep=function(step){
			$scope.ActiveStep = step.id;
		};
		$scope.basicInfo=function(){
			console.log($scope.department);
			$scope.Student.program_id=$scope.program;
			$scope.Student.educ_level_id=$scope.department;
			$scope.Student.curriculum_id=$scope.curriculum;
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
			$scope.NoInfo = false;
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
		$scope.sendInfo = function(){
			$scope.InquirySaving  = true;
			api.POST('students',$scope.Student,function success(response){
				$scope.InquirySaving  = false;
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
			$scope.department = null;
			$scope.curriculum = null;
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
	}]);

});