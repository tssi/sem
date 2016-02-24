"use strict";
define(['model'],function($model){
	return new $model(
			{
			  "meta": {
				"message": "List of Religions",
				"limit": 2000,
				"next": null,
				"prev": null,
				"last": 1,
				"count": 2,
				"page": 1,
				"pages": 1,
				"epoch": 1456275005,
				"code": 200
			  },
			  "data": [
				{
				  "id": 4,
				  "name": "Iglesia ni Cristo",
				  "order": 1,
				  "created": "2016-02-04 07:15:01",
				  "modified": "2016-02-04 08:28:41"
				},
				{
				  "id": 3,
				  "name": "Roman Catholic",
				  "order": 2,
				  "created": "2016-02-04 07:14:52",
				  "modified": "2016-02-04 08:28:41"
				}
			  ]
			}
		);
});