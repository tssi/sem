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
	   
	   
		
	   $scope.hideColIf = function(column){
	   		var hiddenCols = 
				['year_level_id',
				'educ_level_id',
				'program_id',
				'user_type_id',
				'master_module_id',
				'password',
				'department_id',
				'section_id',
				'period',
				'month',
				'calendar_id',
				'input_by',
				'type',
				'curriculum_id',
				'subject_id'
				];
	   		return hiddenCols.indexOf(column)!==-1;
	   }
	   
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
					if(key!='id' && key!="order" && key!='sequence' &&key!="created"&&key!="modified")
							$scope.Columns.push(key);
					if(key=='order'||key=='sequence'){
						$scope.List.sortable = true;
					}
				};
			}
			$scope.ColumnLen =  Math.round(11/($scope.Columns.length));
			$scope.LoadingListItems = true;
			api.GET(list.path,{limit:'less'},function success(response){
				var items = response.data;
				if(list.path=='master_configs'){
					items = [];
					for(var key in response.data){
						var val =  response.data[key];
						if(typeof val =='object')
							val = JSON.stringify(val);
						var item =  {sys_key:key,sys_value:val};
						items.push(item);
					}
				}
				$scope.ListItems=items;
				//console.log($scope.ListItems);
				$scope.LoadingListItems=false;
			},function error(response){
				$scope.ListItems = [];
				$scope.LoadingListItems=false;
				$scope.ErrorMessage =  response.meta.message;
				$scope.ErrorCode = response.meta.code;
				
			});
		};
		$scope.removeMaintenanceInfo=function(){
			$scope.List = null;
			$scope.ListItems=null;
		};
		$scope.removeItem=function(index,id){
			var data = {id:id};
			$scope.SavingItemId = id;
			api.DELETE($scope.List.path,data,function(response){
				$scope.SavingItemId =null;
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
			$scope.SavingItemId = listitem.id;
			api.POST($scope.List.path,$scope.NewItem,function success(response){
				$scope.SavingItemId =null;
			});
		};
		$scope.resetPassword = function(user){
			var data =  {id:user.id};
			$scope.SavingItemId = user.id;
			api.POST('reset_pass',data,function success(response){
				$scope.SavingItemId =null;
			});
			initAPIRequests();
		}
		function initAPIRequests()
		{
			var data = {limit:'less'};
			api.GET('maintenance_lists',data,function success(response){
				console.log(response.data);
				$scope.MaintenanceList = response.data;
			});	
			api.GET('year_levels',data,function success(response){
			$scope.YearLevels = response.data;
			});	
			api.GET('educ_levels',data,function success(response){
				$scope.EducLevels = response.data;
			});
			api.GET('programs',data,function success(response){
				$scope.Programs = response.data;
			});
			api.GET('sections',data,function success(response){
				$scope.Sections = response.data;
			});
			api.GET('user_types',data,function success(response){
				$scope.UserTypes = response.data;
			});
			api.GET('modules',data,function success(response){
				$scope.Modules = response.data;
			});
			api.GET('master_periods',data,function success(response){
				$scope.Periods = response.data;
			});
			api.GET('calendars',data,function success(response){
				$scope.Calendars = response.data;
			});
			api.GET('curriculums',data,function success(response){
				$scope.curris = response.data;
			});
			api.GET('subjects',data,function success(response){
				$scope.subjs = response.data;
			});
			api.GET('school_days',data,function success(response){
				$scope.sd = response.data;
				$scope.Months = [];
				for(var i=0; i<$scope.sd.length; i++){
					$scope.month = $scope.sd[i].month;
					var count = {};
					if($scope.month==1){
						count['id']=$scope.month;
						count['alias']='JAN';
					}if($scope.month==2){
						count['id']=$scope.month;
						count['alias']='FEB';
					}if($scope.month==3){
						count['id']=$scope.month;
						count['alias']='MAR';
					}if($scope.month==4){
						count['id']=$scope.month;
						count['alias']='APR';
					}if($scope.month==5){
						count['id']=$scope.month;
						count['alias']='MAY';
					}if($scope.month==6){
						count['id']=$scope.month;
						count['alias']='JUN';
					}if($scope.month==7){
						count['id']=$scope.month;
						count['alias']='JUL';
					}if($scope.month==8){
						count['id']=$scope.month;
						count['alias']='AUG';
					}if($scope.month==9){
						count['id']=$scope.month;
						count['alias']='SEPT';
					}if($scope.month==10){
						count['id']=$scope.month;
						count['alias']='OCT';
					}if($scope.month==11){
						count['id']=$scope.month;
						count['alias']='NOV';
					}if($scope.month==12){
						count['id']=$scope.month;
						count['alias']='DEC';
					}
					
					$scope.Months.push(count);
				}
				
			});
			$scope.inputBy = [
				{'id':1,'alias':'advsr'},
				{'id':2,'alias':'techr'}
			];
			
		}
		$scope.sortItems=function(){
			for(var index in $scope.SortItem){
				$scope.SortItem[index].order = parseInt(index)+1;
			}
			console.log($scope.SortItem);
		};
		$scope.saveSortItems=function(){
			var data = {reorder:[]};
			for(var index in $scope.SortItem){
				var item =  $scope.SortItem[index];
				data.reorder.push(item.id);
			}
			var success = function(response){
				$scope.List.state="edit";
				$scope.ListItems=angular.copy($scope.SortItem);
				
			};
			console.log(data);
			api.POST($scope.List.path, data, success);
			
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


