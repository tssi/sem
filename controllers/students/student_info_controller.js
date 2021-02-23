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


				atomic.ready(function(){
					// Map defaults and options
					$scope.entrySY = atomic.ActiveSY;
					$scope.entryPeriod =atomic.SelectedPeriod.id;
					$scope.entryPeriods = atomic.Periods;
					$scope.entryDepts =  atomic.Departments;
					$scope.isReady =  true;
					// Filter section dropdown by student department id
					$selfScope.$watch('SI.ActiveStudent.department_id',function(deptId){
						 var sections =  $filter('filter')(atomic.Sections,{department_id:deptId});
						 $scope.entrySections = sections;

					});
				});
				loadStudents(1);
			};
			
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
				}
				api.GET("students",filter,success);
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
				$scope.saving = false;
				$scope.ActiveTab = 0;
				$scope.Active = {};
				$scope.ActiveStudent = {};
				aModal.open('StudentInfoModal');  
				
				if(student) {
					delete student.classroom_user_id;
					
					var mLbl = student.first_name[0]+'.' +student.last_name;
					if(student.lrn)	mLbl +=  ' '+ student.lrn;
					$scope.ModalLabel = mLbl;
					
				
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
				api.POST('students',data,function(response){
					aModal.close("StudentInfoModal");
					if(!$scope.ActiveStudent.id){
						$scope.CurrentPage = $scope.Meta.last;
					}
				
					$scope.goToPage($scope.CurrentPage);
					$scope.Active = response.data;
				});
			}
			
			
	}]);
});