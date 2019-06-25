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
         // && )
        if(!ctype_upper($word[$a])){
          if(ctype_digit($word[$a])){
            if(strlen($word[$a]) != 4){
              $hasil = $hasil + 1;
            }
          }else {
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

  function hasil($data)
  {
    $extraction = new EkstraksiFitur;
    $initcaps = $extraction->initcaps($data);
    $allcaps = $extraction->allcaps($data);
    $containsdigit = $extraction->containsdigit($data);
    $punctuation = $extraction->punctuation($data);
    $alldigit = $extraction->alldigit($data);
    $containsdot = $extraction->containsdots($data);
    $lowercase = $extraction->lowercase($data);
    $eightdigit = $extraction->eightdigit($data);
    $word = $extraction->word($data);

    $array = [];
    $a = 1;
    for ($i=0; $i < count($initcaps); $i++) {
      // code...
      $array[$i] = array(
                          'f(1)' => number_format($initcaps[$i]['hasil']/$initcaps[$i]['jumlahKata'],2),
                          'f(2)' => number_format($allcaps[$i]['hasil']/$allcaps[$i]['jumlahKata'],2),
                          'f(3)' => number_format($containsdigit[$i]['hasil']/$containsdigit[$i]['jumlahKata'],2),
                          'f(4)' => number_format($alldigit[$i]['hasil']/$alldigit[$i]['jumlahKata'],2),
                          'f(5)' => number_format($containsdot[$i]['hasil']/$containsdot[$i]['jumlahKata'],2),
                          'f(6)' => number_format($lowercase[$i]['hasil']/$lowercase[$i]['jumlahKata'],2),
                          'f(7)' => number_format($punctuation[$i]['hasil']/$punctuation[$i]['jumlahKata'],2),
                          'f(8)' => number_format($eightdigit[$i]['hasil']/$eightdigit[$i]['jumlahKata'],2),
                          'f(9)' => number_format($word[$i]['hasil']/$word[$i]['jumlahKata'],2)
                        );
    }

    return $array;

  }
}



?>
