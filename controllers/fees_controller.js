"use strict";
define(['app','api'], function (app) {
    app.register.controller('FeeController',['$scope','$rootScope','api', function ($scope,$rootScope,api) {
		$scope.init=function(){
			$scope.Spreadsheet=[
						[
							{
								row:1,
								col:2,
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
								col:2,
								state: "write",
								value:"F"
							},
							{
								row:2,
								col:2,
								state: "write",
								value:"G"
							},
							{
								row:2,
								col:3,
								state: "write",
								value:"H"
							},
							{
								row:2,
								col:4,
								state: "write",
								value:"I"
							},
							{
								row:2,
								col:5,
								state: "write",
								value:"J"
							},
						]
					  ];
		};
		$scope.updateState=function(rowIndex,colIndex,state){
			$scope.Spreadsheet[rowIndex][colIndex].state=state;
		};
    }]);
});


