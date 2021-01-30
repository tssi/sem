<?php
//Individual Pupil's Rating Sheet (Elementary)
require(__DIR__.'/formsheet.php');
class iprs extends Formsheet{
	protected static $_width = 13;
	protected static $_height = 8.5;
	protected static $_unit = 'in';
	protected static $_orient = 'L';
	protected static $_allot_subjects = 15;
	protected static $_min_col = 1;
	public $data;
	protected  $_fancy=false;
	function iprs($data=null){
		$this->data =$data;
		$this->showLines = !true;
		$this->_colorful = true;
		$this->FPDF(iprs::$_orient, iprs::$_unit,array(iprs::$_width,iprs::$_height));
		$this->createSheet();
	}

	function hdr($info){
		$metrics = array(
			'base_x'=> 0.2125,
			'base_y'=> 0,
			'width'=> 25.575,
			'height'=> 0.75,
			'cols'=> 160,
			'rows'=> 4,
		);
		$this->section($metrics);
		$this->GRID['font_size']=16;
		$this->leftText(0,2,"CLASS RECORD",'b');
		$this->GRID['font_size']=10;
		$this->leftText(0,3,"SUBJECT:",'');
		//print_r($info);
		$load = explode("/",$info['load']);
		$this->leftText(5.5,3,$load[0],'');
		$this->drawLine(3.2,'h',array(5,15));
		$this->leftText(25,3,"GRADE / SECTION:",'');
		$this->leftText(34,3,$load[1],'');
		$this->drawLine(3.2,'h',array(33.5,14));
		
		
		$this->leftText(0,4,"TEACHER:",'');
		$this->leftText(5.5,4,$info['teacher'],'');
		$this->drawLine(4.2,'h',array(5,15));
		$this->leftText(25,4,"S.Y. / PERIOD:",'');
		switch($info['period']){
			case 1:$period='First Grading';break;
			case 2:$period='Second Grading';break;
			case 3:$period='Third Grading';break;
			case 4:$period='Fourth Grading';break;
				
		}
		$sy = $info['sy'].' - '.($info['sy']+1);
		$period = $info['period'];
		$this->leftText(34,4,$sy.' / '.$period,'');
		$this->drawLine(4.2,'h',array(33.5,14));
		
	}
	function table_2($x,$y,$meta,$flgs){
		
		$metrics = array(
			'base_x'=> 0.2125,
			'base_y'=> 0.8,
			'width'=>  12.575*$this->data['page_len'],
			'height'=> 7.4,
			'cols'=> 40*$this->data['page_len'], //40,
			'rows'=> 40,
		);
		
		$COL_CTR=0;
		$PAGE_CTR=$flgs['page_ctr'];
		$this->GRID['font_size']=9;
		$compHeight=2.75;
		$subCompHeight=1.75;
		$hdrHeight=7.25;
		$nameDivider=$PAGE_CTR==0?8:2;
		$hdrDivider=$metrics['cols']-$nameDivider;
		$tableHeight=$metrics['rows'];
		//
		$data = $meta['data'];
		$total_col = $meta['total_col'];
		$total_page = ceil($total_col/($metrics['cols']-$nameDivider))+1;		
		$start_x = $nameDivider;
		$start_y = 1.5;
		$length=0;
		$start_sub_x =$start_x ;
		$start_sub_y = $start_y + $compHeight;
		$sub_hdr_y = $compHeight+$subCompHeight;
		$compIndex=$flgs['compIndex'];
		$subCompIndex=$flgs['subCompIndex'];
		$measIndex=$flgs['measIndex'];
		$colors =array(
					array(	'r'=>253,
							'g'=>207,
							'b'=>207,
					),
					array(	'r'=>253,
							'g'=>237,
							'b'=>207,
					),
					array(	'r'=>253,
							'g'=>250,
							'b'=>207,
					),
					array(	'r'=>214,
							'g'=>253,
							'b'=>207,
					),
					array(	'r'=>207,
							'g'=>248,
							'b'=>253,
					),
					array(	'r'=>210,
							'g'=>207,
							'b'=>253,
					),
		);
		
		//Background
		for($bg_x=$start_x,$compIndex=$flgs['compIndex'];$compIndex<count($data);$compIndex++){	
			$component = $data[$compIndex];
			$bg_c=$colors[$compIndex%count($colors)];
			$this->SetFillColor($bg_c['r'],$bg_c['g'],$bg_c['b']);
			$this->DrawBox($bg_x,0,$component['component']['col_count'],$compHeight,'F');
			$bg_x+=$component['component']['col_count'];
			$this->DrawBox($bg_x-1,$compHeight,1,$tableHeight-$compHeight,'F');
		}
		$bg_c=$colors[$compIndex%count($colors)];
		$this->SetFillColor($bg_c['r'],$bg_c['g'],$bg_c['b']);
		$this->DrawBox($bg_x,0,count($data)*1.75,$compHeight,'F');
		$bg_x+=count($data)*1.75;
		$bg_c=$colors[($compIndex+1)%count($colors)];
		$this->SetFillColor($bg_c['r'],$bg_c['g'],$bg_c['b']);
		$this->DrawBox($bg_x,0,3*1.75,$compHeight,'F');
		//Background End
		
		$this->_colorful=false;
		$this->drawLine($nameDivider,'v');
		$COL_CTR+=$nameDivider;
		
		$this->drawBox($x,$y,$metrics['cols'],$metrics['rows']);
		$this->drawLine($compHeight,'h',array($nameDivider,$hdrDivider));
		//$this->drawLine($compHeight+$hdrHeight,'h');
		
	
		
		
		for($compIndex=$flgs['compIndex'];$compIndex<count($data);$compIndex++){	
			$component = $data[$compIndex];
			//Sub-Components
			$length=0;
			$sub_comp_count=$flgs['subCompIndex'];
		
			for($subCompIndex=$flgs['subCompIndex'];$subCompIndex<count($component['subcomponents'] );$subCompIndex++){
				$subcom = $component['subcomponents'][$subCompIndex];
				$sub_comp_count++;
				$len = count($subcom['items']) - $flgs['measIndex'];
				$start_m_x =$start_sub_x ;
				$start_m_y = $start_sub_y + $subCompHeight;
				$l =  $len;
				$offset=1;
				if($COL_CTR+$len>=$metrics['cols']){
					$l = $metrics['cols']-$COL_CTR;
					$offset=0;
				}
				//Start Total Score
				if($len>1){
					$this->SetDrawColor(31,200,211);
					$this->drawLine($sub_hdr_y,'h',array($start_m_x,$l));	
					$this->SetDrawColor(0,255,0);
					for($ctr=0,$y=$sub_hdr_y+$subCompHeight;$ctr<=$hdrHeight-$sub_hdr_y;$y+=1.25,$ctr++){
						if($ctr==1){
							$this->GRID['font_size']=8;
							$this->rotateText($start_m_x+$len+0.4,$y-1.4,'TOTAL',90);
							$this->rotateText($start_m_x+$len+0.75,$y-1.25,'SCORE',90);
						}
						$this->drawLine($y,'h',array($start_m_x,$l+$offset));
					}
					$this->SetDrawColor(0);
				}
				//End
				
			
				//Start SubComponents Headers
				if($offset){
					if($len>1){
						$this->centerText($start_sub_x+0.3,$start_sub_y-0.4,$subcom['name'],$len-1); //Score Quizes,Score Oral Participation,etc.
					}else{
						$this->GRID['font_size']=8;
						$this->rotateText($start_sub_x+0.5,$hdrHeight+$subCompHeight+0.75 ,$subcom['name'].' /',90);//Rotated Periodical
						$this->rotateText($start_sub_x+0.9,$hdrHeight+$subCompHeight ,'TOTAL SCORE',90);//Rotated Periodical
						
					}
				}
				$COL_CTR++;
				//End
		
				
				$start_sub_x += $len;
				
				//Start Measurabe Item
				for($measIndex=$flgs['measIndex'];$measIndex<count($subcom['items'])&&$COL_CTR<$metrics['cols'];$measIndex++,$COL_CTR++){
					$itm = $subcom['items'][$measIndex];
					$this->GRID['font_size']=7;
					if($len>1){
						$this->centerText($start_m_x,$start_m_y-0.3,$itm,1);//items Q1,Q2,Q3,etc.
					}
					$this->GRID['font_size']=8;
					$start_m_x += 1;
					if($measIndex+1<count($subcom['items'])){
						$this->drawLine($start_m_x,'v',array($sub_hdr_y,$tableHeight-$sub_hdr_y));
					}
					$this->SetDrawColor(0);							
				}
				if($measIndex==count($subcom['items'])){
					$flgs['measIndex']=0;				
				}
				//End
				
				//Start				
				$this->SetDrawColor(0,0,255);
		
				$this->drawLine($start_sub_x++,'v',array($compHeight,$tableHeight-$compHeight));
				
				
				$length+=$len+2;
				$this->SetDrawColor(200,100,255);
				
				if($len>1){
					$this->drawLine($start_sub_x++,'v',array($compHeight,$tableHeight-$compHeight));
					$COL_CTR++;
					
				}
				$this->SetDrawColor(255,0,0);			
				
				$this->rotateText($start_sub_x-0.3,$hdrHeight+0.5,' RATING',90,'b');//Rotated Rating
					
			
				$displayCompo=true;
				//Display Weighted Average After last Component Grid
				
				if($sub_comp_count==count($component['subcomponents'] )){
					$COL_CTR++;
					$this->drawLine($start_sub_x,'v',array($compHeight,$tableHeight-$compHeight));
					$start_sub_x++;
					$this->rotateText($start_sub_x-0.3,$hdrHeight+0.5,' AVERAGE',90,'b');//Rotated Rating
					$this->drawLine($start_sub_x,'v',array($compHeight,$tableHeight-$compHeight));
					$start_sub_x++;	
					$this->GRID['font_size']=8;
					
					$this->rotateText($start_sub_x-0.5,$hdrHeight+$compHeight-0.3,'WIEGHTED Average',90,'b');//Rotated WIEGHTED Average
					$this->rotateText($start_sub_x-0.1,$hdrHeight,$component['component']['percentage'],90,'b');//Rotated Percentage
					$flgs['subCompIndex']=0;
				
					
				}	
				
						
				$this->SetDrawColor(0);
				$this->SetDrawColor(255,0,0);
				$this->drawLine($start_sub_x,'v',array($compHeight,$tableHeight-$compHeight));
				$this->SetDrawColor(0);
						
				
				
				
				//end
			}
			
			
			if($displayCompo){
				$this->centerText($start_x,$start_y,$component['component']['name'],$length+1);//Component Name ex.knowledge,process or skill, etc.	
			}
			$this->SetDrawColor(255,0,255);
			$this->drawLine($start_sub_x,'v');
			$this->SetDrawColor(0);
			$start_x=$start_sub_x;

		

			
		}
		//Summary of Weighted Avg.
		$width=1.75;
		$length=0;
		foreach($data as $component){
			$this->drawLine($start_sub_x+=$width,'v',array($compHeight,$tableHeight-$compHeight));
			$this->rotateText($start_sub_x-0.5,$hdrHeight+$compHeight-0.3,$component['component']['name'],90,'b');//Rotated Percentages
			$length+=$width;
			$COL_CTR+=$width;
		}
		$this->SetDrawColor(255,0,255);
		$this->drawLine($start_sub_x,'v');
		$this->SetDrawColor(0);
		$this->centerText($start_x,$start_y-0.25,'SUMMARY OF',$length);
		$this->centerText($start_x,$start_y+0.75,'WEIGHTED AVE.',$length);
		
		
		//End
		
		//Final
		$start_x=$start_sub_x;
		$this->drawLine($start_sub_x+=$width,'v',array($compHeight,$tableHeight-$compHeight));
		$this->rotateText($start_sub_x-0.1,$hdrHeight,'Original Rating',90,'b');//Rotated Percentages
			
		$this->drawLine($start_sub_x+=$width,'v',array($compHeight,$tableHeight-$compHeight));
		$this->rotateText($start_sub_x-0.1,$hdrHeight,'Final Rating',90,'b');//Rotated Percentages
		
		$this->drawLine($start_sub_x+=$width,'v');
		
		$this->rotateText($start_sub_x-0.1,$hdrHeight,'Discriptive Rating',90,'b');//Rotated Percentages
		
		$COL_CTR+=$width;
			
		$this->centerText($start_x,$start_y,'FINAL',($width*3));
		

		//End	
		$ln_ctr=$compHeight+$hdrHeight;
		do{
			$this->drawLine($ln_ctr,'h');
		}while($ln_ctr++<$tableHeight-1);

	}

