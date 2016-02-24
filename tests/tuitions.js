"use strict";
define(['model'],function($model){
	var model =  new $model(
			{
			  "meta": {
				"message": "List of Tuitions",
				"limit": 10,
				"next": null,
				"prev": null,
				"last": 1,
				"count": 2,
				"page": 1,
				"pages": 1,
				"epoch": 1456275459,
				"code": 200
			  },
			  "data": [
				{
				  "id": "G7REG16",
				  "name": "G7 Tuition Fee",
				  "description": "Grade 7 Tuition",
				  "sy": 2016,
				  "year_level_id": "G7",
				  "program_id": "REG",
				  "amount": 18970,
				  "created": "2016-02-05 01:06:25",
				  "modified": "2016-02-24 00:55:27",
				  "code_sy": 16,
				  "display_sy": "2016 - 2017",
				  "program": "Regular",
				  "year_level": "Grade 7",
				  "fees": [
					{
					  "id": "TUI",
					  "fee_breakdown_id": 49,
					  "name": "Tuition Fee",
					  "amount": 8215
					},
					{
					  "id": "MDF",
					  "fee_breakdown_id": 29,
					  "name": "Medical / Dental",
					  "amount": 157.5
					},
					{
					  "id": "LFT",
					  "fee_breakdown_id": 30,
					  "name": "Laboratory Fee - TLE",
					  "amount": 465
					},
					{
					  "id": "LIB",
					  "fee_breakdown_id": 31,
					  "name": "Library",
					  "amount": 157.5
					},
					{
					  "id": "VOC",
					  "fee_breakdown_id": 36,
					  "name": "Vocational Fee",
					  "amount": 355
					},
					{
					  "id": "ATH",
					  "fee_breakdown_id": 32,
					  "name": "Athletics",
					  "amount": 355
					},
					{
					  "id": "GUI",
					  "fee_breakdown_id": 33,
					  "name": "Guidance",
					  "amount": 165
					},
					{
					  "id": "TST",
					  "fee_breakdown_id": 39,
					  "name": "Testing Fee",
					  "amount": 320
					},
					{
					  "id": "GOV",
					  "fee_breakdown_id": 37,
					  "name": "Government Char",
					  "amount": 75
					},
					{
					  "id": "DEV",
					  "fee_breakdown_id": 38,
					  "name": "Development Fee",
					  "amount": 1400
					},
					{
					  "id": "COM",
					  "fee_breakdown_id": 34,
					  "name": "Computer Fee",
					  "amount": 2950
					},
					{
					  "id": "ENG",
					  "fee_breakdown_id": 35,
					  "name": "Energy Fee",
					  "amount": 1500
					},
					{
					  "id": "TTP",
					  "fee_breakdown_id": 40,
					  "name": "Test Papers",
					  "amount": 337.5
					},
					{
					  "id": "ORG",
					  "fee_breakdown_id": 41,
					  "name": "School Organization",
					  "amount": 225
					},
					{
					  "id": "INS",
					  "fee_breakdown_id": 42,
					  "name": "Insurance",
					  "amount": 165
					},
					{
					  "id": "IDL",
					  "fee_breakdown_id": 43,
					  "name": "ID Lamination",
					  "amount": 315
					},
					{
					  "id": "ECA",
					  "fee_breakdown_id": 44,
					  "name": "ECA Fee",
					  "amount": 120
					},
					{
					  "id": "PEU",
					  "fee_breakdown_id": 45,
					  "name": "MAPEH Uniform",
					  "amount": 562.5
					},
					{
					  "id": "PTA",
					  "fee_breakdown_id": 46,
					  "name": "PTA",
					  "amount": 105
					},
					{
					  "id": "SHB",
					  "fee_breakdown_id": 50,
					  "name": "Student Handbook",
					  "amount": 180
					},
					{
					  "id": "MAG",
					  "fee_breakdown_id": 47,
					  "name": "Supplementary Magazine",
					  "amount": 845
					}
				  ],
				  "discounts": [
					{
					  "id": "DSCA",
					  "tuition_discount_id": 1,
					  "name": "Discount A",
					  "type": "percent",
					  "amount": 100,
					  "display_amount": "100%",
					  "fees_applicable": [
						"all"
					  ]
					},
					{
					  "id": "DSCB",
					  "tuition_discount_id": 2,
					  "name": "Discount B",
					  "type": "percent",
					  "amount": 50,
					  "display_amount": "50%",
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
					  "total_amount": 18700,
					  "variance_amount": -270,
					  "schedule": [
						{
						  "id": 1,
						  "payment_scheme_id": "G7RE16A",
						  "billing_period_id": "UPEN",
						  "billing_period": "Upon Enrollment",
						  "due_dates": [
							"2016-06-05"
						  ],
						  "bill_months": [
							"Jun 2016"
						  ],
						  "amount": 18700
						}
					  ]
					},
					{
					  "id": "SEMI",
					  "name": "Semi Annual",
					  "payment_frequency": 2,
					  "total_amount": 18600,
					  "variance_amount": -370,
					  "schedule": [
						{
						  "id": 3,
						  "payment_scheme_id": "G7RE16S",
						  "billing_period_id": "UPEN",
						  "billing_period": "Upon Enrollment",
						  "due_dates": [
							"2016-06-05"
						  ],
						  "bill_months": [
							"Jun 2016"
						  ],
						  "amount": 10000
						},
						{
						  "id": 6,
						  "payment_scheme_id": "G7RE16S",
						  "billing_period_id": "SEM2",
						  "billing_period": "Second Semester",
						  "due_dates": [
							"2016-10-05"
						  ],
						  "bill_months": [
							"Oct 2016"
						  ],
						  "amount": 8600
						}
					  ]
					},
					{
					  "id": "MNTH",
					  "name": "Monthly",
					  "payment_frequency": 10,
					  "total_amount": 18970,
					  "variance_amount": 0,
					  "schedule": [
						{
						  "id": 4,
						  "payment_scheme_id": "G7RE16M",
						  "billing_period_id": "UPEN",
						  "billing_period": "Upon Enrollment",
						  "due_dates": [
							"2016-06-05"
						  ],
						  "bill_months": [
							"Jun 2016"
						  ],
						  "amount": 9970
						},
						{
						  "id": 7,
						  "payment_scheme_id": "G7RE16M",
						  "billing_period_id": "MO9X",
						  "billing_period": "Monthly for 9 months",
						  "due_dates": [
							"2016-07-05",
							"2016-08-05",
							"2016-09-05",
							"2016-10-05",
							"2016-11-05",
							"2016-12-05",
							"2017-01-05",
							"2017-02-05",
							"2017-03-05"
						  ],
						  "bill_months": [
							"Jul 2016",
							"Aug 2016",
							"Sep 2016",
							"Oct 2016",
							"Nov 2016",
							"Dec 2016",
							"Jan 2017",
							"Feb 2017",
							"Mar 2017"
						  ],
						  "amount": 1000
						}
					  ]
					},
					{
					  "id": "EASY",
					  "name": "Easy",
					  "payment_frequency": 10,
					  "total_amount": 19735,
					  "variance_amount": 765,
					  "schedule": [
						{
						  "id": 5,
						  "payment_scheme_id": "G7RE16E",
						  "billing_period_id": "UPEN",
						  "billing_period": "Upon Enrollment",
						  "due_dates": [
							"2016-06-05"
						  ],
						  "bill_months": [
							"Jun 2016"
						  ],
						  "amount": 10870
						},
						{
						  "id": 9,
						  "payment_scheme_id": "G7RE16E",
						  "billing_period_id": "MO9X",
						  "billing_period": "Monthly for 9 months",
						  "due_dates": [
							"2016-07-05",
							"2016-08-05",
							"2016-09-05",
							"2016-10-05",
							"2016-11-05",
							"2016-12-05",
							"2017-01-05",
							"2017-02-05",
							"2017-03-05"
						  ],
						  "bill_months": [
							"Jul 2016",
							"Aug 2016",
							"Sep 2016",
							"Oct 2016",
							"Nov 2016",
							"Dec 2016",
							"Jan 2017",
							"Feb 2017",
							"Mar 2017"
						  ],
						  "amount": 985
						}
					  ]
					}
				  ]
				},
				{
				  "id": "G8REG16",
				  "name": "G8 Regular 2016",
				  "description": "Grade 8 Regular 2016-2017",
				  "sy": 2016,
				  "year_level_id": "G8",
				  "program_id": "REG",
				  "amount": 7500,
				  "created": "2016-02-24 00:55:44",
				  "modified": "2016-02-24 00:55:55",
				  "code_sy": 16,
				  "display_sy": "2016 - 2017",
				  "program": "Regular",
				  "year_level": "Grade 8",
				  "fees": [
					{
					  "id": "TUI",
					  "fee_breakdown_id": 51,
					  "name": "Tuition Fee",
					  "amount": 5000
					},
					{
					  "id": "MSC",
					  "fee_breakdown_id": 52,
					  "name": "Miscllaneous",
					  "amount": 2500
					}
				  ],
				  "discounts": [
					{
					  "id": "DSCA",
					  "tuition_discount_id": 3,
					  "name": "Discount A",
					  "type": "percent",
					  "amount": 100,
					  "display_amount": "100%",
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
					  "total_amount": 7250,
					  "variance_amount": -250,
					  "schedule": [
						{
						  "id": 10,
						  "payment_scheme_id": "G8RE16A",
						  "billing_period_id": "UPEN",
						  "billing_period": "Upon Enrollment",
						  "due_dates": [
							"2016-06-05"
						  ],
						  "bill_months": [
							"Jun 2016"
						  ],
						  "amount": 7250
						}
					  ]
					},
					{
					  "id": "SEMI",
					  "name": "Semi Annual",
					  "payment_frequency": 2,
					  "total_amount": 7400,
					  "variance_amount": -100,
					  "schedule": [
						{
						  "id": 12,
						  "payment_scheme_id": "G8RE16S",
						  "billing_period_id": "UPEN",
						  "billing_period": "Upon Enrollment",
						  "due_dates": [
							"2016-06-05"
						  ],
						  "bill_months": [
							"Jun 2016"
						  ],
						  "amount": 4500
						},
						{
						  "id": 14,
						  "payment_scheme_id": "G8RE16S",
						  "billing_period_id": "SEM2",
						  "billing_period": "Second Semester",
						  "due_dates": [
							"2016-10-05"
						  ],
						  "bill_months": [
							"Oct 2016"
						  ],
						  "amount": 2900
						}
					  ]
					},
					{
					  "id": "MNTH",
					  "name": "Monthly",
					  "payment_frequency": 10,
					  "total_amount": 7750,
					  "variance_amount": 250,
					  "schedule": [
						{
						  "id": 15,
						  "payment_scheme_id": "G8RE16M",
						  "billing_period_id": "UPEN",
						  "billing_period": "Upon Enrollment",
						  "due_dates": [
							"2016-06-05"
						  ],
						  "bill_months": [
							"Jun 2016"
						  ],
						  "amount": 1000
						},
						{
						  "id": 18,
						  "payment_scheme_id": "G8RE16M",
						  "billing_period_id": "MO9X",
						  "billing_period": "Monthly for 9 months",
						  "due_dates": [
							"2016-07-05",
							"2016-08-05",
							"2016-09-05",
							"2016-10-05",
							"2016-11-05",
							"2016-12-05",
							"2017-01-05",
							"2017-02-05",
							"2017-03-05"
						  ],
						  "bill_months": [
							"Jul 2016",
							"Aug 2016",
							"Sep 2016",
							"Oct 2016",
							"Nov 2016",
							"Dec 2016",
							"Jan 2017",
							"Feb 2017",
							"Mar 2017"
						  ],
						  "amount": 750
						}
					  ]
					},
					{
					  "id": "EASY",
					  "name": "Easy",
					  "payment_frequency": 10,
					  "total_amount": 8000,
					  "variance_amount": 500,
					  "schedule": [
						{
						  "id": 16,
						  "payment_scheme_id": "G8RE16E",
						  "billing_period_id": "UPEN",
						  "billing_period": "Upon Enrollment",
						  "due_dates": [
							"2016-06-05"
						  ],
						  "bill_months": [
							"Jun 2016"
						  ],
						  "amount": 800
						},
						{
						  "id": 19,
						  "payment_scheme_id": "G8RE16E",
						  "billing_period_id": "MO9X",
						  "billing_period": "Monthly for 9 months",
						  "due_dates": [
							"2016-07-05",
							"2016-08-05",
							"2016-09-05",
							"2016-10-05",
							"2016-11-05",
							"2016-12-05",
							"2017-01-05",
							"2017-02-05",
							"2017-03-05"
						  ],
						  "bill_months": [
							"Jul 2016",
							"Aug 2016",
							"Sep 2016",
							"Oct 2016",
							"Nov 2016",
							"Dec 2016",
							"Jan 2017",
							"Feb 2017",
							"Mar 2017"
						  ],
						  "amount": 800
						}
					  ]
					}
				  ]
				}
			  ]
			});
			model.POST = function(data){
				data.program = data.program_id;
				data.year_level = data.year_level_id;
				data.display_sy = data.sy+'-'+(data.sy+1);
				data.fees = [];
				data.discounts = [];
				return {success:model.save(data)};
			}
		return model;
});