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
			$scope.newItem={};
			$scope.$watchCollection('SortItem',function(newValue,oldValue){
				$scope.sortItems();
			});
	   };
		$scope.openMaintenance=function(list){
			$scope.List=angular.copy(list);
			$scope.List.state = 'edit';
			$scope.Columns=[];
			$scope.ErrorMessage  = null;
			$scope.ErrorCode  = null;
			api.GET(list.path,{limit:25},function success(response){
				$scope.ListItems=response.data;
				for(var key in response.data[0]){
					if(key!="order"&&key!="created"&&key!="modified")
							$scope.Columns.push(key);
				};
				$scope.ColumnLen =  Math.round(10/($scope.Columns.length));
			},function error(response){
				$scope.ErrorMessage =  response.meta.message;
				$scope.ErrorCode = response.meta.code;
			});
		};
		$scope.removeMaintenanceInfo=function(){
			$scope.List = null;
			$scope.ListItems=null;
		};
		$scope.removeItem=function(index,id){
			console.log(id);
			var data = {id:id};
			api.DELETE($scope.List.path,data,function(response){
				$scope.ListItems.splice(index, 1);
				});
		};
		$scope.updateState=function(state){
			$scope.List.state=state;
			if(state==='sort'){
				$scope.SortItem=angular.copy($scope.ListItems);
			}
		};
		$scope.addNewItem=function(){
			api.POST($scope.List.path,$scope.newItem,function success(response){
				$scope.ListItems.unshift(response.data);
				console.log($scope.ListItems);
				$scope.newItem={};
			});
		};
		$scope.updateItem=function(listitem){
			$scope.NewItem=listitem;
			api.PUT($scope.List.path,$scope.NewItem,function success(response){
			});
		};
		api.GET('year_levels',{limit:15},function success(response){
			$scope.YearLevels = response.data;
		});
		api.GET('educ_levels',{limit:15},function success(response){
			$scope.EducLevels = response.data;
		});
		$scope.sortItems=function(){
			for(var index in $scope.SortItem){
				$scope.SortItem[index].order = parseInt(index)+1;
			}
		};
		$scope.saveSortItems=function(){
			$scope.ListItems=angular.copy($scope.SortItem);
			api.POST($scope.List.path,$scope.ListItems,function success(response){
				$scope.List.state="edit";
			});
		};
    }]);
});


