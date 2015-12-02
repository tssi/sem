"use strict";
define(['app','api'], function (app) {
    app.register.controller('FeeController',['$scope','$rootScope','$timeout','api', function ($scope,$rootScope,$timeout,api) {
		$scope.init=function(){
			$scope.Titles = [
							{id:1, title:"Fees"},
							{id:2, title:"Nursery/Kinder I"},
							{id:3, title:"Kinder II"},
							{id:4, title:"Grade 1-4"},
							{id:5, title:"Year Levels"},
						   ];
			$scope.Spreadsheet=[
						[
							{
								row:1,
								col:1,
								state: "read",
								value:"A"
							},
							{
								row:1,
								col:2,
								state: "read",
								value:2
							},
							{
								row:1,
								col:3,
								state: "read",
								value:5001.55
							},
							{
								row:1,
								col:4,
								state: "read",
								value:5002.55
							},
							{
								row:2,
								col:5,
								state: "read",
								value:5003.55
							},
						],
						[
							{
								row:2,
								col:1,
								state: "read",
								value:"F"
							},
							{
								row:2,
								col:2,
								state: "read",
								value:6
							},
							{
								row:2,
								col:3,
								state: "read",
								value:5001.55
							},
							{
								row:2,
								col:4,
								state: "read",
								value:5002.55
							},
							{
								row:2,
								col:5,
								state: "read",
								value:5003.55
							},
						]
					  ];
			$scope.ActiveRow=0;
			$scope.ActiveCol=0;
			$scope.$watch('ActiveRow',$scope.ActivateCell);
			$scope.$watch('ActiveCol',$scope.ActivateCell);
			$scope.$watch('Spreadsheet[ActiveRow][ActiveCol]',$scope.AdjustTotal);
			$scope.ComputeTotal();
		};
		$scope.ComputeTotal = function(){
			$scope.Totals={};
			for(var rowIndex in $scope.Spreadsheet){
				var row = $scope.Spreadsheet[rowIndex];
				for(var colIndex in row){
					var col=row[colIndex]
					if(colIndex > 0){
						if(!$scope.Totals[colIndex]){
							$scope.Totals[colIndex]=0;
						};
						$scope.Totals[colIndex] = $scope.Totals[colIndex]+col.value;
					};
				};
			};
		};
		$scope.AdjustTotal = function(newValue,oldValue){
			var old=oldValue.value;
			var new1 = newValue.value;
			console.log(old,new1);
			if($scope.ActiveCol>0 && typeof oldValue.value!='string' && typeof newValue.value!='string'){
				$scope.Totals[$scope.ActiveCol]=-old+new1;
				console.log($scope.Totals[$scope.ActiveCol]);
			}
		};
		$scope.updateState=function(rowIndex,colIndex,state){
			var delay = 0;
			if(state=='read') delay = 150;
			$timeout(function(){
				if(state=='write'){
					$scope.Spreadsheet[$scope.ActiveRow][$scope.ActiveCol].state='read';
					$scope.ActiveRow=rowIndex;
					$scope.ActiveCol=colIndex;
				}
			},delay);
		};
		$scope.addRow=function(rowIndex,colIndex){
			var delay = 151;
			var row = angular.copy($scope.Spreadsheet[rowIndex]);
			for(var index in row){
				row[index].value=null;
				row[index].row=rowIndex.length+1;
				row[index].state='read';
			};
			
			$timeout(function(){
				$scope.Spreadsheet.push(row);
				$scope.ActiveRow=rowIndex+1;
				$scope.ActiveCol=colIndex;
			},delay);
				
		};
		$scope.addCol=function(){
			//$scope.Spreadsheet.push();
		};
		$scope.removeRow=function(rowIndex){
			$scope.Spreadsheet.splice(rowIndex,1);
		};
		$scope.handlePress=function(event){
			if(event.key==="Enter"){
				$scope.Spreadsheet[$scope.ActiveRow][$scope.ActiveCol].state='read';
				var lastRow=$scope.Spreadsheet.length-1;
				var lastCol=$scope.Spreadsheet[$scope.ActiveRow].length-1
				if($scope.ActiveRow==lastRow && $scope.ActiveCol==lastCol){
					$scope.ActiveRow=0;
					$scope.ActiveCol=0;
				}
				else if($scope.ActiveRow===lastRow){
					$scope.ActiveRow=0;
					$scope.ActiveCol=$scope.ActiveCol+1;
				}
				else
					$scope.ActiveRow = $scope.ActiveRow+1;
			};
			if(event.key==="Tab"){
				$scope.Spreadsheet[$scope.ActiveRow][$scope.ActiveCol].state='read';
				var lastRow=$scope.Spreadsheet.length-1;
				var lastCol=$scope.Spreadsheet[$scope.ActiveRow].length-1
				if($scope.ActiveRow===lastRow && $scope.ActiveCol===lastCol){
					$scope.ActiveRow=0;
					$scope.ActiveCol=-1;
				}
				if($scope.ActiveCol==lastCol){
					$scope.ActiveCol=-1;
					$scope.ActiveRow=$scope.ActiveRow+1;
				}
				if($scope.ActiveCol<lastCol){
					$scope.ActiveCol = $scope.ActiveCol+1;
				}
			};                
		};
		$scope.ActivateCell=function(){
			$scope.Spreadsheet[$scope.ActiveRow][$scope.ActiveCol].state='write';
		};
    }]);
});


