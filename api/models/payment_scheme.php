<?php
class PaymentScheme extends AppModel {
	var $belongsTo = array('Tuition','Scheme');
	var $hasMany = array('PaymentSchemeSchedule');
	function prepareData($data){
		$data = $data['PaymentScheme'];
		$tuition_id = $data['tuition_id'];
		$scheme_id = $data['scheme_id'];
		$pay_schem_info = $this->getPaySchemeInfo($tuition_id,$scheme_id);
		$data['id'] = $pay_schem_info['pay_scheme_id'];
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