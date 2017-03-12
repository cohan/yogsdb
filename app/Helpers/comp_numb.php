<?php
function comp_numb($input){
    $input = number_format($input);
    $input_count = substr_count($input, ',');
    $arr = array(1=>'K','M','B','T');
    if(isset($arr[(int)$input_count]))      
       return substr($input,0,(-1*$input_count)*4).$arr[(int)$input_count];
    else return $input;

}