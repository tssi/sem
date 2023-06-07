"use strict";
define(['app','api','atomic/bomb'],function(app){
	app.register.controller('AssessmentController',['$rootScope','$scope','api','Atomic','aModal','$http','$filter',
		function($rootScope,$scope,api,atomic, aModal,$http,$filter){
			const $selfScope = $scope;
			$scope = this;
			$scope.init = function(){
				$rootScope.__MODULE_NAME = 'Assessment';
				// Add all student types based on tuition structure
				$scope.StudTypes = [
								{id:'REG',name:'Regular'},
								{id:'ESC',name:'ESC'}
							];

				$scope.StudFields = ['id','first_name','middle_name','last_name','subsidy_status'];

				// atomic.ready to access core data ex. SchoolYear, Section etc.
				atomic.ready(function(){
					console.log(atomic);
					$scope.YearLevels =  atomic.YearLevels;
					$scope.Sections =  atomic.Sections;
				});
			}
			// Watch variable for AStud.deptId
			$selfScope.$watch('ASC.ActiveStudent.department_id',function(deptId){
				// Add filter year level by deptId
				// Filter section by deptId, add filter by year level
				$scope.Sections = $filter("filter")(atomic.Sections, {department_id:deptId});
			});
	}]);
});