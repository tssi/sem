<?php
include('../fpdf17/fpdf.php'); 
	class FormSheet extends FPDF{
		private $FONT_CONST = 0.50;
		public $GRID = array();
		protected $showLines=true;
		public function createSheet($type=null,$title=null,$img=null){
			$this->AddPage();
			$this->SetMargins(0,0);
			if($img){
					$this->Image($img,0,0,$this->w,$this->h);
			}
		}
		
		public function createGrid($base_x ,$base_y,$width,$height,$rows,$cols){
			$grid = array();
			//Compute Grid Metrics
			$grid['font_size']  = $cols<15?9:round(100/($cols*$this->FONT_CONST));
			$grid['width'] = $width;
			$grid['cell_width'] = $width/$cols;
			$grid['cell_height']= $height/$rows;
			$grid['height']= $height;
			$grid['base_x']=$base_x;
			$grid['base_y']=$base_y;
			//Create Grid
			$grid['v_lines'] = $this->DrawHorLines($base_x ,$base_y,$base_x +$width,$base_y,$height,$rows);
			$grid['h_lines'] = $this->DrawVerLines($base_x ,$base_y,$base_x ,$base_y+$height,$width,$cols);
		
			$this->GRID = $grid;
		}
		
		protected function section($metrics){
			$this->createGrid($metrics['base_x'] ,$metrics['base_y'],$metrics['width'],$metrics['height'],$metrics['rows'],$metrics['cols']);
			$this->SetDrawColor(0);
			if(isset($metrics['border'])){
				$this->Rect($metrics['base_x'],$metrics['base_y'],$metrics['width'],$metrics['height']);
			}
		}
		public function putText($x,$y,$txt,$style=''){
			$this->SetFont('Arial',$style,$this->GRID['font_size']);
			$this->Text($this->GRID['base_x']+($this->GRID['cell_width']*$x),$this->GRID['base_y']+($this->GRID['cell_height']*$y),$txt);			
		}
		
		public function leftText($x,$y,$txt,$w,$style=''){
			$this->putText($x,$y,$txt,$style);
		}
		
		public function fitText($x,$y,$txt,$w,$style=''){
			$font_size = $this->GRID['font_size'];
			$this->SetFont('Arial','',$font_size);
			$const =round($this->GetStringWidth($txt),2);
			while($const>$w*0.6){				
				$this->SetFont('Arial','',$font_size);
				$const =round($this->GetStringWidth($txt),2);
				$font_size-=0.1;
			}
			$this->Text($this->GRID['base_x']+($this->GRID['cell_width']*$x),$this->GRID['base_y']+($this->GRID['cell_height']*$y),$txt);
		}
		
		public function centerText($x,$y,$txt,$w,$style=''){
			$disp_x = $this->GRID['base_x']+($this->GRID['cell_width']*$x);
			$disp_x += ($this->GRID['cell_width']*$w)/2;
			$disp_y = $this->GRID['base_y']+($this->GRID['cell_height']*$y);
			$disp_x = $disp_x - $this->GetStringWidth($txt)*0.5;
			$this->SetFont('Arial',$style,$this->GRID['font_size']);
			$this->Text($disp_x,$disp_y,$txt);
		}
		public function rightText($x,$y,$txt,$w,$style=''){
			$disp_x = $this->GRID['base_x']+($this->GRID['cell_width']*$x);
			$disp_y = $this->GRID['base_y']+($this->GRID['cell_height']*$y);
			$disp_x = $disp_x - $this->GetStringWidth($txt);
			$disp_x = $disp_x +($this->GRID['cell_width']*$w);
			$this->SetFont('Arial',$style,$this->GRID['font_size']);
			$this->Text($disp_x,$disp_y,$txt);
		}
		public function DrawLine($pt,$ort,$plot=null) {
			if($ort=='v'){
			if(empty($plot)){
					$plot =  array(0,$this->GRID['height']/$this->GRID['cell_height']);
				}
				$x1=$this->GRID['base_x']+($this->GRID['cell_width']*$pt);
				$y1=$this->GRID['base_y']+($this->GRID['cell_height']*$plot[0]);
				$x2=$this->GRID['base_x']+($this->GRID['cell_width']*$pt);
				$y2=$y1+($this->GRID['height'] - ($this->GRID['height']-($this->GRID['cell_height']*$plot[1])));
			}else if($ort=='h'){
				if(empty($plot)){
					$plot =  array(0,$this->GRID['width']/$this->GRID['cell_width']);
				}
				$x1=$this->GRID['base_x']+($this->GRID['cell_width']*$plot[0]);
				$y1=$this->GRID['base_y']+($this->GRID['cell_height']*$pt);
				$x2=$x1+($this->GRID['width'] - ($this->GRID['width']-($this->GRID['cell_width']*$plot[1])));
				$y2=$this->GRID['base_y']+($this->GRID['cell_height']*$pt);
				
			}
			$this->Line($x1,$y1,$x2,$y2);
		}
		
		public function DrawHorLines($x1,$y1,$x2,$y2,$h,$rows){
			
			$H=$h/$rows;
			$h_lines=array();
			for($index=0;$index<$rows;$index++){
				$X1=$x1;
				$Y1=$y1+($H*$index);
				$X2=$x2;
				$Y2=$y2+($H*$index);
				array_push($h_lines,$Y1);
				if($this->showLines){
					if($index%4!=0){
						$this->SetDrawColor(223,224,246);
					}else{
						$this->SetDrawColor(255,0,0);				
					}
					$this->Line($X1,$Y1,$X2,$Y2);
				}
			}
			return $h_lines;
		}
		public function DrawVerLines($x1,$y1,$x2,$y2,$w,$cols){
			
			$W=$w/$cols;
			$v_lines=array();
			for($index=0; $index<$cols; $index++){
				$X1=$x1+($W*$index);
				$Y1=$y1;
				$X2=$x2+($W*$index);
				$Y2=$y2;
				array_push($v_lines,$X1);
				if($this->showLines){
					if($index%4!=0){
						$this->SetDrawColor(223,224,246);
					}else{
						$this->SetDrawColor(255,0,0);				
					}
					$this->Line($X1,$Y1,$X2,$Y2);
				}
			}
			return $v_lines;
		}
		
		protected function DrawMultipleLines($start_at,$ln_count,$step=1,$orient='h'){
			$ctrs = array();
			for($ctr=$start_at;$ctr<=$ln_count;$ctr+=$step){
				$this->DrawLine($ctr,$orient);
				array_push($ctrs,$ctr);
			}
			return $ctrs;
		}
		
		public function DrawBox($x,$y,$w,$h){
			$x1=$this->GRID['base_x']+($this->GRID['cell_width']*$x);
			$y1=$this->GRID['base_y']+($this->GRID['cell_height']*$y);
			$w1 =$this->GRID['cell_width']*$w;
			$h1 =$this->GRID['cell_height']*$h;
			$this->Rect($x1,$y1,$w1,$h1);
		}
		
		
		
		
		
		/*public function DrawBrokenline(){
		// draw a broken line
			$width=3;
			$area=216;
			$pad=2;
	
			for ($i=10;$i<200;$i++) {
			$linePos=array($i,$area,$width);
			$pdf->DrawLine($linePos);
			$i = (($i+$width)+$pad)-1;
		}
		}*/
	}
?>