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
			$scope.ShowSched = 0;
			$scope.Headers = ['Billing Period','Amount'];
			$scope.Props = ['billing_period_id','amount'];
			getYearLevels();
			getSections();
		}
		function getYearLevels(){
			api.GET('year_levels',{limit:'less'}, function success(response){
				$scope.YL = response.data;
			})
		}
		function getSections(){
			api.GET('sections',{limit:'less'}, function success(response){
				$scope.Sections = response.data;
			})
		}

		function getTuitions(){
			let filter = {
				applicable_to: 'Old',
				sy: 2023,
				year_level_id: $scope.year_level_id
			}
			api.GET('tuitions',filter, function success(response){
				$scope.Tuition = response.data[0];
				let tuition = $scope.Tuition;
				$scope.Schemes = [];
				angular.forEach(tuition.schemes, function(s){
					$scope.Schemes.push(s);					
				});
				
			})
		}

		$scope.selectSection = function(){
			getTuitions();
		}

		$scope.SelectScheme = function(scheme){
			console.log(scheme)
			$scope.PaySched = scheme.schedule;
			$scope.ShowSched = 1;
		}
	}]);
});