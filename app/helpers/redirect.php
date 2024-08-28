<?php

function redirect($file){
    header('Location:'.URLROOT.$file);
}
function getRandomstr($length=10){
    $characters='0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN';
    $charactersLength=strlen($characters);
    $random='';
    for($i=0;$i<$length;$i++){
        $random.=$characters[random_int(0,$charactersLength-1)];
    };
    return $random;
}
function getRandomNumber($length=10){
    $characters='0123456789';
    $charactersLength=strlen($characters);
    $random='';
    for($i=0;$i<$length;$i++){
        $random.=$characters[random_int(0,$charactersLength-1)];
    };
    return $random;
}