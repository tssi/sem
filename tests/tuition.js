"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Tuitions',
				},
				data:[
					{
					  "id": 1,
					  "name": "G7 Tuition Fee",
					  "sy": 2016,
					  "year_level_id": "G7",
					  "program": "regular",
					  "fees": [
						{
						  "id": "TUI",
						  "name": "Tuition Fee",
						  "amount": 5000
						},
						{
						  "id": "MSC",
						  "name": "Miscellaneous Fee",
						  "amount": 3000
						}
					  ],
					  "discounts": [
						{
						  "id": "DSCA",
						  "name": "Discount A",
						  "type": "percent",
						  "amount": 50,
						  "fees_applicable": [
							"TF"
						  ]
						},
						{
						  "id": "DSCB",
						  "name": "Discount B",
						  "type": "percent",
						  "amount": 100,
						  "fees_applicable": [
							"all"
						  ]
						}
					  ],
					  "schemes": [
						{
						  "id": "ANNL",
						  "name": "Annual",
						  "payment_frequency": 1,
						  "amount": 8000,
						  "interest_charge": -500
						},
						{
						  "id": "SEMI",
						  "name": "Semi Annual",
						  "payment_frequency": 2,
						  "amount": 4000,
						  "interest_charge": -250
						},
						{
						  "id": "MNTH",
						  "name": "Monthly",
						  "payment_frequency": 8,
						  "amount": 1000,
						  "interest_charge": 0
						},
						{
						  "id": "EASY",
						  "name": "Easy",
						  "payment_frequency": 8,
						  "amount": 1100,
						  "interest_charge": 800
						}
					  ]
					}
				]
			}
		);
});