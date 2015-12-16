"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Religions',
				},
				data:[
					  {
						"id": 1,
						"name": "Catholic",
						"order": 2
					  },
					  {
						"id": 2,
						"name": "Inglesia ni Cristo",
						"order": 1
					  },
					]
			}
		);
});