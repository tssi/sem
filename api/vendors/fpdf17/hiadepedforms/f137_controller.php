<?php
set_time_limit (2000);
include_once ('database_login.php');
class F137{
	private $db_server = "localhost:3306"; 
	private $db_username; 
	private $db_password;
	private $db_name;
	private $db_connection;

	
	public function __construct($db_username, $db_password, $db_server, $db_name ) {
		//Database login information
		$this->db_server = $db_server;
		$this->db_username = $db_username;
		$this->db_password = $db_password;
		$this->db_name = $db_name;
		
	}
	//Database open connection method
	//@param	null
	//@return	$this->db_connection	mysqli object
	public function db_connect() {
		$this->db_connection = new mysqli($this->db_server, $this->db_username, $this->db_password, $this->db_name);
		if(mysqli_connect_errno()) self::error();
		else return $this->db_connection;
	}
	//Database close connection method
	//@param	$connection	boolean variable
	//@return	null
	public function db_close($connection=false) {
		if($connection != false) $connection->close(); 
		$this->db_connection->close();
	}
	//Get PSGS3 Detials
	public function get_psgs3($sno){
		$query = "SELECT ID, SY, DateEnter, DateExit, School, YearLevel, Attendance, FinalRating, Status, Adviser ";
		$query .="FROM tb_transPS2G3 ";
		$query .="WHERE StudentNumber ='$sno' ORDER BY IndexOrder";
		//echo $query;
		$results=array();
		$id=$sy= $date_enter=$date_exit=$school=$yrlvl=$att= $final_rate= $status=$adviser='';
		if ($stmt = $this->db_connection->prepare($query)) {
			$stmt->execute();
			$stmt->bind_result($id,$sy, $date_enter,$date_exit,$school, $yrlvl, $att, $final_rate, $status, $adviser);
			$index=0;
			while($stmt->fetch()){
				$index=$yrlvl;
				$results[$index]['psgs3_id']=$id;
				$results[$index]['sy']=$sy;
				$results[$index]['date_enter']=$date_enter;
				$results[$index]['date_exit']=$date_exit;
				$results[$index]['school']=$school;
				$results[$index]['yrlvl']=$yrlvl;
				$results[$index]['att']=$att;
				$results[$index]['final_rate']=$final_rate;
				$results[$index]['prom_ret']=$status;
				$results[$index]['adviser']=$adviser;
				
			}
			$stmt->close();		
		}
		return $results;
	}
	//Save PSGS3 details
	public function save_psgs3($id,$sno, $sy, $date_enter,$date_exit,$school, $yrlvl, $att, $final_rate, $status, $adviser,$order){
		$query="";
		$result=array();
		if(empty($id)){
			$query="INSERT INTO tb_transPS2G3 (StudentNumber, SY, DateEnter, DateExit, School, YearLevel, Attendance, FinalRating, Status, Adviser, IndexOrder) ";
			$query.="VALUES('$sno','$sy', '$date_enter','$date_exit','$school','$yrlvl', '$att', '$final_rate', '$status', '$adviser','$order') ";
			$result['action']='INSERT';
		}else{
			$query ="UPDATE tb_transPS2G3 SET SY='$sy', DateEnter='$date_enter', DateExit='$date_exit', ";
			$query .="School='$school', YearLevel='$yrlvl', Attendance='$att', FinalRating='$final_rate', Status='$status', Adviser='$adviser' , IndexOrder='$order'";
			$query .="WHERE StudentNumber='$sno' AND ID ='$id' ";
			$result['action']='UPDATE';
		}
		if ($stmt = $this->db_connection->prepare($query)) {
			$stmt->execute();
			if(empty($id)){
				$id=$stmt->insert_id;	
			}
			$stmt->fetch();
			$stmt->close();	
			
		}
		$result['id']=$id;
		return $result;
	}

