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
				  "id": 1,
				  "program_id": "BSIT",
				  "name": "BT101P",
				  "year_level_id": "T1",
				  "order": 1,
				  "created": "2016-02-22 04:59:02",
				  "modified": "2016-02-22 04:59:08",
				},
				{
				  "id": 2,
				  "program_id": "BSIT",
				  "name": "BT101A",
				  "year_level_id": "T1",
				  "order": 2,
				  "created": "2016-02-22 04:59:02",
				  "modified": "2016-02-22 04:59:08",
				},
				{
				  "id": 3,
				  "program_id": "BSCS",
				  "name": "BS101A",
				  "year_level_id": "T1",
				  "order": 3,
				  "created": "2016-02-22 04:59:02",
				  "modified": "2016-02-22 04:59:08"
				},
				{
				  "id": 4,
				  "program_id": "BSCS",
				  "name": "BS101P",
				  "year_level_id": "T1",
				  "order": 4,
				  "created": "2016-02-22 04:59:02",
				  "modified": "2016-02-22 04:59:08"
				},
				
			  ]
			}
	);
});