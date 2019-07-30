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
					'id':1,
					'section_id':'',
					'program_id':'BSIT',
					'subject_id':1,
					'sy':2019,
					'sem':1
				},
				{
					'id':2,
					'section_id':'',
					'program_id':'BSIT',
					'subject_id':2,
					'sy':2019,
					'sem':1
				},
			]
		}
	)

});