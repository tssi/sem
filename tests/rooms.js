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
					'name': 'Computer Laboratory 1',
					'code': 'COMLAB1',
					'type':'lab'
				},
				{
					'id':2,
					'name': 'Computer Laboratory 2',
					'code': 'COMLAB2',
					'type':'lab'
				},
				{
					'id':3,
					'name': 'Science Laboratory 1',
					'code': 'SCILAB1',
					'type':'lab'
				},
				{
					'id':4,
					'name': 'Science Laboratory 2',
					'code': 'SCILAB2',
					'type':'lab'
				},
				{
					'id':5,
					'name': 'Room 1',
					'code': 'LECROM1',
					'type':'lec'
				},
				{
					'id':6,
					'name': 'Room 2',
					'code': 'LECROM2',
					'type':'lec'
				},
				{
					'id':7,
					'name': 'Room 3',
					'code': 'LECROM3',
					'type':'lec'
				},
			]
		}
	)

});