"use strict";
define(['app','api'], function (app) {
    app.register.controller('CollegeAssesmentController',['$scope','$rootScope','$uibModal','api', function ($scope,$rootScope,$uibModal,api) {
		$scope.init = function(){
			$rootScope.__MODULE_NAME = 'College Assesment';
			$scope.Steps = [
				{id:1, title:"Student", description:"Select Student"},
				{id:2, title:"Type", description:"Select Type"},
				{id:3, title:"Schedule", description:"Select Schedule"},
				{id:4, title:"Schedule", description:"Select Schedule"},
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

		$scope.revealSched = function(section_id){
			$rootScope.RevealSectionSched = section_id;
		}
		$scope.nextStep = function(){
			if($scope.ActiveStep<=$scope.Steps.length){
				$scope.ActiveStep++;
				if($scope.ActiveStep===2){
					$scope.SelectedSubjects = [];
					$scope.ActiveStudent = $scope.SelectedStudent;
					getSubjects();
					getFees();
				}

				if($scope.ActiveStep===3){
					$scope.PreviewSection = null; 
					getSections();
					
				}
				if($scope.ActiveStep===4){
					$scope.SubjectsEnrolled = $scope.SelectedSubjects;
					$scope.level2 = true;
					
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
			var sch = {};
			angular.forEach($scope.ClassSchedules, function(sched){
				if(sec.id==sched.section_id){
					angular.forEach(sched.details,function(detail){
						sch['id']=sched.id;
						sch['subject']=sched.subject;
						sch['detail']=detail;
						$scope.SelectedSchedule.push(sch);
						sch = {};
					});
				}
			});
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
			api.GET('college_inquiries',function success(response){
				$scope.Students = response.data;
			});
		};
		
		function getSubjects(){
			var success = function(response){
				$scope.Subjects = response.data;
			};
			var error = function(response){
				
			};
			var data = {
				id:$scope.SelectedStudent.curriculum_id,
			}
			api.GET('curriculums', success, error);
		};
		
		function getSections(){
			var success = function(response){
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


