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
			$scope.Options = ['Summary','List'];
			$scope.Order = ['Year Level','Date'];
			$scope.ActiveOrder = 'Year Level';
			$scope.ActiveOpt = 'Summary';
			getList();
			atomic.ready(function(){
				/* $selfScope.$watch('SI.ActiveStudent.department_id',function(deptId){
					
				}); */
			});
			
		};
		
		$scope.setActOption = function(opt){
			$scope.ActiveOpt = opt;
		}
		$scope.setActiveOrder = function(opt){
			$scope.ActiveOrder = opt;
		}
		
		$scope.Clear = function(){
			$scope.date = '';
			$scope.Enrollment = '';
		}
		
		$scope.Print = function(){
			$timeout(function(){
				document.getElementById('PrintEnrollment').submit();
			},1000);
		}
		$scope.PrintList = function(){
			$timeout(function(){
				document.getElementById('PrintEnrollmentList').submit();
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
		
		function getList(){
			var data = {
				esp:2021,
				transaction_type_id:['INIPY','FULLP'],
				limit:'less'
			}
			api.GET('enrollment_lists',data, function success(response){
				angular.forEach(response.data, function(item){
					switch(item.level){
						case 'G7': item.level = 'Grade 7'; break;
						case 'G8': item.level = 'Grade 8'; break;
						case 'G9': item.level = 'Grade 9'; break;
						case 'GX': item.level = 'Grade 10'; break;
						case 'GYSTEM': item.level = 'Grade 11 STEM'; break;
						case 'GYHUMS': item.level = 'Grade 11 HUMMS'; break;
						case 'GYABM': item.level = 'Grade 11 ABM'; break;
						case 'GYTVL': item.level = 'Grade 11 TVL'; break;
						case 'GZSTEM': item.level = 'Grade 12 STEM'; break;
						case 'GZHUMS': item.level = 'Grade 12 HUMMS'; break;
						case 'GZABM': item.level = 'Grade 12 ABM'; break;
						case 'GZTVL': item.level = 'Grade 12 TVL'; break;
					};
				})
				$scope.Lists = response.data;
				console.log($scope.Lists);
			});
		}
		
	}]);
});