	//Save GSUP Header
	public function save_gsup_hdg($id,$sno,$yrlvl,$seccode,$school,$adviser,$sy){
		$query="";
		$result=array();
		if(empty($id)){
			$query ="INSERT INTO tb_transG42H4_Hdg (StudentNumber, YearLevel, SectionCode, School, Adviser, SY) ";
			$query .= "VALUES ('$sno','$yrlvl','$seccode','$school','$adviser','$sy') ";
		}else{
			$query ="UPDATE tb_transG42H4_Hdg SET SectionCode='$seccode', School='$school', Adviser='$adviser', SY='$sy' ";
			$query .="WHERE StudentNumber='$sno' AND ID ='$id' ";
		}
		if ($stmt = $this->db_connection->prepare($query)) {
			$stmt->execute();
			if(empty($id)){
				$id=$stmt->insert_id;	
			}
			$stmt->fetch();
			$stmt->close();	
			
		}
		$result['id']=$id;
		$result['query']=$query;
		return $result;
	}
	//Save GSUP Header
	public function save_gsup_hdg_btm($id,$sno,$promoted, $retained,$gen_ave){
		$query="";
		$result=array();
		if(empty($id)){
			$query ="INSERT INTO tb_transG42H4_Hdg (StudentNumber, PromotedTo, RetainedIn, GenAve) ";
			$query .= "VALUES ('$sno','$promoted', '$retained','$gen_ave') ";
		}else{
			$query ="UPDATE tb_transG42H4_Hdg SET PromotedTo='$promoted', RetainedIn='$retained', GenAve='$gen_ave' ";
			$query .="WHERE StudentNumber='$sno' AND ID ='$id' ";
		}
		if ($stmt = $this->db_connection->prepare($query)) {
			$stmt->execute();
			if(empty($id)){
				$id=$stmt->insert_id;	
			}
			$stmt->fetch();
			$stmt->close();	
			
		}
		$result['id']=$id;
		$result['query']=$query;
		return $result;
	}
	//Get GSUP Header
	public function get_gsup_hdg($sno){
		$query = "SELECT ID, YearLevel, SectionCode, School, Adviser, SY, PromotedTo, RetainedIn, GenAve ";
		$query .="FROM tb_transG42H4_Hdg ";
		$query .="WHERE StudentNumber ='$sno' ";
		//echo $query;
		$results=array();
		$id=$yrlvl=$seccode=$school=$adviser=$sy=$promoted=$retained=$gen_ave='';
			if ($stmt = $this->db_connection->prepare($query)) {
			$stmt->execute();
			$stmt->bind_result($id,$yrlvl,$seccode,$school,$adviser,$sy,$promoted,$retained,$gen_ave);
			$index=0;
			while($stmt->fetch()){
				$index=$yrlvl;
				$results[$index]['gsuphdg_id']=$id;
				$results[$index]['sy']=$sy;
				$results[$index]['school']=$school;
				$results[$index]['yrlvl']=$yrlvl;
				$results[$index]['seccode']=$seccode;
				$results[$index]['adviser']=$adviser;
				$results[$index]['promoted']=$promoted;
				$results[$index]['retained']=$retained;
				$results[$index]['gen_ave']=$gen_ave;
			}
			$stmt->close();		
		}
		return $results;
	}
	//Get GSUP Attendance
	public function get_gsup_attnd($sno){
		$query = "SELECT ID, YearLevel, `Jun_p`,`Jun_s`,`Jul_p`,`Jul_s`,`Aug_p`,`Aug_s`,`Sep_p`,`Sep_s`,`Oct_p`,`Oct_s`,`Nov_p`,`Nov_s`,`Dec_p`,`Dec_s`,`Jan_p`,`Jan_s`,`Feb_p`,`Feb_s`,`Mar_p`,`Mar_s`, `Apr_p`,`Apr_s`,`total_s`,`total_p` ";
		$query .="FROM tb_transG42H4_Hdg ";
		$query .="WHERE StudentNumber ='$sno' ";
		$results=array();
		$id=$yrlvl=$jun=$jun_s=$jul=$jul_s=$aug=$aug_s=$sep=$sep_s=$oct=$oct_s=$nov=$nov_s=$dec=$dec_s=$jan=$jan_s=$feb=$feb_s=$mar=$mar_s=$apr=$apr_s=$total_s=$total_p='';
			if ($stmt = $this->db_connection->prepare($query)) {
			$stmt->execute();
			$stmt->bind_result($id,$yrlvl,$jun,$jun_s,$jul,$jul_s,$aug,$aug_s,$sep,$sep_s,$oct,$oct_s,$nov,$nov_s,$dec,$dec_s,$jan,$jan_s,$feb,$feb_s,$mar,$mar_s,$apr,$apr_s,$total_s,$total_p);
			//$stmt->bind_result($id,$yrlvl,$jun,$jul,$aug,$sep,$oct,$nov,$dec,$jan,$feb,$mar,$apr);
			$index=0;
			while($stmt->fetch()){
				$index=$yrlvl;
				$results[$index]['jun']=$jun;
				$results[$index]['jul']=$jul;
				$results[$index]['aug']=$aug;
				$results[$index]['sep']=$sep;
				$results[$index]['oct']=$oct;
				$results[$index]['nov']=$nov;
				$results[$index]['dec']=$dec;
				$results[$index]['jan']=$jan;
				$results[$index]['feb']=$feb;
				$results[$index]['mar']=$mar;
				$results[$index]['apr']=$apr;
				$results[$index]['total_p']=$total_p;
				
				$results[$index]['jun_s']=$jun_s;
				$results[$index]['jul_s']=$jul_s;
				$results[$index]['aug_s']=$aug_s;
				$results[$index]['sep_s']=$sep_s;
				$results[$index]['oct_s']=$oct_s;
				$results[$index]['nov_s']=$nov_s;
				$results[$index]['dec_s']=$dec_s;
				$results[$index]['jan_s']=$jan_s;
				$results[$index]['feb_s']=$feb_s;
				$results[$index]['mar_s']=$mar_s;
				$results[$index]['apr_s']=$apr_s;
				$results[$index]['total_s']=$total_s;
			}
			$stmt->close();		
		}
		return $results;
	}
	
