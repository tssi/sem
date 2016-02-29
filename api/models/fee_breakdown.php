<?php
class FeeBreakdown extends AppModel {
	var $useDbConfig = 'sfm';
	var $belongsTo = array('Tuition','Fee');
}