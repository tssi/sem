"use strict";
define(['model'],function($model){
	return new $model(
		{
			'meta':{
				'limit': 100,
				'title': 'Class Schedule Details'
			},
			'data':[
				{
					'id':1,
					'schedule_id':1,
					'start_time':'06:00',
					'end_time':'09:00',
					'day':'MW',
					'room_id':1
				},
				{
					'id':2,
					'schedule_id':2,
					'start_time':'01:00',
					'end_time':'03:00',
					'day':'MW',
					'room_id':5
				},
				{
					'id':3,
					'schedule_id':2,
					'start_time':'01:00',
					'end_time':'03:00',
					'day':'WF',
					'room_id':6
				},
				{
					'id':4,
					'schedule_id':6,
					'start_time':'03:00',
					'end_time':'05:00',
					'day':'WF',
					'room_id':7
				},
			]
		}
	)

});