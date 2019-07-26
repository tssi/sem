"use strict";
define(['model'],function($model){
	return new $model(
			{
			  "meta": {
				"message": "List of Educ Levels",
				"limit": 10,
				"next": null,
				"prev": null,
				"last": 1,
				"count": 4,
				"page": 1,
				"pages": 1,
				"epoch": 1456274897,
				"code": 200
			  },
			  "data": [
				{
				  "id": "PS",
				  "name": "Preschool",
				  "alias": "PS",
				  "order": 1,
				  "college": 0,
				  "created": "2016-01-26 07:25:49",
				  "modified": "2016-01-27 01:22:58"
				},
				{
				  "id": "GS",
				  "name": "Grade School",
				  "alias": "GS",
				  "order": 2,
				  "college": 0,
				  "created": "2016-01-26 07:25:41",
				  "modified": "2016-01-27 01:22:50"
				},
				{
				  "id": "HS",
				  "name": "High School",
				  "alias": "HS",
				  "order": 3,
				  "college": 0,
				  "created": "2016-01-26 07:25:56",
				  "modified": "2016-01-27 01:22:54"
				},
				{
				  "id": "SH",
				  "name": "Senior High",
				  "alias": "SH",
				  "order": 4,
				  "college": 0,
				  "created": "2016-02-04 08:20:11",
				  "modified": "2016-02-04 08:20:11"
				},
				{
				  "id": "TS",
				  "name": "Tertiary School",
				  "alias": "TS",
				  "order": 5,
				  "college": 1,
				  "created": "2016-02-04 08:20:11",
				  "modified": "2016-02-04 08:20:11"
				},
				{
				  "id": "GD",
				  "name": "Graduate School",
				  "alias": "GD",
				  "order": 6,
				  "college": 1,
				  "created": "2016-02-04 08:20:11",
				  "modified": "2016-02-04 08:20:11"
				},
				{
				  "id": "LW",
				  "name": "Law School",
				  "alias": "LW",
				  "order": 7,
				  "college": 1,
				  "created": "2016-02-04 08:20:11",
				  "modified": "2016-02-04 08:20:11"
				},
			  ]
			}
		);
});