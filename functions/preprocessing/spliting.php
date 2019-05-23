<?php

/**
 *
 */

class Spliting
{

  function perhitungan($data)
  {

    $wordb = explode("\n",$data);
    $abstrak = false;
    // foreach ($wordb as $item) {
    // if (preg_match('/.*ABSTRAK.*/i', $item)) {
    //       $abstrak = true;
    //       break;
    //     }
    // }
    $newWord = [];
    $a = 0;
    $wordText = '';
    for ($i=0; $i < count($wordb) ; $i++) {
      // if(!ctype_space($wordb[$i])){
      // if($abstrak){
        if($wordb[$i] != '' && !ctype_space($wordb[$i])){
          $wordText .= ''.$wordb[$i];
          if(substr($wordb[$i],-2,-1) != ','){
            $newWord[$a] = $wordText;
            $wordText = '';
            $a++;
          }
        }
      // }else {
    //     if($wordb[$i] != '' && !ctype_space($wordb[$i])){
    //       if($wordText == ''){
    //         $wordText .= substr($wordb[$i],0,-1);
    //       }else {
    //         $wordText .= ' '.$wordb[$i];
    //       }
    //       // if($i == 58){
    //       //   echo "jihad";
    //       // }
    //       if($i == (count($wordb) - 1)){
    //         $newWord[$a] = $wordText;
    //         $a++;
    //         $wordText = '';
    //       }
    //     }else {
    //       if(strlen($wordText) > 0){
    //         $newWord[$a] = $wordText;
    //         $a++;
    //       }
    //       $wordText = '';
    //     }
    //   }
    //   // code...
    //   // echo "Word = ".substr($wordb[$i],0,-1)."<br>";
    // //
    }

    return $newWord;
    // for ($i=0; $i < count($newWord); $i++) {
    //   echo "Word = ".$newWord[$i]."<br>";
    // }


    // var_dump($newWord);
  }
}



?>
