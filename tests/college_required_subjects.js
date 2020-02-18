"use strict";
define(['model'],function($model){
	return new $model(
		{
			'meta':{
				'limit': 100,
				'title': 'College Required Subjects'
			},
			'data':[
				{
					'id':1,
					'college_curri_details_id':12,
					'subject_id':7,
					'type':'PRE',
					
				},
				{
					'id':2,
					'college_curri_details_id':13,
					'subject_id':7,
					'type':'PRE',
					
				},
				{
					'id':3,
					'college_curri_details_id':12,
					'subject_id':9,
					'type':'COR',
					
				},
				{
					'id':4,
					'college_curri_details_id':13,
					'subject_id':8,
					'type':'COR',
					
				},
				
			]
		}
	);

});