	function classRecord($x=0,$y=0,$columns,$start_index,$col_index,$grades,$grade_index=0,$classlist,$cl_index,$g_flg,$stud_count=1,$total_page,$page_no){
		$metrics = array(
			'base_x'=> 0.2125,
			'base_y'=> 1.17,
			'width'=>  12.575,
			'height'=> 7.03,
			'cols'=> 40, //40,
			'rows'=> 38,
		);
		$this->section($metrics);
		//Create new page when necessary
		if($this->data['page_no']){
			$this->createSheet();
		}else{
			//name of students 
			$this->GRID['font_size']=20;
			$this->centerText(0,4,'NAME OF',8);
			$this->centerText(0,6,'STUDENTS',8);
			$this->GRID['font_size']=9;
		}
		//Increment page number
		$this->data['page_no']++;
		$compHeight=2.75;
		$subCompHeight=1.75;
		$hdrHeight=7.25;
		$max_lines =30;
		$nameDivider=$col_index;
		$hdrDivider=$metrics['cols']-$nameDivider;
		$tableHeight=$metrics['rows'];
		
		
		$this->data['col_start']=$col_index;
		$this->_colorful=false;
		$this->drawLine($nameDivider,'v');
		$this->GRID['font_size']=9;
		//$this->drawBox($x,$y,$metrics['cols'],$metrics['rows']);
		//$this->drawLine($compHeight,'h',array($nameDivider,$hdrDivider));
		$end=false;
		$prev_part='';
		$prev_rotate=false;
		for($c_index=$col_index,$s_index=$start_index;$c_index<$metrics['cols']&&$s_index<count($columns);$c_index+=$columns[$s_index]['width'],$s_index++){
			$width = $columns[$s_index]['width'];
			$level = $columns[$s_index]['level']; 
			$label = $columns[$s_index]['label']; 
			$wrap = $columns[$s_index]['wrap']; 
			$rotate = $columns[$s_index]['rotate']; 
			$align = $columns[$s_index]['align'];  
			$color = isset($columns[$s_index]['color'])?$columns[$s_index]['color']:false; 
			$end = isset($columns[$s_index]['end']); 
			$part='none';
			
			if(isset($columns[$s_index]['part'])){
				$part = $columns[$s_index]['part'];
			}
			
			$x =$c_index;
			$orient = 'NE';
			//Adjust level placement
			switch($level){
					case 1: $y=0; break;
					case 2: $y=$compHeight; break;
					case 3: $y=$compHeight+$subCompHeight; break;
			}
			
			//Draw column using NEWS
			if($color){
				$this->SetFillColor($color[0],$color[1],$color[2]);
				$this->DrawBox($x,$y,$width,$tableHeight-$compHeight,"F");
				$this->drawNEWSLine($x,$y,$width,$tableHeight,"NW");

			}
			
			$this->drawNEWSLine($x,$y,$width,$tableHeight,$orient);
			switch($rotate){
				case true:
					$adjust =array('x'=>1.2,'y'=>5,'font'=>7);
					$this->GRID['font_size']=$adjust['font'];
					//Update subcomponent count every time % is found
					if($align=='sc'){
						$this->data['s_comp_count']++;
					}
					//Adjust text rotation with wrapping
					switch($wrap){
						case true:
							$lbl = explode(" ",$label);
							$x_l =$x;
							$adjust['x']=-0.15;
							foreach($lbl as $l){
								$x_l +=($width/count($lbl))+($adjust['x']/count($lbl));
								
								$this->rotateText($x_l,$y+$adjust['y'],$l,90);
								
							}
						break;
						case false:
							$this->rotateText($x+($adjust['x']*0.5),$y+$adjust['y'],$label,90);
						break;
					}
					break;
				break;
				case false:
					$adjust =array('x'=>0,'y'=>1.0,'font'=>7);
					$this->GRID['font_size']=$adjust['font'];
					//Align text with no rotation
					switch($align){
						case 'c':
							$this->centerText($x+$adjust['x'],$y+$adjust['y'],$label,$width);
							break;
						case 'w':
							$this->wrapText($x+$adjust['x'],$y+$adjust['y'],$label,$width,$align,1.25);
							break;
					}
				break;
			}
			
			//Display subcomponent section
			switch($part){
				case 'head': $this->data['s_col_start'] = $c_index; break;
				case 'tail':

					$comp_count =$this->data['comp_count'];
					$s_comp_count =$this->data['s_comp_count'];

					if(!isset($this->data['components'][$comp_count]['subcomponents'][$s_comp_count])){
						$s_comp_count =  count($this->data['components'][$comp_count]['subcomponents'])-1;
					}
					$ss_count = count($this->data['components'][$comp_count]['subcomponents'][$s_comp_count]['items']);
					$s_col_start = $this->data['s_col_start'];
					$w = $c_index-$s_col_start+1;
					$this->drawNEWSLine($s_col_start,$compHeight,$w,$compHeight+$subCompHeight,'NE');
					if($this->_fancy){
						$this->drawNEWSLine($s_col_start,$compHeight+$subCompHeight+1.75,$w,$compHeight+$subCompHeight,'N');
						$this->drawNEWSLine($s_col_start,$compHeight+$subCompHeight,$w,$compHeight+$subCompHeight,'N');
						$this->drawNEWSLine($s_col_start,$compHeight+$subCompHeight+2.75,$w,$compHeight+$subCompHeight,'N');
					}
					//Roll back counter when subcomponent header is already printed
					if($this->data['s_comp_printed']){
						$s_comp_count--;
					}
					//Check if s_comp_count is still in range
					if($s_comp_count<count( $this->data['components'][$comp_count]['subcomponents'])){					
						$comp_name = $this->data['components'][$comp_count]['subcomponents'][$s_comp_count]['name'];
						$comp_name =  strtoupper($comp_name);
						if($w>iprs::$_min_col){
							$LBL_x =   $s_col_start;
							$LBL_y =  ($compHeight+$subCompHeight)*0.85;
							//WRAP text if label is doesnot fit							
							if($this->GetStringWidth($comp_name)/$this->GRID['cell_width']>$w){
								$this->fitParagraph($LBL_x+0.5,$LBL_y-0.1,$comp_name,1,'c',0.5);
							}else{
								$this->centerText($LBL_x,$LBL_y,$comp_name,$w);
							}
							$this->data['s_comp_count']++;
							$this->data['s_comp_printed']=false;							
						}
					}
					//Revert part to none to make fool proof
					$part='none';
					break;
			}
			
			//Display components 
			if($end&& $this->data['comp_count']<count($this->data['components'])){
				$comp_count = $this->data['comp_count'];
				$col_start = $this->data['col_start'];
				$special = isset($this->data['components'][$comp_count]['component']['special']);
				$comp_name = explode('~',$this->data['components'][$comp_count]['component']['name']);
				$col_count = $this->data['components'][$comp_count]['component']['col_count'];
				$w =  $this->data['comp_printed']?$col_start+$c_index-1:$col_count;
				$plot_x = $col_start+$w;
				if($plot_x<=$metrics['cols']){
					//Display components if it fits
					if($w>iprs::$_min_col+1||$special){	
						$cH = $compHeight*0.5-0.75;
					
						foreach($comp_name as $cn){
							$disp_comp = $cn;
							if($special&&$w==1) $disp_comp =substr($cn,0,4);
							$this->fitParagraph($col_start,$cH+=0.75,$disp_comp,$w,'c');
							//$this->centerText($col_start,$cH+=0.75,$cn,$w);
						}
						
					}
					$this->drawNEWSLine($col_start,0,$w,$compHeight,'E');
					$this->data['comp_count']++;
					$this->data['s_comp_count']=0;
					$this->data['comp_printed']=false;
					$this->data['col_start']=$plot_x;
				}	
			}
			//Diplay grades
			//echo "<pre>";print_r($grades);exit();
			$line_ctr = 0;
			$curr_flg= $prev_flg=$g_flg;
			//Diplay Names and Grades
			for($ln = 8.7,$stud_index=$cl_index;$stud_index<count($grades)&&$line_ctr<$max_lines;$ln++,$stud_index++){
				$grade = isset($grades[$stud_index][$s_index])?$grades[$stud_index][$s_index]:'';
				if(!isset($classlist[$stud_index])) continue;
				$stud_name = utf8_decode($classlist[$stud_index]['fullname']);
				if(strlen($stud_name)>32){
					$stud_name =  substr($stud_name, 0,32).'...';
				}
				$curr_flg=$classlist[$stud_index]['gender'];
				if($curr_flg!=$prev_flg){
					if($line_ctr==$max_lines-1){
						$curr_flg = $prev_flg;
						$stud_count = 1;
						break;
					}
					$line_ctr++;
					$ln++;
					if($this->data['page_no']==1&&$c_index==$col_index){
						$this->leftText(.5,$ln-1,$curr_flg=='M'?'BOYS':'GIRLS','','b');
						$stud_count = 1;
						
					}
				}
				if($this->data['page_no']==1&&$c_index==$col_index){
					$this->leftText(.5,$ln,$stud_count.'. '. $stud_name,'');
					$stud_count++;
				}
				$prev_flg = $curr_flg;
				$this->centerText($x,$ln,$grade,$width);//grades
				$line_ctr++;
			}
			$prev_part=$part;
			$prev_rotate=$rotate;
		}
		
		if(!$end&&$this->data['comp_count']<count($this->data['components'])){
			//Swap parts when measurable item splits across page
			switch($part){
				case 'body':
				$columns[$s_index]['part']='head';
				$comp_count =$this->data['comp_count'];
					$s_comp_count =$this->data['s_comp_count'];
					$s_col_start = $this->data['s_col_start'];
					$w = $c_index-$s_col_start;
					$this->drawNEWSLine($s_col_start,$compHeight,$w,$compHeight+$subCompHeight,'NE');
					//Check if s_comp_count is still in range
					if($s_comp_count<count( $this->data['components'][$comp_count]['subcomponents'])){					
						$comp_name = $this->data['components'][$comp_count]['subcomponents'][$s_comp_count]['name'];
						if($w>iprs::$_min_col){
							$this->centerText($s_col_start,($compHeight+$subCompHeight)*0.85,$comp_name,$w);
							$this->data['comp_printed']=true; 	
						}
						
					}
				break;
			}
			//Draw subcomponent header
			$s_col_start = $this->data['s_col_start'];
			$w = $c_index-$s_col_start;
			$this->drawNEWSLine($s_col_start,$compHeight,$w,$compHeight+$subCompHeight,'NE');
			//Calculate component header
			$comp_count = $this->data['comp_count'];
			$col_start = $this->data['col_start'];
			$comp_name = explode('~',$this->data['components'][$comp_count]['component']['name']);
			$col_count = $this->data['components'][$comp_count]['component']['col_count'];
			$plot_x = $metrics['cols']-$col_start;
			//Draw component header if it fits
			if($plot_x>iprs::$_min_col+1){
				$cH = $compHeight*0.5-0.75;
				foreach($comp_name as $cn){
					$this->centerText($col_start,$cH+=0.75,$cn,$plot_x);
				}
				$this->drawNEWSLine($col_start,0,$plot_x,$compHeight,'E');
				$this->data['comp_printed']=true;
				$this->data['col_start']=$plot_x;
			}else if($plot_x>=iprs::$_min_col){
				$this->drawNEWSLine($col_start,0,$plot_x,$compHeight,'E');
				$this->data['comp_printed']=true;
				$this->data['col_start']=$plot_x;
			}
		}
		$this->_colorful = true;
		//Left Side lining
		$this->drawNEWSLine(0,0,$c_index,$tableHeight,'NW');
		//Use multiple line on firstpage
		$this->drawMultipleLines($hdrHeight+0.75,$metrics['rows']);
		$this->drawBWB($c_index,0,$metrics['rows'],$tableHeight);
		/* if($this->data['page_no']<$this->data['page_max']&&$this->data['page_no']==1){
			
		}else{
			//Play smart on succeeding page
			for($x=$hdrHeight+0.75;$x<=$metrics['rows'];$x++){
				$this->drawLine($x,'h',array(0,$plot_x));
			}
		} */

			date_default_timezone_set('Asia/Manila');
			$timestamp = date("F j, Y, g:i a");
			$date = date("F j, Y, g:i a", strtotime($timestamp )); //timezone adjustment
		$this->leftText($x-15.5,$tableHeight+1,sprintf("%s %s Page %d of %d",$this->data['load'],$date,$page_no,$total_page),'');

		//echo $stud_index;
		//return the index where the loop stops and the columns 
		return array('columns'=>$columns, 'index'=>$s_index,'cl_index'=>$stud_index,'g_flag'=>$curr_flg,'stud_count'=>$stud_count);
	}
	function drawBWB($x,$y,$w,$h){
		$this->SetFillColor(255,255,255);
		$this->SetDrawColor(0,0,0);
		$this->drawBox($x,$y,$w,$h,"FD");
		$this->drawBox($x+0.02,$y-0.2,$w,$h*1.2,"F");
	}
}
?>