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
					'desc':'Cash',
					'terms':1,
					'discount':500,
					'upon_enrollment':null,
					'due_date': null
				},
				{
					'id':2,
					'desc':'Installment',
					'terms':5,
					'discount': 0 ,
					'upon_enrollment':2500,
					'due_date': "July-Nov"
				}
				
			]
		}
	)

});