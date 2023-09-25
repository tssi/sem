<?php
class AdvisorySection extends AppModel {
	var $name = 'AdvisorySection';
	var $useDbConfig = 'ser';
	
    var $belongsTo = array(
		'Teacher' => array(
			'className' => 'Teacher',
			'foreignKey' => false,
			'dependent' => false,
			'conditions' => array('AdvisorySection.teacher_id =  Teacher.id'),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

    function getAdvisorySection($sid,$esp){
        return $advisory = $this->find('all',array('conditions'=>array('AdvisorySection.section_id'=>array($sid),'AdvisorySection.esp'=>$esp+.10)));
    }

}
