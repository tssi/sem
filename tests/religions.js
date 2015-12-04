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
						"name": "Catholic"
					  },
					  {
						"id": 2,
						"name": "Inglesia ni Cristo"
					  },
					]
			}
		);
});