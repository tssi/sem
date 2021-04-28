<?php
require('vendors/fpdf17/formsheet.php');
class ReservedStudent extends Formsheet{
	protected static $_width = 210;
	protected static $_height = 297;
	protected static $_unit = 'mm';
	protected static $_orient = 'P';	
	
	function ReservedStudent(){
		$this->showLines = !true;
		$this->FPDF(ReservedStudent::$_orient, ReservedStudent::$_unit,array(ReservedStudent::$_width,ReservedStudent::$_height));
		$this->createSheet();
	}
	
	function data($data,$page){
		//pr($data); exit();
		$this->showLines = false;
		$metrics = array(
			'base_x'=> 0,
			'base_y'=> 0,
			'width'=> 210,
			'height'=> 297,
			'cols'=> 36,
			'rows'=> 32,	
		);
		$this->section($metrics);
		$this->GRID['font_size']=10;
		$this->leftText(3,1,'Date',null,'');
		$this->leftText(8,1,'OR Number',null,'');
		$this->leftText(14,1,'Name',null,'');
		$this->leftText(26,1,'Grade',null,'');
		$this->leftText(29,1,'Status',null,'');
		$this->GRID['font_size']=8;
		$line = 2;
		foreach($data as $dt){
			//pr($dt); exit();
			$this->leftText(3,$line,$dt['transac_date'],null,'');
			$this->leftText(8,$line,$dt['ref_no'],null,'');
			$this->leftText(14,$line,$dt['name'],null,'');
			$this->leftText(26,$line,$dt['year_level'],null,'');
			$this->leftText(29,$line,$dt['status'],null,'');
			$line+=.6;
			continue;
		}
	}	
}
?>
	