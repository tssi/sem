"use strict";
define(['app','api'], function (app) {
    app.register.controller('TuitionController',['$scope','$rootScope','$uibModal','api', function ($scope,$rootScope,$uibModal,api) {
		$scope.list=function(){
			$rootScope.__MODULE_NAME = 'Tuition Structure';
			initAPIRequest();
	   };
	   $scope.openTuition = function(tuition){
		   $scope.Tuition = tuition;
		   $scope.Tuition.state = 'edit';
	   }
	   function initAPIRequest(){
		   api.GET('tuitions',function success(response){
			   $scope.TuitionList = response.data;
		   },function error(response){
			   $scope.ErrorCode = response.meta.code;
			   $scope.ErrorMessage = response.meta.message;
		   });
		   api.GET('schemes',function success(response){
			   $scope.Schemes = response.data;
		   });
		   api.GET('billing_periods',function success(response){
			   $scope.BillingPeriods = response.data;
			   $scope.Amounts = {};
			   for(var i in $scope.BillingPeriods){
				   var period =  $scope.BillingPeriods[i];
				   $scope.Amounts[period.id]={};
			   }
		   });
		   api.GET('fees',function success(response){
			   $scope.Fees = response.data;
		   });
		   api.GET('discounts',function success(response){
			   $scope.Discounts = response.data;
		   })
	   }
	}]);
});