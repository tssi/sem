"use strict";
define(['model'],function($model){
	return new $model(
			{
			  "meta": {
				"message": "List of Sections",
				"limit": 2000,
				"next": null,
				"prev": null,
				"last": 1,
				"count": 8,
				"page": 1,
				"pages": 1,
				"epoch": 1456275222,
				"code": 200
			  },
			  "data": [
				{
					id: 1000,
					department_id: "SH",
					year_level_id: "GZ",
					program_id: "IE",
					name: "IE-2A",
					description: "IE-2A",
					alias: "IE-2A",
					esp: 2019,
					order: 1,
					created: null,
					modified: null
				},
				{
					id: 1001,
					department_id: "SH",
					year_level_id: "GZ",
					program_id: "IE",
					name: "Try",
					description: "Try",
					alias: "Try",
					esp: 2019,
					order: 2,
					created: null,
					modified: null
				}
				
			  ]
			}
	);
});