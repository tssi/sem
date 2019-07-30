"use strict";
define(['model'],function($model){
	return new $model(
		{
			'meta':{
				'limit': 100,
				'title': 'Credits Earned'
			},
			'data':[
				{
					'id':1,
					'student_id':2,
					'subject_id':2,
					'subject_name':'English 1',
					'units':3,
					'final_grade': 89.00
				},
				
			]
		}
	)

});