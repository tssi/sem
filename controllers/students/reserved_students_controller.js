"use strict";
define(['app','api','atomic/bomb'],function(app){
	app.register.controller('ReservedController',['$rootScope','$scope','api','Atomic','aModal','$http','$filter',
		function($rootScope,$scope,api,atomic, aModal,$http,$filter){
			const $selfScope = $scope;
			$scope = this;
			$scope.init = function(){
				$scope.Headers = ['Date','OR Number','Student','Year Level','Status',];
				$scope.Props = ['transac_date','ref_no','name','year_level','status'];
				$scope.SearchBy = ['name'];// Fields you can search from the items 			
				
				atomic.ready(function(){
					$selfScope.$watch('SI.ActiveStudent.department_id',function(deptId){
						
					});
				});
				loadStudents(1);
				getForPrinting();
			};
			
			function loadStudents(page,search){
				var filter = {limit:10,page:page,field_type:'RSRVE'};
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
				api.GET('reservations',filter, success,error);
			}
			
			function getForPrinting(){
				api.GET('reservations',{limit:9999,field_type:'RSRVE'},function success(response){
					$scope.CompleteReservations = response.data;
					console.log(response.data);
				});
			}
			
			$scope.PrintRes = function(){
				document.getElementById('PrintRess').submit();
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
			
			
	}]);
});