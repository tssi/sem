"use strict";
define(['app','api','atomic/bomb'], function (app) {
    app.register.controller('PageController',['$scope','$rootScope','api','Atomic','$filter',
	function ($scope,$rootScope,api,atomic,$filter) {
		const $selfScope = $scope;
		$scope = this;
       	$scope.init = function (module_name) { 
			$rootScope.__MODULE_NAME = module_name || app.settings.DEFAULT_MODULE_NAME;
			$rootScope._APP = $rootScope._APP ||{};
			$rootScope._APP.CopyRight =  document.querySelector('meta[name="copyright"]').getAttribute('content');
			$rootScope._APP.VersionNo =  document.querySelector('meta[name="version"]').getAttribute('content');
			$rootScope.__MODULE_NAME = 'SEM';
			atomic.ready(function(){
				$scope.ActiveSY = atomic.ActiveSY;
				getEnrollment();
			});

			$scope.Headers = ['Student',{label:'Year Level',class:'col-md-3'}];
			$scope.Props = ['student','year_level'];
			$scope.Data = [{student:'Juan Dela Cruz',year_level:'Grade 7'}];
			
			
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


