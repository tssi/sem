<?php
class PaymentScheme extends AppModel {
	var $belongsTo = array('Tuition','Scheme');
	var $hasMany = array('PaymentSchemeSchedule');
}