<?php 

function isValidDate($date, $format = 'Y-m-d\TH:i'){
    $dt = DateTime::createFromFormat($format, $date);
    return $dt && $dt->format($format) === $date;
  }