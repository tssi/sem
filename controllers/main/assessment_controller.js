"use strict";
define(['app','api','atomic/bomb'],function(app){
	app.register.controller('AssessmentController',['$rootScope','$scope','api','Atomic','aModal','$http','$filter','$uibModal',

	function($rootScope,$scope,api,atomic, aModal,$http,$filter,$uibModal){
		const $selfScope = $scope;
		$scope = this;
		$scope.init = function(){
			$rootScope.__MODULE_NAME = 'Assessment';
			$rootScope.$watch('_APP', function (data){
				if(data){
					$scope.ActiveSy  =  data.ACTIVE_SY;
					$scope.Defaults  =  data.DEFAULT_;
					$scope.ActiveSem = $scope.Defaults.SEMESTER
					$scope.ActiveEsp = $scope.ActiveSy+($scope.ActiveSem.id/100);
					$scope.StudTypes = [
							{id:'REG',name:'Regular'},
							{id:'ESC',name:'ESC'}
						];
					$scope.StudFields = ['sno','lrn','gender','year_level','section','department_id','year_level_id','section_id','subsidy_status','program_id']
					$scope.ShowSched = 0;
					getBP();
					getYearLevels();
					getSections();
					$scope.Saving = 0;
				}
			});
			
		}
		
		function initData(){
			$scope.ActiveStudent = {};
			$scope.Subjects = [];
		}
		
		function getYearLevels(){
			api.GET('year_levels',{limit:'less'}, function success(response){
				$scope.YL = response.data;
			})
		}
		function getSections(){
			api.GET('sections',{limit:'less'}, function success(response){
				$scope.Sections = response.data;
			})
		}

		function getTuitions(){
			let filter = {
				applicable_to: 'Old',
				sy: $scope.ActiveSy,
				year_level_id: $scope.year_level_id
			}
			api.GET('tuitions',filter, function success(response){
				$scope.Tuition = response.data[0];
				let tuition = $scope.Tuition;
				$scope.Schemes = [];
				angular.forEach(tuition.schemes, function(s){
					$scope.Schemes.push(s);					
				});
				
			})
		}
		
		function getBP(){
			api.GET('billing_periods',{sy:$scope.ActiveSy, limit:'less'}, function success(response){
				$scope.billing_periods = response.data;
			})
		}
		
		function getCurriSec(){
			let filter = {
				section_id:$scope.section_id,
				esp:$scope.ActiveEsp
			}
			if($scope.ActiveStudent.department_id!='SH'&&$scope.ActiveStudent.year_level_id!='GX')
				filter.esp = $scope.ActiveSy;
			api.GET('curriculum_sections',filter,function success(response){
				let cid = response.data[0].curriculum_id;
				getCurriculum(cid);
			});
		}
		
		function getCurriculum(cid){
			api.GET('curriculums',{id:cid}, function success(response){
				$scope.Curriculum = response.data[0];
				let subjects = [];
				angular.forEach(response.data[0].subjects, function(sub){
					if($scope.year_level_id==sub.year_level_id)
						subjects.push(sub);
				});
				$scope.Subjects = subjects;
			});
		}
		
		$scope.selectSection = function(){
			getTuitions();
			getCurriSec();
		}

		$scope.SelectScheme = function(scheme){
			$scope.Scheme = scheme;
			
			let net = 0;
			angular.forEach(scheme.schedule, function(s){
				net+=s.amount;
			})
			$scope.PaySched = scheme.schedule;
			$scope.TotalDue = net;
			$scope.ShowSched = 1;
		}
		
		$scope.SetYearLevel = function(stud){
			let yls = [];
			angular.forEach($scope.YL, function(y){
				yls.push(y.id);
			})
			console.log(yls);
			console.log(yls[stud.year_level_id]);
		}
		
		$scope.SaveAssessment = function(){
			$scope.Saving = 1;
			let account = {
				id: $scope.ActiveStudent.id,
				year_level_id: $scope.year_level_id,
				outstanding_balance : $scope.TotalDue,
				section_id : $scope.section_id,
				discount_amount : $scope.Scheme.variance_amount,
				assessment_total : $scope.Tuition.assessment_total,
				payment_scheme : $scope.Scheme.scheme_id,
				status: 'active',
				subsidy_status: $scope.Scheme.subsidy_status,
				department_id: $scope.Curriculum.department_id,
				program_id: '',
				esp: $scope.ActiveEsp
			}
			angular.forEach($scope.Subjects, function(sub){
				sub['section_id'] = $scope.section_id;
				sub['subject_id'] = sub.code;
			})
			var Assessment = {
				assessment: account, 
				fees: $scope.Tuition.fee_breakdowns, 
				paysched: $scope.PaySched,
				Schedule : $scope.Subjects
			};
			
			//console.log($scope.ActiveStudent); return;
			api.POST('assessments', Assessment, function success(response){
				$scope.AssessmentId = response.data.id;
				$scope.Saving = 0;
				$scope.openModal();
			})
		}
		
		$scope.openModal = function(){
			var modalInstance = $uibModal.open({
				animation: true,
				size:'sm',
				templateUrl: 'assessmentModal.html',
				controller: 'SuccessAssessModalController',
				resolve:{
					assessmentId:function(){
						return $scope.AssessmentId;
					}
				}
			});
			modalInstance.result.then(function (source) {
				
			}, function (source) {
				$scope.initData();
			});
		}
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
	
});