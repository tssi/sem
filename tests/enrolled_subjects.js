"use strict";
define(['model'],function($model){
	return new $model(
		{
			'meta':{
				'limit': 100,
				'title': 'Enrolled Subjects'
			},
			'data':[
				{
					'id':1,
					'student_id': 1,
					'subject_id': '1',
					'schedule_id':''
				}
			]
		}
	)

});