"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Fees',
				},
				data:[
					{
					  "id": "TUI",
					  "name": "Tuition Fee",
					  "order": 1
					},
					{
					  "id": "REG",
					  "name": "Registration",
					  "order": 2
					},
					{
					  "id": "MDF",
					  "name": "Medical/Dental Fee",
					  "order": 3
					},
					{
					  "id": "GUI",
					  "name": "Guidance Fee",
					  "order": 4
					},
					{
					  "id": "INS",
					  "name": "Insurance",
					  "order": 5
					},
					{
					  "id": "LIB",
					  "name": "Library",
					  "order": 6
					},
					{
					  "id": "ATH",
					  "name": "Athletics",
					  "order": 7
					},
					{
					  "id": "LFT",
					  "name": "Laboraty Fee-TLE",
					  "order": 8
					},
					{
					  "id": "LFS",
					  "name": "Laboraty Fee-Science",
					  "order": 9
					},
					{
					  "id": "BSP",
					  "name": "BSP/GSP",
					  "order": 10
					},
					{
					  "id": "IDL",
					  "name": "ID Lamination",
					  "order": 11
					},
					{
					  "id": "REP",
					  "name": "Report Card",
					  "order": 12
					},
					{
					  "id": "CLA",
					  "name": "Class Picture",
					  "order": 13
					},
					{
					  "id": "INM",
					  "name": "Instructional Materials",
					  "order": 14
					},
					{
					  "id": "SCH",
					  "name": "School Organization",
					  "order": 15
					},
					{
					  "id": "REC",
					  "name": "Recollection Fee",
					  "order": 16
					},
					{
					  "id": "GRA",
					  "name": "Graduation Fee",
					  "order": 17
					},
					{
					  "id": "YEA",
					  "name": "Yearbook",
					  "order": 18
					},
					{
					  "id": "ENE",
					  "name": "Energy Fee",
					  "order": 19
					},
					{
					  "id": "COMP",
					  "name": "Computer Fee",
					  "order": 20
					}
				]
			}
		);
});