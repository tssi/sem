"use strict";
define(['app','api','atomic/bomb'],function(app){
	app.register.controller('AssessmentController',['$rootScope','$scope','api','Atomic','aModal','$http','$filter',
		function($rootScope,$scope,api,atomic, aModal,$http,$filter){
			const $selfScope = $scope;
			$scope = this;
			$scope.init = function(){
				$rootScope.__MODULE_NAME = 'Assessment';
				$scope.StudTypes = [
								{id:'REG',name:'Regular'},
								{id:'ESC',name:'ESC'}
							];
			}
	}]);
});