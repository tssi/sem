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
							"TUI"
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
						},
						{
						  "id": "DSCC",
						  "name": "Discount C",
						  "type": "peso",
						  "amount": 10,
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
					},
					{
					  "id": 2,
					  "name": "G7 Tuition Fee",
					  "sy": 2016,
					  "year_level_id": "G7",
					  "program": "pilot",
					  "fees": [
						{
						  "id": "TUI",
						  "name": "Tuition Fee",
						  "amount": 5001
						},
						{
						  "id": "MSC",
						  "name": "Miscellaneous Fee",
						  "amount": 3001
						}
					  ],
					  "discounts": [
						{
						  "id": "DSCA",
						  "name": "Discount A",
						  "type": "percent",
						  "amount": 51,
						  "fees_applicable": [
							"TF"
						  ]
						},
						{
						  "id": "DSCB",
						  "name": "Discount B",
						  "type": "percent",
						  "amount": 101,
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
						  "amount": 8001,
						  "interest_charge": -501
						},
						{
						  "id": "SEMI",
						  "name": "Semi Annual",
						  "payment_frequency": 2,
						  "amount": 4001,
						  "interest_charge": -251
						},
						{
						  "id": "MNTH",
						  "name": "Monthly",
						  "payment_frequency": 8,
						  "amount": 1001,
						  "interest_charge": 0
						},
						{
						  "id": "EASY",
						  "name": "Easy",
						  "payment_frequency": 8,
						  "amount": 1101,
						  "interest_charge": 801
						}
					  ]
					},
					{
					  "id": 3,
					  "name": "G8 Tuition Fee",
					  "sy": 2016,
					  "year_level_id": "G8",
					  "program": "regular",
					  "fees": [
						{
						  "id": "TUI",
						  "name": "Tuition Fee",
						  "amount": 5002
						},
						{
						  "id": "MSC",
						  "name": "Miscellaneous Fee",
						  "amount": 3002
						}
					  ],
					  "discounts": [
						{
						  "id": "DSCA",
						  "name": "Discount A",
						  "type": "percent",
						  "amount": 52,
						  "fees_applicable": [
							"TF"
						  ]
						},
						{
						  "id": "DSCB",
						  "name": "Discount B",
						  "type": "percent",
						  "amount": 102,
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
						  "amount": 8002,
						  "interest_charge": -502
						},
						{
						  "id": "SEMI",
						  "name": "Semi Annual",
						  "payment_frequency": 2,
						  "amount": 4002,
						  "interest_charge": -252
						},
						{
						  "id": "MNTH",
						  "name": "Monthly",
						  "payment_frequency": 8,
						  "amount": 1002,
						  "interest_charge": 0
						},
						{
						  "id": "EASY",
						  "name": "Easy",
						  "payment_frequency": 8,
						  "amount": 1102,
						  "interest_charge": 802
						}
					  ]
					}
				]
			}
		);
});