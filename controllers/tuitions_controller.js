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
			$scope.$watch(
				function($scope) {
					if($scope.Tuition == undefined) return false;
					return $scope.Tuition.fees.
						map(function(obj) {
							return obj.amount
						});
				}, 
				function (newValue) {
					if(newValue){
						var total = 0;
						for(var i in newValue){
							var amount =  newValue[i];
							total+=amount;
						}
						$scope.Tuition.amount =  total;
						$scope.saveTuitionTotal();
					}
			}, true);
	   };
	   $scope.saveTuitionTotal = function(){
			var data = {id:$scope.Tuition.id,amount:$scope.Tuition.amount};
			$scope.SavingTutionTotal = true;
			api.PUT('tuitions',data,function success(response){
				$scope.SavingTutionTotal = false;
			});
	   }
	   $scope.openTuition = function(tuition){
		   resetTuition();
		   $scope.Tuition = tuition;
		   $scope.Tuition.state = {fees:'edit',schedule:'edit',discounts:'edit'};
		   $scope.SavingFee = [];
		   initAmounts();
		   initTotals();
	   }
	   $scope.removeTuitionInfo = function(){
		   $scope.Tuition = null;
	   }
	   $scope.addFeeItem = function(feeItem,amount){
		   var data =  {
			   fee_id:feeItem.id,
			   amount:amount,
			   tuition_id:$scope.Tuition.id,
			   order:$scope.Tuition.fees.length+1
			  };
			$scope.SavingFeeItem = true;
		   api.POST('fee_breakdowns',data,function success(response){
			   var fee = {
					fee_breakdown_id:response.data.id,
					name:feeItem.name,
					amount:amount,
					order:response.data.order
				};
			   $scope.Tuition.fees.push(fee);
			   $scope.FeeItem = {};
			   $scope.SavingFeeItem = false;
		   });
	   }
	   $scope.removeFeeItem = function(item,index){
		   var data = {id:item.fee_breakdown_id};
		   $scope.SavingFee[index]=true;
		   api.DELETE('fee_breakdowns',data,function success(response){
			  $scope.SavingFee[index]=false;
			  $scope.Tuition.fees.splice(index,1); 
		   });
	   }
	   $scope.updateFeeItem = function(feeItem,index){
		     var data =  {
			   id:feeItem.fee_breakdown_id,
			   amount:feeItem.amount
			  };
			$scope.SavingFee[index]=true;
		   api.PUT('fee_breakdowns',data,function success(response){
			   $scope.SavingFee[index]=false;
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
					display_amount:discountItem.display_amount,
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
			$scope.SavingFees =true;
			api.POST(path,data,function success(response){
				$scope.Tuition[list]=angular.copy($scope.SortItem[[list]]);
				$scope.Tuition.state[list]="edit";
				$scope.SavingFees =false;
			});
		};
		$scope.computeTotal = function(scheme_id){
			$scope.Totals[scheme_id]=0;
			for(var bill_period in $scope.Amounts){
				var amount = $scope.Amounts[bill_period][scheme_id];
				var multiplyer = $scope.Multiplyer[bill_period];
				if(amount)
					$scope.Totals[scheme_id]+=(amount*multiplyer);
			}
		}
		$scope.resetAmounts = function(bill_period){
			$scope.Amounts[bill_period] = {};
			for(var i in $scope.Schemes){
				var scheme = $scope.Schemes[i];
				$scope.computeTotal(scheme.id);
			}
		}
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
			   initTotals();
		   });
		   api.GET('billing_periods',function success(response){
			  $scope.BillingPeriods = response.data;
			  initAmounts();
		   });
		   api.GET('fees',function success(response){
			   $scope.Fees = response.data;
		   });
		   api.GET('discounts',function success(response){
			   $scope.Discounts = response.data;
		   })
	   }
	   function initAmounts(){
		   $scope.Amounts = {};
		   $scope.Multiplyer = {};
		   for(var i in $scope.BillingPeriods){
			   var period =  $scope.BillingPeriods[i];
			   $scope.Amounts[period.id]={};
			   $scope.Multiplyer[period.id]=period.payment_frequency;
		   }
	   }
	   function initTotals(){
		   $scope.Totals = {};
		   for(var i in $scope.Schemes){
			   var scheme =  $scope.Schemes[i];
			   $scope.Totals[scheme.id]=0;
		   }
	   }
	}]);
});