"use strict";
define(['model'],function($model){
	return new $model(
			{
			  "meta": {
				"message": "List of College Inquiries",
				"limit": 10,
				"next": null,
				"prev": null,
				"last": 1,
				"count": 2,
				"page": 1,
				"pages": 1,
				"epoch": 1456274154,
				"code": 200
			  },
			  "data": [
				{
				  "id": 1,
				  "department_id": "TS",
				  "program_id": "BSIT",
				  "curriculum_id": "IT2019",
				  "first_name": "Abraham",
				  "middle_name": "D",
				  "last_name": "Lincoln",
				  "suffix_name": "III",
				  "gender": "M",
				  "birthday": "1998-09-29",
				  "birthplace": "Batangas",
				  "religion": "Iglesia ni Cristo",
				  "citizenship": "Filipino",
				  "prev_school": "Basic Education School",
				  "created": "2016-02-24 00:29:27",
				  "modified": "2016-02-24 00:29:27"
				},
				{
				  "id": 2,
				  "department_id": "TS",
				  "program_id": "BSCS",
				  "curriculum_id": "CS2019",
				  "first_name": "Mong",
				  "middle_name": "O",
				  "last_name": "Lloyd",
				  "suffix_name": "Jr",
				  "gender": "M",
				  "birthday": "1998-09-29",
				  "birthplace": "Batangas",
				  "religion": "Iglesia ni Cristo",
				  "citizenship": "Filipino",
				  "prev_school": "Basic Education School",
				  "created": "2016-02-24 00:29:27",
				  "modified": "2016-02-24 00:29:27"
				},
				
			  ]
			}
		);
});