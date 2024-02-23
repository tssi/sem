<?php
class Inquiry extends AppModel {
	var $name = 'Inquiry';
	var $displayField = 'name';
	var $actsAs ='Containable';
	var $virtualFields = array(
				'full_name'=>"CONCAT( Inquiry.last_name,', ',Inquiry.first_name,', ',COALESCE(Inquiry.middle_name,''))"
				);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'YearLevel' => array(
			'className' => 'YearLevel',
			'foreignKey' => 'year_level_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Program' => array(
			'className' => 'Program',
			'foreignKey' => 'program_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Student' => array(
			'className' => 'Student',
			'foreignKey' => 'year_level_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		/* 'Reservation' => array(
			'className' => 'Reservation',
			'foreignKey' => 'account_id',
			'fields' => '',
			'order' => ''
		), */
	);
	
	function beforeFind($queryData){
		$queryData['order']=array('Inquiry.id'=>'desc');
		//pr($queryData['conditions']); exit();
		if($conds=$queryData['conditions']){
			foreach($conds as $i=>$cond){
				if(!is_array($cond))
					break;
				$keys =  array_keys($cond);
				$search = 'Inquiry.full_name LIKE';
				//pr($cond[$search]); exit();
				if(in_array($search,$keys)){
					$val = $cond[$search];
					unset($cond[$search]);
					unset($cond['Inquiry.lrn LIKE']);
					$cond['OR'] = array('OR'=>array('Inquiry.first_name LIKE'=>$val,'Inquiry.middle_name LIKE'=>$val,'Inquiry.last_name LIKE'=>$val));
				}

				$conds[$i]=$cond;
			}
			//pr($conds); exit();
			$queryData['conditions']=$conds;
		}
		return $queryData;
	}
	
	function findByName($name){
		//pr($name); exit(); 
		$students = $this->find('all',
							array('conditions'=>
								array('OR'=>array('Inquiry.first_name LIKE'=>$name,
													'Inquiry.middle_name LIKE'=>$name,
													'Inquiry.last_name LIKE'=>$name
												)
										)
								)
							);
		//pr($students); exit();
		return $students;
		
		
	} 
	
	function generateIID(){
		$ID = 0;
		$cond =  array('Inquiry.id LIKE'=>'LSN%');
		$this->recursive=-1;
		$inqObj = $this->find('first',array('conditions'=>$cond,'order'=>array('id'=>'desc')));

		if($inqObj)
			$ID =  (int)(str_replace('LSN', '', $inqObj['Inquiry']['id']));
		$IID = 'LSN'.str_pad($ID+1, 5, 0, STR_PAD_LEFT);
		
		return $IID;
	}

	function checkInfo($student) {
	    // Trim all input values
	    $names = array('first_name', 'middle_name', 'last_name', 'suffix');
	    foreach ($names as $nameKey) {
	        if (isset($student[$nameKey])) {
	            $student[$nameKey] = trim($student[$nameKey]);
	        }else{
	        	$student[$nameKey] = "";
	        }
	    }

	    // Use find('all') to retrieve matches based on first and last name
	    $potentialMatches = $this->find('all', array(
	    	'recursive'=>-1,
	        'conditions' => array(
	            'Inquiry.first_name LIKE' => $student['first_name'] . "%",
	            'Inquiry.last_name LIKE' => $student['last_name'] . "%"
	        ),
	        'fields' => array('id', 'first_name', 'middle_name', 'last_name', 'suffix', 'birthday'), // Specify only the fields you need
	    ));

	    // Check each potential match for more specific criteria
	    $similar = array();
	    foreach ($potentialMatches as $match) :
	        $matchedStudent = $match['Inquiry'];

	         foreach ($names as $nameKey):
		        if (isset($matchedStudent[$nameKey])):
		            $matchedStudent[$nameKey] = strtolower($matchedStudent[$nameKey]);
		            $student[$nameKey] = strtolower($student[$nameKey]);
		        endif;
		     endforeach; 
		    
	        // Assume a match
	        $isMatch = false;
	        $similar['keyword'] = sprintf("%s %s",$matchedStudent['first_name'],$matchedStudent['last_name']);
	        $checkFields= array('middle_name','suffix','birthday');
	        foreach($checkFields as $cFld):
	        	if(!empty($student[$cFld]) && $matchedStudent[$cFld]==$student[$cFld]):
	        		$isMatch = true;
	            	$similar['keyword'] = sprintf("%s %s %s",$matchedStudent['first_name'],$matchedStudent['last_name'],$matchedStudent[$cFld]);
	            	$similar['keyword'] .=  sprintf(" with ref_no %s",$matchedStudent['id']);
	        	endif;
	        endforeach;

	        // If after all checks, it's still a match, return false (duplicate exists)
	        if ($isMatch) 
	        	return $similar;
	        
	    endforeach;

	    // If no matches found after all checks, return false (unique)
	    return false;
	}


}
