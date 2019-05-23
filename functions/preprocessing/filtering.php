<?php

/**
 *
 */

class Filtering
{

  function perhitungan($data)
  {

    // echo $data;

    // echo "<pre>".$data."</pre>";
    // $word = $data;
    $replace = '';
    $search = array("\t");
    $word = str_replace($search, $replace, $data);
    // // echo $word;

    return $word;

  }
}



?>
