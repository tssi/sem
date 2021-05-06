<?php
class ReservationsController extends AppController {

	var $name = 'Reservations';

	function index() {
		$this->Reservation->recursive = 0;
		$reservations = $this->paginate();
		//pr($reservations); exit();
		if($this->isAPIRequest()){
			foreach($reservations as $i=>$res){
				$data = $res['Reservation'];
				if(!isset($res['Student']['full_name'])){
					$stud = $res['Inquiry'];
					/* if(!isset($stud['first_name'])){
						pr($res); exit();
					} */
					$data['name'] = $stud['first_name'].' '.$stud['middle_name'].' '.$stud['last_name'];			
					$data['status'] = 'New';
					$yl = $res['Inquiry']['YearLevel'];
				}else{
					$stud = $res['Student'];
					$data['name'] = $stud['full_name'];
					$data['status'] = 'Old';
					$yl = $res['Student']['YearLevel'];
				}
				
				$data['year_level'] = $yl['description'];
				//$data['year_level_id'] = $yl['id'];
				//pr($res);
				$reservations[$i]['Reservation'] = $data;
			}
		};
		//exit();
		$this->set('reservations', $reservations);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid reservation', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('reservation', $this->Reservation->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Reservation->create();
			if ($this->Reservation->save($this->data)) {
				$this->Session->setFlash(__('The reservation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reservation could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid reservation', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Reservation->save($this->data)) {
				$this->Session->setFlash(__('The reservation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reservation could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Reservation->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for reservation', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Reservation->delete($id)) {
			$this->Session->setFlash(__('reservation deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('reservation was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
