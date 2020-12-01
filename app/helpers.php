<?php
use Carbon\Carbon;

function formatDate($date){
    return Carbon::parse($date)->format('M d,Y');
}

function format_item($value)
{
       $format = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
       return $format->formatCurrency($value, 'EUR');
}

function formatPrice($price){
    return number_format((float)$price,'2','.','');
}
?>