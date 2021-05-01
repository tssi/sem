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
				$scope.Tabs = ['Breakdown','Summary'];
				$scope.ActiveTab = 'Breakdown';
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
				api.GET('reservations', filter, success,error);
			}
			
			function getForPrinting(){
				api.GET('reservations',{limit:9999,field_type:'RSRVE'},function success(response){
					var cnt = 1;
					var levels = [];
					var totals = [];
					angular.forEach(response.data, function(data){
						data['cnt'] = cnt;
						cnt++;
					});
					totals['total'] = cnt;
					totals['new'] = 0;
					totals['old'] = 0;
					for(var i in response.data){
						var data = response.data[i];
						levels[data.year_level_id]={};
						
					};
					for(var i in levels){
						var desc = '';
						levels[i]['total']=0;
						levels[i]['total_new']=0;
						levels[i]['total_old']=0;
						switch(i){
							case 'G7': desc = 'Grade 7'; var order = 1; break;
							case 'G8': desc = 'Grade 8'; var order = 2; break;
							case 'G9': desc = 'Grade 9'; var order = 3; break;
							case 'GX': desc = 'Grade 10'; var order = 4; break;
							case 'GY': desc = 'Grade 11'; var order = 5; break;
							case 'GZ': desc = 'Grade 12'; var order = 6; break;
						}
						levels[i]['description']=desc;
						levels[i]['order']=order;
						angular.forEach(response.data, function(data){
							if(i==data.year_level_id){
								levels[i].total++;
								switch(data.status){
									case 'Old': levels[i].total_old++; totals['old']++; break;
									case 'New': levels[i].total_new++; totals['new']++; break;
								}
							}
						}); 
					}
					var a=0;
					for(var i in levels){
						levels[a]=levels[i];
						a++;
					}
					$scope.CompleteReservations = [];
					$scope.CompleteReservations['breakdown'] = response.data;
					$scope.CompleteReservations['summary'] = levels;
					$scope.CompleteReservations['totals'] = totals;
				});
			}
			
			$scope.SetActiveTab = function(tab){
				$scope.ActiveTab = tab;
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