"use strict";
define(['app','api'], function (app) {
    app.register.controller('FeeController',['$scope','$rootScope','$timeout','api', function ($scope,$rootScope,$timeout,api) {
		$scope.init=function(){
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
								value:5000.55
							},
							{
								row:1,
								col:3,
								state: "read",
								value:5000.55
							},
							{
								row:1,
								col:4,
								state: "read",
								value:5000.55
							},
							{
								row:2,
								col:5,
								state: "read",
								value:5000.55
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
								value:5000.55
							},
							{
								row:2,
								col:3,
								state: "read",
								value:5000.55
							},
							{
								row:2,
								col:4,
								state: "read",
								value:5000.55
							},
							{
								row:2,
								col:5,
								state: "read",
								value:5000.55
							},
						]
					  ];
			$scope.ActiveRow=0;
			$scope.ActiveCol=0;
			$scope.$watch('ActiveRow',$scope.ActivateCell);
			$scope.$watch('ActiveCol',$scope.ActivateCell);
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


