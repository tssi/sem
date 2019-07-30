"use strict";
define(['app','api'], function (app) {
    app.register.controller('CollegeAssesmentController',['$scope','$rootScope','$uibModal','api', function ($scope,$rootScope,$uibModal,api) {
		$scope.init = function(){
			$rootScope.__MODULE_NAME = 'College Assesment';
			$scope.Steps = [
				{id:1, title:"Student", description:"Select Student"},
				{id:2, title:"Subjects", description:"Select Subjects"},
				{id:3, title:"Schedule", description:"Select Schedule"},
				{id:4, title:"Payment Scheme", description:"Select Payment Scheme"},
				{id:5, title:"Discount", description:"Select Discount"},
				{id:6, title:"Confirmation", description:"Confirmation"}
			];
			$scope.ActiveStep = 1;
			$scope.ActiveStudent = [];
			getStudents();
		};
		
		
		$scope.setSelectedStudent = function(stud){
			$scope.SelectedStudent = stud;
			$scope.SelectedStudent.name = stud.first_name +' '+ stud.middle_name +' '+ stud.last_name +' '+ stud.suffix_name;
		};
		
		$scope.nextStep = function(){
			if($scope.ActiveStep<$scope.Steps.length){
				$scope.ActiveStep++;
				if($scope.ActiveStep===2){
					getSubjects();
				}
				if($scope.ActiveStep===3){
					getSections();
				}
			}
		};
		
		$scope.SelectedSubjects = [];
		$scope.PickSubjects = function(subject,index){
			subject['active']=1;
			$scope.SelectedSubjects.push(subject);
		};
		
		$scope.SetSection = function(sec){
			$scope.ActiveSection = sec;
			getSchedule();
		};
		
		$scope.SearchStudent = function(){
			var data = {
				keyword:$scope.SearchWord,
				fields:[
				'first_name','last_name','middle_name'
				],
			};
			var success = function(response){
				$scope.Students = response.data;
			};
			var error = function(response){
				$scope.NoRecords = true;
			};
			api.GET('college_students',data,success,error);
		};
		
		function getStudents(){
			api.GET('college_students',function success(response){
				$scope.Students = response.data;
			});
		};
		
		function getSubjects(){
			var success = function(response){
				$scope.Subjects = response.data;
			};
			var error = function(response){
				
			};
		
			api.GET('college_subjects', success, error);
		};
		
		function getSections(){
			var success = function(response){
				console.log(response.data);
				$scope.Sections = response.data;
			};
			var error = function(response){
				
			};
			var data = {
				program_id : $scope.SelectedStudent.program_id
			};
			api.GET('college_sections', success, error);
		};
		
		function getSchedule(){
			var success = function(response){
				console.log(resopnse.data);
				$scope.ClassSchedules = response.data;
			};
			var error = function(){
				
			};
			var data = {
				program_id: $scope.SelectedStudent.program_id
			};
			api.GET('class_schedules', data, success, error);
		};
		
		function getScheduleDetails(){
			var success = function(response){
				
			};
			var error = function(){
				
			};
			var data = {
				
			};
			api.GET('class_sched_details', data, success, error);
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


