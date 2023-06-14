"use strict";
define(['app','api','atomic/bomb'],function(app){
	app.register.controller('TuitionController',['$rootScope','$scope','api','Atomic','aModal','$http','$filter','$uibModal',

	function($rootScope,$scope,api,atomic, aModal,$http,$filter,$uibModal){
		const $selfScope = $scope;
		$scope = this;
		$scope.init = function(){
			$scope.EP = 'tuitions';
			$scope.OF = ['id','name','description','sy'];
			$scope.SF = ['description'];
			$scope.DF = 'description';

		}
		atomic.ready(function(){
			console.log(atomic);
		});
	}]);
});