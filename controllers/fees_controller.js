"use strict";
define(['app','api'], function (app) {
    app.register.controller('FeeController',['$scope','$rootScope','api', function ($scope,$rootScope,api) {
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
								value:"B"
							},
							{
								row:1,
								col:3,
								state: "read",
								value:"C"
							},
							{
								row:1,
								col:4,
								state: "read",
								value:"D"
							},
							{
								row:2,
								col:5,
								state: "read",
								value:"E"
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
								value:"G"
							},
							{
								row:2,
								col:3,
								state: "read",
								value:"H"
							},
							{
								row:2,
								col:4,
								state: "read",
								value:"I"
							},
							{
								row:2,
								col:5,
								state: "read",
								value:"J"
							},
						]
					  ];
		};
		$scope.updateState=function(rowIndex,colIndex,state){
			$scope.Spreadsheet[rowIndex][colIndex].state=state;
		};
		$scope.addRow=function(rowIndex){
			var row = angular.copy($scope.Spreadsheet[rowIndex]);
			for(var index in row){
				row[index].value=null;
				row[index].row=rowIndex.length+1;
				row[index].state='read';
			};
			$scope.Spreadsheet.push(row);
			
		};
		$scope.removeRow=function(rowIndex){
			$scope.Spreadsheet.splice(rowIndex,1);
		};
    }]);
});


