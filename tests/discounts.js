"use strict";
define(['model'],function($model){
	return new $model(
			{
			  "meta": {
				"message": "List of Discounts",
				"limit": 10,
				"next": null,
				"prev": null,
				"last": 1,
				"count": 2,
				"page": 1,
				"pages": 1,
				"epoch": 1456275886,
				"code": 200
			  },
			  "data": [
				{
				  "id": "DSCA",
				  "name": "Discount A",
				  "description": "Full Scholarship",
				  "type": "percent",
				  "amount": 100,
				  "fees_applicable": "all",
				  "created": "2016-02-05 01:04:10",
				  "modified": "2016-02-05 01:04:10",
				  "display_amount": "100%"
				},
				{
				  "id": "DSCB",
				  "name": "Discount B",
				  "description": "50% Off",
				  "type": "percent",
				  "amount": 50,
				  "fees_applicable": "all",
				  "created": "2016-02-05 01:04:31",
				  "modified": "2016-02-05 01:04:31",
				  "display_amount": "50%"
				}
			  ]
			}
		);
});