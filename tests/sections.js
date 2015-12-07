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
					  "program": "pilot"
					},
					{
					  "id": 2,
					  "name": "Sapphire",
					  "year_level_id": "G7",
					  "program": "regular"
					},
					{
					  "id": 3,
					  "name": "Gold",
					  "year_level_id": "G8",
					  "program": "pilot"
					},
					{
					  "id": 4,
					  "name": "Silver",
					  "year_level_id": "G8",
					  "program": "regular"
					},
					{
					  "id": 5,
					  "name": "Earth",
					  "year_level_id": "G9",
					  "program": "pilot"
					},
					{
					  "id": 6,
					  "name": "Mars",
					  "year_level_id": "G9",
					  "program": "regular"
					}
				]
			}
		);
});