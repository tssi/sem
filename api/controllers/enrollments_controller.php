<?php
class EnrollmentsController extends AppController {

	var $name = 'Enrollments';
	var $uses = array('Enrollment','Student','ClasslistBlock');

	function index() {
		$this->Enrollment->recursive = 0;
		$esp = $_GET['esp'];
		$Enrollments = $this->paginate();
		
		$ClasslistBlock = $this->ClasslistBlock->find('all',array('recursive'=>0,'conditions'=>array('and'=>array('ClasslistBlock.esp >='=>$esp,'ClasslistBlock.esp <'=>$esp+1))));
		$students = array();
		
		foreach($ClasslistBlock as $i=>$c){
			$block = $c['ClasslistBlock'];
			$students[$block['student_id']] = $c;
		}
		
		
		$interval = new DateInterval('P1D');
		
		if($this->isAPIRequest()){
			$date = $_GET['transac_date'];
			
			$today = date('Y-m-d');
			$today = explode('-',$today);
			if(isset($_GET['ctr'])){
				$ctr = $_GET['ctr'];
				$today[1]+=2;
			}
				
			$today = $esp.'-'.$today[1].'-'.$today[2];
			
			//pr($today); exit();
			$start = $Enrollments[0]['Enrollment']['transac_date'];
			$period = new DatePeriod(new DateTime($start), $interval, new DateTime($today));
			//pr($today); exit();
			$days = array();
			$levels_empty = array(
								'G7'=>0,
								'G8'=>0,
								'G9'=>0,
								'GX'=>0,
								'GYABM'=>0,
								'GYSTEM'=>0,
								'GYTVL'=>0,
								'GYHUMS'=>0,
								'GYGAS'=>0,
								'GYMIXED'=>0,
								'GZABM'=>0,
								'GZSTEM'=>0,
								'GZTVL'=>0,
								'GZHUMS'=>0,
								'GZGAS'=>0,
								'GZMIXED'=>0,
								'total'=>0
								);
			$counter = 1;
			foreach($period as $day){
				if(isset($ctr)&&$counter>$ctr){
					break;
				}
				if(date('D', strtotime($day->format('Y-m-d')))!='Sun')
					$counter++;
				$days[$day->format('Y-m-d')]= array(
												'date'=>$day->format('Y-m-d'),
												'day'=>date('D', strtotime($day->format('Y-m-d'))),
												'levels'=>$levels_empty
												);
			}
			//pr($days); exit();
			$days[$today] = array(
								'date'=>$today,
								'day'=>date('D', strtotime($today)),
								'levels'=>$levels_empty
								);

			$HS = array('G7','G8','G9','GX');
			$programs = array(
				'SHSTM'=>"STEM",
				'SHHUM'=>"HUMS",
				'SHTVL'=>"TVL",
				'SHABM'=>"ABM",
				'SHGAS'=>"GAS",
				'MIXED'=>'MIXED'
			);
			$totals = array(
							'levels'=>array(
										'G7'=>0,
										'G8'=>0,
										'G9'=>0,
										'GX'=>0,
										'GYABM'=>0,
										'GYSTEM'=>0,
										'GYTVL'=>0,
										'GYHUMS'=>0,
										'GYGAS'=>0,
										'GYMIXED'=>0,
										'GZABM'=>0,
										'GZSTEM'=>0,
										'GZTVL'=>0,
										'GZHUMS'=>0,
										'GZGAS'=>0,
										'GZMIXED'=>0,
										'total'=>0
									)
			);
			
			foreach($Enrollments as $i=>$l){
				
				if($l['Enrollment']['transac_date']>$today&&!isset($ctr))
					continue;
				$counter++;
				$totals['levels']['total']++;
				$led = $l['Enrollment'];
				$stud = $students[$led['account_id']];
				// Skip loop if empty student or invalid date
				
				if(!isset($stud['Section']['year_level_id']) || !isset($days[$led['transac_date']])):
					continue;
				endif;
				
				$days[$led['transac_date']]['levels']['total']++;

				if(in_array($stud['Section']['year_level_id'],$HS)){
					$days[$led['transac_date']]['levels'][$stud['Section']['year_level_id']]++;
					$totals['levels'][$stud['Section']['year_level_id']]++;
				}
				else{
					if(isset($stud['Section']['program_id'])){
						if(!isset($programs[$stud['Section']['program_id']])){
							pr($stud); exit();
						}
						$program = $programs[$stud['Section']['program_id']];
						$prog_display = $stud['Section']['year_level_id'].$program;
						$days[$led['transac_date']]['levels'][$prog_display]++;
						$totals['levels'][$prog_display]++;
					}
					
				}
				
				
			}
			$index = 0;
			$overall = array();
			//pr($days); exit();
			foreach($days as $day){
				//pr($day);
				$overall[$index] = $day;
				$index++;
			}
			
			$data = array(
				'coverage'=>$today,
				//'today'=>$days[$date],
				'overall'=>$overall,
				'totals'=>$totals
			);
			if(isset($days[$date]))
				$data['today']=$days[$date];
			$enrollment_data[0]['Enrollment'] = $data;
			//pr($data); exit();
		}
		$this->set('enrollments', $enrollment_data);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Enrollment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('enrollment', $this->Enrollment->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Enrollment->create();
			if ($this->Enrollment->save($this->data)) {
				$this->Session->setFlash(__('The Enrollment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Enrollment could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Enrollment', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Enrollment->save($this->data)) {
				$this->Session->setFlash(__('The Enrollment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Enrollment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Enrollment->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Enrollment', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Enrollment->delete($id)) {
			$this->Session->setFlash(__('Enrollment deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Enrollment was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
