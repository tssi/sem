<?php
class EnrollmentsController extends AppController {

	var $name = 'Enrollments';
	var $uses = array('Enrollment','Student','ClasslistBlock');

	function index() {
		$this->Enrollment->recursive = 0;
		$esp = $_GET['esp'];
		$Enrollments = $this->paginate();
		
		$ClasslistBlock = $this->ClasslistBlock->find('all',array('recursive'=>0,'conditions'=>array('and'=>array('ClasslistBlock.esp >='=>$esp,'ClasslistBlock.esp <'=>$esp+1))));
		//$prevBlock = $this->ClasslistBlock->find('all',array('recursive'=>0,'conditions'=>array('and'=>array('ClasslistBlock.esp >='=>$esp-1,'ClasslistBlock.esp <'=>$esp))));
		$students = array();
		//$prevStu = array();
		foreach($ClasslistBlock as $i=>$c){
			$block = $c['ClasslistBlock'];
			$students[$block['student_id']] = $c;
		}
		
		
		/* foreach($prevBlock as $i=>$b){
			$block = $b['ClasslistBlock'];
			$prevStu[$block['student_id']] = $c;
		}
		//pr($prevStu); exit(); */
		$interval = new DateInterval('P1D');
		/* 
		$prevEnroll = $this->Enrollment->find('all',array('recursive'=>0,'conditions'=>array('Enrollment.esp'=>$esp-1,'Enrollment.transaction_type_id'=>'TUIXN')));
		$lastRecord = end($prevEnroll);
		$prevLastDate = $lastRecord['Enrollment']['transac_date'];
		$prevStartDate = $prevEnroll[0]['Enrollment']['transac_date'];
		$prevPeriod = new DatePeriod(new DateTime($prevStartDate), $interval, new DateTime($prevLastDate));
		$prevDays = array();
		foreach($prevPeriod as $day){
			$prevDays[$day->format('Y-m-d')]= array(
											'date'=>$day->format('Y-m-d'),
											'day'=>date('D', strtotime($day->format('Y-m-d'))),
											'JH'=>0,
											'SH'=>0,
											'total'=>0,
											);
		}
		foreach($prevEnroll as $en){
			$led = $en['Enrollment'];
			$stud = $prevStu[$led['account_id']];
			if($stud['Section']=='HS'){
				$prevDays[]
			}
			pr($stud); exit();
		}
		
		pr($prevDays); exit(); */
		if($this->isAPIRequest()){
			$date = $_GET['transac_date'];
			$today = $_GET['transac_date'];
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
								);
			foreach($period as $day){
				$days[$day->format('Y-m-d')]= array(
												'date'=>$day->format('Y-m-d'),
												'day'=>date('D', strtotime($day->format('Y-m-d'))),
												'total'=>0,
												'levels'=>$levels_empty
												);
			}
			
			$days[$today] = array(
								'date'=>$today,
								'day'=>date('D', strtotime($today)),
								'total'=>0,
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
							'total'=>0,
							'levels'=>array(
										'G7'=>0,
										'G8'=>0,
										'G9'=>0,
										'GX'=>0,
										'GYSTEM'=>0,
										'GYHUMS'=>0,
										'GYABM'=>0,
										'GYTVL'=>0,
										'GYGAS'=>0,
										'GYMIXED'=>0,
										'GZSTEM'=>0,
										'GZHUMS'=>0,
										'GZABM'=>0,
										'GZTVL'=>0,
										'GZGAS'=>0,
										'GZMIXED'=>0,
									)
			);
			foreach($Enrollments as $i=>$l){
				$totals['total']++;
				$led = $l['Enrollment'];
				$stud = $students[$led['account_id']];
				// Skip loop if empty student or invalid date
				//pr($stud); exit();
				if(!isset($stud['Section']['year_level_id']) || !isset($days[$led['transac_date']])):
					continue;
				endif;
				
				$days[$led['transac_date']]['total']++;

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
				'today'=>$days[$date],
				'overall'=>$overall,
				'totals'=>$totals
			);
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