	public function save_gsup_attnd($id,$sno,$jun,$jul,$aug,$sep,$oct,$nov,$dec,$jan,$feb,$mar,$apr){
		$query="";
		$result=array();
		if(empty($id)){
			$query ="INSERT INTO  tb_transG42H4_Hdg (StudentNumber,transG42H4_Hdg_ID, `Jun_p`, `Jul_p`, `Aug_p`, `Sep_p`, `Oct_p`, `Nov_p`, `Dec_p`, `Jan_p`, `Feb_p`, `Mar_p`, `Apr_p`) ";
			$query .= "VALUES ('$sno','$jun','$jul','$aug','$sep','$oct','$nov','$dec','$jan','$feb','$mar','$apr') ";
		}else{
			$query ="UPDATE  tb_transG42H4_Hdg SET  `Jun_p`='$jun', `Jul_p`='$jul', `Aug_p`='$aug', `Sep_p`='$sep', `Oct_p`='$oct', `Nov_p`='$nov', `Dec_p`='$dec', `Jan_p`='$jan', `Feb_p`='$feb', `Mar_p`='$mar', `Apr_p`='$apr' ";
			$query .="WHERE StudentNumber='$sno' AND ID ='$id' ";
		}
		if ($stmt = $this->db_connection->prepare($query)) {
			$stmt->execute();
			if(empty($id)){
				$id=$stmt->insert_id;	
			}
			$stmt->fetch();
			$stmt->close();	
			
		}
		$result['id']=$id;
		$result['query']=$query;
		return $result;
	}
	
