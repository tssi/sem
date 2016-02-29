<?php
class Discount extends AppModel {
	var $name = 'Discount';
	var $useDbConfig = 'sfm';
	var $virtualFields = array('display_amount'=>
					"CASE Discount.type 
						WHEN  'percent' THEN 
							CONCAT(CAST(Discount.amount AS DECIMAL) ,'%')
						ELSE
							CONCAT('P',Discount.amount)
					END");
}
