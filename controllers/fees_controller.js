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
		};
		$scope.updateState=function(rowIndex,colIndex,state){
			var delay = 0;
			if(state=='read') delay = 150;
			$timeout(function(){$scope.Spreadsheet[rowIndex][colIndex].state=state;},delay);
		};
		$scope.addRow=function(rowIndex){
			var delay = 151;
			var row = angular.copy($scope.Spreadsheet[rowIndex]);
			for(var index in row){
				row[index].value=null;
				row[index].row=rowIndex.length+1;
				row[index].state='read';
			};
			
			$timeout(function(){$scope.Spreadsheet.push(row);},delay);
			
		};
		$scope.removeRow=function(rowIndex){
			$scope.Spreadsheet.splice(rowIndex,1);
		};
    }]);
});


