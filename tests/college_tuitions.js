"use strict";
define(['model'],function($model){
	return new $model(
		{
			'meta':{
				'limit': 100,
				'title': 'College Tuitions'
			},
			'data':[
				{
					'id':1,
					'desc':'Medical / Dental',
					'amount':500
				},
				{
					'id':2,
					'desc':'Library',
					'amount':200
				},
				{
					'id':3,
					'desc':'Athletics',
					'amount':500
				},
				{
					'id':4,
					'desc':'Guidance',
					'amount':100
				},
				{
					'id':5,
					'desc':'Energy Fee',
					'amount':300
				},
				{
					'id':6,
					'desc':'ID Lamination',
					'amount':250
				},
				{
					'id':7,
					'desc':'MAPEH Uniform',
					'amount':600
				},
				{
					'id':8,
					'desc':'School Organization',
					'amount':200
				},
				{
					'id':9,
					'desc':'Test Papers',
					'amount':150
				},
				{
					'id':10,
					'desc':'Computer Fee',
					'amount':350
				},
					
			]
		}
	)

});