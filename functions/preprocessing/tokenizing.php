<?php

/**
 *
 */
class Tokenizing
{

  function perhitungan($data)
  {
    $tok = strtok($data, " \n\t");
    $array = [];
    while ($tok !== false) {
        $array[] = $tok;
        $tok = strtok(" \n\t");
    }

    return $array;
  }
}



 ?>
