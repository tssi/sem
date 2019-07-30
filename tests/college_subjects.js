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
					'code':'PROGFUN',
					'description':'Programming Fundamentals',
					'name':'Programming Fundamentals',
					'units':4,
					'year_level_id':'T1',
					'lec':3,
					'lab':4,
					'tuition_hours':4
				},
				{
					'id':2,
					'code':'COPRO',
					'description':'Communications Proficiency',
					'name':'English 1',
					'units':4,
					'year_level_id':'T1',
					'lec':3,
					'lab':4,
					'tuition_hours':4
				},
				{
					'id':3,
					'code':'PROFETH',
					'description':'Profesional Ethics',
					'name':'Ethics',
					'units':3,
					'year_level_id':'T1',
					'lec':3,
					'lab':4,
					'tuition_hours':4
				},
				{
					'id':4,
					'code':'PHISED',
					'description':'Physical Educations',
					'name':'P.E.',
					'units':3,
					'year_level_id':'T1',
					'lec':3,
					'lab':4,
					'tuition_hours':4
				},
				{
					'id':5,
					'code':'SOFTWEN',
					'description':'Software Engineering',
					'name':'Software Engineering',
					'units':4,
					'year_level_id':'T1',
					'lec':3,
					'lab':4,
					'tuition_hours':4
				},
				{
					'id':6,
					'code':'NSTP',
					'description':'National Service Training Program',
					'name':'NSTP1',
					'units':3,
					'year_level_id':'T1',
					'lec':3,
					'lab':0,
					'tuition_hours':3
				},
			]
		}
	)

});