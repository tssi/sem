<?php
class CurriculumSection extends AppModel {
	var $name = 'CurriculumSection';
	var $useDbConfig = 'ser';
	var $actsAs = array('Containable');
	var $recursive = 2;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Section' => array(
			'className' => 'Section',
			'foreignKey' => 'section_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Curriculum' => array(
			'className' => 'Curriculum',
			'foreignKey' => 'curriculum_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function findBySectId($sectId,$esp){
		//pr($sectId); exit();
		$sections = $this->Section->find('first',
										array('conditions'=>
											array('Section.id'=>$sectId)
											)
										);
		$sy =  floor($esp);
		$period =  ($esp -  $sy)*10;
		//pr($period); exit();
		if($period<=2.5){
			$esp =  $sy+0.25;
		}else{
			$esp =  $sy+0.45;
		}
		if($period==0)
			$esp = $sy;
		$sect =  $this->Section->findById($sectId);
		if($sect['Section']['department_id']!='SH'){
			$esp =  $sy;
		}
		$data = $this->find('first',
									array(
										'conditions'=>array('CurriculumSection.section_id'=>$sectId,
															'CurriculumSection.esp'=>$esp)
										)
									);
							 
		return $data;
	}
	
	public function getByDeptId($dept,$esp){
		
		$sections = $this->Section->find('list',
										array(
											'conditions'=>array('Section.department_id'=>$dept),
											'fields'=>array('id','id')
											)
										);
		$sy =  floor($esp);
		$period =  ($esp -  $sy)*10;
		//pr($period); exit();
		if($period<=2.5){
			$esp =  $sy+0.25;
		}else{
			$esp =  $sy+0.45;
		}
		if($period==0)
			$esp = $sy;
		$sections = array_values($sections);
		if($dept!='SH'){
			$esp =  $sy;
		}
		$data = $this->find('list',
									array(
										'conditions'=>
											array(
												array('CurriculumSection.section_id'=>$sections),
												array('CurriculumSection.esp'=>$esp)
											),
										'fields'=>array('curriculum_id','curriculum_id'),
										)
									);

		$data = array_values($data);
							 
		return $data;
	}
	
	function beforeFind($queryData){
		if($conds=$queryData['conditions']){
			foreach($conds as $i=>$cond){
				if(is_array($cond)):
					$keys = array_keys($cond);
					$search = 'CurriculumSection.sy';
					if(in_array($search,$keys)){
						$value = $cond[$search];
						//pr($value);
						unset($cond[$search]);
						$cond = array('and'=>array('CurriculumSection.esp >='=>$value,'CurriculumSection.esp <'=>$value + 1));;
					}
				endif;
				$conds[$i] = $cond;
			}
			$queryData['conditions'] = $conds;
		}
		//pr($queryData); exit();
		return $queryData;
	}


}
