"use strict";
define(['model'],function($model){
	return new $model(
		{
			'meta':{
				'limit': 100,
				'title': 'College Payment Scheme'
			},
			'data':[
				{
					'id':1,
					'desc':'Cash Payment',
					'terms':1
				},
				{
					'id':2,
					'desc':'Monthly Payment',
					'terms':5
				},
				
			]
		}
	)

});