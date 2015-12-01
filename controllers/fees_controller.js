"use strict";
define(['app','api'], function (app) {
    app.register.controller('FeeController',['$scope','$rootScope','api', function ($scope,$rootScope,api) {
		$scope.init=function(){
			$scope.SS=[
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
    }]);
});


