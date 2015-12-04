"use strict";
define(['app','api'], function (app) {
    app.register.controller('MaintenanceController',['$scope','$rootScope','$uibModal','api', function ($scope,$rootScope,$uibModal,api) {
		$scope.list=function(){
			$rootScope.__MODULE_NAME = 'Maintenance';
			$scope.MaintenanceList=[
									{id:1, name:"Fees", description:"List of Fees", path:"fees"},
									{id:2, name:"Year Level", description:"List of Year Level", path:"year_levels"},
									{id:3, name:"Section", description:"List of Section", path:"sections"},
									{id:4, name:"Religion", description:"List of Religion", path:"religions"},
									{id:5, name:"Citizenship", description:"List of Citizenship", path:"citizenships"}
								   ];
		};
		$scope.openMaintenance=function(list){
			$scope.List=angular.copy(list);
			$scope.List.state = 'edit';
			api.GET(list.path, function success(response){
				$scope.ListItems=response.data;
			});
		};
		$scope.removeMaintenanceInfo=function(){
			$scope.List = null;
			$scope.ListItems=null;
		};
		$scope.removeItem=function(index,id){
			$scope.ListItems.splice(index, 1);
		};
		$scope.updateState=function(state){
			$scope.List.state=state;
		};
    }]);
});


