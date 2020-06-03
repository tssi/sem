"use strict";
define(['app','api'], function (app) {
    app.register.controller('CollegeAssesmentController',['$scope','$rootScope','$uibModal','api', function ($scope,$rootScope,$uibModal,api) {
		$scope.init = function(){
			$rootScope.__MODULE_NAME = 'College Assesment';
			$scope.Steps = [
				{id:1, title:"Student", description:"Select Student"},
				{id:2, title:"Type", description:"Select Type"},
				{id:3, title:"Schedule", description:"Select Schedule"},
				{id:5, title:"Payment Scheme", description:"Select Payment Scheme"},
				{id:6, title:"Discount", description:"Select Discount"},
				{id:7, title:"Confirmation", description:"Confirmation"}
			];

			$scope.SectionTypes = [
				{id:'block', name:"Block", description:"Fixed subject offering"},
				{id:'irreg', name:"Irregular", description:"Customized subjects"}
			];
			$scope.Days = [
				{'id':'M','desc':'Mon'},
				{'id':'T','desc':'Tues'},
				{'id':'W','desc':'Wed'},
				{'id':'TH','desc':'Thu'},
				{'id':'F','desc':'Fri'},
				{'id':'S','desc':'Sat'},
			];
			$scope.Discounts = [
				{'id':1,'disc':25,'desc':'Academic Scholarship'},
				{'id':2,'disc':50,'desc':'Athletic Scholarship'},
				{'id':3,'disc':100,'desc':'Full Academic Scholarship'},
			];

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
					getFees();
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
					$scope.SubjectsEnrolled = $scope.SelectedSubjects;
					$scope.level2 = true;
					$scope.SelectedSchedule = $scope.Schedule_details;
					getSchedule();
				}
				if($scope.ActiveStep===5){
					$scope.ComputeTuition();
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
		
		$scope.SelectedSubjects = [];
		$scope.PickSubjects = function(subject,index){
			if($scope.SelectedSubjects.indexOf(subject)===-1){
				subject['active']=1;
				$scope.SelectedSubjects.push(subject);
			}
			else{
				subject['active']=0;
				$scope.SelectedSubjects.splice($scope.SelectedSubjects.indexOf(subject), 1);
			}
			//console.log(subject,index);
			
		};
		
		$scope.SelectAll = function(){
			$scope.Select = true;
			angular.forEach($scope.Subjects,function(sub){
				sub['active']=1;
				$scope.SelectedSubjects.push(sub);
			});
		};
		
		$scope.UnSelect = function(){
			$scope.Select = false;
			$scope.SelectedSubjects = [];
			angular.forEach($scope.Subjects,function(sub){
				sub['active']=0;
			});
		};
		
		$scope.SetSection = function(sec){
			Schedules = [];
			$scope.ActiveSection = sec;
			
			
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
		
		$scope.ComputeTuition = function(){
			var SubjectAmount = 0;
			var total = 0;
			$scope.TotalFee =0;
			angular.forEach($scope.SelectedSubjects, function(sub){
				var SubjectAmount = 400 * sub.tuition_hours;
				total = total + SubjectAmount;
			});
			var t = $scope.TotalFee.length + 1;
			$scope.Fees.splice(0, 0, t);
			$scope.Fees[0]={'desc':'Tuition fee','amount':total};
			angular.forEach($scope.Fees, function(fee){
				$scope.TotalFee = $scope.TotalFee + fee.amount;
			});
			
			//console.log($scope.Fees);
		};
		
		$scope.SelectPayment = function(pm){
			$scope.ActivePm = pm;
			$scope.ComputeBreakdown();
		};
		
		$scope.ComputeBreakdown = function(){
			$scope.PaymentMethod = [];
			if($scope.ActivePm.id==1){
				$scope.PaymentMethod.push({'desc':'Down/Cash Payment','amount':$scope.TotalFee});
			}
			if($scope.ActivePm.id==2){
				var terms = ['Downpayment','Prelim','Midterm','Semi-final','Final'];
				if(!$scope.TotalDiscounted)
					var devided = $scope.TotalFee/$scope.ActivePm.terms;
				if($scope.TotalDiscounted)
					var devided = $scope.TotalDiscounted/$scope.ActivePm.terms;
				angular.forEach(terms,function(term){
					var pair = {};
					pair['desc'] = term;
					pair['amount']= devided;
					$scope.PaymentMethod.push(pair);
				});
			}
		};
		
		$scope.ChooseDiscount = function(dc){
			$scope.AppliedDiscounts = [];
			$scope.ActiveDiscount = dc;
			var disc = ($scope.TotalFee * dc.disc) / 100;
			$scope.Discount = $scope.TotalFee - disc;
			$scope.AppliedDiscounts.push({'desc':dc.desc,'amount':disc});
			//console.log($scope.AppliedDiscounts);
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
				console.log($scope.Subjects);
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
			var success = function(response){
				$scope.Schedules = response.data;
			}
			var error = function(response){
				
			}
			var data = {
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
			console.log($scope.Schedule_details);
		}
		
		function getFees(){
			api.GET('college_tuitions',function success(response){
				$scope.Fees = response.data;
			});
		};
		
		function getPaymentScheme(){
			api.GET('college_payment_schemes',function success(response){
				$scope.Payments = response.data;
				console.log(response.data);
			});
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


