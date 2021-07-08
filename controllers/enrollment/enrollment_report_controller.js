"use strict";
define(['app','api','atomic/bomb'],function(app){
	app.register.controller('EnrollmentController',['$rootScope','$scope','api','Atomic','aModal','$http','$filter','$timeout',
	function($rootScope,$scope,api,atomic, aModal,$http,$filter,$timeout){
		const $selfScope = $scope;
		$scope = this;
		$scope.init = function(){
			$rootScope.__MODULE_NAME = 'Enrollment Report';
			/* $scope.Headers = ['Date','Day','Gr 7','Gr 8','Gr 9','Gr 10','ABM 11''STEM 11','HUMS 11','TVL 11','ABM 12','STEM 12','HUMS 12','TVL 12'];
			$scope.Props = ['date','day','levels.G7','levels.G8','l']; */
			$scope.SearchBy = ['name'];// Fields you can search from the items 	
			atomic.ready(function(){
				/* $selfScope.$watch('SI.ActiveStudent.department_id',function(deptId){
					
				}); */
			});
			
		};
		
		
		$scope.Clear = function(){
			$scope.date = '';
			$scope.Enrollment = '';
		}
		
		$scope.Print = function(){
			$timeout(function(){
				document.getElementById('PrintEnrollment').submit();
			},1000);
		}
		
		$scope.LoadReport = function(){
			$scope.Loading = 1;
			var data = {
				esp:2021,
				transaction_type_id:['INIPY','FULLP'],
				transac_date:$scope.date,
				limit:'less'
			}
			data.transac_date = $filter('date')(new Date(data.transac_date),'yyyy-MM-dd');
			api.GET('enrollments',data, function success(response){
				$scope.Enrollment = response.data[0];
				$scope.Loading = 0;
			}, function error(response){
				
			});
		}
		
	}]);
});