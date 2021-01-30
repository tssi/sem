<?php
require(__DIR__.'/formsheet.php');
class SampleReport extends Formsheet{
	protected static $_width = 5.5;
	protected static $_height = 7;
	protected static $_unit = 'in';
	protected static $_orient = 'P';
	protected static $_allot_subjects = 15;
	function SampleReport($data=null){
		$this->data =$data;
		$this->showLines = true;
		$this->FPDF(SampleReport::$_orient, SampleReport::$_unit,array(SampleReport::$_width,SampleReport::$_height));
		$this->createSheet();
	}
	function sampleText(){
		$metrics = array(
			'base_x'=> 0.2,
			'base_y'=> 0.15,
			'width'=> 5,
			'height'=> 0.8,
			'cols'=> 20,
			'rows'=>6,	
		);
		$this->section($metrics);
		
		// Text alignment
		// $x, $y, $txt, $width
		$this->GRID['font_size']=15;	
		$this->leftText(0,5,"This is sample Left Text",20);
		$this->rightText(0,8,"This is sample Right Text",20);
		$this->centerText(0,11,"This is sample Center Text",20);

		// Text wrap with line spacing
		// $x, $y, $txt, $width, $line_spacing (optional)
		$this->GRID['font_size']=12;	
		$this->wrapText(0,12,"This is sample wrapping text",5);
		$this->wrapText(0,15,"This is sample wrapping text",5,1.5);


		// RGB Fill and Outline
		$this->SetFillColor(255,255,255);
		$this->SetDrawColor(0,0,0);
		$this->DrawBox(0,20,10,10,'FD');
		
		//Change fill color no border
		$this->SetFillColor(255,255,0);
		$this->DrawBox(5,33,10,10,'F');

		//Change draw color border only
		$this->SetDrawColor(0,0,255);
		$this->DrawBox(3,25,10,10,'D');
	}
}
?>