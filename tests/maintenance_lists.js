"use strict";
define(['model'],function($model){
	return new $model(
			{
			  "meta": {
				"message": "List of Maintenance Lists",
				"limit": 2000,
				"next": null,
				"prev": null,
				"last": 1,
				"count": 14,
				"page": 1,
				"pages": 1,
				"epoch": 1456275678,
				"code": 200
			  },
			  "data": [
				{
				  "id": 28,
				  "name": "Program",
				  "description": "List of Programs",
				  "path": "programs",
				  "order": null,
				  "created": "2016-02-18 07:51:13",
				  "modified": "2016-02-18 07:51:13",
				  "schema": [
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 3,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "id"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 2,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "code"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 20,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "name"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 50,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "description"
					},
					{
					  "type": "integer",
					  "null": true,
					  "default": null,
					  "length": 4,
					  "name": "order"
					},
					{
					  "type": "datetime",
					  "null": true,
					  "default": null,
					  "length": null,
					  "name": "created"
					},
					{
					  "type": "datetime",
					  "null": true,
					  "default": null,
					  "length": null,
					  "name": "modified"
					}
				  ]
				},
				{
				  "id": 27,
				  "name": "Billing Period",
				  "description": "List of Billing Periods",
				  "path": "billing_periods",
				  "order": null,
				  "created": "2016-02-05 08:12:29",
				  "modified": "2016-02-05 08:12:29",
				  "schema": [
					{
					  "type": "string",
					  "null": false,
					  "default": null,
					  "length": 4,
					  "key": "primary",
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "id"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 50,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "name"
					},
					{
					  "type": "integer",
					  "null": true,
					  "default": null,
					  "length": 4,
					  "name": "payment_frequency"
					},
					{
					  "type": "integer",
					  "null": true,
					  "default": null,
					  "length": 2,
					  "name": "bill_month_start"
					},
					{
					  "type": "integer",
					  "null": true,
					  "default": null,
					  "length": 2,
					  "name": "bill_cutoff_date"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 20,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "bill_cycle_increment"
					},
					{
					  "type": "integer",
					  "null": true,
					  "default": null,
					  "length": 4,
					  "name": "order"
					},
					{
					  "type": "datetime",
					  "null": true,
					  "default": null,
					  "length": null,
					  "name": "created"
					},
					{
					  "type": "datetime",
					  "null": true,
					  "default": null,
					  "length": null,
					  "name": "modified"
					}
				  ]
				},
				{
				  "id": 26,
				  "name": "Section",
				  "description": "List of Sections",
				  "path": "sections",
				  "order": 1,
				  "created": "2016-02-05 04:14:01",
				  "modified": "2016-02-05 07:59:18",
				  "schema": [
					{
					  "type": "integer",
					  "null": false,
					  "default": null,
					  "length": 11,
					  "key": "primary",
					  "name": "id"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 2,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "year_level_id"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 50,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "name"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 3,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "program_id"
					},
					{
					  "type": "integer",
					  "null": true,
					  "default": null,
					  "length": 4,
					  "name": "order"
					},
					{
					  "type": "datetime",
					  "null": true,
					  "default": null,
					  "length": null,
					  "name": "created"
					},
					{
					  "type": "datetime",
					  "null": true,
					  "default": null,
					  "length": null,
					  "name": "modified"
					}
				  ]
				},
				{
				  "id": 24,
				  "name": "Payment Scheme",
				  "description": "List of Payment Schemes",
				  "path": "schemes",
				  "order": 2,
				  "created": "2016-02-05 01:02:07",
				  "modified": "2016-02-05 07:59:18",
				  "schema": [
					{
					  "type": "string",
					  "null": false,
					  "default": null,
					  "length": 4,
					  "key": "primary",
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "id"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 1,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "code"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 50,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "name"
					},
					{
					  "type": "integer",
					  "null": true,
					  "default": null,
					  "length": 2,
					  "name": "payment_frequency"
					},
					{
					  "type": "integer",
					  "null": true,
					  "default": null,
					  "length": 4,
					  "name": "order"
					},
					{
					  "type": "datetime",
					  "null": true,
					  "default": null,
					  "length": null,
					  "name": "created"
					},
					{
					  "type": "datetime",
					  "null": true,
					  "default": null,
					  "length": null,
					  "name": "modified"
					}
				  ]
				},
				{
				  "id": 23,
				  "name": "Discount",
				  "description": "List of Discounts",
				  "path": "discounts",
				  "order": 3,
				  "created": "2016-02-05 01:01:44",
				  "modified": "2016-02-05 07:59:18",
				  "schema": [
					{
					  "type": "string",
					  "null": false,
					  "default": null,
					  "length": 4,
					  "key": "primary",
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "id"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 50,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "name"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 140,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "description"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 10,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "type"
					},
					{
					  "type": "float",
					  "null": true,
					  "default": null,
					  "length": "10,2",
					  "name": "amount"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 140,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "fees_applicable"
					},
					{
					  "type": "datetime",
					  "null": true,
					  "default": null,
					  "length": null,
					  "name": "created"
					},
					{
					  "type": "datetime",
					  "null": true,
					  "default": null,
					  "length": null,
					  "name": "modified"
					}
				  ]
				},
				{
				  "id": 22,
				  "name": "Fee",
				  "description": "List of Fees",
				  "path": "fees",
				  "order": 4,
				  "created": "2016-02-05 00:35:46",
				  "modified": "2016-02-05 07:59:18",
				  "schema": [
					{
					  "type": "string",
					  "null": false,
					  "default": null,
					  "length": 3,
					  "key": "primary",
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "id"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 50,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "name"
					},
					{
					  "type": "integer",
					  "null": true,
					  "default": null,
					  "length": 4,
					  "name": "order"
					},
					{
					  "type": "datetime",
					  "null": true,
					  "default": null,
					  "length": null,
					  "name": "created"
					},
					{
					  "type": "datetime",
					  "null": true,
					  "default": null,
					  "length": null,
					  "name": "modified"
					}
				  ]
				},
				{
				  "id": 17,
				  "name": "List",
				  "description": "List of Maintenance",
				  "path": "maintenance_lists",
				  "order": 5,
				  "created": "2016-02-04 08:35:53",
				  "modified": "2016-02-05 07:59:18",
				  "schema": [
					{
					  "type": "integer",
					  "null": false,
					  "default": null,
					  "length": 11,
					  "key": "primary",
					  "name": "id"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 50,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "name"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 140,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "description"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 50,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "path"
					},
					{
					  "type": "integer",
					  "null": true,
					  "default": null,
					  "length": 4,
					  "name": "order"
					},
					{
					  "type": "datetime",
					  "null": true,
					  "default": null,
					  "length": null,
					  "name": "created"
					},
					{
					  "type": "datetime",
					  "null": true,
					  "default": null,
					  "length": null,
					  "name": "modified"
					}
				  ]
				},
				{
				  "id": 2,
				  "name": "Year Level",
				  "description": "List of Year Levels",
				  "path": "year_levels",
				  "order": 6,
				  "created": "2016-02-03 06:08:19",
				  "modified": "2016-02-05 07:59:18",
				  "schema": [
					{
					  "type": "string",
					  "null": false,
					  "default": null,
					  "length": 2,
					  "key": "primary",
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "id"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 2,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "educ_level_id"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 15,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "name"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 5,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "alias"
					},
					{
					  "type": "integer",
					  "null": true,
					  "default": null,
					  "length": 11,
					  "name": "order"
					},
					{
					  "type": "datetime",
					  "null": true,
					  "default": null,
					  "length": null,
					  "name": "created"
					},
					{
					  "type": "datetime",
					  "null": true,
					  "default": null,
					  "length": null,
					  "name": "modified"
					}
				  ]
				},
				{
				  "id": 4,
				  "name": "Religion",
				  "description": "List of Religions",
				  "path": "religions",
				  "order": 7,
				  "created": "2016-02-03 06:08:44",
				  "modified": "2016-02-05 07:59:18",
				  "schema": [
					{
					  "type": "integer",
					  "null": false,
					  "default": null,
					  "length": 11,
					  "key": "primary",
					  "name": "id"
					},
					{
					  "type": "string",
					  "null": false,
					  "default": null,
					  "length": 50,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "name"
					},
					{
					  "type": "integer",
					  "null": true,
					  "default": null,
					  "length": 11,
					  "name": "order"
					},
					{
					  "type": "datetime",
					  "null": true,
					  "default": null,
					  "length": null,
					  "name": "created"
					},
					{
					  "type": "datetime",
					  "null": true,
					  "default": null,
					  "length": null,
					  "name": "modified"
					}
				  ]
				},
				{
				  "id": 5,
				  "name": "Citizenship",
				  "description": "List of Citizenships",
				  "path": "citizenships",
				  "order": 8,
				  "created": "2016-02-03 06:09:03",
				  "modified": "2016-02-05 07:59:18",
				  "schema": [
					{
					  "type": "integer",
					  "null": false,
					  "default": null,
					  "length": 11,
					  "key": "primary",
					  "name": "id"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 50,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "name"
					},
					{
					  "type": "integer",
					  "null": true,
					  "default": null,
					  "length": 11,
					  "name": "order"
					},
					{
					  "type": "datetime",
					  "null": true,
					  "default": null,
					  "length": null,
					  "name": "created"
					},
					{
					  "type": "datetime",
					  "null": true,
					  "default": null,
					  "length": null,
					  "name": "modified"
					}
				  ]
				},
				{
				  "id": 13,
				  "name": "Department",
				  "description": "List of Departments",
				  "path": "educ_levels",
				  "order": 9,
				  "created": "2016-02-04 08:19:56",
				  "modified": "2016-02-05 07:59:18",
				  "schema": [
					{
					  "type": "string",
					  "null": false,
					  "default": null,
					  "length": 2,
					  "key": "primary",
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "id"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 15,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "name"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 5,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "alias"
					},
					{
					  "type": "integer",
					  "null": true,
					  "default": null,
					  "length": 11,
					  "name": "order"
					},
					{
					  "type": "datetime",
					  "null": true,
					  "default": null,
					  "length": null,
					  "name": "created"
					},
					{
					  "type": "datetime",
					  "null": true,
					  "default": null,
					  "length": null,
					  "name": "modified"
					}
				  ]
				},
				{
				  "id": 14,
				  "name": "Country",
				  "description": "List of Countries",
				  "path": "countries",
				  "order": 10,
				  "created": "2016-02-04 08:21:40",
				  "modified": "2016-02-05 07:59:18",
				  "schema": [
					{
					  "type": "string",
					  "null": false,
					  "default": null,
					  "length": 2,
					  "key": "primary",
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "id"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 50,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "name"
					},
					{
					  "type": "integer",
					  "null": true,
					  "default": null,
					  "length": 2,
					  "name": "call_code"
					},
					{
					  "type": "integer",
					  "null": true,
					  "default": null,
					  "length": 4,
					  "name": "order"
					}
				  ]
				},
				{
				  "id": 16,
				  "name": "Barangay",
				  "description": "List of Barangays",
				  "path": "barangays",
				  "order": 11,
				  "created": "2016-02-04 08:30:35",
				  "modified": "2016-02-05 07:59:18",
				  "schema": [
					{
					  "type": "integer",
					  "null": false,
					  "default": null,
					  "length": 11,
					  "key": "primary",
					  "name": "id"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 150,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "name"
					},
					{
					  "type": "integer",
					  "null": true,
					  "default": null,
					  "length": 11,
					  "name": "city_id"
					},
					{
					  "type": "boolean",
					  "null": true,
					  "default": null,
					  "length": 1,
					  "comment": "Is Show On Drop Down",
					  "name": "is_active"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 4,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "zip_code"
					}
				  ]
				},
				{
				  "id": 15,
				  "name": "Province",
				  "description": "List of Provinces",
				  "path": "provinces",
				  "order": 12,
				  "created": "2016-02-04 08:25:03",
				  "modified": "2016-02-05 07:59:18",
				  "schema": [
					{
					  "type": "string",
					  "null": false,
					  "default": null,
					  "length": 3,
					  "key": "primary",
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "id"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 150,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "name"
					},
					{
					  "type": "string",
					  "null": true,
					  "default": null,
					  "length": 2,
					  "collate": "latin1_swedish_ci",
					  "charset": "latin1",
					  "name": "country_id"
					},
					{
					  "type": "boolean",
					  "null": true,
					  "default": null,
					  "length": 1,
					  "comment": "Is Show On Drop Down",
					  "name": "is_active"
					},
					{
					  "type": "integer",
					  "null": true,
					  "default": null,
					  "length": 4,
					  "name": "order"
					}
				  ]
				}
			  ]
			}
	);
});