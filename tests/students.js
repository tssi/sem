"use strict";
define(['model'],function($model){
	return new $model(
			{
			  "meta": {
				"message": "List of Students",
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
				  "sno":"1007898100",
				  "educ_level_id": "HS",
				  "year_level_id": "GY",
				  "year_level": "Grade 11",
				  "first_name": "Juan",
				  "middle_name": "Masipag",
				  "last_name": "Dela Cruz",
				  "suffix_name": "II",
				  "gender": "M",
				  "birthday": "1998-09-29",
				  "birthplace": "Batangas",
				  "religion": "Iglesia ni Cristo",
				  "citizenship": "Filipino",
				  "status":"cleared",
				  "prev_school": "Basic Education School",
				  "created": "2016-02-24 00:29:27",
				  "modified": "2016-02-24 00:29:27"
				},
				{
				  "id": 7,
				  "sno":"1002349400",
				  "educ_level_id": "HS",
				  "year_level_id": "GZ",
				  "year_level": "Grade 12",
				  "first_name": "Juanita",
				  "middle_name": "Masipag",
				  "last_name": "Dela Cruz",
				  "suffix_name": null,
				  "gender": "M",
				  "birthday": "2000-11-11",
				  "birthplace": "Batangas",
				  "religion": "Iglesia ni Cristo",
				  "citizenship": "Filipino",
				  "status":"for-clearance",
				  "prev_school": "Basic Education School",
				  "created": "2016-02-24 00:34:56",
				  "modified": "2016-02-24 00:34:56"
				}
			  ]
			}
		);
});