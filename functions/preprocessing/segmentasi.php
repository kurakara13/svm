<?php

/**
 *
 */

class Segmentasi
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
    $abs = 0;
    $nim = 0;
    $judul = 0;
    $katakunci = 0;
    $judulskripsi = 0;
    for ($i=0; $i < count($wordb) ; $i++) {

        if ($wordb[$i] == 'ABSTRAK  ' || $wordb[$i] == 'ABSTRAK '){
          $abs = 1;
        }

        if ($wordb[$i] == 'SKRIPSI  ' || $wordb[$i] == 'SKRIPSI '){
          $judul = 1;
        }

      // if(!ctype_space($wordb[$i])){
      // if($abstrak){
        if($wordb[$i] != '' && !ctype_space($wordb[$i]) && $wordb[$i] != 'i '){
          if (strpos($wordb[$i], 'Kata') !== false){
            if (strpos($wordb[$i], 'Kunci') !== false){
              $wordTextNew = ''.$wordb[$i];
            }
          }else {
            if ($wordb[$i] == 'SKRIPSI  ' || $wordb[$i] == 'SKRIPSI ' || $wordb[$i] == 'Oleh : ' || $wordb[$i] == 'Oleh: '){
              $wordTextNew = ''.$wordb[$i];
            }else {
              $wordText .= ''.$wordb[$i];
            }
          }

          if($abs == 1){
            if($nim == 1){
              if (strpos($wordb[$i], 'Kata') !== false){
                if (strpos($wordb[$i], 'Kunci') !== false){
                  $newWord[$a] = $wordText;
                  $wordText = '';
                  $a++;
                  $newWord[$a] = $wordTextNew;
                  $a++;
                }
              }
            }else if($judulskripsi != 0){
              if ($wordb[$i] == 'Oleh : ' || $wordb[$i] == 'Oleh: '){
                $newWord[$a] = $wordText;
                $wordText = '';
                $a++;
                $newWord[$a] = $wordTextNew;
                $a++;
                $judulskripsi = 0;
              }
            }else {
              $newWord[$a] = $wordText;
              $wordText = '';
              $a++;
            }
          }else {
            if($judul == 1){
              if (strpos($wordb[$i], 'SKRIPSI') !== false){
                $newWord[$a] = $wordText;
                $wordText = '';
                $a++;
                $newWord[$a] = $wordTextNew;
                $a++;
              }else {
                $newWord[$a] = $wordText;
                $wordText = '';
                $a++;
              }
            }
          }
          if(substr($wordb[$i],-2,-1) != ','){
          }


          if (ctype_digit(substr($wordb[$i],0,-1))) {
            if(strlen(substr($wordb[$i],0,-1)) == 8){
              $nim = 1;
            }
          }
        }

        if ($wordb[$i] == 'ABSTRAK  ' || $wordb[$i] == 'ABSTRAK '){
          $judulskripsi = 1;
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
