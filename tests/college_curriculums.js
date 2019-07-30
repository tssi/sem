"use strict";
define(['model'],function($model){
	return new $model(
		{
			'meta':{
				'limit': 100,
				'title': 'College Curriculums'
			},
			'data':[
				{
					'id':'IT2019',
					'name':'IT Curriculum 2019',
					'desc':'Curriculum for BSIT 2019',
					'program_id':'BSIT'
				},
				{
					'id':'CS2019',
					'name':'CS Curriculum 2019',
					'desc':'Curriculum for BSCS 2019',
					'program_id':'BSCS'
				},
				{
					'id':'LW2019',
					'name':'Law Curriculum 2019',
					'desc':'Curriculum for Law 2019',
					'program_id':'LAW'
				}
			]
		}
	);

});