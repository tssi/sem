"use strict";
define(['model'],function($model){
	return new $model(
		{
			'meta':{
				'limit': 100,
				'title': 'Subjects'
			},
			'data':[
				{
					id: "IE19S1",
					department_id: "SH",
					name: "IE Curriculum",
					description: "IE Curriculum",
					type: null,
					alias: "IE Curricu",
					esp: 2019.25,
					created: null,
					modified: null,
					section_id: 1000,
					subjects: [
						{
							subject_id: "2UENVIXX",
							year_level_id: "GZ",
							name: "Environmental Engineering",
							code: "2U-ENVI"
						},
						{
							subject_id: "COMPHARX",
							year_level_id: "GZ",
							name: "Computer Hardware and Fundamentals",
							code: "COMPHAR"
						},
						{
							subject_id: "DIFCAL4X",
							year_level_id: "GZ",
							name: "Differencial Calculus",
							code: "DIFCAL4"
						},
						{
							subject_id: "GENPSYCX",
							year_level_id: "GZ",
							name: "General Psychology",
							code: "GENPSYC"
						},
						{
							subject_id: "KOMIKAXX",
							year_level_id: "GZ",
							name: "Komunikasyon sa Akademikong Filipino",
							code: "KOMIKA+"
						},
						{
							subject_id: "P6TWO4UX",
							year_level_id: "GZ",
							name: "Physics 2",
							code: "P6TWO4U"
						},
						{
							subject_id: "PHILITEX",
							year_level_id: "GZ",
							name: "Philippine Literature",
							code: "PHILITE"
						},
						{
							subject_id: "SPORTSXX",
							year_level_id: "GZ",
							name: "P.E. 3 ",
							code: "SPORTS"
						},
						{
							subject_id: "TECHCOMX",
							year_level_id: "GZ",
							name: "Technical Communications",
							code: "TECHCOM"
						}
					]
				}
			]
		}
	)

});