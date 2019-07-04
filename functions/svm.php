<?php

/**
 *
 */

class Svm
{

  function init($data)
  {
    $dataFilter = Filtering::perhitungan($data);
    $dataSegmentasi = Segmentasi::perhitungan($dataFilter);
    // unset($dataSegmentasi[1]);
    // unset($dataSegmentasi[2]);
    // unset($dataSegmentasi[7]);
    // unset($dataSegmentasi[8]);
    // unset($dataSegmentasi[9]);

    $dataSegmentasi = array_values($dataSegmentasi);
    $ekstraksi_fitur = EkstraksiFitur::hasil($dataSegmentasi);

    // //test
    // $ekstraksi_fitur[0]['f(1)'] = 1; $ekstraksi_fitur[1]['f(1)'] = 0.2; $ekstraksi_fitur[2]['f(1)'] = 1; $ekstraksi_fitur[3]['f(1)'] = 0; $ekstraksi_fitur[4]['f(1)'] = 0;
    // $ekstraksi_fitur[0]['f(2)'] = 1; $ekstraksi_fitur[1]['f(2)'] = 0;   $ekstraksi_fitur[2]['f(2)'] = 1; $ekstraksi_fitur[3]['f(2)'] = 0; $ekstraksi_fitur[4]['f(2)'] = 0;
    // $ekstraksi_fitur[0]['f(3)'] = 0; $ekstraksi_fitur[1]['f(3)'] = 0.1; $ekstraksi_fitur[2]['f(3)'] = 0; $ekstraksi_fitur[3]['f(3)'] = 1; $ekstraksi_fitur[4]['f(3)'] = 1;
    // $ekstraksi_fitur[0]['f(4)'] = 0; $ekstraksi_fitur[1]['f(4)'] = 0;   $ekstraksi_fitur[2]['f(4)'] = 0; $ekstraksi_fitur[3]['f(4)'] = 1; $ekstraksi_fitur[4]['f(4)'] = 1;
    // $ekstraksi_fitur[0]['f(5)'] = 0; $ekstraksi_fitur[1]['f(5)'] = 0;   $ekstraksi_fitur[2]['f(5)'] = 0; $ekstraksi_fitur[3]['f(5)'] = 0; $ekstraksi_fitur[4]['f(5)'] = 0;
    // $ekstraksi_fitur[0]['f(6)'] = 0; $ekstraksi_fitur[1]['f(6)'] = 1;   $ekstraksi_fitur[2]['f(6)'] = 0; $ekstraksi_fitur[3]['f(6)'] = 1; $ekstraksi_fitur[4]['f(6)'] = 0;
    // $ekstraksi_fitur[0]['f(7)'] = 0; $ekstraksi_fitur[1]['f(7)'] = 0.2; $ekstraksi_fitur[2]['f(7)'] = 0; $ekstraksi_fitur[3]['f(7)'] = 0; $ekstraksi_fitur[4]['f(7)'] = 0;
    // $ekstraksi_fitur[0]['f(8)'] = 0; $ekstraksi_fitur[1]['f(8)'] = 0;   $ekstraksi_fitur[2]['f(8)'] = 0; $ekstraksi_fitur[3]['f(8)'] = 1; $ekstraksi_fitur[4]['f(8)'] = 0;
    // $ekstraksi_fitur[0]['f(9)'] = 1; $ekstraksi_fitur[1]['f(9)'] = 0.1; $ekstraksi_fitur[2]['f(9)'] = 0; $ekstraksi_fitur[3]['f(9)'] = 0; $ekstraksi_fitur[4]['f(9)'] = 0;

    $a = 1;
    for ($i=0; $i < count($ekstraksi_fitur); $i++) {
      $ekstraksi_fitur[$i]['label'] = $a;
      $a++;
    }
    //data
    echo "<div style='display:flex'>";
    echo "<div>";
    echo "<h1>Data</h1>";
    $gamma = 0.5;
    $a = 1;
    $b = 1;
    echo "<table style='border:1px solid'>";
    echo "<tr>";
    echo "<td style='border:1px solid;padding:5px'></td>";
    for ($i=0; $i < count($dataSegmentasi) ; $i++) {
      echo "<td style='border:1px solid;padding:5px'>Data ".$a."</td>";
      $a++;
    }
    "</tr>";
    for ($c=0; $c < count($ekstraksi_fitur[0])-1 ; $c++) {
    echo "<tr style='border:1px solid'>";
    echo "<td style='border:1px solid;padding:5px'>Fitur ".$b."</td>";
    for ($i=0; $i < count($dataSegmentasi) ; $i++) {
          echo "<td style='border:1px solid;padding:5px'>".$ekstraksi_fitur[$i]['f('.$b.')']."</td>";
      }
      $b++;
      echo "</tr>";
    }

    echo "<tr style='border:1px solid'>";
    echo "<td style='border:1px solid;padding:5px'>Kelas</td>";
    for ($i=0; $i < count($dataSegmentasi) ; $i++) {
          echo "<td style='border:1px solid;padding:5px'>".$ekstraksi_fitur[$i]['label']."</td>";
      }
    echo "</tr>";
    echo "</table>";
    echo "</div>";
    echo "<div style='margin-left:100px'>";
    echo "<h1>Gamma = ".$gamma."</h1>";
    echo "</div>";
  echo "</div>";

    //end data

    $iterasi = [];
    for ($a=0; $a < count($dataSegmentasi) ; $a++) {
      //iterasi
      $c = 1;

      for ($d=0; $d < count($ekstraksi_fitur[0])-1 ; $d++) {
        $e = 0;
        for ($i=0; $i < count($dataSegmentasi) ; $i++) {
              $iterasi[$a][$i][] = ($ekstraksi_fitur[$a]['f('.$c.')'] - $ekstraksi_fitur[$e]['f('.$c.')']);
              $e++;
        }
        $c++;
      }
    }

    $iterasiMutlak = [];
    $exp = [];
    for ($a=0; $a < count($iterasi) ; $a++) {
      for ($e=0; $e < count($iterasi[0]); $e++) {
        $data = 0;
        for ($f=0; $f < count($iterasi[0][0]); $f++) {
          $data = $data + pow($iterasi[$a][$e][$f],2);
        }
        $iterasiMutlak[$a][] = sqrt($data);
        $exp[$a][] = exp(-$gamma * pow(sqrt($data), 2));
      }
    }


    for ($a=0; $a < count($iterasi) ; $a++) {
      //iterasi
      $b = 1;
      echo "<div>";
      echo "<div>";
      echo "<h1>Sub Data ".($a+1)."</h1>";
      echo "<table style='border:1px solid'>";
      echo "<tr>";
      echo "<td style='border:1px solid;padding:5px'></td>";
      for ($i=0; $i < count($iterasi) ; $i++) {
        echo "<td style='border:1px solid;padding:5px;width:100px'>X".($a+1)." - X".($i+1)."</td>";
      }
      echo "</tr>";
      for ($c=0; $c < count($iterasi[0][0]) ; $c++) {
        $d = 0;
        echo "<tr style='border:1px solid'>";
        echo "<td style='border:1px solid;padding:5px'>Fitur ".$b."</td>";
        for ($i=0; $i < count($iterasi) ; $i++) {
              echo "<td style='border:1px solid;padding:5px'>".$iterasi[$a][$i][$c]."</td>";
              $d++;
        }
        $b++;
        "</tr>";
      }
        echo "</table>";
        echo "</div>";
        echo "<div style='padding-top:80px'>";
        echo "<table style='border:1px solid'>";
          echo "<tr>";
          for ($i=0; $i < count($iterasi) ; $i++) {
            echo "<td style='border:1px solid;padding:5px;width:100px;text-align:center'>||X".($a+1)." - X".($i+1)."||</td>";
          }
          echo "</tr>";
          echo "<tr>";
            for ($e=0; $e < count($iterasiMutlak[0]); $e++) {
              echo "<td style='border:1px solid;padding:5px;width:100px;text-align:center'>".$iterasiMutlak[$a][$e]."</td>";
            }
          echo "</tr>";
          echo "</table>";
          echo "<br>";
          echo "<br>";
          echo "<table style='border:1px solid'>";
            echo "<tr>";
            for ($i=0; $i < count($iterasi) ; $i++) {
              echo "<td style='border:1px solid;padding:5px;width:9%'>K(".($a+1)." , ".($i+1).")</td>";
            }
            echo "</tr>";
            echo "<tr>";
              for ($e=0; $e < count($exp[0]); $e++) {
                echo "<td style='border:1px solid;padding:5px'>".$exp[$a][$e]."</td>";
              }
            echo "</tr>";
            echo "</table>";
        echo "</div>";
      echo "</div>";
    }

    echo "<h1>Matriks K dengan kernel RBF</h1>";
    echo "<table style='border:1px solid'>";
    $kernelString = '';
    for ($a=0; $a < count($iterasi) ; $a++) {
      echo "<tr>";
        for ($e=0; $e < count($exp[0]); $e++) {
          $kernelString .= number_format($exp[$a][$e],4).',';
          echo "<td style='border:1px solid;padding:5px'>".number_format($exp[$a][$e],4)."</td>";
        }
        $kernelString = substr($kernelString,0,-1).' ';
      echo "</tr>";
    }
    echo "</table>";
    $kernelString = substr($kernelString,0,-1);

    echo "<br><br>";
    $y = [];
    $c = 1;
    for ($a=0; $a < count($dataSegmentasi); $a++) {
      for ($b=0; $b < count($dataSegmentasi); $b++) {
        if($ekstraksi_fitur[$b]['label'] == $c){
          $y[$a][] = 1;
        }else {
          $y[$a][] = -1;
        }
      }
      $c++;
    }

    $matriksY = [];
    for ($i=0; $i < count($y); $i++) {
      for ($a=0; $a < count($y) ; $a++) {
          for ($e=0; $e < count($y[0]); $e++) {
            $matriksY[$i][$a][] = ($y[$i][$a]*$y[$i][$e]);
          }
      }
    }
    for ($i=0; $i < count($dataSegmentasi); $i++) {

      $newY = '';
      for ($m=0; $m < count($y[$i]); $m++) {
        $newY .= $y[$i][$m].'.,';
      }

      $newData = shell_exec('python quadratic-programming.py '.$kernelString.' '.substr($newY,0,-1).' 2>&1');
      // $newData = shell_exec('python quadratic-programming2.py 2>&1');
      $newData = explode(',', $newData);

      echo "<h1>Untuk Kelas ".$ekstraksi_fitur[$i]['label']." jenispenelitian Y = [ ".implode(' ', $y[$i])." ]</h1>";
      echo "<div>";
        echo "<div>";
          echo "<table style='border:1px solid'>";

          $k = 1;
          $n = count($dataSegmentasi)-1;
          $v = 2;
          for ($a=0; $a < count($iterasiMutlak)-1 ; $a++) {
            echo "<tr>";
            $l = $v++;
              for ($e=1; $e < count($iterasiMutlak[0]); $e++) {
                if($e > $n){
                  echo "<td style='border:1px solid;padding:5px'></td>";
                }else {
                  echo "<td style='border:1px solid;padding:5px'>a".$k."a".$l."</td>";
                }
                $l++;
              }
            echo "</tr>";
            echo "<tr>";
            $u = 1 + $a;
              for ($e=1; $e < count($exp[0]); $e++) {
                if($e > $n){
                  echo "<td style='border:1px solid;padding:5px'></td>";
                }else {
                  echo "<td style='border:1px solid;padding:5px'>".number_format((($exp[$a][$u] + $exp[$u][$a])*$matriksY[$i][$a][$u]), 4)."</td>";
                }
                $u++;
              }
            echo "</tr>";
            $n--;
            $k++;
          }
          echo "</table>";
        echo "</div>";
        echo "<div style='display:flex'>";
          echo "<div>";
            echo "<h1>Matriks Y</h1>";
            echo "<table style='border:1px solid;'>";
            for ($a=0; $a < count($matriksY) ; $a++) {
              echo "<tr>";
                for ($e=0; $e < count($matriksY[0]); $e++) {
                  echo "<td style='border:1px solid;padding:13px'>".$matriksY[$i][$a][$e]."</td>";
                }
              echo "</tr>";
            }
            echo "</table>";
          echo "</div>";
          echo "<div style='margin-left:50px'>";
            echo "<h1>Nilai Alfa</h1>";
            echo "<table style='border:1px solid;'>";
            for ($a=0; $a < count($matriksY) ; $a++) {
              echo "<tr>";
                echo "<td style='border:1px solid;padding:13px'>".$newData[$a]."</td>";
                // for ($e=0; $e < count($matriksY[0]); $e++) {
                //   echo "<td style='border:1px solid;padding:13px'>".$matriksY[$i][$a][$e]."</td>";
                // }
              echo "</tr>";
            }
            echo "<tr>";
              echo "<td style='border:1px solid;padding:13px'>".$newData[(count($newData)-1)]."</td>";
              // for ($e=0; $e < count($matriksY[0]); $e++) {
              //   echo "<td style='border:1px solid;padding:13px'>".$matriksY[$i][$a][$e]."</td>";
              // }
            echo "</tr>";
            echo "</table>";
          echo "</div>";
          echo "</div>";
        echo "</div>";
      echo "</div>";
    }
  }
}

?>
