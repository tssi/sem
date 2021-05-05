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
	
	function hdr($sum,$totals){
		//pr($sum); exit();
		$metrics = array(
			'base_x'=> 0,
			'base_y'=> 0,
			'width'=> 210,
			'height'=> 297,
			'cols'=> 36,
			'rows'=> 32,	
		);
		$this->section($metrics);
		$this->GRID['font_size']=12;
		$this->leftText(15,1,'SUMMARY',null,'');
		$this->GRID['font_size']=10;
		$this->leftText(3,2,'Year Level',null,'');
		$this->drawBox(2.8,1.2,9,1);
		$this->leftText(12,2,'New Students',null,'');
		$this->drawBox(11.8,1.2,8,1);
		$this->leftText(20,2,'Old Students',null,'');
		$this->drawBox(19.8,1.2,8,1);
		$this->leftText(28,2,'Total',null,'');
		$this->drawBox(27.8,1.2,6,1);
		$line = 3;
		foreach($sum as $d){
			if(isset($d['total_new'])){
				if(!isset($d['program']))
					$this->leftText(3,$line,$d['description'],null,'');
				else
					$this->rightText(11,$line,$d['description'],null,'');
				$this->drawBox(2.8,$line-.8,9,1);
				$this->leftText(12,$line,$d['total_new'],null,'');
				$this->drawBox(11.8,$line-.8,8,1);
				$this->leftText(20,$line,$d['total_old'],null,'');
				$this->drawBox(19.8,$line-.8,8,1);
				$this->leftText(28,$line,$d['total'],null,'');
				$this->drawBox(27.8,$line-.8,6,1);
			}else{
				$this->leftText(3,$line,$d['description'],null,'');
				$this->drawBox(2.8,$line-.8,31,1);
			}
			$line++;
			
		}
		
		$this->leftText(3,$line,'Totals',null,'');
		$this->drawBox(2.8,$line-.8,9,1);
		$this->leftText(12,$line,$totals['new'],null,'');
		$this->drawBox(11.8,$line-.8,8,1);
		$this->leftText(20,$line,$totals['old'],null,'');
		$this->drawBox(19.8,$line-.8,8,1);
		$this->leftText(28,$line,$totals['total'],null,'');
		$this->drawBox(27.8,$line-.8,6,1);
		
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
		foreach($data as $i=>$dt){
			//pr($dt); exit();
			$this->leftText(1.8,$line,$i+1 . '. ',null,'');
			$this->leftText(3,$line,$dt['transac_date'],null,'');
			$this->leftText(8,$line,$dt['ref_no'],null,'');
			$this->leftText(14,$line,$dt['name'],null,'');
			$this->leftText(26,$line,$dt['year_level'],null,'');
			$this->leftText(29,$line,$dt['status'],null,'');
			$line+=.6;
		}
	}	
}
?>
	