<?php
//print Report Promotion Grade 4-6 form
include('hiaform18e2.php');  
include('data_form18.php');  
$ROWS = 50;
$next_index = 0;
$rp_form= new rpForm();
$rp_form->hdr($curri_info);
$rp_form->rightHeader();
$rp_form->table($sp_pane,$next_index,$ROWS);
$rp_form->output();
?>