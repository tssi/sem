<?php
class PaymentScheme extends AppModel {
	//var $useDbConfig = 'sfm';
	var $name = 'PaymentScheme';
	var $order = 'order';
	//var $belongsTo = array('Tuition','Scheme');
	///var $hasMany = array('PaymentSchemeSchedule');
	
	
	var $belongsTo = array(
		'Tuition' => array(
			'className' => 'Tuition',
			'foreignKey' => 'tuition_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Scheme' => array(
			'className' => 'Scheme',
			'foreignKey' => 'scheme_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
	
	var $hasMany = array(
		'PaymentSchemeSchedule' => array(
			'className' => 'PaymentSchemeSchedule',
			'foreignKey' => 'payment_scheme_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
	
	function prepareData($data){
		$data = $data['PaymentScheme'];
		if(isset($data[0])){
			foreach($data as $index=>$datum){
				$tuition_id = $datum['tuition_id'];
				$scheme_id = $datum['scheme_id'];
				$pay_schem_info = $this->getPaySchemeInfo($tuition_id,$scheme_id);
				$datum['id'] = $pay_schem_info['pay_scheme_id'];
				$data[$index]=$datum;
			}
		}else{
			$tuition_id = $data['tuition_id'];
			$scheme_id = $data['scheme_id'];
			$pay_schem_info = $this->getPaySchemeInfo($tuition_id,$scheme_id);
			$data['id'] = $pay_schem_info['pay_scheme_id'];
		}
		$data= array('PaymentScheme'=>$data);
		return $data;
	}
	function getPaySchemeInfo($tuition_id,$scheme_id){
		$this->Tuition->recursive=0;
		$this->Scheme->recursive=0;
		$tuition = $this->Tuition->findById($tuition_id,array('Tuition.sy','Tuition.code_sy','YearLevel.id','Program.code'));
		$scheme = $this->Scheme->findById($scheme_id,array('Scheme.code'));
		$pay_scheme_id = $tuition['YearLevel']['id'].$tuition['Program']['code'].$tuition['Tuition']['code_sy'].$scheme['Scheme']['code'];
		$pay_schem_info = array('sy'=>$tuition['Tuition']['sy'],'pay_scheme_id'=>$pay_scheme_id);
		return $pay_schem_info;
	}
}