"use strict";
define(['model'],function($model){
	return new $model(
			{
			  "meta": {
				"message": "List of Countries",
				"limit": 2000,
				"next": null,
				"prev": null,
				"last": 1,
				"count": 2,
				"page": 1,
				"pages": 1,
				"epoch": 1456274825,
				"code": 200
			  },
			  "data": [
				{
				  "id": "PH",
				  "name": "Philippines",
				  "call_code": 63,
				  "order": 1
				},
				{
				  "id": "US",
				  "name": "United States of America",
				  "call_code": 1,
				  "order": 2
				}
			  ]
			}
		);
});