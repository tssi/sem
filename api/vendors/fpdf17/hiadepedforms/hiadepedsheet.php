<?php 
$EGB->db_connect();
$gryrlv = array(
				  array('dept'=> 'PS', 'level'=>'Nursery,Kinder,Prep'),
				  array('dept'=> 'GS', 'level'=>'Grade 1, Grade 2, Grade 3, Grade 4, Grade 5, Grade 6, Grade 7'),
				  array('dept'=> 'HS', 'level'=>'First Year, Second Year, Third Year,Fourth Year'),
				);
$index=0;
$data = array();
foreach($gryrlv as $g){
	$gryrlv[$index]['level']= explode(',', $gryrlv[$index]['level']);
	$id=1;
	foreach($gryrlv[$index]['level'] as $level){
		array_push($data, array('fk'=>$g['dept'], 'c'=>$level , 'id'=> $id++));
		}
	$index+=1;
}
?>
<style>
	.uiForm{
		display:none;
	}
</style>
<table border="0">
  <tr valign="top">
	   <td><img src="img/RegisterIcon.jpg" /></td>
	<td><h1>Deped Report Printing</h1></td>
  </tr>
</table>
<hr />
<input type="hidden" class="xlarge" id="teachers" data='<?php echo json_encode($EGB->list_get('faculties'));?>' />
<table >
<tr>
	<td>User ID:</td>
	<td>
		<input class="large disable-text" id="faculty_id" type="text" disabled="disabled"/ >
	</td>
	
	<td>
	Name:
	</td>
	<td>
		<input class="xlarge disable-text" id="full_name" type="text" disabled="disabled"/>
	</td>
	<td>
	<input type="radio" class="mode" name="mode" value="individual" />Individual
	</td>
	<td>
	<input type="radio"class="mode"  name="mode" value="batch" /> Batch
	</td>
</tr>
</table>
<table border="0">

  <tr>
    <td align="right">SY:</td>
    <td><select name="select" class="medium" id="sy" >
    </select></td>
   
		<td align="right" class="individual invisible">Student Name:</td>
		<td class="individual invisible" ><input type="text" id="studentname"  class="xlarge"/></td>
	<td class="batch invisible">Educ Level</td>
    <td class="batch invisible" ><select name="educlvl" class="medium validate[required] link_list" id="educlvl" link_to="gryrlvl">
		<option value="#" class="default">Select department</option>
		<option value="PS">Pre-school</option>
		<option value="GS"> Grade School</option>
        <option value="HS">High School</option>
    </select></td>
    <td class="batch invisible">Gr/Yr Level</td>
    <td class="batch invisible" data='<?php echo json_encode($data);?>' ><select name="gryrlvl" class="medium validate[required] refer" id="gryrlvl"  >
    </select></td>
    <td class="batch invisible">Section</td>
   <td class="batch invisible" data='<?php echo json_encode($EGB->list_get('sections'));?>' ><select class="medium validate[required]" id="section" >
    </select></td>
	 <td class='uiForm'>
	<div align="right">Form: </div>
	</td>
	<td class='uiForm'>
		<select id="form" class="large">
			<option value="form137" id = "F137">Form 137</option>
			<option value="form9 " id = "F9">Form 9</option>
			<option value="form18" id = "F18">Form 18</option>
		</select>
	</td>
  </tr>
</table>
<form id="printForm" action="fpdf17/createcard.php" method="POST" target="_blank">
	<input type="hidden" name="prnt_sy" id="prnt_sy" value="0"/>
	<input type="hidden" name="prnt_form" id="prnt_form" value="0"/>
	<input type="hidden" name="prnt_sno"  id="prnt_sno" value="0"/>
	<input type="hidden" name="prnt_classcode"  id="prnt_classcode"  value="0"/>
	<input type="hidden" name="prnt_mode"  id="prnt_mode" />
	<input type="hidden" name="prnt_section"  id="prnt_section" />
</form>

<div align="right">
				<span class="art-button-wrapper">
					<span class="l"> </span>
					<span class="r"> </span>
					<a class="art-button card_load_btn" href="javascript:void(0)" frm="printForm" >Load</a>
				</span>
			</div>
<?php
	$EGB->db_close();
?>
<style>
.invisible{
display:none;
}
</style>

