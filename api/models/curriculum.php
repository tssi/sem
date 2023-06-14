<?php
class Curriculum extends AppModel {
	var $name = 'Curriculum';
	var $useDbConfig = 'ser';
	var $recursive = 2;
	var $cacheExpires = '+7 days';
	var $usePaginationCache = false;
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $joins = array();
	var $belongsTo = array(
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'CurriculumDetail' => array(
			'className' => 'CurriculumDetail',
			'foreignKey' => 'curriculum_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'CurriculumDetail.order',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CurriculumSection' => array(
			'className' => 'CurriculumSection',
			'foreignKey' => 'curriculum_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	
	function beforeFind($queryData){
		//pr($queryData); exit();
		
		if($conds=$queryData['conditions']){
			$flags = array(
						'Curriculum.year_level_id'=>0,
						'Curriculum.section_id'=>0,
						'Curriculum.esp'=>0,
						'Curriculum.department_id'=>0,
						'Curriculum.id'=>0,
					);
			$vals = $flags;
			foreach($conds as $i=>$cond){
				$key = array_keys($cond)[0];
				$val = array_values($cond)[0];
				$flags[$key]=1;
				$vals[$key] = $val;
				
			} 
			
			if($flags['Curriculum.year_level_id']&&
				$flags['Curriculum.esp']&&
				$flags['Curriculum.department_id']){
					
					
					$this->unbindModel(array('hasMany'=>array('CurriculumDetail')));
					$this->bindModel(array('hasMany'=>
								array('CurriculumDetail'=>
									array('conditions'=>
										array('CurriculumDetail.year_level_id'=>$vals['Curriculum.year_level_id']),
										'order'=>array('CurriculumDetail.order'=>'ASC')
										)
									)
								));
					

					$condition = array('Curriculum.department_id'=>$vals['Curriculum.department_id'],
										'Curriculum.esp'=>$vals['Curriculum.esp']
										);	
					
					
			} 
			
			if($flags['Curriculum.section_id']&&$flags['Curriculum.esp']){
				$sectId = $vals['Curriculum.section_id'];
				$esp = $vals['Curriculum.esp'];
				pr($esp);
				pr($this->CurriculumSection->findBySectionId($sectId,$esp)); exit();
				exit();
				$CurriSections = $this->CurriculumSection->findBySectionId($sectId,$esp);
				pr($CurriculumSection); exit();
				$this->unbindModel(array('hasMany'=>array('CurriculumDetail')));
				$this->bindModel(array('hasMany'=>
								array('CurriculumDetail'=>
									array('conditions'=>
										array('CurriculumDetail.year_level_id'=>$CurriSections['Section']['year_level_id']),
										'order'=>array('CurriculumDetail.order'=>'ASC')
										)
									)
								));
				
				
				$condition = array('Curriculum.id'=>$CurriSections['CurriculumSection']['curriculum_id']);
			}
			
			if($flags['Curriculum.id']){
				$condition = $queryData['conditions'];
			}
			
			if(isset($condition))
				$queryData['conditions'] = $condition;
				
		}
		return $queryData;
	} 
	
	
	function getSubjects($esp,$sect){
		return $curriculums = $this->find('all',array('limit'=>9999,'conditions'=>array('Curriculum.esp'=>array($esp),'Curriculum.section_id'=>array($sect))));	
	}
	
}
