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
					if($scope.Tuition == undefined ||$scope.Tuition.fees == undefined ) return false;
					return $scope.Tuition.fees.
						map(function(obj) {
							return obj.amount;
						});
				}, 
				function (newValue) {
					if(newValue){
						var total = 0;
						for(var i in newValue){
							var amount =  newValue[i];
							total+=parseFloat(amount);
						}
						$scope.Tuition.amount =  total;
						$scope.saveTuitionTotal();
					}
			}, true);
			$scope.$watch('Tuition.amount',function(newAmount){
				 for(var i in $scope.Schemes){
					   var scheme =  $scope.Schemes[i];
					   $scope.Variance[scheme.id]= $scope.Totals[scheme.id] - newAmount;
				   }
			});
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
		   $scope.SavingDiscount = [];
		   $scope.SavingSchedule = {};
		   initAmounts();
		   initTotals();
		   mapAmounts();
	   }
	   $scope.navigatePage=function(page){
			$scope.ActivePage=page;
			getTuitions({page:$scope.ActivePage});
		};
		$scope.filterTuition=function(tuition){
				var searchBox = $scope.searchTuition;
				var keyword = new RegExp(searchBox,'i');	
				var test = keyword.test(tuition.name) || keyword.test(tuition.description);
				return !searchBox || test;
			};
		$scope.confirmSearch = function(){
			getTuitions({page:$scope.ActivePage,keyword:$scope.searchTuition,fields:['name','description']});
		}
		//Filter search box
		$scope.clearSearch = function(){
			$scope.searchTuition = null;
			getTuitions({page:$scope.ActivePage,fields:['name','description']});
		};
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
			if(!feeItem.amount) feeItem.amount=0;
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
			 $scope.SavingDiscountItem = true;
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
			   $scope.SavingDiscountItem = false;
		   });
	   }
	   $scope.removeDiscountItem = function(item,index){
		   var data = {id:item.tuition_discount_id};
		    $scope.SavingDiscount[index]=true;
		   api.DELETE('tuition_discounts',data,function success(response){
			   $scope.SavingDiscount[index]=false;
			   $scope.SavingDiscountItem = false;
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
		$scope.computeTotal = function(scheme_id, billing_period_id){
			$scope.Totals[scheme_id]=0;
			for(var bill_period in $scope.Amounts){
				var amount = $scope.Amounts[bill_period][scheme_id];
				var multiplyer = $scope.Multiplyer[bill_period];
				if(amount)
					$scope.Totals[scheme_id]+=(amount*multiplyer);
			}
			$scope.Variance[scheme_id] =  $scope.Totals[scheme_id] - $scope.Tuition.amount;
			if(billing_period_id){
				var tuition_id = $scope.Tuition.id;
				var payment_scheme_id = $scope.SchemeId[billing_period_id][scheme_id];
				var schedule_id = $scope.ScheduleId[billing_period_id][scheme_id];
				var total_amount  = $scope.Totals[scheme_id];
				var variance_amount  = $scope.Variance[scheme_id];
				var amount = $scope.Amounts[billing_period_id][scheme_id];
					if(amount==undefined) amount = 0;
				var scheme_data = {id:payment_scheme_id,tuition_id:tuition_id,scheme_id:scheme_id,total_amount:total_amount,variance_amount:variance_amount};
				var schedule_data = {id:schedule_id,tuition_id:tuition_id,scheme_id:scheme_id,billing_period_id:billing_period_id,amount:amount};
				$scope.SavingSchedule[billing_period_id] = true;
				$scope.SavingScheduleTotals = true;
				api.PUT('payment_schemes',scheme_data,function success(response){
					$scope.SchemeId[billing_period_id][scheme_id] =  response.data.id;
					api.PUT('payment_scheme_schedules',schedule_data,function success(response){
						$scope.ScheduleId[billing_period_id][scheme_id] =  response.data.id;
						$scope.SavingSchedule[billing_period_id] = false;
						$scope.SavingScheduleTotals = false;
					});
				});
			}
		}
		$scope.savePayschemSchedule = function(){
			var tuition_id = $scope.Tuition.id;
			var schemes = [];
			var schedules = [];
			for(var i in $scope.BillingPeriods){
				var bp = $scope.BillingPeriods[i];
				var billing_period_id = bp.id;
				var hasAmount =false;
				for(var scheme_id  in $scope.SchemeId[billing_period_id]){
					var payment_scheme_id = $scope.SchemeId[billing_period_id][scheme_id];
					var schedule_id = $scope.ScheduleId[billing_period_id][scheme_id];
					var total_amount  = $scope.Totals[scheme_id];
					var variance_amount  = $scope.Variance[scheme_id];
					var amount = $scope.Amounts[billing_period_id][scheme_id];
					var scheme_data = {id:payment_scheme_id,tuition_id:tuition_id,scheme_id:scheme_id,total_amount:total_amount,variance_amount:variance_amount};
					var schedule_data = {id:schedule_id,tuition_id:tuition_id,scheme_id:scheme_id,billing_period_id:billing_period_id,amount:amount};
					$scope.SavingSchedule[billing_period_id] = true;
					schemes.push(scheme_data);
					schedules.push(schedule_data);
					hasAmount |= amount;
				}
				if(hasAmount) 
					$scope.SavingSchedule[billing_period_id] = true;
			}
			$scope.SavingScheduleTotals = true;
			api.PUT('payment_schemes',schemes,function success(response){
					api.PUT('payment_scheme_schedules',schedules,function success(response){
						for(var index in response.data){
							var datum = response.data[index];
							if(datum){
								$scope.SavingSchedule[datum.billing_period_id]=false;
							}
						}
						$scope.SavingScheduleTotals = false;
					});
				});
			
		}
		$scope.resetAmounts = function(bill_period){
			$scope.Amounts[bill_period] = {};
			for(var i in $scope.Schemes){
				var scheme = $scope.Schemes[i];
				$scope.computeTotal(scheme.id,bill_period);
			}
		}
		$scope.eraseAmounts = function(target){
			if(target=='schemes'){
				for(var i in $scope.BillingPeriods){
					var bill_period =  $scope.BillingPeriods[i];
					var bp_id = bill_period.id;
					for(var scheme_id in $scope.SchemeId[bp_id])
						api.DELETE('payment_schemes',{id:$scope.SchemeId[bp_id][scheme_id]},function success(response){});
					for(var scheme_id in $scope.ScheduleId[bp_id])
						api.DELETE('payment_scheme_schedules',{id:$scope.ScheduleId[bp_id][scheme_id]},function success(response){});
					$scope.Amounts[bp_id] = {};
					$scope.SchemeId[bp_id]={};
					$scope.ScheduleId[bp_id]={};
				}				
				initTotals();
			}else if(target=='discounts'){
				$scope.SavingDiscountItem = true;
				for(var index in $scope.Tuition.discounts){
					var data = {id:$scope.Tuition.discounts[index].tuition_discount_id};
						$scope.SavingDiscount[index]=true;
						 api.DELETE('tuition_discounts',data,function success(response){
						   $scope.SavingDiscount[index]=false;
						   $scope.SavingDiscountItem = false;
						  $scope.Tuition.discounts=[]; 
						});
				}
			}
		}
		$scope.openModal = function(){
				var modalInstance = $uibModal.open({
					animation: true,
					templateUrl: 'TuitionModal.html',
					controller: 'ModalInstanceController',
				});
				modalInstance.result.then(function (tuition) {
				  $scope.TuitionList.push(tuition);
				  $scope.openTuition(tuition);
				}, function (source) {
					//Re-initialize booklets when confirmed
					
						
				});
		}
		function resetTuition(){
			$scope.FeeItem = {};
			$scope.DiscountItem = {};
			$scope.SortItem = {};
		}
	   function initAPIRequest(){
			$scope.ActivePage = 1;
			$scope.NextPage=null;
			$scope.PrevPage=null;
			$scope.DataLoading = false;
			getTuitions({page:$scope.ActivePage});
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
	   function getTuitions(data){
			$scope.DataLoading=true;
			$scope.ErrorCode  = null;
			$scope.ErrorMessage  = null;
			data.limit = 5;
			api.GET('tuitions',data,function success(response){
				console.log(response);
				switch(parseInt(response.meta.code)){
					case 200:
						$scope.TuitionList=response.data;
						$scope.NextPage=response.meta.next;
						$scope.PrevPage=response.meta.prev;
						$scope.TotalItems=response.meta.count;
						$scope.LastItem=response.meta.page*response.meta.limit;
						$scope.FirstItem=$scope.LastItem-(response.meta.limit-1);
						if($scope.LastItem>$scope.TotalItems){
							$scope.LastItem=$scope.TotalItems;
						};
					break;
					default:
						$scope.ErrorCode = response.meta.code;
						$scope.ErrorMessage = response.meta.message;
					break;
				}
				$scope.DataLoading = false;							
			},function error(response){
			   $scope.DataLoading = false;	
			   $scope.ErrorCode = response.meta.code;
			   $scope.ErrorMessage = response.meta.message;
		   });
		}
	   function initAmounts(){
		   $scope.Amounts = {};
		   $scope.Multiplyer = {};
		   $scope.SchemeCode = {};
		   $scope.ScheduleId = {};
		   $scope.SchemeId = {};
		   for(var i in $scope.BillingPeriods){
			   var period =  $scope.BillingPeriods[i];
			   $scope.ScheduleId[period.id]={};
			   $scope.SchemeId[period.id]={};
			   $scope.Amounts[period.id]={};
			   $scope.Multiplyer[period.id]=period.payment_frequency;
			   $scope.SchemeCode[period.id]=period.code;
		   }
	   }
	   function initTotals(){
		   $scope.Totals = {};
		   $scope.Variance = {};
		   for(var i in $scope.Schemes){
			   var scheme =  $scope.Schemes[i];
			   $scope.Totals[scheme.id]=0;
			   if($scope.Tuition) 
					$scope.Variance[scheme.id]=-$scope.Tuition.amount;
			   else
					$scope.Variance[scheme.id] = 0;
		   }
	   }
	   function mapAmounts(){
		   for(var si in $scope.Tuition.schemes){
				var scheme  =  $scope.Tuition.schemes[si];
				for(var sj in scheme.schedule){
				   var schedule =  scheme.schedule[sj];
					$scope.SchemeId[schedule.billing_period_id][scheme.id] = schedule.payment_scheme_id;
					$scope.ScheduleId[schedule.billing_period_id][scheme.id] = schedule.id;
					$scope.Amounts[schedule.billing_period_id][scheme.id] = schedule.amount;
				}
				$scope.computeTotal(scheme.id);
		   }		   
	   }
	}]);
	app.register.controller('ModalInstanceController',['$scope','$filter','$uibModalInstance','api', function ($scope, $filter, $uibModalInstance, api){
		$scope.initialize = function(){
			initAPIRequest();
			$scope.$watchGroup(['school_year','program','year_level'],generateTuitionCode);
			function generateTuitionCode(){
				var code = '';
				if($scope.year_level&&$scope.program&&$scope.school_year){
					code += $scope.year_level;
					code += $scope.program;
					code += $scope.school_year.slice(-2);
				}
				
				$scope.tuition_code = code;
				var year_level = $scope.year_level?$filter('filter')($scope.YearLevels, {id: $scope.year_level})[0]:null;
				var school_year = $scope.school_year?$filter('filter')($scope.SchoolYears, {id: $scope.school_year})[0]:null;
				var program = $scope.program?$scope.Programs[$scope.program]:'';
				$scope.placeholder_name='Name';
				$scope.placeholder_description='Description';
				if($scope.year_level||program){
					$scope.placeholder_name+=': ';
					$scope.placeholder_description+=': ';
				}
				if($scope.year_level){
					$scope.placeholder_name += year_level.alias+' ';
					$scope.placeholder_description += year_level.name+' ';
				}
				if(program){
					$scope.placeholder_name += program+' ';
					$scope.placeholder_description += program+' ';
				}
					
				if(school_year&&($scope.year_level||program)){
					$scope.placeholder_name += school_year.id;
					$scope.placeholder_description += school_year.label;
				}
				
			}
		}
		$scope.setDeparment  = function(id){
			$scope.department = id;
		}
		$scope.suggestValue = function(field,is_pristine,suggestion){
			if(is_pristine){
				if(suggestion){
					var placeholder = suggestion;
					var token_index = placeholder.indexOf(':');
					suggestion  =  placeholder.substr(token_index+2,placeholder.length);
				}
				$scope[field] = suggestion;
			}
			
		}
		$scope.confirmTuition = function(){
			var data = {
				id:$scope.tuition_code,
				name:$scope.name,
				description:$scope.description,
				sy:$scope.school_year,
				year_level_id:$scope.year_level,
				program_id:$scope.program,
				amount:0,
			}
			$scope.SavingTuition= true;
			api.POST('tuitions',data,function success(response){
				$scope.SavingTuition = false;
				$uibModalInstance.close(response.data);
			},function error(response){
				
			});
		};
		$scope.cancelTuition = function(){
			$uibModalInstance.dismiss('cancel');
		};
		function initAPIRequest(){
			api.GET('system_defaults',function success(response){
				$scope.SchoolYears = response.data.SCHOOL_YEARS;
				$scope.Programs = response.data.PROGRAMS;
				$scope.Departments = response.data.DEPARTMENTS;
				$scope.YearLevels = response.data.YEAR_LEVELS;
				$scope.ACTIVE_SY = response.data.ACTIVE_SY;
				$scope.school_year = response.data.ACTIVE_SY.toString();
			
			});
		}
	}]);
});