<?php
class Section extends AppModel {
	var $name = 'Section';
	var $displayField = 'name';
	var $useDbConfig = 'ser';
	var $cacheExpires = '+1 day';
	var $usePaginationCache = true;
	var $recursive = 0;
	var $actsAs = array('Containable');
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' =>  array('id','name','description'),
			'order' => ''
		),
		'YearLevel' => array(
			'className' => 'YearLevel',
			'foreignKey' => 'year_level_id',
			'conditions' => '',
			'fields' => array('id','name','description','alias'),
			'order' => ''
		),
		'Program' => array(
			'className' => 'Program',
			'foreignKey' => 'program_id',
			'conditions' => '',
			'fields' => array('id','name'),
			'order' => ''
		)
	);

	var $hasMany = array(
		'Schedule' => array(
			'className' => 'Schedule',
			'foreignKey' => 'section_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Student' => array(
			'className' => 'Student',
			'foreignKey' => 'section_id',
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


	var $hasAndBelongsToMany = array(
		'Curriculum' => array(
			'className' => 'Curriculum',
			'joinTable' => 'curriculum_sections',
			'foreignKey' => 'section_id',
			'associationForeignKey' => 'curriculum_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
	
	function findByProgramId($prog_id){
		$sections = $this->find('list',array('conditions'=>array('Section.program_id'=>$prog_id)));
		//pr($sections); exit();
		return $sections;
	}
	
	function findByDeptId($dept_id){
		$sections = $this->find('list',array('conditions'=>array('Section.department_id'=>$dept_id)));
		return $sections;
	}

	function findByYl($yl){
		$sections = $this->find('list',array('conditions'=>array('Section.year_level_id'=>$yl)));
		return $sections;
	}
}
