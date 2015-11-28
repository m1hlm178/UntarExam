<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$now = date('Y');
$tm = date('Y', strtotime('+1 year'));

//echo date('Y-m-d', strtotime('-1 month'));
$month = date('m');
if($month<6){
    echo date('Y') .'/'.date('Y', strtotime('+1 year'));
}else
{
    echo date('Y',strtotime('+1 year')) .'/'.date('Y', strtotime('+2 year'));
}
?>