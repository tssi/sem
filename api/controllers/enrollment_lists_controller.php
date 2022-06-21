<?php
class EnrollmentListsController extends AppController {

	var $name = 'EnrollmentLists';

	function index() {
		$this->EnrollmentList->recursive = 0;
		$list = $this->paginate();
		//pr($_GET); exit();
		$conds = array('EnrollmentList.esp'=>$_GET['esp'],'EnrollmentList.ref_no LIKE'=>'X%');
		//pr($conds); exit();
		//$cancelled = $this->EnrollmentList->find('all',array('recursive'=>0,'conditions'=>$conds));
		//$cancelled_ors = array();
		//pr($cancelled); exit();
		/* foreach($cancelled as $c){
			$ref_no = explode(" ",$c['EnrollmentList']['ref_no']);
			//pr($ref_no);
			array_push($cancelled_ors,$ref_no[1]);
		} */
		//pr($cancelled_ors); exit();
		$levels = array(
							'G7'=>array(),
							'G8'=>array(),
							'G9'=>array(),
							'GX'=>array(),
							'GYSTEM'=>array(),
							'GYHUMS'=>array(),
							'GYABM'=>array(),
							'GYGAS'=>array(),
							'GYTVL'=>array(),
							'GYMIXED'=>array(),
							'GZSTEM'=>array(),
							'GZHUMS'=>array(),
							'GZABM'=>array(),
							'GZGAS'=>array(),
							'GZTVL'=>array(),
							'GZMIXED'=>array(),
							);
		$HS = array('G7','G8','G9','GX');
		$programs = array(
			'SHSTM'=>"STEM",
			'SHHUM'=>"HUMS",
			'SHTVL'=>"TVL",
			'SHABM'=>"ABM",
			'SHGAS'=>"GAS",
			'SHMIXED'=>"MIXED",
		);
		$today = date("Y-m-d");
		$interval = new DateInterval('P1D');
		$start = $list[0]['EnrollmentList']['transac_date'];
		//pr($start); exit();
		$period = new DatePeriod(new DateTime($start), $interval, new DateTime($today));
		$days = array();
		foreach($period as $day){
			$days[$day->format('Y-m-d')]= array();
		}
		$days[$today] = array();
		if($this->isAPIRequest()){
			//pr($days); exit();
			foreach($list as $i=>$l){
				$ref_no = explode(" ",$l['EnrollmentList']['ref_no']);
				/* if(in_array($ref_no[1],$cancelled_ors)){
					continue;
				} */
				$stud = $l['Student'];
				$data = $l['EnrollmentList'];
				
				$data['name'] = $stud['last_name'].', '.$stud['first_name'].' '.$stud['middle_name'];
				$data['sno'] = $stud['sno'];
				if(!isset($l['Student']['id'])){
					pr($l); exit();
				}
				$data['year_level_id'] = $stud['year_level_id'];
				$data['program_id'] = $stud['program_id'];
				if(in_array($stud['year_level_id'],$HS)){
					array_push($levels[$stud['year_level_id']],$data);
				}else{
					if(!isset($programs[$stud['program_id']])){pr($stud); exit();}
					$program = $programs[$stud['program_id']];
					$prog_display = $stud['year_level_id'].$program;
					
					if(!isset($levels[$prog_display])){pr($stud); exit();}
					array_push($levels[$prog_display],$data);
				}
				$item = array(
								'year_level_id'=>$data['year_level_id'],
								'sno'=>$data['sno'],
								'name'=>$data['name'],
								'ref_no'=>$data['ref_no']
								
							);
				array_push($days[$data['transac_date']],$item );
			}
			$list = array();
			$list['days'] = array();
			
			
			//pr($list['days']); exit();
			
			function array_sort($array, $on, $order=SORT_ASC)
			{
				$new_array = array();
				$sortable_array = array();

				if (count($array) > 0) {
					foreach ($array as $k => $v) {
						if (is_array($v)) {
							foreach ($v as $k2 => $v2) {
								if ($k2 == $on) {
									$sortable_array[$k] = $v2;
								}
							}
						} else {
							$sortable_array[$k] = $v;
						}
					}

					switch ($order) {
						case SORT_ASC:
							asort($sortable_array);
						break;
						case SORT_DESC:
							arsort($sortable_array);
						break;
					}

					foreach ($sortable_array as $k => $v) {
						$new_array[$k] = $array[$k];
					}
				}

				return $new_array;
			}
			foreach($days as $i=>$d){
				$d = array_sort($d,'name',SORT_ASC);
				$cnt = 1;
				$dItem = array();
				foreach($d as $date){
					$date['cnt']=$cnt++;
					array_push($dItem,$date);
				}
				$item = array('date'=>$i,'lists'=>$dItem);
				array_push($list['days'],$item);
			}
			$list['level'] = array();
			foreach($levels as $i=>$level){
				$level = array_sort($level,'name',SORT_ASC);
				$newL = array();
				$cnt = 1;
				foreach($level as $l){
					$l['cnt'] = $cnt++;
					array_push($newL,$l);
				}
				//pr($level);
				$item = array('level'=>$i,'lists'=>$newL);
				array_push($list['level'],$item);
				
			}
			//pr($list); exit();
			$coll = array(array('EnrollmentList'=>$list));
		}
		//pr($list); exit();
		$this->set('enrollmentLists', $coll);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid EnrollmentList', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('enrollmentList', $this->EnrollmentList->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->EnrollmentList->create();
			if ($this->EnrollmentList->save($this->data)) {
				$this->Session->setFlash(__('The EnrollmentList has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The EnrollmentList could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid EnrollmentList', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->EnrollmentList->save($this->data)) {
				$this->Session->setFlash(__('The EnrollmentList has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The EnrollmentList could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->EnrollmentList->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for EnrollmentList', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->EnrollmentList->delete($id)) {
			$this->Session->setFlash(__('EnrollmentList deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('EnrollmentList was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
