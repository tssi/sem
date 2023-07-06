"use strict";
define(['app','api','atomic/bomb'], function (app) {
    app.register.controller('PageController',['$scope','$rootScope','api','Atomic','$filter',
	function ($scope,$rootScope,api,atomic,$filter) {
       $scope.init = function (module_name) { 
			$rootScope.__MODULE_NAME = module_name || app.settings.DEFAULT_MODULE_NAME;
			$rootScope.__MODULE_NAME = 'SEM';
			atomic.ready(function(){
				$scope.ActiveSY = atomic.ActiveSY;
				getEnrollment();
			});
			api.GET('test',function(response){
				$scope.List = response.data;
			});
			$scope.openListItem = function($index){
				$scope.ActiveListItem = $scope.List[$index];
			}
			
	   }

	   function getEnrollment(){
			var data = {
				esp:$scope.ActiveSY,
				transaction_type_id:'TUIXN',
				limit:'less'
			}
			data.transac_date = $filter('date')(new Date(),'yyyy-MM-dd');
			api.GET('enrollments',data, function success(response){
				var overall = [];
				var ctr = 0;
				angular.forEach(response.data[0].overall, function(item){
					if(item.day=='Sun')
						return;
					overall[ctr]=item;
					ctr++;
				});
				response.data[0].overall = overall;
				$scope.Totals = response.data[0].totals.levels;
				
				var SH = {'GY':0, 'GZ':0};
				angular.forEach($scope.Totals, function(value,key){
					if(value>0){
						switch(key){
							case 'GYABM': SH.GY++; break;
							case 'GYGAS': SH.GY++; break;
							case 'GYHUMS': SH.GY++; break;
							case 'GYMIXED': SH.GY++; break;
							case 'GYSTEM': 
								SH.GY++; break;
							case 'GZABM': SH.GZ++; break;
							case 'GZGAS': SH.GZ++; break;
							case 'GZHUMS': SH.GZ++; break;
							case 'GZMIXED': SH.GZ++; break;
							case 'GZSTEM': SH.GZ++; break;
								SH.GZ++; break;
						}
					}
					
				})
				$scope.Totals['SH'] = SH;
				console.log($scope.Totals);
			}, function error(response){
			
			});
	   }

    }]);
});


