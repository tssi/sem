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
			$scope.Days = [
				{'id':'M','desc':'Mon'},
				{'id':'T','desc':'Tues'},
				{'id':'W','desc':'Wed'},
				{'id':'TH','desc':'Thu'},
				{'id':'F','desc':'Fri'},
				{'id':'S','desc':'Sat'},
			];
			$scope.ActiveStep = 1;
			
			getStudents();
			$scope.Customize = false;
		};
		var Schedules = [];
		$scope.SubjectsEnrolled = [];
		$scope.SelectedSchedule = [];
		$scope.setSelectedStudent = function(stud){
			$scope.SelectedStudent = stud;
			$scope.SelectedStudent.name = stud.first_name +' '+ stud.middle_name +' '+ stud.last_name +' '+ stud.suffix_name;
		};
		
		$scope.nextStep = function(){
			if($scope.ActiveStep<$scope.Steps.length){
				$scope.ActiveStep++;
				if($scope.ActiveStep===2){
					$scope.ActiveStudent = $scope.SelectedStudent;
					getSubjects();
				}
				if($scope.ActiveStep===3){
					$scope.SubjectsEnrolled = $scope.SelectedSubjects;
					$scope.level2 = true;
					$scope.SelectedSubjects = [];
					getSections();
					getSchedule();
				}
				if($scope.ActiveStep===4){
					$scope.SelectedSchedule = Schedules;
					Schedules = [];
				}
			}
		};
		$scope.prevStep = function(){
			$scope.ActiveStep--;
		};
		$scope.SelectedSubjects = [];
		$scope.PickSubjects = function(subject,index){
			subject['active']=1;
			$scope.SelectedSubjects.push(subject);
		};
		
		$scope.SetSection = function(sec){
			$scope.ActiveSection = sec;
			var sch = {};
			angular.forEach($scope.ClassSchedules, function(sched){
				if(sec.id==sched.section_id){
					angular.forEach(sched.details,function(detail){
						sch['id']=sched.id;
						sch['subject']=sched.subject;
						sch['detail']=detail;
						Schedules.push(sch);
						sch = {};
					});
				}
			});
			console.log(Schedules);
		};
		
		$scope.SetCustomSched = function(sched,detail){
			var schedule = {};
			schedule['id']=sched.id;
			schedule['subject']=sched.subject;
			schedule['detail'] = detail;
			Schedules.push(schedule);
		};
		
		$scope.CustomizeSched = function(){
			$scope.Customize = true;
			$scope.SelectedSchedule = [];
		};
		$scope.Block = function(){
			$scope.Customize = false;
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
			api.GET('college_sections', data, success, error);
		};
		
		function getSchedule(){
			var success = function(response){
				var scheds = response.data;
				$scope.ClassSchedules = [];
				angular.forEach(scheds, function(sched){
					angular.forEach($scope.SubjectsEnrolled, function(sub){
						if(sub.id===sched.subject_id){
							$scope.ClassSchedules.push(sched);
						}
					});
				});
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


