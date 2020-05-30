"use strict";
define(['model'],function($model){
	return new $model(
			{
			  "meta": {
				"message": "List of Programs",
				"limit": 2000,
				"next": null,
				"prev": null,
				"last": 1,
				"count": 4,
				"page": 1,
				"pages": 1,
				"epoch": 1456275620,
				"code": 200
			  },
			  "data": [
				{
				  "id": "REG",
				  "code": "RE",
				  "name": "Regular",
				  "description": "Regular",
				  "order": 1,
				  "created": "2016-02-18 07:51:50",
				  "modified": "2016-02-18 07:53:32"
				},
				{
				  "id": "PIL",
				  "code": "PL",
				  "name": "Pilot",
				  "description": "Pilot",
				  "order": 2,
				  "created": "2016-02-18 07:52:00",
				  "modified": "2016-02-18 07:53:32"
				},
				{
				  "id": "SCI",
				  "code": "SC",
				  "name": "Science",
				  "description": "Science",
				  "order": 3,
				  "created": "2016-02-18 07:52:12",
				  "modified": "2016-02-18 07:53:32"
				},
				{
				  "id": "STM",
				  "code": "ST",
				  "name": "STEM",
				  "description": "Science, Technology, Engineering & Mathematics",
				  "order": 4,
				  "created": "2016-02-18 07:52:41",
				  "modified": "2016-02-18 07:53:32"
				},
				{
				  "id": "ABM",
				  "code": "AB",
				  "name": "ABM",
				  "description": "Administration and Business Management",
				  "order": 5,
				  "created": "2016-02-18 07:52:41",
				  "modified": "2016-02-18 07:53:32"
				},
				{
				  "id": "BSIT",
				  "code": "IT",
				  "name": "BSIT",
				  'department_id': 'TS',
				  'college':1,
				  'prefix_sched':'T',
				  'prefix_tuition':'T',
				  "description": "Bachelor of Science in Information Technology",
				  "order": 6,
				  "created": "2016-02-18 07:52:41",
				  "modified": "2016-02-18 07:53:32"
				},
				{
				  "id": "BSCS",
				  "code": "CS",
				  "name": "BSCS",
				  'department_id': 'TS',
				  'prefix_sched':'T',
				  'prefix_tuition':'T',
				  'college':1,
				  "description": "Bachelor of Science in Communication Science",
				  "order": 7,
				  "created": "2016-02-18 07:52:41",
				  "modified": "2016-02-18 07:53:32"
				},
				{
				  "id": "LAW",
				  "code": "LW",
				  "name": "LAW",
				  'department_id': 'LW',
				  'prefix_sched':'L',
				  'prefix_tuition':'L',
				  'college':1,
				  "description": "Bachelor of Science in Law",
				  "order": 8,
				  "created": "2016-02-18 07:52:41",
				  "modified": "2016-02-18 07:53:32"
				},
				{
				  "id": "IE",
				  "code": "IE",
				  "name": "Industrial Engineering",
				  'department_id': 'SH',
				  'prefix_sched':'L',
				  'prefix_tuition':'L',
				  'college':1,
				  "description": "Industrial Engineering",
				  "order": 8,
				  "created": "2016-02-18 07:52:41",
				  "modified": "2016-02-18 07:53:32"
				},
			  ]
			}
		);
});