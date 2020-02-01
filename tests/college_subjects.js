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
					'year_level_id':'T2',
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
				{
					'id':7,
					'code':'ABM110',
					'description':'ABM 110',
					'name':'ABM 110',
					'units':3,
					'year_level_id':'T1',
					'lec':3,
					'lab':0,
					'tuition_hours':3
				},
				{
					'id':8,
					'code':'ABM114',
					'description':'ABM 114',
					'name':'ABM 115',
					'units':3,
					'year_level_id':'T2',
					'lec':3,
					'lab':0,
					'tuition_hours':3
				},
				{
					'id':9,
					'code':'ABM118',
					'description':'ABM 118',
					'name':'ABM 118',
					'units':3,
					'year_level_id':'T2',
					'lec':3,
					'lab':0,
					'tuition_hours':3
				},
			]
		}
	)

});