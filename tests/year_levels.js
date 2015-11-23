"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Year Levels',
				},
				data:[
					  {
						"id": "PS1",
						"educ_level_id": "PS",
						"name": "Nursery",
						"alias": "N",
						"order": 1
					  },
					  {
						"id": "PS2",
						"educ_level_id": "PS",
						"name": "Kinder I",
						"alias": "K1",
						"order": 2
					  },
					  {
						"id": "PS3",
						"educ_level_id": "PS",
						"name": "Kinder II",
						"alias": "K2",
						"order": 3
					  },
					  {
						"id": "G1",
						"educ_level_id": "GS",
						"name": "Grade 1",
						"alias": "G1",
						"order": 4
					  },
					  {
						"id": "G2",
						"educ_level_id": "GS",
						"name": "Grade 2",
						"alias": "G2",
						"order": 5
					  },
					  {
						"id": "G3",
						"educ_level_id": "GS",
						"name": "Grade 3",
						"alias": "G3",
						"order": 6
					  },
					  {
						"id": "G4",
						"educ_level_id": "GS",
						"name": "Grade 4",
						"alias": "G4",
						"order": 7
					  },
					  {
						"id": "G5",
						"educ_level_id": "GS",
						"name": "Grade 5",
						"alias": "G5",
						"order": 8
					  },
					  {
						"id": "G6",
						"educ_level_id": "GS",
						"name": "Grade 6",
						"alias": "G6",
						"order": 9
					  },
					  {
						"id": "G7",
						"educ_level_id": "HS",
						"name": "Grade 7",
						"alias": "G7",
						"order": 10
					  },
					  {
						"id": "G8",
						"educ_level_id": "HS",
						"name": "Grade 8",
						"alias": "G8",
						"order": 11
					  },
					  {
						"id": "G9",
						"educ_level_id": "HS",
						"name": "Grade 9",
						"alias": "G9",
						"order": 11
					  },
					  {
						"id": "GX",
						"educ_level_id": "HS",
						"name": "Grade 10",
						"alias": "GX",
						"order": 13
					  }
					]
			}
		);
});