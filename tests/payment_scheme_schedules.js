"use strict";
define(['model'],function($model){
	var model =  new $model(
			{
				meta:{
					 "message": "The payment scheme schedule has been saved",
					"epoch": 1456287667,
					"code": 200
				},
				data:[]
			}
		);
		model.POST = function(data){
			return {success:model.save(data)};
		}
	return model;
});