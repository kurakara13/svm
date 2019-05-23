<?php

/**
 *
 */
 
class EkstraksiFitur
{

  function initcaps($data)
  {

    // echo $data;

    // echo "<pre>".$data."</pre>";
    // $word = $data;
    $jumlahKata = 0;
    $hasil = 0;
    $array = [];

    for ($i=0; $i < count($data); $i++) {

      // $dataBaru = str_replace("\r", '', $data[$i]);
      // if($i == 0){
      //   echo $dataBaru;
      // }
      $word = Tokenizing::perhitungan($data[$i]);
      for ($a=0; $a < count($word) ; $a++) {
        if(ctype_upper(substr($word[$a],0,1))){
          $hasil = $hasil + 1;
        }
        $jumlahKata = $jumlahKata + 1;
      }

      $array[] = array('hasil' => $hasil, 'jumlahKata' => $jumlahKata);
      $hasil = 0;
      $jumlahKata = 0;
    }

    return $array;

  }

  function allcaps($data)
  {
    $jumlahKata = 0;
    $hasil = 0;
    $array = [];

    for ($i=0; $i < count($data); $i++) {

      $word = Tokenizing::perhitungan($data[$i]);

      for ($a=0; $a < count($word) ; $a++) {
        if(ctype_upper($word[$a])){
          $hasil = $hasil + 1;
        }
        $jumlahKata = $jumlahKata + 1;
      }

      $array[] = array('hasil' => $hasil, 'jumlahKata' => $jumlahKata);
      $hasil = 0;
      $jumlahKata = 0;
    }

    return $array;

  }

  function containsdigit($data)
  {
    $jumlahKata = 0;
    $hasil = 0;
    $array = [];

    for ($i=0; $i < count($data); $i++) {
      $word = Tokenizing::perhitungan($data[$i]);
      for ($a=0; $a < count($word) ; $a++) {
        if (preg_match('~[0-9]+~', $word[$a])) {
          $hasil = $hasil + 1;
        }
        $jumlahKata = $jumlahKata + 1;
      }

      $array[] = array('hasil' => $hasil, 'jumlahKata' => $jumlahKata);
      $hasil = 0;
      $jumlahKata = 0;
    }

    return $array;

  }

  function alldigit($data)
  {
    $jumlahKata = 0;
    $hasil = 0;
    $array = [];

    for ($i=0; $i < count($data); $i++) {
      $word = Tokenizing::perhitungan($data[$i]);
      for ($a=0; $a < count($word) ; $a++) {
        if (ctype_digit($word[$a])) {
          $hasil = $hasil + 1;
        }
        $jumlahKata = $jumlahKata + 1;
      }

      $array[] = array('hasil' => $hasil, 'jumlahKata' => $jumlahKata);
      $hasil = 0;
      $jumlahKata = 0;
    }

    return $array;

  }

  function containsdots($data)
  {
    $jumlahKata = 0;
    $hasil = 0;
    $array = [];

    for ($i=0; $i < count($data); $i++) {
      $word = Tokenizing::perhitungan($data[$i]);
      for ($a=0; $a < count($word) ; $a++) {
        if (strpos($word[$a], ".") !== false) {
          $hasil = $hasil + 1;
        }
        $jumlahKata = $jumlahKata + 1;
      }

      $array[] = array('hasil' => $hasil, 'jumlahKata' => $jumlahKata);
      $hasil = 0;
      $jumlahKata = 0;
    }

    return $array;

  }

  function lowercase($data)
  {
    $jumlahKata = 0;
    $hasil = 0;
    $array = [];

    for ($i=0; $i < count($data); $i++) {

      $word = Tokenizing::perhitungan($data[$i]);

      for ($a=0; $a < count($word) ; $a++) {
        if(!ctype_upper($word[$a]) && !ctype_digit($word[$a])){
          $hasil = $hasil + 1;
        }
        $jumlahKata = $jumlahKata + 1;
      }

      $array[] = array('hasil' => $hasil, 'jumlahKata' => $jumlahKata);
      $hasil = 0;
      $jumlahKata = 0;
    }

    return $array;

  }

  function punctuation($data)
  {
    $jumlahKata = 0;
    $hasil = 0;
    $array = [];

    for ($i=0; $i < count($data); $i++) {
      $word = Tokenizing::perhitungan($data[$i]);
      for ($a=0; $a < count($word) ; $a++) {
        $wordText = str_split($word[$a]);
        for ($c=0; $c < count($wordText) ; $c++) {
          if (preg_match('/[\':.^£$%&*()}{@#~?><>,|=_+¬-]/', $wordText[$c])) {
            $hasil = $hasil + 1;
          }
        }
        $jumlahKata = $jumlahKata + 1;
      }

      $array[] = array('hasil' => $hasil, 'jumlahKata' => $jumlahKata);
      $hasil = 0;
      $jumlahKata = 0;
    }

    return $array;

  }

  function eightdigit($data)
  {
    $jumlahKata = 0;
    $hasil = 0;
    $array = [];

    for ($i=0; $i < count($data); $i++) {
      $word = Tokenizing::perhitungan($data[$i]);
      for ($a=0; $a < count($word) ; $a++) {
        if (ctype_digit($word[$a])) {
          if(strlen($word[$a]) == 8){
            $hasil = $hasil + 1;
          }
        }
        $jumlahKata = $jumlahKata + 1;
      }

      $array[] = array('hasil' => $hasil, 'jumlahKata' => $jumlahKata);
      $hasil = 0;
      $jumlahKata = 0;
    }

    return $array;
  }

  function word($data)
  {
    $jumlahKata = 0;
    $hasil = 0;
    $array = [];

    for ($i=0; $i < count($data); $i++) {
      $word = Tokenizing::perhitungan($data[$i]);
      for ($a=0; $a < count($word) ; $a++) {
        if (strpos($word[$a], 'SKRIPSI') !== false || strpos($word[$a], 'Diajukan') !== false) {
            $hasil = $hasil + 1;
        }
        $jumlahKata = $jumlahKata + 1;
      }

      $array[] = array('hasil' => $hasil, 'jumlahKata' => $jumlahKata);
      $hasil = 0;
      $jumlahKata = 0;
    }

    return $array;
  }

  function line($data)
  {
    $jumlahKata = 0;
    $hasil = 0;
    $array = [];

    for ($i=0; $i < count($data); $i++) {
      $word = Tokenizing::perhitungan($data[$i]);
      $hasil = $hasil + 1;

      $array[] = array('hasil' => $hasil, 'jumlahKata' => count($data));
    }

    return $array;
  }

  function person($data)
  {
    // assume composer autoload
    // require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

    $path = __DIR__ . '\postag\stanford-postagger-2018-10-16';
    //
    $pos = new \StanfordNLP\POSTagger(
      $path . '\models\english-left3words-distsim.tagger',
      $path . '\stanford-postagger.jar'
    );
    //
    // //$pos->setDebug(true);
    //
    $result = $pos->tag(explode(' ', "The Federal Reserve Bank of New York led by Timothy R. Geithner. He also said that we should call the Internal Revenue Services office"));
    //$results = $pos->batchTag([explode(' ', "The Federal Reserve Bank of New York led by Timothy R. Geithner."), explode(' ', "He also said that we should call the Internal Revenue Services office")]);
    var_dump($result);
    // var_dump($path);    // $pos->setOutputFormat(StanfordTagger::OUTPUT_FORMAT_TSV);
  }

  function roganization($data)
  {

  }

  function year($data)
  {

  }
}



?>
