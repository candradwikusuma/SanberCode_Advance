<?php

spl_autoload_register(function($class_name){
    include $class_name.'.php';
});

$harimau_1= new Harimau('Harimau_1');
$elang_1= new Elang('Elang_1');
$harimau_1->atraksi();
$harimau_1->serang($elang_1); 
$elang_1->atraksi();
$elang_1->serang($harimau_1); 
$harimau_1->getInfoHewan(); 
$elang_1->getInfoHewan();

