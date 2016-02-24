"use strict";
define(['model'],function($model){
	return new $model(
			{
			  "meta": {
				"message": "List of Citizenships",
				"limit": 2000,
				"next": null,
				"prev": null,
				"last": 1,
				"count": 3,
				"page": 1,
				"pages": 1,
				"epoch": 1456274787,
				"code": 200
			  },
			  "data": [
				{
				  "id": 12,
				  "name": "Korean",
				  "order": 1,
				  "created": "2016-02-03 08:06:45",
				  "modified": "2016-02-05 07:08:15"
				},
				{
				  "id": 11,
				  "name": "Filipino",
				  "order": 2,
				  "created": "2016-02-03 08:06:42",
				  "modified": "2016-02-05 07:08:15"
				},
				{
				  "id": 19,
				  "name": "Japanese",
				  "order": 3,
				  "created": "2016-02-04 07:10:09",
				  "modified": "2016-02-05 07:08:15"
				}
			  ]
			}
		);
});