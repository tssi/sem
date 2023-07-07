"use strict";
define(['app','api','atomic/bomb'],function(app){
	app.register.controller('EnrollmentController',['$rootScope','$scope','api','Atomic','aModal','$http','$filter','$timeout',
	function($rootScope,$scope,api,atomic, aModal,$http,$filter,$timeout){
		const $selfScope = $scope;
		$scope = this;
		$scope.init = function(){
			$rootScope.__MODULE_NAME = 'Enrollment Report';
			/* $scope.Headers = ['Date','Day','Gr 7','Gr 8','Gr 9','Gr 10','ABM 11''STEM 11','HUMS 11','TVL 11','ABM 12','STEM 12','HUMS 12','TVL 12'];
			$scope.Props = ['date','day','levels.G7','levels.G8','l']; */
			$scope.SearchBy = ['name'];// Fields you can search from the items 	
			$scope.Options = ['Summary','List'];
			$scope.Order = ['Year Level','Date'];
			$scope.ActiveOrder = 'Year Level';
			$scope.ActiveOpt = 'Summary';
			$scope.DateToday = new Date();
			console.log(new Date());
			atomic.ready(function(){
				$scope.ActiveSY = atomic.ActiveSY;
				getList();
			});
			
		};
		
		$selfScope.$watch("EC.Active",function(active){
			if(!active) return false;
			$scope.ActiveSY = active.sy;
			console.log($scope.ActiveSY);
		});
		
		$scope.setActOption = function(opt){
			$scope.ActiveOpt = opt;
		}
		$scope.setActiveOrder = function(opt){
			$scope.ActiveOrder = opt;
		}
		
		$scope.Clear = function(){
			$scope.date = '';
			$scope.Enrollment = '';
		}
		
		$scope.Print = function(){
			console.log($scope.Enrollment);
			$timeout(function(){
				document.getElementById('PrintEnrollment').submit();
			},1000);
		}
		$scope.PrintList = function(){
			if($scope.ActiveOrder=='Year Level'){
				$timeout(function(){
					document.getElementById('PrintEnrollmentList').submit();
				},1000);
			}else{
				$timeout(function(){
					document.getElementById('PrintEnrollmentDate').submit();
				},1000);
			}
		}
		
		$scope.LoadReport = function(){
			$scope.Loading = 1;
			var data = {
				esp:$scope.ActiveSY,
				transaction_type_id:'TUIXN',
				transac_date:$scope.date,
				limit:'less'
			}
			data.transac_date = $filter('date')(new Date(data.transac_date),'yyyy-MM-dd');
			api.GET('enrollments',data, function success(response){
				var overall = [];
				var ctr = 0;
				angular.forEach(response.data[0].overall, function(item){
					if(item.day=='Sun')
						return;
					overall[ctr]=item;
					ctr++;
				});
				response.data[0].overall = overall;
				$scope.Enrollment = response.data[0];
				
				getPrev(data,ctr)
			}, function error(response){
				
			});
		}
		function getPrev(data,ctr){
			data.ctr = ctr;
			data.transac_date = '';
			data.esp = $scope.ActiveSY-1;
			api.GET('enrollments',data, function success(response){
				var HS = ['G7','G8','G9','GX'];
				var counter = 0;
				$scope.Enrollment.totals.levels['HS']=0;
				$scope.Enrollment.totals.levels['SH']=0;
				$scope.Enrollment.totals.levels['prevtotal']=0;
				angular.forEach(response.data[0].overall, function(item){
					if(item.day=='Sun')
						return;
					if(counter > $scope.Enrollment.overall.length-1)
						return;
					$scope.Enrollment.overall[counter].levels['HS']=0;
					$scope.Enrollment.overall[counter].levels['SH']=0;
					$scope.Enrollment.overall[counter].levels['prevtotal']=0;
					for(var key in item.levels){
						var level = item.levels[key];
						if(HS.indexOf(key)!==-1 && level>0){
							$scope.Enrollment.overall[counter].levels['HS']+=level;
							$scope.Enrollment.overall[counter].levels['prevtotal']+=level;
							$scope.Enrollment.totals.levels['HS']+=level;
						}
						if(HS.indexOf(key)===-1 && level>0 &&key != 'total'){
							$scope.Enrollment.overall[counter].levels['SH']+=level;
							$scope.Enrollment.overall[counter].levels['prevtotal']+=level;
							$scope.Enrollment.totals.levels['SH']+=level;
						}
						if(key!='total')
							$scope.Enrollment.totals.levels['prevtotal']+=level;
					}
					counter++;
					
				});
				angular.forEach($scope.Enrollment.overall, function(o) {
					angular.forEach(o.levels, function(lvl, index) {
						if (lvl == 0)
							o.levels[index] = '-';
					});
				});
				angular.forEach($scope.Enrollment.today.levels, function(lvl,index){
					if(lvl==0)
						$scope.Enrollment.today.levels[index]='-';
				})
				console.log($scope.Enrollment)
				angular.forEach($scope.Enrollment.totals.levels, function(lvl,index){
					if(lvl==0)
						$scope.Enrollment.totals.levels[index]='-';
				})
				
				$scope.Loading = 0;
			}, function error(response){
				
			});
		}
		
		function getList(){
			var data = {
				esp:$scope.ActiveSY,
				transaction_type_id:'INIPY',
				limit:'less'
			}
			api.GET('enrollment_lists',data, function success(response){
				angular.forEach(response.data[0].level, function(item){
					switch(item.level){
						case 'G7': item.level = 'Grade 7'; break;
						case 'G8': item.level = 'Grade 8'; break;
						case 'G9': item.level = 'Grade 9'; break;
						case 'GX': item.level = 'Grade 10'; break;
						case 'GYABM': item.level = 'Grade 11 ABM'; break;
						case 'GYSTEM': item.level = 'Grade 11 STEM'; break;
						case 'GYTVL': item.level = 'Grade 11 TVL'; break;
						case 'GYHUMS': item.level = 'Grade 11 HUMMS'; break;
						case 'GYGAS': item.level = 'Grade 11 GAS'; break;
						case 'GYMIXED': item.level = 'Grade 11 IRREG'; break;
						case 'GZABM': item.level = 'Grade 12 ABM'; break;
						case 'GZSTEM': item.level = 'Grade 12 STEM'; break;
						case 'GZTVL': item.level = 'Grade 12 TVL'; break;
						case 'GZHUMS': item.level = 'Grade 12 HUMMS'; break;
						case 'GZGAS': item.level = 'Grade 12 GAS'; break;
						case 'GZMIXED': item.level = 'Grade 12 IRREG'; break;
					};
				})
				angular.forEach(response.data[0].days, function(item){
					angular.forEach(item.lists, function(i){
						switch(i.year_level_id){
							case 'G7': i.level = 'Grade 7'; break;
							case 'G8': i.level = 'Grade 8'; break;
							case 'G9': i.level = 'Grade 9'; break;
							case 'GX': i.level = 'Grade 10'; break;
							case 'GY': i.level = 'Grade 11'; break;
							case 'GZ': i.level = 'Grade 12'; break;
						}
					});
					
				});
				$scope.Lists = response.data[0].level;
				$scope.Days = response.data[0].days;
				console.log($scope.Lists);
			});
		}
		
		
	}]);
});