"use strict";
define(['app','api','atomic/bomb'],function(app){
	app.register.controller('ReservedController',['$rootScope','$scope','api','Atomic','aModal','$http','$filter',
		function($rootScope,$scope,api,atomic, aModal,$http,$filter){
			const $selfScope = $scope;
			$scope = this;
			$scope.init = function(){
				$scope.Headers = ['Date','OR Number','Student','Year Level','Status',];
				$scope.Props = ['transac_date','ref_no','name','year_level','status'];
				$scope.SearchBy = ['name'];// Fields you can search from the items 			
				$scope.Tabs = ['Breakdown','Summary'];
				$scope.ActiveTab = 'Breakdown';
				atomic.ready(function(){
					$selfScope.$watch('SI.ActiveStudent.department_id',function(deptId){
						
					});
				});
				loadStudents(1);
				getPrograms();
			};
			
			function loadStudents(page,search){
				var filter = {limit:10,page:page,field_type:'RSRVE'};
				if(search){
					filter.keyword = search.keyword;
					filter.fields = search.fields;
				}
				var success =  function(response){
					$scope.Meta =  response.meta;
					$scope.Students =  response.data;
					$scope.CurrentPage =  $scope.Meta.page;
					$scope.NoStudents = false;
				}
				var error = function(response){
					$scope.NoStudents = true;
				}
				api.GET('reservations', filter, success,error);
			}
			function getPrograms(){
				api.GET('programs',{department_id:'SH'}, function success(response){
					var progs = [];
					angular.forEach(response.data, function(data){
						if(data.id!='MIXED')
							progs[data.id] = {description:data.alias,total_old:0,total_new:0,total:0};
					});
					$scope.Programs = progs;
					getForPrinting();
				});
			}
			
			function getForPrinting(){
				api.GET('reservations',{limit:9999,field_type:'RSRVE'},function success(response){
					var cnt = response.data.length;
					var levels = [];
					var totals = [];
					/*	
					angular.forEach(response.data, function(data){
						data['cnt'] = cnt;
						cnt++;
					});
					*/
					//data['cnt'] =  response.data.length;
					var totals = {};
						totals['total'] = cnt;
						totals['new'] = 0;
						totals['old'] = 0;
						totals['unset'] = 0;
					/*for(var i in response.data){
						var data = response.data[i];
						levels[data.year_level_id]={};
						
					};*/
					//Initialize programs & level objects for counter 
					var programs={};
					var levels = {};
					var lvlKys = ['G7','G8','G9','GX','GY','GZ'];
					var lvlNum = 7;

					for( var pg in  $scope.Programs){
						var pObj = $scope.Programs[pg];
						pObj.total = 0;
						pObj.total_new = 0;
						pObj.total_old = 0;
						programs[pg] =  pObj;
					}
					//console.log(programs);
					for(var k in lvlKys){
						var ky = lvlKys[k];
						var lvlObj = {};
							lvlObj.total = 0;
							lvlObj.total_new = 0;
							lvlObj.total_old = 0;
							
						// Build Description
						var desc =  'Grade '+ lvlNum;
							lvlObj.description = desc;
						// Attach programs for Grade 11 & G12
						if(ky== 'GY'|| ky=='GZ'){
							lvlObj.unset = 0;
							lvlObj.programs = programs;
						}

						levels[ky] =  lvlObj;
						lvlNum++;
					}
					console.log(levels);
					var RSV  = response.data;

					for(var i in RSV){
						var resObj  =  RSV[i];
						var yrLID = resObj.year_level_id;
						var prgID = resObj.program_id;
						console.log(yrLID,lvlKys.indexOf(yrLID));
						if(levels[yrLID]!=undefined){
							var targetLevel = levels[yrLID];
							switch(yrLID){
								case 'G7': case 'G8': case 'G9': case 'GX':
									// Counting for Grade 7 -10
									switch(resObj.status){
										case 'Old':
											targetLevel.total_old++;
											totals.old++;
										break;
										case 'New':
											targetLevel.total_new++;
											totals.new++;
										break;
									}
									targetLevel.total++;
								break;
								case 'GY': case 'GZ':
									// Counting for Grade 11 & 12
									if(prgID&&prgID!='MIXED'){
										var targetProgram =  targetLevel.programs[prgID];
										
										switch(resObj.status){
											case 'Old':
												targetProgram.total_old++;
												targetLevel.total_old++;
												totals.old++;
											break;
											case 'New':
												console.log(prgID);
												targetProgram.total_new++;
												targetLevel.total_new++;
												totals.new++;
											break;
										}
										targetProgram.total++;
										targetLevel.programs[prgID] =  targetProgram;
										
									}else{
										// No Assigned Program
										switch(resObj.status){
											case 'Old':
												targetLevel.total_old++;
												totals.old++;
											break;
											case 'New':
												targetLevel.total_new++;
												totals.new++;
											break;
										}
										targetLevel.unset++;
										totals.unset++;
										targetLevel.total++;
									}
								break;
							}
							
							
							totals.total++;
							// Apply changes to levels;
							levels[yrLID] =  targetLevel;
						}
					}
					var index = 0;
					var levelArr = [];
					var order = 1;
					console.log(levels);
					for(var ky in levels){
						var lvlObj = angular.copy(levels[ky]);
							lvlObj.order = order;
						switch(ky){
							case 'G7': case 'G8': case 'G9': case 'GX': 
								levelArr.push(lvlObj);
								order++;
							break;
							case 'GY': case 'GZ':
								//              OLD     NEW       TOTAL
								//  Grade 11             1         23
								//   ABM          0      1         0     1
								//   STEM
								//   HUMSS
								//   TVL
								//   No program
								var lvl = angular.copy(lvlObj);
								delete lvl.programs;
								delete lvl.total_old;
								delete lvl.total_new;
								delete lvl.total;
								levelArr.push(lvl);
								order++;
								for(var pg in lvlObj.programs){
									// ABM, STEM, HUMSS, TVL
									var prgObj =  lvlObj.programs[pg];
									levelArr.push(prgObj);
									order++;
								}
								if(lvlObj.unset>0){
									var noPrg = angular.copy(lvlObj);
									noPrg.order = order;
									noPrg.description = 'No Program';
									delete noPrg.programs;
									levelArr.push(noPrg);
									order++;
								}
							break;
						}
						
					}
					console.log(levelArr);
					//return;
					/*
					for(var i in levels){
						var lvl = levels[i];
						switch(i){
							case 'GY': levels[i]['programs'] = $scope.Programs; break;
							case 'GZ': levels[i]['programs'] = $scope.Programs; break;
						}
					}
					
					//console.log(levels); return;
					for(var i in levels){
						var item = levels[i];
						levels[i]['total']=0;
						levels[i]['total_new']=0;
						levels[i]['total_old']=0;
						levels[i]['unset']=0;
						
						switch(i){
							case 'G7': item['description'] = 'Grade 7'; item['order'] = 1; break;
							case 'G8': item['description'] = 'Grade 8'; item['order'] = 2; break;
							case 'G9': item['description']  = 'Grade 9'; item['order'] = 3; break;
							case 'GX': item['description']  = 'Grade 10'; item['order'] = 4; break;
							case 'GY': item['description']  = 'Grade 11'; item['order'] = 5; break;
							case 'GZ': item['description']  = 'Grade 12'; item['order'] = 6; break;
						}
						
						
						if(i!=='GY'&&i!='GZ'){
							angular.forEach(response.data, function(data){
								if(i==data.year_level_id){
									levels[i].total++;
									switch(data.status){
										case 'Old': levels[i].total_old++; totals['old']++; break;
										case 'New': levels[i].total_new++; totals['new']++; break;
									}
								}
							}); 
						}else{
							angular.forEach(response.data, function(data){
								if(data.year_level_id==i){
									levels[i].total++;
									for(var x in item['programs']){
										if(x==data.program_id){
											switch(data.status){
												case 'Old': item['programs'][x].total_old++; levels[i].total_old++; totals['old']++; break;
												case 'New': item['programs'][x].total_new++; levels[i].total_new++; totals['new']++; break;
											}
										}
										
									}
									if(data.program_id===null){
										levels[i].unset++;
										totals.unset++;
										switch(data.status){
											case 'Old': levels[i].total_old++; totals['old']++; break;
											case 'New': levels[i].total_new++; totals['new']++; break;
										}
										
									}
								}
								
							})
						}
						//console.log(levels[i]);
					}
					console.log(levels);
					var levelss=[];
					for(var i in levels){
						//console.log(levels[i]);
						/* if(levels[i]['programs']){
							
							for(var x in levels[i]['programs']){
								levelss[a]=levels[i]['programs'][x];
								a++; 
							}
						}
						else{ 
							levelss[levels[i].order-1]=levels[i];
					//	}
						
					}
					 var a=0;
					var levelsss = [];
					for(var i in levelss){
						
						if(levelss[i]['programs']){
							levelsss[a]=levelss[i];
							a++;
							for(var x in levelss[i]['programs']){
								levelss[i]['programs'][x]['order'] = a+1;
								levelsss[a]=levelss[i]['programs'][x];
								a++; 
							}
						}
						else{
							levelss[i]['order'] = a+1;
							levelsss[a]=levelss[i];
							a++;
						}
						//console.log(levelsss[a]);
						
					} */
					
					//console.log(levelss); return;*/
					$scope.CompleteReservations = {};
					$scope.CompleteReservations['breakdown'] = response.data;
					$scope.CompleteReservations['summary'] = levelArr;
					$scope.CompleteReservations['totals'] = totals;
					//console.log($scope.CompleteReservations);
				});
			}
			
			$scope.SetActiveTab = function(tab){
				$scope.ActiveTab = tab;
			}
			
			$scope.PrintRes = function(){
				document.getElementById('PrintRess').submit();
			}
			
			//SEARCH
			$scope.goToPage = function(page){
				var keyword =  $scope.Searchbox;
				var fields =  $scope.SearchBy;
				if(keyword){
					var search = {keyword:keyword,fields:fields};
					loadStudents(page,search);
				}else{
					loadStudents(page);
				}
			}
			
			$scope.search = function(keyword){//Catch the search event to handle loading of items, go to first page
				$scope.Students = '';
				var fields =  $scope.SearchBy;
				var search = {keyword:keyword,fields:fields};
				loadStudents(1,search);
			}
			$scope.clearSearch = function(){// on clear search reset the filter goto page 1
				$scope.Students = '';
				loadStudents(1);
			}
			
			
	}]);
});