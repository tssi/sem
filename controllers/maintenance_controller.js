"use strict";
define(['app','api'], function (app) {
    app.register.controller('MaintenanceController',['$scope','$rootScope','$uibModal','api', function ($scope,$rootScope,$uibModal,api) {
		$scope.list=function(){
			$rootScope.__MODULE_NAME = 'Maintenance';
			initAPIRequests();
			$scope.newItem={};
			$scope.$watchCollection('SortItem',function(newValue,oldValue){
				$scope.sortItems();
			});
			
	   };
		//Opening the modal
			$scope.openModal=function(){
				var modalInstance = $uibModal.open({
					animation: true,
					templateUrl: 'MaintenanceListModal.html',
					controller: 'ModalInstanceController',
				});
				modalInstance.result.then(function (list) {
				  $scope.MaintenanceList.push(list);
				}, function (source) {
					//Re-initialize booklets when confirmed
					
						
				});
			};
		$scope.openMaintenance=function(list){
			$scope.List=angular.copy(list);
			$scope.List.state = 'edit';
			$scope.List.sortable = false;
			$scope.ListItems=[];
			$scope.Columns=[];
			$scope.ErrorMessage  = null;
			$scope.ErrorCode  = null;
			if(typeof list.schema=='object'){
				for(var index in list.schema){
					var column =  list.schema[index];
					var key = column.name;
					var type = column.type;
					if(key!="order"&&key!="created"&&key!="modified"&&!(key=="id" && type=="integer" ))
							$scope.Columns.push(key);
					if(key=='order'){
						$scope.List.sortable = true;
					}
				};
			}
			$scope.ColumnLen =  Math.round(11/($scope.Columns.length));
			api.GET(list.path,function success(response){
				$scope.ListItems=response.data;
			},function error(response){
				console.log(response);
				$scope.ListItems = [];
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
			$scope.newItem.order =  $scope.ListItems.length+1;
			api.POST($scope.List.path,$scope.newItem,function success(response){
				$scope.ListItems.push(response.data);
				$scope.newItem={};
			});
		};
		$scope.updateItem=function(listitem){
			$scope.NewItem=listitem;
			api.PUT($scope.List.path,$scope.NewItem,function success(response){
			});
		};
		function initAPIRequests()
		{
			api.GET('maintenance_lists',function success(response){
				$scope.MaintenanceList = response.data;
			});	
			api.GET('year_levels',function success(response){
			$scope.YearLevels = response.data;
			});	
			api.GET('educ_levels',function success(response){
				$scope.EducLevels = response.data;
			});
		}
		$scope.sortItems=function(){
			for(var index in $scope.SortItem){
				$scope.SortItem[index].order = parseInt(index)+1;
			}
		};
		$scope.saveSortItems=function(){
			var data = {reorder:[]};
			for(var index in $scope.SortItem){
				var item =  $scope.SortItem[index];
				data.reorder.push(item.id);
			}
			api.POST($scope.List.path,data,function success(response){
				$scope.ListItems=angular.copy($scope.SortItem);
				$scope.List.state="edit";
			});
		};
    }]);
	app.register.controller('ModalInstanceController',['$scope','$uibModalInstance','api', function ($scope, $uibModalInstance, api){
		$scope.confirmMaintenanceList = function(){
			var list = {
				name:$scope.name,
				description:$scope.description,
				path:$scope.path,
			}
			api.POST('maintenance_lists',list,function success(response){
				$uibModalInstance.close(response.data);
			},function error(response){
				
			});
		};
		$scope.cancelMaintenanceList = function(){
			$uibModalInstance.dismiss('cancel');
		};
	}]);
});


