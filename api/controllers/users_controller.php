<?php
class UsersController extends AppController {

	var $name = 'Users';

	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		$userTypes = $this->User->UserType->find('list');
		$departments = $this->User->Department->find('list');
		$this->set(compact('userTypes', 'departments'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$userTypes = $this->User->UserType->find('list');
		$departments = $this->User->Department->find('list');
		$this->set(compact('userTypes', 'departments'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function change_pass(){
		if(isset($this->data)){
			$oldPass =  $this->data['User']['old_password'];
			$oldPass =  $this->Auth->password($oldPass);
			$newPass =  $this->data['User']['new_password'];
			$newPass =  $this->Auth->password($newPass);
			$loggedIn = $this->Auth->user()['User'];
			$user  =$this->User->findById($loggedIn['id'])['User'];
			$currPass =  $user['password'];
			if($currPass==$oldPass){
				if($newPass==$oldPass){
					$this->Session->setFlash(__('Try something new. Password similar to current.', true));
					$this->cakeError('dataNotSet');  
				}else{
					$user['password']=$newPass;
					$user['password_changed'] = date("Y-m-d H:i:s");
					$this->User->save($user);
					$this->Session->setFlash(__('Password updated', true));	
				}
			}else{
				$this->Session->setFlash(__('Incorrect Password', true));
				$this->cakeError('invalidLogin');  
			}
		}
		$this->redirect(array('action'=>'index'));

	}
}
