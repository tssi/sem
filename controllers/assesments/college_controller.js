"use strict";
define(['app','api'], function (app) {
    app.register.controller('CollegeAssesmentController',['$scope','$rootScope','$uibModal','api', function ($scope,$rootScope,$uibModal,api) {
		$scope.init = function(){
			$rootScope.__MODULE_NAME = 'College Assesment';
			$scope.Steps = [
				{id:1, title:"Student", description:"Select Student"},
				{id:2, title:"Type", description:"Select Type"},
				{id:3, title:"Schedule", description:"Select Schedule"},
				{id:4, title:"Payment Scheme", description:"Select Payment Scheme"},
				{id:5, title:"Discount", description:"Select Discount"},
				{id:6, title:"Confirmation", description:"Confirmation"}
			];

			$scope.SectionTypes = [
				{id:'block', name:"Block", description:"Fixed subject offering"},
				{id:'irreg', name:"Irregular", description:"Customized subjects"}
			];
			$scope.ComputingTuition = true;
			
			//$scope.DemoSubs = ['Programming Fundamentals','English 1','Ethics','P.E.','NSTP1'];
			$scope.ActiveStep = 1;
			getStudents();
			$scope.Customize = false;
		
			$scope.SubjectsEnrolled = [];
			$scope.SelectedSchedule = [];
			$scope.SelectedStudent = [];
			$scope.DemoMode = true;
		};
		var Schedules = [];
		
		
		
		$scope.setSelectedStudent = function(stud){
			$scope.SelectedStudent = stud;
			$scope.SelectedStudent.name = stud.first_name +' '+ stud.middle_name +' '+ stud.last_name +' '+ stud.suffix_name;
		};
		$scope.setSelectedSectionType =  function(type){
			$scope.SelectedSchedules = [];
			$scope.SelectedSectionType =  type;
		}

		$scope.revealSched = function(data){
			if($scope.SelectedSectionType.id=='block'){
				$scope.RevealSectionSched = data;
				BuildSchedule(data);
			}else{
				$scope.ActiveSubject = data;
				
			}
		}
		$scope.nextStep = function(){
			if($scope.ActiveStep<=$scope.Steps.length){
				$scope.ActiveStep++;
				if($scope.ActiveStep===2){
					$scope.SelectedSubjects = [];
					$scope.ActiveStudent = $scope.SelectedStudent;
					getTuition();
				}

				if($scope.ActiveStep===3){
					$scope.PreviewSection = null; 
					$scope.PreviewSubject = null;
					if($scope.SelectedSectionType.id=='irreg'){
						getCurriculum();
					}else{
						getSections();
					}
					
					
				}
				if($scope.ActiveStep===4){
					if($scope.SelectedSectionType.id=='block'){
						$scope.SelectedSchedules = $scope.Schedule_details;
					}
					
					console.log($scope.SelectedSchedules);
					computeTuition();
				}
				if($scope.ActiveStep===5){
					$scope.ShowBreakDown = true;
					$scope.DemoMode = false;
					$scope.SelectedSchedule = Schedules;
					Schedules = [];
					getPaymentScheme();
				}
				if($scope.ActiveStep===6){
					
				}
				if($scope.ActiveStep===7){
					$scope.TotalAppliedDiscount = 0;
					$scope.TotalDiscounted = $scope.Discount;
					$scope.ComputeBreakdown();
					angular.forEach($scope.AppliedDiscounts,function(dc){
						$scope.TotalAppliedDiscount = $scope.TotalAppliedDiscount + dc.amount;
					});
				}
				if($scope.ActiveStep===7){
					$scope.openModal();
					$scope.Reset();
					$scope.init();
				}
			}
		};
		
		$scope.prevStep = function(){
			$scope.ActiveStep--;
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
		
		$scope.Reset = function(){
			$scope.SelectedStudent = '';
			$scope.SubjectsEnrolled = '';
			$scope.SelectedSubjects = '';
			$scope.SelectedSchedule = '';
			$scope.ActiveStudent = '';
			$scope.Fees = '';
			$scope.TotalDiscounted = '';
			$scope.TotalFee = '';
			$scope.ActiveSection = '';
			$scope.ActivePm = '';
			$scope.ActiveDiscount = '';
			$scope.Select = false;
			$scope.ActiveStep = 1;
			$scope.level2 = 0;
			$scope.ShowBreakDown = 0;
			$scope.PaymentMethod = 0;
		};
		$scope.RemovedSubjects = [];
		$scope.SelectIrregSched = function(data){
			console.log(data);
			angular.forEach($scope.Subjects, function(sub){
				if(data.subject_id==sub.subject_id)
					$scope.RemovedSubjects.push(sub);
			});
			angular.forEach($scope.IrregSched, function(sched){
				if(data.subject_id==sched.subject_id&&
					data.section_id==sched.section_id){
						sched['units']=data.units;
					$scope.SelectedSchedules.push(sched);
				}
			});
			
			$scope.Subjects = $scope.Subjects.filter(function(sub){
				return sub.subject_id!==data.subject_id;
			});
			console.log($scope.Subjects);
			$scope.ActiveSubject = null;
		}
		
		$scope.SetSection = function(section){
			$scope.ActiveSection = section;
			
		}
		
		$scope.RemoveSched = function(data){
			//console.log($scope.RemovedSubjects);
			angular.forEach($scope.RemovedSubjects, function(sub){
				if(data.subject_id==sub.subject_id)
					$scope.Subjects.push(sub);
			});
			$scope.SelectedSchedules = $scope.SelectedSchedules.filter(function(sched){
				return sched.subject_id!==data.subject_id;
			});
		}
		
		$scope.HideSched = function(){
			if($scope.SelectedSectionType.id=='irreg'){
				$scope.ActiveSubject = null;
				$scope.ActiveRow = null;
			}else{
				$scope.RevealSectionSched = null;
			}
		}
		function getStudents(){
			api.GET('students',function success(response){
				$scope.Students = response.data;
			});
		};
		function getCurriculum(){
			var success = function(response){
				var curr = response.data[0];
				$scope.Subjects = [];
				angular.forEach(curr.subjects, function(sub){
					$scope.Subjects.push(sub);
				});
				getIrregSchedules();
				
			}
			var error = function(response){
				
			}
			var data = {
				id: $scope.SelectedStudent.curriculum_id
			}
			api.GET('curriculums', data, success, error);
		}
		
		function getSections(){
			var success = function(response){
				$scope.Sections = response.data;
				getSchedule();
			};
			var error = function(response){
				
			};
			var data = {
				program_id : $scope.SelectedStudent.program_id
			};
			api.GET('sections', data, success, error);
		};
		
		function getSchedule(section_id){
			var success = function(response){
				$scope.Schedules = response.data;
			};
			var error = function(){
				
			};
			var data = {
				section_id: section_id
			};
			api.GET('schedules', data, success, error);
		};
		
		function getIrregSchedules(){
			var subs = [];
			angular.forEach($scope.Subjects,function(sub){
				subs.push(sub.subject_id);
			});
			subs = subs.join(',');
			var success = function(response){
				$scope.IrregSched = response.data;
			}
			var error = function(response){
				
			}
			var data = {
				subject_id:subs,
				limit:'less',
			}
			api.GET('schedule_details',data, success, error);
		}
		
		function BuildSchedule(section_id){
			var schedule = [];
			angular.forEach($scope.Schedules, function(sched){
				if(sched.section_id==section_id){
					schedule.push(sched);
				}
			});
			$scope.Schedule_details = [];
			var sched_dtl = [];
			angular.forEach(schedule[0].schedule_details, function(detail){
				if(sched_dtl.indexOf(detail.subject_id)===-1){
					sched_dtl.push(detail.subject_id);
					$scope.Schedule_details.push(detail);
				}else{
					detail.subject='';
					$scope.Schedule_details.push(detail);
				}
				
			});
			sched_dtl = [];
			for(var i in $scope.Schedule_details){
				var subid = $scope.Schedule_details[i].subject_id;
				if(sched_dtl.indexOf(subid)===-1){
					sched_dtl.push(subid);
					$scope.Schedule_details[i]['span']=1;
				}else{
					
					var span = $scope.Schedule_details[i].span;
					console.log(span)
					$scope.Schedule_details[i]['span'] = parseInt(span) +1;
				}
			}
		}
		
		function computeTuition(){
			$scope.ComputingTuition = true;
			var subs = [];
			var fees = [];
			angular.forEach($scope.SelectedSchedules, function(sched){
				subs.push(sched.subject_id);
			});
			api.GET('subjects',function success(response){
				angular.forEach(response.data, function(sub){
					if(subs.indexOf(sub.id)!==-1){
						fees.push(sub);
					}
				});
				var total_tuition = 0;
				angular.forEach(fees, function(fee){
					total_tuition = total_tuition + parseInt(fee.lec*$scope.Base) + parseInt(fee.lab*$scope.Base);
				
				});
				$scope.TotalFee = 0;
				angular.forEach($scope.Tuition['fee_breakdowns'], function(fee){
					if(fee.fee_id==='TUI'){
						fee.amount = total_tuition;
					}
					$scope.TotalFee = $scope.TotalFee + fee.amount;
				});
				
			});
			$scope.ComputingTuition = false;
		}
		function getTuition(){
			var data = {
				sy:2020,
				year_level_id:$scope.SelectedStudent.year_level_id
			}
			return api.GET('tuitions', function success(response){
				$scope.Tuition = response.data[0];
				angular.forEach(response.data[0]['fee_breakdowns'], function(fee){
					if(fee.fee_id==='TUI'){
						$scope.Base = fee.amount;
						console.log($scope.Base);
					}
				});
			});
			
		}
		
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


