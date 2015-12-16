"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Sections',
				},
				data:[
					{
					  "id": 1,
					  "name": "Emerald",
					  "year_level_id": "G7",
					  "program": "pilot",
					  "order": 1
					},
					{
					  "id": 2,
					  "name": "Sapphire",
					  "year_level_id": "G7",
					  "program": "regular",
					  "order": 2
					},
					{
					  "id": 3,
					  "name": "Gold",
					  "year_level_id": "G8",
					  "program": "pilot",
					  "order": 3
					},
					{
					  "id": 4,
					  "name": "Silver",
					  "year_level_id": "G8",
					  "program": "regular",
					  "order": 4
					},
					{
					  "id": 5,
					  "name": "Earth",
					  "year_level_id": "G9",
					  "program": "pilot",
					  "order": 5
					},
					{
					  "id": 6,
					  "name": "Mars",
					  "year_level_id": "G9",
					  "program": "regular",
					  "order": 6
					}
				]
			}
		);
});