"use strict";
define(['app','api','atomic/bomb'],function(app){
	app.register.controller('StudentInfoController',['$rootScope','$scope','api','Atomic','aModal','$http','$filter',
		function($rootScope,$scope,api,atomic, aModal,$http,$filter){
			const $selfScope = $scope;
			$scope = this;
			$scope.init = function(){
				$scope.Headers = ['LRN','Name','Year Level'];
				$scope.Props = ['lrn','full_name','year_level'];
				$scope.genders = [{'id':'M','name':'Male'},{'id':'F','name':'Female'}];
				$scope.HHeaders = ['Guardian','Relationship'];
				$scope.HProp = ['name','rel'];
				$scope.Ginputs = [{field:'last_name'},{field:'first_name'},{field:'middle_name'},{field:'rel'}];
				$scope.GuardHeader = ['Last Name','First Name', 'Middle Name', 'Relationship'];
				$scope.GuardProp = ['last_name','first_name','middle_name','rel'];
				$scope.SearchBy = ['lrn','full_name'];// Fields you can search from the items 			
				
				$scope.entryStats = [{id:"RETURN",name:'Returnee'},{id:"TRNSIN",name:"Transfer In"},{id:"REGLAR",name:"Regular"}];
				$scope.Types = ['Old','New'];
				$scope.StudTypes = [{id:'Old',name:'Old Students'},{id:'New',name:'New Inquiry'}];
				$scope.setActiveTyp('New');
				atomic.ready(function(){
					// Map defaults and options
					console.log(atomic);
					$scope.entrySY = atomic.ActiveSY;
					$scope.entryPeriod =atomic.SelectedPeriod.id;
					$scope.entryPeriods = atomic.Periods;
					$scope.entryDepts =  atomic.Departments;
					$scope.entryProgs =  atomic.Programs;
					$scope.isReady =  true;
					// Filter section dropdown by student department id
					$selfScope.$watch('SI.ActiveStudent.department_id',function(deptId){
						 var sections =  $filter('filter')(atomic.Sections,{department_id:deptId});
						 $scope.entrySections = sections;

					});
				});
				loadStudents(1);
			};
			$selfScope.$watch('SI.ActiveTyp',function(type){
				loadStudents(1);
			});
			
			function loadStudents(page,search){
				var filter = {limit:10,page:page};
				if(search){
					filter.keyword = search.keyword;
					filter.fields = search.fields;
				}
				var success =  function(response){
					$scope.Meta =  response.meta;
					$scope.Students =  response.data;
					$scope.CurrentPage =  $scope.Meta.page;
					$scope.NoStudents = false;
				}
				var error = function(response){
					$scope.NoStudents = true;
				}
				if($scope.ActiveTyp=='Old')
					api.GET("students",filter,success,error);
				else
					api.GET("inquiries",filter,success,error);
			}
			
			//SEARCH
			$scope.goToPage = function(page){
				var keyword =  $scope.Searchbox;
				var fields =  $scope.SearchBy;
				if(keyword){
					var search = {keyword:keyword,fields:fields};
					loadStudents(page,search);
				}else{
					loadStudents(page);
				}
			}
			
			$scope.setActiveTyp = function(type){
				$scope.Students = '';
				$scope.ActiveTyp = type;
				if(type=='New'){
					$scope.Headers[0] = 'Ref No';
					$scope.Props[0] = 'id';
				}else{
					$scope.Headers[0] = 'LRN';
					$scope.Props[0] = 'lrn';
				}
				loadStudents()
			}
			
			$scope.search = function(keyword){//Catch the search event to handle loading of items, go to first page
				$scope.Students = '';
				var fields =  $scope.SearchBy;
				var search = {keyword:keyword,fields:fields};
				loadStudents(1,search);
			}
			$scope.clearSearch = function(){// on clear search reset the filter goto page 1
				$scope.Students = '';
				loadStudents(1);
			}
			//END
			
			//MODAL
			$scope.openModal = function(student){
				console.log(student);
				$scope.saving = false;
				$scope.ActiveTab = 0;
				$scope.Active = {};
				$scope.ActiveStudent = '';
				aModal.open('StudentInfoModal');  
				if(student) {
					delete student.classroom_user_id;
					var mLbl = student.first_name[0]+'.' +student.last_name;
					if(student.lrn)	mLbl +=  ' '+ student.lrn;
					$scope.ModalLabel = mLbl;
					if($scope.ActiveTyp=='New')
						$scope.ModalLabel = student.id;
					$scope.ActiveStudent = student;
					
					
				}else{
					$scope.ModalLabel='New Student';
					$scope.ActiveStudent.entry_sy =  $scope.entrySY;
					$scope.ActiveStudent.entry_period =  $scope.entryPeriod;
				}
				
				aModal.open('StudentInfoModal');  
			}		
			
			

			$scope.closeModal = function(mod){
				mod = mod || "StudentInfoModal";
				aModal.close(mod);
				if(mod=='HouseholdModal')
					aModal.open('StudentInfoModal');
			}
			
			$scope.confirmModal = function(){
				$scope.saving = true;
				var data = $scope.ActiveStudent;
				var yl = $filter('filter')(atomic.Sections,{id:data.section_id});
				if(data.section_id)
				data.year_level_id = yl[0].year_level_id;

				if(data.department_id!='SH') data.program_id = null;

				if(data.sno){
					api.POST('students',data,function(response){
						aModal.close("StudentInfoModal");
						if(!$scope.ActiveStudent.id){
							$scope.CurrentPage = $scope.Meta.last;
						}
						
						$scope.goToPage($scope.CurrentPage);
						$scope.Active = response.data;
					});
				}else{
					api.POST('inquiries',data,function(response){
						aModal.close("StudentInfoModal");
						if(!$scope.ActiveStudent.id){
							$scope.CurrentPage = $scope.Meta.last;
						}
						$scope.ActiveTyp = 'New';
						$scope.goToPage($scope.CurrentPage);
						$scope.Active = response.data;
					});
				}
			}

			$scope.printInfoSheet = function(){
				document.getElementById('PrintInfoSheet').submit();
			}
			
			
	}]);
});