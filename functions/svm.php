<?php

/**
 *
 */

class Svm
{

  function init($data)
  {
    $dataFilter = Filtering::perhitungan($data);
    $dataSplitting = Spliting::perhitungan($dataFilter);
    unset($dataSplitting[0]);
    unset($dataSplitting[1]);
    unset($dataSplitting[2]);
    unset($dataSplitting[7]);
    unset($dataSplitting[8]);
    unset($dataSplitting[9]);

    $dataSplitting = array_values($dataSplitting);
    $ekstraksi_fitur = EkstraksiFitur::hasil($dataSplitting);
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
    for ($i=0; $i < count($dataSplitting) ; $i++) {
      echo "<td style='border:1px solid;padding:5px'>Data ".$a."</td>";
      $a++;
    }
    "</tr>";
    for ($c=0; $c < count($ekstraksi_fitur[0])-1 ; $c++) {
    echo "<tr style='border:1px solid'>";
    echo "<td style='border:1px solid;padding:5px'>Fitur ".$b."</td>";
    for ($i=0; $i < count($dataSplitting) ; $i++) {
          echo "<td style='border:1px solid;padding:5px'>".$ekstraksi_fitur[$i]['f('.$b.')']."</td>";
      }
      $b++;
      echo "</tr>";
    }

    echo "<tr style='border:1px solid'>";
    echo "<td style='border:1px solid;padding:5px'>Kelas</td>";
    for ($i=0; $i < count($dataSplitting) ; $i++) {
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
    for ($a=0; $a < count($dataSplitting) ; $a++) {
      //iterasi
      $c = 1;

      for ($d=0; $d < count($ekstraksi_fitur[0])-1 ; $d++) {
        $e = 0;
        for ($i=0; $i < count($dataSplitting) ; $i++) {
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
    for ($a=0; $a < count($iterasi) ; $a++) {
      echo "<tr>";
        for ($e=0; $e < count($exp[0]); $e++) {
          echo "<td style='border:1px solid;padding:5px'>".$exp[$a][$e]."</td>";
        }
      echo "</tr>";
    }
    echo "</table>";
    echo "<br><br>";
    $y = [];
    $c = 1;
    for ($a=0; $a < count($dataSplitting); $a++) {
      for ($b=0; $b < count($dataSplitting); $b++) {
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

    for ($i=0; $i < count($dataSplitting); $i++) {
      echo "<h1>Untuk Kelas ".$ekstraksi_fitur[$i]['label']." jenispenelitian Y = [ ".implode(' ', $y[$i])." ]</h1>";
      echo "<div>";
      echo "<div>";
      echo "<table style='border:1px solid'>";
      $k = 1;
      $n = count($dataSplitting)-1;
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
              echo "<td style='border:1px solid;padding:5px'>".(($exp[$a][$u] + $exp[$u][$a])*$matriksY[$i][$a][$u])."</td>";
            }
            $u++;
          }
        echo "</tr>";
        $n--;
        $k++;
      }
      echo "</table>";
      echo "</div>";
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
    echo "</div>";
    }
  }
}

?>
