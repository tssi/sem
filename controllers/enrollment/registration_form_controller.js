"use strict";
define(['app','md5','api','atomic/bomb'],function(app,md5){
	
	app.register.controller('RegFormController',['$rootScope','$scope','api','Atomic','aModal','$http','$filter','$timeout',
	function($rootScope,$scope,api,atomic, aModal,$http,$filter,$timeout){
		const $selfScope = $scope;
		$scope = this;

		atomic.ready(function(){
			$scope.ActiveDept = atomic.ActiveDept;
			$scope.ActiveDeptId = $scope.ActiveDept.id;
			$scope.Departments = atomic.Departments;
			$scope.ActiveSY = atomic.ActiveSY;	
				
			$scope.SelectedPeriod = atomic.SelectedPeriod;	
			$scope.Sections =  atomic.Sections;
			console.log($scope.SelectedSem);
		});

		$scope.init = function(){
			$selfScope.$watch('RFC.ActiveDeptId',function(deptId){
				$scope.ActiveSection = null;
				$scope.ActiveSections  = $filter('filter')($scope.Sections,{department_id:deptId},true);
				$scope.isBatch = true;
			});
		}
		
		$selfScope.$watch("RFC.Active",function(active){
			if(!active) return false;
			$scope.SelectedSem = active.sem;
			$scope.ActiveSY = active.sy;
		});
		
		$scope.Load = function(){
			if(!$scope.isBatch){
				$scope.ActiveSection = null;
			}else{
				$scope.ActiveStudent = null;
			}
			console.log($scope.isBatch);
			// Hash Request to prevent cache
			var request =  JSON.stringify({timestamp:new Date()});
				$scope.RequestHash = md5(request);
			// Prepare form submission via iframe
			$scope.Loading = true;
			$scope.Loaded =false;
			var form=  document.getElementById('PrintRegForm');
			var iframe=  document.getElementById('RegFormFrame');
				// Handle iframe loaded event
				iframe.addEventListener('load', function () {
				  $timeout(function(){
				  	$scope.Loading = false;
				  	$scope.Loaded =true;
				  },100);
				});
				// Submit form
				form.submit();	
		}

		}]);
});