<?php
function fixEuro($string){
    return str_replace('€', "&#8364;", $string);
}
