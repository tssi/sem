<?php
class InquiriesController extends AppController {

	var $name = 'Inquiries';
	var $uses = array('Inquiry','Student','Account','StudentHistory','Record');

	function index() {
		$this->Inquiry->recursive = 0;
		$students = $this->paginate();
		foreach($students as $i=>$s){
			//pr($s); exit();
			$student = $s['Inquiry'];
			if(isset($s['YearLevel']['name']))
			$s['Inquiry']['year_level'] = $s['YearLevel']['name'];
			$s['Inquiry']['full_name'] = $student['first_name'] .' '. $student['middle_name'] .' '. $student['last_name'];
			$students[$i]=$s;
		}
		$this->set('inquiries', $students);
	}

	function view($id = null) {
		if($id=='docs')
			return $this->docs();
		if (!$id) {
			$this->Session->setFlash(__('Invalid payment scheme', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('inquiry', $this->Inquiry->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$hist  = array();
			$student = $this->data['Inquiry'];
			if(!isset($student['id'])):
				$student['id']=$this->Inquiry->generateIID();
				$student['student_id'] = $this->Student->generateSID('LS','X');
			
				//pr($student); exit();

				$hist = array('student_id'=>$student['id'],'ref_no'=>$student['id'],'transaction'=>'INQ_INFO','status'=>'ADDNEW');
				$acctObj = array('id'=>$student['id'],'account_type'=>'inquiry');
				$this->Account->save($acctObj);
			else:
				$hist = array('student_id'=>$student['id'],'ref_no'=>$student['id'],'transaction'=>'INQ_INFO','status'=>'UPDATE');
			endif;

			if(!isset($student['preffix'])) $student['preffix'] = "";
			if(!isset($student['suffix'])) $student['suffix'] = "";
			//TODO: Load from  master config
			$hist['esp']= 2024;
			if ($this->Inquiry->save($student)) {
				$this->StudentHistory->save($hist);
				$this->Session->setFlash(__('The payment scheme has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment scheme could not be saved. Please, try again.', true));
			}
		}
		$this->set(compact('tuitions', 'schemes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid payment scheme', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->data = $this->Inquiry->prepareData($this->data);
			if ($this->Inquiry->saveAll($this->data)) {
				$this->Session->setFlash(__('The payment scheme has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment scheme could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Inquiry->read(null, $id);
		}
		$tuitions = $this->Inquiry->Tuition->find('list');
		$schemes = $this->Inquiry->Scheme->find('list');
		$this->set(compact('tuitions', 'schemes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for payment scheme', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Inquiry->delete($id)) {
			$this->Session->setFlash(__('Payment scheme deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Payment scheme was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function docs(){
		$sid = $_REQUEST['id'];
		$docs = $this->Record->getDocs($sid);
		$docsData = $docs['data']['img'];
		$docsInfo = [];
		foreach($docsData as $i=>$doc):
			$dox = array();
			$dox['id']=md5($doc.''.$sid);
			$dox['file']=$doc;
			$docsInfo[]=$dox;
		endforeach;
		$inquiry = array('Inquiry'=>array('docs'=>$docsInfo));
		$this->set(compact('inquiry'));
	}

	function upload(){
		
		$fileObj = $_FILES['file'];
		$meta = json_decode($_POST['meta'],true);
		$sid =  $meta['student_id'];
		$docType =  $meta['doc_type'];
		$fileInfo = $this->Record->uploadFile($fileObj, $meta);
		$hist = array('student_id'=>$sid,'ref_no'=>$docType,'transaction'=>'DOC_UPLD','status'=>'OK');
		$hist['esp']= 2024;
		$this->StudentHistory->save($hist);
		$json =  array();
        $json['meta'] = array('code'=>200,'message'=>'Success upload');
        $json['data'] = array('file'=>$fileInfo);
        header("Pragma: no-cache");
		header("Cache-Control: no-store, no-cache, max-age=0, must-revalidate");
		header('Content-Type: application/json');
		echo json_encode($json);


		exit;
	}

}
