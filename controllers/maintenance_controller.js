"use strict";
define(['app','api'], function (app) {
    app.register.controller('MaintenanceController',['$scope','$rootScope','$uibModal','api', function ($scope,$rootScope,$uibModal,api) {
		$scope.list=function(){
			$rootScope.__MODULE_NAME = 'Maintenance';
			$scope.MaintenanceList=[
									{id:1, name:"Fees", description:"List of Fees", path:"fees"},
									{id:2, name:"Tuition", description:"List of Tuition", path:"tuitions"},
									{id:3, name:"Year Level", description:"List of Year Level", path:"year_levels"},
									{id:4, name:"Section", description:"List of Section", path:"sections"},
									{id:5, name:"Religion", description:"List of Religion", path:"religions"},
									{id:6, name:"Citizenship", description:"List of Citizenship", path:"citizenships"}
								   ];
		};
		$scope.openMaintenance=function(list){
			$scope.List=list;
		};
		$scope.removeMaintenanceInfo=function(){
			$scope.List = null;
		};
    }]);
});


