"use strict";
define(['app','api'], function (app) {
    app.register.controller('TuitionController',['$scope','$rootScope','$uibModal','api', function ($scope,$rootScope,$uibModal,api) {
		$scope.list=function(){
			$rootScope.__MODULE_NAME = 'Tuition Structure';
			resetTuition();
			initAPIRequest();
			$scope.$watchCollection('SortItem.fees',function(newValue,oldValue){
				$scope.sortItems('fees');
			});
	   };
	   $scope.openTuition = function(tuition){
		   resetTuition();
		   $scope.Tuition = tuition;
		   $scope.Tuition.state = {fees:'edit',schedule:'edit',discounts:'edit'};
	   }
	   $scope.removeTuitionInfo = function(){
		   resetTuition();
		   $scope.Tuition = null;
	   }
	   $scope.addFeeItem = function(feeItem,amount){
		   var data =  {
			   fee_id:feeItem.id,
			   amount:amount,
			   tuition_id:$scope.Tuition.id,
			   order:$scope.Tuition.fees.length+1
			  };
		   api.POST('fee_breakdowns',data,function success(response){
			   var fee = {
					fee_breakdown_id:response.data.id,
					name:feeItem.name,
					amount:amount,
					order:response.data.order
				};
			   $scope.Tuition.fees.push(fee);
			   $scope.FeeItem = {};
		   });
	   }
	   $scope.removeFeeItem = function(item,index){
		   var data = {id:item.fee_breakdown_id};
		   api.DELETE('fee_breakdowns',data,function success(response){
			  $scope.Tuition.fees.splice(index,1); 
		   });
	   }
	   $scope.addDiscountItem = function(discountItem){
		   var data =  {
			   discount_id:discountItem.id,
			   tuition_id:$scope.Tuition.id,
			   order:$scope.Tuition.discounts.length+1
			  };
		   api.POST('tuition_discounts',data,function success(response){
			   var discount = {
					tuition_discount_id:response.data.id,
					name:discountItem.name,
					fees_applicable:discountItem.fees_applicable,
					disaplay_amount:discountItem.disaplay_amount,
					order:response.data.order
				};
			   $scope.Tuition.discounts.push(discount);
			   $scope.DiscountItem = {};
		   });
	   }
	   $scope.removeDiscountItem = function(item,index){
		   var data = {id:item.tuition_discount_id};
		   api.DELETE('tuition_discounts',data,function success(response){
			  $scope.Tuition.discounts.splice(index,1); 
		   });
	   }
	   $scope.updateState=function(list,state){
			$scope.Tuition.state[list]=state;
			if(state==='sort'){
				$scope.SortItem[list]=angular.copy($scope.Tuition[list]);
			}
		};
		$scope.sortItems=function(list){
			for(var index in $scope.SortItem[list]){
				$scope.SortItem[list][index].order = parseInt(index)+1;
			}
		};
		$scope.saveSortItems=function(list){
			var data = {reorder:[]};
			for(var index in $scope.SortItem[list]){
				var item =  $scope.SortItem[list][index];
				data.reorder.push(item.fee_breakdown_id);
			}
			var path = 'fee_breakdowns';
			api.POST(path,data,function success(response){
				$scope.Tuition[list]=angular.copy($scope.SortItem[[list]]);
				$scope.Tuition.state[list]="edit";
			});
		};
		function resetTuition(){
			$scope.FeeItem = {};
			$scope.DiscountItem = {};
			$scope.SortItem = {};
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