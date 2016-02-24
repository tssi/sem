"use strict";
define(['model'],function($model){
	return new $model(
			{
			  "meta": {
				"message": "List of Billing Periods",
				"limit": 10,
				"next": null,
				"prev": null,
				"last": 1,
				"count": 4,
				"page": 1,
				"pages": 1,
				"epoch": 1456275752,
				"code": 200
			  },
			  "data": [
				{
				  "id": "UPEN",
				  "name": "Upon Enrollment",
				  "payment_frequency": 1,
				  "bill_month_start": 6,
				  "bill_cutoff_date": 5,
				  "bill_cycle_increment": "+0 day",
				  "order": 1,
				  "created": "2016-02-05 08:13:02",
				  "modified": "2016-02-05 08:16:01"
				},
				{
				  "id": "SEM2",
				  "name": "Second Semester",
				  "payment_frequency": 1,
				  "bill_month_start": 10,
				  "bill_cutoff_date": 5,
				  "bill_cycle_increment": "+0 day",
				  "order": 2,
				  "created": "2016-02-05 08:13:16",
				  "modified": "2016-02-05 08:16:01"
				},
				{
				  "id": "MO9X",
				  "name": "Monthly for 9 months",
				  "payment_frequency": 9,
				  "bill_month_start": 7,
				  "bill_cutoff_date": 5,
				  "bill_cycle_increment": "+1 month",
				  "order": 3,
				  "created": "2016-02-05 08:13:35",
				  "modified": "2016-02-05 08:13:39"
				},
				{
				  "id": "LSEV",
				  "name": "Less: Educ Voucher",
				  "payment_frequency": 9,
				  "bill_month_start": 7,
				  "bill_cutoff_date": 5,
				  "bill_cycle_increment": "+1 month",
				  "order": 4,
				  "created": "2016-02-10 04:27:58",
				  "modified": "2016-02-10 04:27:58"
				}
			  ]
			}
	);
});