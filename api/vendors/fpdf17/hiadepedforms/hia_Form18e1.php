<?php
//print Report Promotion Grade 1-3 form
include('hiaform18e1.php');  
include('data_form18.php');  
$ROWS = 50;
$next_index = 0;
$rp_form= new rpForm();
$rp_form->hdr($curri_info);
$rp_form->tableHeader();
//print_r($sp_pane);
$rp_form->table($sp_pane,$next_index,$ROWS);
$rp_form->output();
?>