<?php

/**
 *
 */
class Tokenizing
{

  function perhitungan($data)
  {
    $tok = strtok($data, " \n\t");

    while ($tok !== false) {
        echo "Word=$tok<br />";
        $tok = strtok(" \n\t");
    }
  }
}



 ?>
