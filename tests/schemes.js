"use strict";
define(['model'],function($model){
	return new $model(
			{
			  "meta": {
				"message": "List of Schemes",
				"limit": 10,
				"next": null,
				"prev": null,
				"last": 1,
				"count": 4,
				"page": 1,
				"pages": 1,
				"epoch": 1456275839,
				"code": 200
			  },
			  "data": [
				{
				  "id": "ANNL",
				  "code": "A",
				  "name": "Annual",
				  "payment_frequency": 1,
				  "order": 1,
				  "created": "2016-02-05 01:02:32",
				  "modified": "2016-02-05 08:42:37"
				},
				{
				  "id": "SEMI",
				  "code": "S",
				  "name": "Semi Annual",
				  "payment_frequency": 2,
				  "order": 2,
				  "created": "2016-02-05 01:02:42",
				  "modified": "2016-02-05 08:42:37"
				},
				{
				  "id": "MNTH",
				  "code": "M",
				  "name": "Monthly",
				  "payment_frequency": 10,
				  "order": 3,
				  "created": "2016-02-05 01:03:08",
				  "modified": "2016-02-05 08:42:37"
				},
				{
				  "id": "EASY",
				  "code": "E",
				  "name": "Easy",
				  "payment_frequency": 10,
				  "order": 4,
				  "created": "2016-02-05 01:03:17",
				  "modified": "2016-02-05 08:42:37"
				}
			  ]
			}
	);
});
	