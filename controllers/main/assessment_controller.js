"use strict";
define(['app','api','atomic/bomb'],function(app){
	app.register.controller('AssessmentController',['$rootScope','$scope','api','Atomic','aModal','$http','$filter','$uibModal',

	function($rootScope,$scope,api,atomic, aModal,$http,$filter,$uibModal){
		const $selfScope = $scope;
		$scope = this;
		$scope.init = function(){
			$rootScope.__MODULE_NAME = 'Assessment';
			$scope.StudTypes = [
				{id:'DSESC',name:'ESC'},
				{id:'REGXX',name:'Regular'},
				{id:'DSPUB',name:'Public'},
			];
			$scope.StudFields = ['sno','lrn','gender','year_level','section','department_id','year_level_id','section_id','subsidy_status','program_id'];
			$scope.ActiveType =  'DSESC';
			$scope.ShowSched = 0;
			$scope.Saving = 0;
			$scope.Scheme = null;
			atomic.ready(function(){
				console.log(atomic)
				$scope.SYs = atomic.SchoolYears;
				$scope.AllYL = atomic.YearLevels;
				$scope.AllSections = atomic.Sections;
				$scope.ActiveSy = atomic.ActiveSY;
				getTuitions();
				getBP();
			})
		}
		
		$selfScope.$watch('ASC.ActiveStudent', function(stud){
			if(stud){
				$scope.ActiveStudent.name = stud.sno + ' | ' + stud.name;
				if(stud.year_level_id=='GX')
					stud.department_id = 'SH';
				$scope.SetDefaults(stud);
				$scope.ActiveType = stud.subsidy_status;
			}
		})

		$selfScope.$watch('ASC.ActiveType', function(type){
			if($scope.Scheme!=null){
				angular.forEach($scope.Tuition.schemes, function(s){
					if(type==s.subsidy_status)
						$scope.SelectScheme(s);
				})
			}
		})
		//program_id not binding when picking up students
		$scope.SetDefaults = function(stud){
			let yls = [];
			angular.forEach($scope.AllYL, function(y){
				yls.push(y.id);
			})
			let yindx = yls.indexOf($scope.ActiveStudent.year_level_id);
			$scope.year_level_id = yls[yindx+1];
			angular.forEach($scope.AllSections, function(sec){
				if(stud.program_id==sec.program_id&&yls[yindx+1]==sec.year_level_id){
					$scope.section_id = sec.id;
					return;
				}
			})
			$scope.Sections = $filter("filter")($scope.AllSections, {year_level_id:$scope.year_level_id, program_id: '!MIXED'});
			let tui = $filter("filter")($scope.Tuitions, {year_level_id:$scope.year_level_id});
			$scope.Tuition = tui[0];
			pickScheme(stud);
		}
		//update applicable to depending on student
		function getTuitions(){
			let filter = {
				applicable_to: 'Old',
				sy: $scope.ActiveSy
			}
			api.GET('tuitions',filter, function success(response){
				$scope.Tuitions = response.data;
			})
		}

		function pickScheme(stud){
			angular.forEach($scope.Tuition.schemes, function(s){
				if(stud.subsidy_status==s.subsidy_status)
					$scope.SelectScheme(s);
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
		
		

		$scope.SelectScheme = function(scheme){
			$scope.Scheme = scheme;
			let net = 0;
			angular.forEach(scheme.schedule, function(s){
				net+=s.amount;
				angular.forEach($scope.billing_periods, function(bp){
					if(bp.id==s.billing_period_id)
						s['billing_period'] = bp.name;
				})
			})
			$scope.PaySched = scheme.schedule;
			$scope.TotalDue = net;
			$scope.ShowSched = 1;
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
				esp: $scope.ActiveSy + .25
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
				$scope.ClearRecord();
			});
		}
		
		$scope.ClearRecord = function(){
			$scope.ActiveStudent = null;
			$scope.year_level_id = null;
			$scope.section_id = null;
			$scope.s = null;
			$scope.Scheme = null;
			$scope.ShowSched = 0;
		}
		
		

		$selfScope.$watch('ASC.ActiveStudent.name', function(stud){
			if(stud=='undefined | null')
				$scope.ClearRecord();
				
		})
		
		
		
		$selfScope.$watch('ASC.section_id', function(sid){
			$scope.Subjects = [];
			if(sid)
				getCurriSec();
			
		})
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