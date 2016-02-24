"use strict";
define(['model'],function($model){
	return new $model(
			{
			  "meta": {
				"message": "List of Fees",
				"limit": 10,
				"next": 2,
				"prev": null,
				"last": 4,
				"count": 31,
				"page": 1,
				"pages": 4,
				"epoch": 1456274312,
				"code": 200
			  },
			  "data": [
				{
				  "id": "TUI",
				  "name": "Tuition Fee",
				  "order": 1,
				  "created": "2016-02-05 00:35:56",
				  "modified": "2016-02-05 07:09:11"
				},
				{
				  "id": "MSC",
				  "name": "Miscllaneous",
				  "order": 2,
				  "created": "2016-02-05 02:41:39",
				  "modified": "2016-02-05 07:09:11"
				},
				{
				  "id": "REG",
				  "name": "Registration",
				  "order": 3,
				  "created": "2016-02-05 00:36:19",
				  "modified": "2016-02-05 07:09:11"
				},
				{
				  "id": "MDF",
				  "name": "Medical / Dental",
				  "order": 4,
				  "created": "2016-02-05 00:36:35",
				  "modified": "2016-02-05 07:09:11"
				},
				{
				  "id": "GUI",
				  "name": "Guidance",
				  "order": 5,
				  "created": "2016-02-05 00:36:45",
				  "modified": "2016-02-05 07:09:11"
				},
				{
				  "id": "INS",
				  "name": "Insurance",
				  "order": 6,
				  "created": "2016-02-05 00:36:51",
				  "modified": "2016-02-05 07:09:11"
				},
				{
				  "id": "LIB",
				  "name": "Library",
				  "order": 7,
				  "created": "2016-02-05 00:36:59",
				  "modified": "2016-02-05 07:09:11"
				},
				{
				  "id": "ATH",
				  "name": "Athletics",
				  "order": 8,
				  "created": "2016-02-05 00:37:06",
				  "modified": "2016-02-05 07:09:11"
				},
				{
				  "id": "LFT",
				  "name": "Laboratory Fee - TLE",
				  "order": 9,
				  "created": "2016-02-05 00:37:24",
				  "modified": "2016-02-05 07:09:11"
				},
				{
				  "id": "LFS",
				  "name": "Laboratory Fee - Science",
				  "order": 10,
				  "created": "2016-02-05 00:37:38",
				  "modified": "2016-02-05 07:09:11"
				}
			  ]
			}
	);
});