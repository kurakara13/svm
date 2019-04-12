<?php

/**
 *
 */

class Spliting
{

  function perhitungan($data)
  {

    $wordb = explode("\n",$data);
    $newWord = [];
    $a = 0;
    $wordText = '';
    for ($i=0; $i < count($wordb) ; $i++) {
      if(!ctype_space($wordb[$i])){
        if($wordText == ''){
          $wordText .= $wordb[$i];
        }else {
          $wordText .= ' '.$wordb[$i];
        }
        // if($i == 58){
        //   echo "jihad";
        // }
        if($i == (count($wordb) - 1)){
          $newWord[$a] = $wordText;
          $a++;
          $wordText = '';
        }
      }else {
        if(strlen($wordText) > 0){
          $newWord[$a] = $wordText;
          $a++;
        }
        $wordText = '';
      }
      // code...
      // echo "Word = ".$wordb[$i]."<br>";
    //
    }

    return $newWord;

  }
}



?>
