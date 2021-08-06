<?php
class EnrollmentsController extends AppController {

	var $name = 'Enrollments';

	function index() {
		$this->Enrollment->recursive = 0;
		$Enrollments = $this->paginate();
		if($this->isAPIRequest()){
			$date = $_GET['transac_date'];
			$today = date("Y-m-d");
			$interval = new DateInterval('P1D');
			$start = $Enrollments[0]['Enrollment']['transac_date'];
			//pr($start); exit();
			$period = new DatePeriod(new DateTime($start), $interval, new DateTime($today));
			$days = array();
			$levels_empty = array(
								'G7'=>0,
								'G8'=>0,
								'G9'=>0,
								'GX'=>0,
								'GYSTEM'=>0,
								'GYHUMS'=>0,
								'GYABM'=>0,
								'GYTVL'=>0,
								'GYGAS'=>0,
								'GZSTEM'=>0,
								'GZHUMS'=>0,
								'GZABM'=>0,
								'GZTVL'=>0,
								'GZGAS'=>0,
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
			//pr($days); exit();
			$HS = array('G7','G8','G9','GX');
			$programs = array(
				'SHSTM'=>"STEM",
				'SHHUM'=>"HUMS",
				'SHTVL'=>"TVL",
				'SHABM'=>"ABM",
				'SHGAS'=>"GAS"
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
										'GZSTEM'=>0,
										'GZHUMS'=>0,
										'GZABM'=>0,
										'GZTVL'=>0,
										'GZGAS'=>0,
									)
			);
			foreach($Enrollments as $i=>$l){
				$totals['total']++;
				$stud = $l['Student'];
				$led = $l['Enrollment'];
				// Skip loop if empty student or invalid date
				if(!isset($stud['year_level_id']) || !isset($days[$led['transac_date']])):
					continue;
				endif;
				
				$days[$led['transac_date']]['total']++;

				if(in_array($stud['year_level_id'],$HS)){
					$days[$led['transac_date']]['levels'][$stud['year_level_id']]++;
					$totals['levels'][$stud['year_level_id']]++;
				}
				else{
					if(isset($stud['program_id'])){
						$program = $programs[$stud['program_id']];
						$prog_display = $stud['year_level_id'].$program;
						$days[$led['transac_date']]['levels'][$prog_display]++;
						$totals['levels'][$prog_display]++;
					}
					
				}
				
				
			}
			$index = 0;
			$overall = array();
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
