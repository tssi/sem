"use strict";
define(['app','api','atomic/bomb'],function(app){
	app.register.controller('AssessmentController',['$rootScope','$scope','api','Atomic','aModal','$http','$filter','$timeout','$uibModal',

	function($rootScope,$scope,api,atomic, aModal,$http,$filter,$timeout,$uibModal){
		const $selfScope = $scope;
		$scope = this;
		$scope.init = function(){
			$rootScope.__MODULE_NAME = 'Assessment';

			$scope.StudTypes = [
				{id:'DSESC',name:'ESC'},
				{id:'REGXX',name:'Regular'},
				{id:'DSPUB',name:'Public'},
			];
			$scope.StudFields = ['sno','lrn','enroll_status','department_id',
								'year_level_id','section_id','student_type','program_id'];
			$scope.Headers = ['Sno','Student', 'Track','Type'];
			$scope.Props = ['sno','full_name','program_id','subsidy_status'];
			$scope.isBatchLoading = false;
			$scope.ClearRecord();
			atomic.ready(function(){
				$scope.SYs = atomic.SchoolYears;
				$scope.AllYearLevels = atomic.YearLevels;
				$scope.AllSections = atomic.Sections;
				$scope.ActiveSy = atomic.ActiveSY;
				getTuitions();
				getBP();
			})
		}
		$selfScope.$watch('ASC.BatchDeptId',function(deptId){
			if(!deptId) return;
			$scope.BatchLevels = $filter("filter")($scope.AllYearLevels,{department_id:deptId});
		});

		$selfScope.$watch('ASC.ActiveStudent', function(stud,oldStud){
			if(stud){
				if(stud.hasOwnProperty('student_type'))
					stud.subsidy_status = stud.student_type;
				if(!stud.name)
					stud.name =  stud.full_name;
				switch(stud.subsidy_status){
					case 'ESC': stud.subsidy_status = 'DSESC';break;
					case 'PUB': stud.subsidy_status = 'DSPUB';break;
					case 'QVR': stud.subsidy_status = 'DSESC';break;
					case 'REG': case null:
						stud.subsidy_status = 'REGXX';
					break;
				}

				$scope.ActiveType = stud.subsidy_status;
				$scope.SetDefaults(stud);
			}
		})


		$selfScope.$watch('ASC.ActiveType', function(type){
			if($scope.Scheme!=null){
				angular.forEach($scope.Tuition.schemes, function(s){
					if(type==s.subsidy_status)
						$scope.SelectScheme(s);
				})
			}
		});

		$selfScope.$watch('ASC.Subjects',function(subjects){
			if(!subjects) return;
			if(subjects.length==0) return;
			if($scope.isBatch && $scope.BatchStatus=='BATCH_RUNNING'){
				$scope.BatchStatus='ASSESS_SAVING';
				$scope.SaveAssessment();
			}
		});
		$scope.LoadBatch = function(){
			$scope.BatchStatus = 'BATCH_LOADING';
			$scope.BatchStud = [];
			var YEAR_LVLID =  $scope.BatchLevel;
			var filter ={year_level_id:YEAR_LVLID,'limit':20, page:1};
			var success =function(response){
				$scope.BatchStud =  response.data;
				$scope.BatchStatus = 'BATCH_LOADED';
			}
			var error = function(response){
				$scope.BatchStatus = 'BATCH_LOAD_ERROR';
			}
			api.GET('students',filter,success,error);
		}
		$scope.StartBatch = function(){
			triageBatchItem('START_BATCH');
		}
		function triageBatchItem(source){
			switch(source){
				case 'START_BATCH':
					$scope.BatchIndex=0;
				break;
				case 'ASSESS_OK':
					$scope.BatchStatus = 'BATCH_RUN_SAVED';
					$scope.BatchIndex+=1;
					$scope.ClearRecord();
				break;
			}
			
			if($scope.BatchIndex<$scope.BatchStud.length){
				$timeout(function(){
					runBatchItem($scope.BatchIndex);	
				},300);
				
			}else{
				$scope.BatchStatus = 'BATCH_RUN_ENDED';
			}
		}
		function runBatchItem(index){
			$scope.BatchStatus = 'BATCH_RUNNING';
			$scope.ActiveBatchStud =  $scope.BatchStud[index];
			$scope.ActiveBatchStud.enroll_status = 'OLD';
			$scope.ActiveStudent = angular.copy($scope.ActiveBatchStud);
		}

		// Improve Default values based on student info
		$scope.SetDefaults = function(stud){
			// Check for basic info such as enrollment status, year level and program(track)
			var ENROL_STAT = stud.enroll_status;
			var YEAR_LVLID = stud.year_level_id;
			var DEPT_ID = YEAR_LVLID=='GX'?'SH':stud.department_id;
			var YEAR_LEVELS = $filter("filter")($scope.AllYearLevels,{department_id:DEPT_ID,program_id:'!MIXED'});

			// Filter sections based on current year level
			var SECTIONS = $filter("filter")($scope.AllSections,{year_level_id:YEAR_LVLID});
			// Filter applicable sections 
			console.log(YEAR_LEVELS,YEAR_LVLID, ENROL_STAT );
			if(YEAR_LVLID!='GZ' && ENROL_STAT =='OLD'){
				var nextYL;
				if(YEAR_LVLID=='GX'){
					delete stud.program_id;
					nextYL = $filter("filter")($scope.AllSections,{year_level_id:'GY'});
					SECTIONS = SECTIONS.concat(nextYL);
					alert("Grade 10 assign track individually!");
				}else{
					// Look for the year level and match the next  year level
					YEAR_LEVELS.map(function(YL,index){
						if(YL.id==YEAR_LVLID){
							// Filter all sections and add 1 to index to get the next year level
							nextYL = $filter("filter")($scope.AllSections,{year_level_id:YEAR_LEVELS[index+1].id});
							// Concatenate the current  and next year level for NEW or Repeater and Promoted 
							SECTIONS = SECTIONS.concat(nextYL);
							return;
						}
					});
				}
				
				// Update the year level id as promoted
				YEAR_LVLID = nextYL[0].year_level_id;
			}
			// Bind the filtered sections
			$scope.Sections =  SECTIONS;
			if(YEAR_LVLID=='GY' && !stud.program_id ) return;
			// Default Section based on program

			var sectFltr = {year_level_id:YEAR_LVLID};
			if(stud.program_id)
				sectFltr.program_id = stud.program_id;
		
			

			var VALID_SECTS	 	= $filter("filter")(SECTIONS,sectFltr);
			$scope.section_id	= VALID_SECTS[0].id;
			
		}
		$selfScope.$watch('ASC.section_id',function(sectId){
			if(!sectId) return;
			// Set ActiveSection to section_id
			$scope.ActiveSection = $filter("filter")($scope.AllSections,{id:sectId})[0];
			// Include enrollment status and year level to filter tuitions
			var ENROL_STAT = $scope.ActiveStudent.enroll_status;
			var YEAR_LVLID =  $scope.ActiveSection.year_level_id;
			// Filter all tuitions by year level and enroll status
			$scope.Tuitions = $filter("filter")($scope.AllTuitions, {year_level_id:YEAR_LVLID,applicable_to:ENROL_STAT});
			$scope.Tuition = $scope.Tuitions[0];
			$scope.TuitionId = $scope.Tuition.id;	

			pickScheme($scope.ActiveStudent);

			// Reset subjects and reload curriculum
			$scope.Subjects = [];
			getCurriSec();
		});
		
		function pickScheme(stud){
			angular.forEach($scope.Tuition.schemes, function(s){
				if(stud.subsidy_status==s.subsidy_status)
					$scope.SelectScheme(s);
			})
		}
		
		// Load all applicable tuition to cache
		function getTuitions(){
			let filter = {
				//applicable_to: 'Old', Removed to load all tuitions on init
				sy: $scope.ActiveSy,
				limit:'less'
			}
			api.GET('tuitions',filter, function success(response){
				$scope.AllTuitions = response.data;
			})
		}

		// Load all billing periods to cache
		function getBP(){
			api.GET('billing_periods',{sy:$scope.ActiveSy, limit:'less'}, function success(response){
				$scope.billing_periods = response.data;
			})
		}
		
		function getCurriSec(){
			var deptId = $scope.ActiveSection.department_id;
			var yrlvId = $scope.ActiveSection.year_level_id;
			let filter = {
				section_id:$scope.section_id,
				esp:2022.25
			}
			if(deptId!='SH'&&yrlvId!='GX')
				filter.esp = 2022
			
			api.GET('curriculum_sections',filter,function success(response){
				let cid = response.data[0].curriculum_id;
				getCurriculum(cid,yrlvId);
			});
		}
		
		function getCurriculum(cid,yid){
			api.GET('curriculums',{id:cid}, function success(response){
				$scope.Curriculum = response.data[0];
				let subjects = [];
				angular.forEach(response.data[0].subjects, function(sub){
					if(yid==sub.year_level_id)
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
				status: 'ACTIVE',
				subsidy_status: $scope.Scheme.subsidy_status,
				department_id: $scope.Curriculum.department_id,
				program_id: $scope.ActiveSection.program_id,
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
				if($scope.isBatch && $scope.BatchStatus=='ASSESS_SAVING'){
					$scope.BatchStatus = 'ASSESS_OK';
					triageBatchItem('ASSESS_OK');
				}else{
					$scope.openModal();	
				}
				
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
			$scope.ActiveSection = null;
			$scope.year_level_id = null;
			$scope.section_id = null;
			$scope.s = null;
			$scope.Scheme = null;
			$scope.ShowSched = 0;
			$scope.Sections = null;
			$scope.Tuitions = null;
			$scope.TuitionId = null;
			$scope.ActiveType = null;
		}
		
		

		$selfScope.$watch('ASC.ActiveStudent.name', function(stud){
			if(!stud)
				$scope.ClearRecord();
				
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