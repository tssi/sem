"use strict";
define(['app','api','atomic/bomb'],function(app){
	app.register.controller('RegFormController',['$rootScope','$scope','api','Atomic','aModal','$http','$filter','$timeout',
	function($rootScope,$scope,api,atomic, aModal,$http,$filter,$timeout){
		const $selfScope = $scope;
		$scope = this;

		atomic.ready(function(){
			$scope.ActiveDept = atomic.ActiveDept;
			$scope.ActiveDeptId = $scope.ActiveDept.id;
			$scope.Departments = atomic.Departments;
			$scope.ActiveSY = atomic.ActiveSY;	
			$scope.SelectedSem = atomic.SelectedSem;	
			$scope.SelectedPeriod = atomic.SelectedPeriod;	
			$scope.Sections =  atomic.Sections;

		});

		$scope.init = function(){
			$selfScope.$watch('RFC.ActiveDeptId',function(deptId){
				$scope.ActiveSection = null;
				$scope.ActiveSections  = $filter('filter')($scope.Sections,{department_id:deptId},true);
			});
		}

		}]);
});