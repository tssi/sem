<?php
//print Report Promotion Grade 1-3 form
include('hiaform18a.php');  
include('data_form18.php');
$ROWS = 35;
$next_index = 0;
$rp_form= new rpForm();
$rp_form->hdr($curri_info);
$rp_form->table($sp_pane);
$rp_form->table_hor_lines($sp_pane,$next_index,$ROWS);
$rp_form->bottom_ver_lines();
$rp_form->output();
?>