	public function save_gsup_dtl($id,$sno,$sy,$compcode, $first,$second,$third, $fourth, $final, $gsup_hdg_id){
		$query="";
		$result=array();
		if(empty($id)){
			$query ="INSERT INTO  tb_transg42h4_dtl (StudentNumber, SY, CompCode, First, Second, Third, Fourth, FinalRating, transG42H4_Hdg_ID) ";
			$query .= "VALUES ('$sno','$sy','$compcode','$first','$second','$third', '$fourth', '$final', '$gsup_hdg_id') ";
		}else{
			$query ="UPDATE  tb_transg42h4_dtl SET  First='$first', Second='$second', Third='$third', Fourth='$fourth', FinalRating='$final' ";
			$query .="WHERE StudentNumber='$sno' AND ID ='$id' ";
		}
		if ($stmt = $this->db_connection->prepare($query)) {
			$stmt->execute();
			if(empty($id)){
				$id=$stmt->insert_id;	
			}
			$stmt->fetch();
			$stmt->close();	
			
		}
		$result['id']=$id;
		$result['query']=$query;
		return $result;
	}
	//Get GSUP detail
	public function get_gsup_dtl($sno){
		$query = "SELECT HDG.YearLevel,DTL.ID, DTL.CompCode,DTL.Nomenclature, DTL.CreditsEarned, DTL.First, DTL.Second, DTL.Third, DTL.Fourth, DTL.FinalRating, DTL.transG42H4_Hdg_ID ";
		$query .="FROM tb_transg42h4_dtl as DTL  INNER JOIN tb_transg42h4_hdg as HDG ON(DTL.transG42H4_Hdg_ID=HDG.ID)";
		$query .="WHERE HDG.StudentNumber ='$sno' ";
		//echo $query;
		$results=array();
		$yrlvl=$id=$compcode=$nomen=$unit=$first=$second=$third=$fourth=$final=$gsup_hdg_id='';
		if ($stmt = $this->db_connection->prepare($query)) {
			$stmt->execute();
			$stmt->bind_result($yrlvl,$id,$compcode,$nomen,$unit, $first,$second,$third, $fourth, $final, $gsup_hdg_id);
			$index=0;
			while($stmt->fetch()){
				$index=$compcode;
				$results[$yrlvl][$index]['yrlvl']=$yrlvl;
				$results[$yrlvl][$index]['gsup_dtl_id']=$id;
				$results[$yrlvl][$index]['first']=$first;
				$results[$yrlvl][$index]['second']=$second;
				$results[$yrlvl][$index]['third']=$third;
				$results[$yrlvl][$index]['fourth']=$fourth;
				$results[$yrlvl][$index]['final']=$final;
				$results[$yrlvl][$index]['nomen']=$nomen;
				$results[$yrlvl][$index]['unit']=round($unit,1);
			}
			$stmt->close();		
		}
		return $results;
	}
	public function get_subjects($deptcode, $gryrlvl, $sy){
		$sql ="SELECT nrol_currdtl.CompCode, nrol_currdtl.IsPrintReportCard, nrol_currdtl.Under ,nrol_currdtl.Child, nrol_currdtl.Weight, nrol_currdtl.IsLetterGrade, tb_subject.Nomenclature, tb_subject.Alias, tb_subject.OLD_Alias "; 
		$sql .="FROM    nrol_currhdr    INNER JOIN nrol_currdtl         ON (nrol_currhdr.CurriculumId = nrol_currdtl.CurriculumId)    LEFT JOIN tb_subject  ON (nrol_currdtl.CompCode = tb_subject.CompCode) ";
		$sql .="WHERE (nrol_currhdr.ProgramId ='$deptcode'  AND  nrol_currhdr.SY='$sy' AND nrol_currdtl.CurrYear =$gryrlvl) ";
		$sql.="AND IsPrintReportCard = '1'  ORDER BY nrol_currdtl.IndexOrder ";
		//echo $sql;
		$results1=array();
		if ($stmt1 = $this->db_connection->prepare($sql)) {			
			$stmt1->execute();
			$stmt1->bind_result($compcode, $isprintreportcard, $under, $child, $weight, $isletter, $nomen, $alias, $old_alias);
			$index=0;
			while($stmt1->fetch()){
				$results1[$index]['compcode']=$compcode;
				$results1[$index]['comp_code']=$compcode;
				$results1[$index]['isprintreportcard']=$isprintreportcard;
				$results1[$index]['nomen']=$nomen;
				$results1[$index]['under']=$under;
				$results1[$index]['child']=$child;
				$results1[$index]['weight']=$weight;
				$results1[$index]['isletter']=$isletter;
				$results1[$index]['alias']=$alias;
				$results1[$index]['old_alias']=$old_alias;
				$index+=1;
			}
			$stmt1->close();		
		}
		return $results1;
	}
	
}
$F137 = new F137($db_username,$db_password,$db_server,$db_name);
?>