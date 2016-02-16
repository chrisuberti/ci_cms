<?php

//General set of custom functions to be used for this project helper fiel



function preprint($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}

function print_money($value){
    return money_format('$%i',$value);
}