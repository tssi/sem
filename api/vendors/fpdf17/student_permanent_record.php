<?php
require(__DIR__.'/formsheet.php');
class StudentPermanentRecord extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 13;
	protected static $_unit = 'in';
	protected static $_orient = 'P';	
	protected static $curr_page = 1;
	protected static $page_count;
	var $base_y;
	var $height;
	var $total_page;
	var $current_page = 1;
	
	function StudentPermanentRecord(){
		$this->showLines = !true;
		$this->FPDF(StudentPermanentRecord::$_orient, StudentPermanentRecord::$_unit,array(StudentPermanentRecord::$_width,StudentPermanentRecord::$_height));
		$this->createSheet();
		$metrics = array(
			'base_x'=> 0,
			'base_y'=> 0,
			'width'=> 8.5,
			'height'=> 11,
			'cols'=> 8.5,
			'rows'=> 11,	
		);	
		$this->section($metrics);
	}
	
	function letterhead($total_page){
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 0.25,
			'width'=> 8,
			'height'=> 1.4,
			'cols'=> 35,
			'rows'=> 7,	
		);	
		$this->section($metrics);
		$this->GRID['font_size']=8;
		$this->DrawImage(0,0,1,1,__DIR__ ."/../deped_forms/logos/kagawaran-ng-edukasyon.png");
		$this->GRID['font_size']=12;
		$this->centerText(0,2,'School Form 10 (SF 10) School Register',$metrics['cols'],'b');
		//$this->DrawImage(5.6,0,4.75,1.25,__DIR__ ."/spr_headr2.png");
		$this->base_y = $metrics['height'];
		$this->height += $metrics['height'];
		$y=6;
		//$this->leftText(0.5,$y+1,'LTx Base Y ='.$this->base_y . ' Height ='.$this->height ,'','b');	
		$this->current_page=1;
		$this->total_page = $total_page;
	}
	
	function student_info($student_info = null){
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> $this->base_y,
			'width'=> 8,
			'height'=> 1.5,
			'cols'=> 35,
			'rows'=> 7,	
		);	
			
		$this->section($metrics);
		$this->GRID['font_size']=8;
		$y = 0;
		$this->DrawBox(27,$y,8,1);
		$this->drawLine($y+0.8,'h',array(29,3.5));
		$y+=1.2;
		$this->DrawBox(0,$y,$metrics['cols'],4);
		$this->drawMultipleLines($y+1,$y+3,1,'h');
		$this->drawLine(18,'v',array($y,3));
		$y=5.4;
		$this->DrawBox(0,$y,$metrics['cols'],1);
		$this->drawLine(25,'v',array($y,1));
		$y+=1.2;
		$this->DrawBox(0,$y,$metrics['cols'],1);
		
		
		$y = 0.7;
		$this->leftText(27.2,$y++,'LRN:     '. $student_info['lrn'],'','b');
		$y = 1.9;
		$this->leftText(0.5,$y,'Student Name: '. $student_info['name'],'','b');
		$this->leftText(18.5,$y++,'Nationality: '. $student_info['nationality'],'','b');
		$this->leftText(0.5,$y,'Date of Birth: '. $student_info['date_of_birth'],'','b');
		$this->leftText(18.5,$y++,'Father: '. $student_info['father'],'','b');
		$this->leftText(0.5,$y,'Place of Birth: '. $student_info['place_of_birth'],'','b');
		$this->leftText(18.5,$y++,'Mother: '. $student_info['mother'],'','b');
		$this->leftText(0.5,$y++,'Address: '. $student_info['address'],'','b');
		
		$y=6.1;
		//$this->leftText(0.5,$y,'Junior High School Completed: '. $student_info['jhs_school_completed'],'','b');
		$this->leftText(25.5,$y,'School Year:'. $student_info['jhs_school_year'],'','b');
		
		$y+=1.2;
		$this->leftText(0.5,$y,'Track/Strand: '. $student_info['track_strand'],'','b');
		
		$this->base_y = $this->base_y+$metrics['height']+$metrics['base_x'];

		$this->height += $metrics['height'];
		//$this->leftText(0.5,$y+1,'STx Base Y ='.$this->base_y . ' Height ='.$this->height ,'','b');	

		
	}
	
	function learning_areas($level_info,$sem,$grades,$avg){
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> $this->base_y,
			//'base_y'=> $y,
			'width'=> 8,
			'height'=> 3,
			'cols'=> 35,
			'rows'=> 15,	
		);	
		
		$this->section($metrics);
		$this->GRID['font_size']=8;
		$y = 0;
		$this->DrawBox(0,$y,$metrics['cols'],$metrics['rows']);
		$this->drawMultipleLines($y+2,$y+14,1,'h');
		$this->drawLine(1,'h',array(0,20));
		$this->drawLine(5,'v',array(1,13));
		$this->drawLine(20,'v',array(0,14));
		$this->drawLine(25,'v',array(0,15));
		$this->drawLine(30,'v',array(0,14));
		$this->drawLine(16,'v',array(14,1));
		
		$y=1.7;
		$this->centerText(0,$y,'CODE',5,'b');
		$this->centerText(5,$y,'SUBJECTS',15,'b');
		$this->GRID['font_size']=7;
		$this->centerText(20,$y-0.8,'SEMESTRAL',5,'b');
		$this->centerText(20,$y-0.2,'GRADE',5,'b');
		$this->centerText(25,$y-0.8,'RECOMPUTED',5,'b');
		$this->centerText(25,$y-0.2,'FINAL GRADE',5,'b');
		$this->centerText(30,$y-0.5,'REMARKS',5,'b');
		
		$y=1.2;
		$this->centerText(0,$y-0.5,$level_info['year_level'].' - '.$sem.' Semester, '.$level_info['sy'],20,'b');
		
		$y=2.8;
		//pr($grades);exit;
		foreach($grades as $i=>$gr){
			if(isset($gr['code']))
				$this->leftText(0.5,$y,$gr['code'],5,'');
			$this->leftText(5.2,$y,$gr['subject'],15,''); //Subject Name
			$this->centerText(20,$y,$gr['semesteral'],5,'');
			$this->centerText(25,$y,$gr['recomputed'],5,'');
			$this->centerText(30,$y,$gr['remark'],5,'');
			
			$y++;
		}
		$y=14.8;
		$this->leftText(16.5,$y,'GENERAL AVERAGE:','','b');
		$this->GRID['font_size']=9;
		//pr($sem);
		//pr($avg);exit;
		if($sem =="1st"){
			$this->centerText(25,$y,$avg['gen_ave_recom'],10,'b');
		}
		if($sem =="2nd"){
			$this->centerText(25,$y,$avg['gen_ave'],10,'b');
		}
		
		
		$this->base_y = $this->base_y+$metrics['height'];
		$this->height += $metrics['height'];
		//$this->leftText(0.5,$y+1,'LAx Base Y ='.$this->base_y . ' Height ='.$this->height ,'','b');	
		
		if($this->height > 11){
			$this->ftr($this->current_page);
			$this->current_page=+1;
			$this->createSheet();
			$this->base_y =0.15;
			$this->height = 0;
		}
		
	}
	
	function observed_values($data){
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> $this->base_y+=0.05,
			//'base_y'=> 6.05+$y,
			'width'=> 8,
			'height'=> 2.4,
			'cols'=> 35,
			'rows'=> 15,	
		);	
		$this->section($metrics);
		$y = 1.4;
		$this->GRID['font_size']=10;
		$this->centerText(0,$y,'OBSERVED VALUES',23,'b');
		
		$this->DrawBox(0,0,$metrics['cols'],$metrics['rows']);
		$this->DrawLine(5,'v',array(2,13));
		$this->DrawLine(23,'v',array(0,15));
		$this->DrawLine(26,'v',array(3,12));
		$this->DrawLine(29,'v',array(0,15));
		$this->DrawLine(32,'v',array(3,12));
		
		$this->DrawLine(1,'h',array(23,12));
		$this->DrawLine(2,'h');
		$this->DrawLine(3,'h',array(23,12));
		$this->DrawLine(4,'h');
		
	
		$this->GRID['font_size']=8;
		$this->centerText(0,2.9,'CORE',5,'b');
		$this->centerText(0,3.7,'VALUES',5,'b');
		
		$this->centerText(5,3.2,'BEHAVIOR STATEMENTS',18,'b');
		
		$this->centerText(23,2.8,'First Semester',6,'b');
		$this->centerText(29,2.8,'Second Semester',6,'b');
		$this->centerText(23,3.8,'1st',3,'b');
		$this->centerText(26,3.8,'2nd',3,'b');
		$this->centerText(29,3.8,'1st',3,'b');
		$this->centerText(32,3.8,'2nd',3,'b');
		
		
		$this->GRID['font_size']=8;
		$y = 4.8;
		$this->leftText(0.5,$y+1,'1. Maka-Diyos','','b');
		$this->leftText(5.2,$y++,'Expresses one\'s spiritual beliefs while respecting the spiritual','','');
		$this->leftText(5.2,$y++,'beliefs of others','','');
		$this->DrawLine(6,'h',array(5,30));
		$this->leftText(5.2,$y++,'Shows adherence to ethical principles by upholding truth','','');
		$this->DrawLine($y-0.8,'h');
		
		$this->leftText(0.5,$y+0.4,'2. Maka-Tao','','b');
		$this->leftText(5.2,$y++,'Is sensitive to individual, social, and cultural differences','','');
		$this->DrawLine($y-0.8,'h',array(5,30));
		$this->leftText(5.2,$y++,'Demonstrate contributions toward solidarity','','');
		$this->DrawLine($y-0.8,'h');
		
		$this->leftText(0.5,$y+0.4,'3. Makakalikasan','','b');
		$this->leftText(5.2,$y++,'Cares for the environment and utilizes resources wisely,','','');
		$this->leftText(5.2,$y++,'judiciously and economically','','');
		$this->DrawLine($y-0.8,'h');
		
		$this->leftText(0.5,$y+0.4,'4. Makabansa','','b');
		$this->leftText(5.2,$y++,'Demonstrates pride in being a Filipino; exercises the rights and responsibilities','','');
		$this->leftText(5.2,$y++,'of a Filipino Citizen','','');
		$this->DrawLine($y-0.8,'h',array(5,30));
		$this->leftText(5.2,$y++,'Demonstrates appropriate behavior in carrying out activities in the school,','','');
		$this->leftText(5.2,$y++,'community and country','','');

		foreach($data as $sem => $sem_data){
			foreach($sem_data as  $val){
			if($sem == "first_sem") $x=23;	
			if($sem == "second_sem") $x=29;		
			switch($val['key']){
				case "MKD1": $y=5.3; 
					break;
				case "MKD2": $y=6.8;
					break;
				case "MKT1": $y=7.8;
					break;
				case "MKT2": $y=8.8;
					break;
				case "MKK1": $y=10.3;
					break;
				case "MKK2": $y=12.3;
					break;
				case "MKBA": $y=14.3;
					break;
			}
			//$this->centerText($x,$y,$y.' '.$val['key'].' '.$val['midterm'],3,'');
			$this->centerText($x,$y,$val['midterm'],3,'');
			$this->centerText($x+3,$y,$val['finals'],3,'');	
			}
		}
		
		$this->base_y = $this->base_y+$metrics['height'];
		$this->height += $metrics['height'];
		//$this->leftText(0.5,$y+1,' OBx Base Y ='.$this->base_y . ' Height ='.$this->height ,'','b');	
		
		if($this->height > 11){
			$this->ftr($this->current_page);
			/*$this->current_page=+1;*/
			$this->createSheet(); 
			$this->base_y =0.15;
			$this->height = 0;
		}
	}
	
	function ftr($page){
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 12,
			'width'=> 8,
			'height'=> 0.6,
			'cols'=> 35,
			'rows'=> 3,	
		);	
		$this->section($metrics);
		$y = 1;
		$this->GRID['font_size']=9;
		$this->leftText(1,$y++,'Not valid without School Seal','','i');
		
		$this->GRID['font_size']=6;
		//$this->leftText(0,2.2,'SBCA-FORM-ACAD-RO-SHS-52','','');
		$this->leftText(0,2.8,'June 1, 2016 Rev.00','','');
		$this->drawLine(1.2,'h');
		$this->drawLine(1.4,'h');
		
		$y = 2.5;
		$this->GRID['font_size']=8;
		$this->centerText(1,$y,'"That in all things God may be glorifed"',35,'i');
		$this->rightText(34,$y,'Page '.$page.' of '.$this->total_page,'','');
	}
	
	function legend(){
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.25,
			//'base_y'=> 8.65,
			'base_y'=> $this->base_y+=0.05,
			'width'=> 8,
			'height'=> 1.2,
			'cols'=> 18,
			'rows'=> 8,	
		);	
		$this->section($metrics);
		$y = 1;
		$this->GRID['font_size']=10;
		$this->DrawBox(0,0,$metrics['cols'],$metrics['rows']-0.5);
		
		$this->GRID['font_size']=7;
		$y = 1;
		$this->centerText(0,$y++,'OBSERVED VALUES:',3,'b');
		$this->centerText(0,$y++,'Marking',3,'b');
		$this->centerText(0,$y++,'AO',3,'');
		$this->centerText(0,$y++,'SO',3,'');
		$this->centerText(0,$y++,'RO',3,'');
		$this->centerText(0,$y++,'NO',3,'');
		
		$y = 2;
		$this->centerText(3,$y++,'Non-Numerical Rating',3,'b');
		$this->centerText(3,$y++,'Always Observed',3,'b');
		$this->centerText(3,$y++,'Sometimes Observed',3,'');
		$this->centerText(3,$y++,'Rarely Observed',3,'');
		$this->centerText(3,$y++,'Not Observed',3,'');
		
		
		
		$y = 1;
		$this->centerText(7,$y++,'LEARNING PROGRESS AND ACHIEVEMENT:',5,'b');
		$this->leftText(8,$y++,'Description','','b');
		$this->leftText(8,$y++,'Outstanding','','');
		$this->leftText(8,$y++,'Very Satisfactory','','');
		$this->leftText(8,$y++,'Satisfactory','','');
		$this->leftText(8,$y++,'Fairly Satisfactory','','');
		$this->leftText(8,$y++,'Did Not Meet Expectation',4,'');
		
		$y = 2;
		$this->leftText(12,$y++,'Grade Scale','','b');
		$this->leftText(12,$y++,'90 - 100','','');
		$this->leftText(12,$y++,'85 - 89.99','','');
		$this->leftText(12,$y++,'80 - 84.99','','');
		$this->leftText(12,$y++,'75 - 79.99','','');
		$this->leftText(12,$y++,'Below 75','','');
		
		$y = 2;
		$this->leftText(15,$y++,'Remarks','','b');
		$this->leftText(15,$y++,'Passed','','');
		$this->leftText(15,$y++,'Passed','','');
		$this->leftText(15,$y++,'Passed','','');
		$this->leftText(15,$y++,'Passed','','');
		$this->leftText(15,$y++,'Failed','','');
		
		$this->base_y = $this->base_y+$metrics['height'];
		$this->height += $metrics['height'];
		//$this->leftText(0.5,$y+1,'LGx Base Y ='.$this->base_y . ' Height ='.$this->height ,'','b');	
		
		if($this->height > 11){
			$this->createSheet();
			$this->base_y =0.15;
			$this->height = 0;
		}
		
		
	}
	
	function summer($scholastic_records){
		//pr($scholastic_records);
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.25,
			//'base_y'=> 9.8+$y,
			'base_y'=> $this->base_y,
			'width'=> 8,
			'height'=> 1,
			'cols'=> 35,
			'rows'=> 6,	
		);	
		$this->section($metrics);
		$this->GRID['font_size']=7;
		$y = 1;
		$this->DrawBox(0,0,$metrics['cols'],$metrics['rows']);
		$this->leftText(0.5,$y,'Summer Class:','','b');
		$y = 2;
		foreach($scholastic_records as $record){
			foreach($record['grades']['summer_class'] as $summer){
				$this->leftText(4,$y,'Summer '.$record['level_info']['sy'],'','');
				$this->leftText(10,$y,'Code','','');
				$this->leftText(13,$y,$summer['subject'],'','');
				$this->leftText(25,$y,$summer['grade'],'','');
				$this->leftText(30,$y,$summer['remark'],'','');
				$y++;
			}
		}
	
	
		$this->base_y = $this->base_y+$metrics['height'];
		$this->height += $metrics['height'];
		
		//$this->leftText(0.5,$y+1,'SMx Base Y ='.$this->base_y . ' Height ='.$this->height ,'','b');		
		if($this->height > 9){
			$this->ftr($this->current_page);
			$this->createSheet();
			$this->base_y =0.15;
			$this->height = 0;
		}
	}
	
	function certification($stud_info){
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 1,
			//'base_y'=> 0.5,
			'base_y'=> $this->base_y+=0.05,
			'width'=> 6.5,
			'height'=> 1.5,
			'cols'=> 18,
			'rows'=> 11,	
		);	
		//pr($stud_info);exit;
		$this->section($metrics);
		$this->GRID['font_size']=10;
		$y = 1;
		$this->centerText(0,$y++,'Certification',$metrics['cols'],'b');
		$this->GRID['font_size']=9;
		$y+=0.5;
		
		$this->wrapText(0,$y,'                    I hereby certify that this is a true record of '. strToUpper($stud_info['name']) .' and that official documents substantiating same are kept in the files of ___ .',19,'l',1);
		//$this->leftText(2,$y++,'I hereby certify that this is a true record of '. strToUpper($stud_info['name']) .' and that official','','');
		//$this->leftText(0,$y++,'documents substantiating same are kept in the files of San Beda College Alabang .','','');
		$y=6.5;
		if(!isset($stud_info['cert'])):
			$stud_info['cert']['issued']= '';
			$stud_info['cert']['record_assistant']= '';
			$stud_info['cert']['registrar']= '';
		endif;
		$this->leftText(2,$y++,'Issued this '.$stud_info['cert']['issued'],'','');
		
		$y=9;
		$this->leftText(0,$y,'Prepared By:','','');
		$y=11;
		$this->centerText(0,$y++,$stud_info['cert']['record_assistant'],9,'b');
		$this->centerText(0,$y,'Records Assistant',9,'');
		$y=11;
		$this->centerText(9,$y++,$stud_info['cert']['registrar'],9,'b');
		$this->centerText(9,$y,'Registrar',9,'');
		
		$y+=4;
		$this->leftText(0,$y,'FOR EVALUATION PURPOSES ONLY.','','b');
		
	}
	
	function printFail($status){
		$metrics = array(
			'base_x'=> 0,
			'base_y'=> 0,
			'width'=> 8.5,
			'height'=> 11,
			'cols'=> 4,
			'rows'=> 44,	
		);	
		$this->section($metrics);
		$y = 1;
		$this->GRID['font_size']=16;
		$message = sprintf("Warning: Unable to print %s ",$status['SECTION']);
		$y = 10;
		$this->centerText(0,$y+=2,$message,$metrics['cols'],'b');
		$y+=2;
		unset($status['SECTION']);
		unset($status['VALID']);
		foreach($status as $key=>$value){
			if($value!='POST')
			$this->leftText(1,$y++,"$key not posted",$metrics['cols'],'');	
			else
				$this->leftText(1,$y++,"$key OK",$metrics['cols'],'');	
		}
	}
		
}
?>
	
