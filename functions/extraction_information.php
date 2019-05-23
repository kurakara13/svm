<?php
  include "preprocessing/tokenizing.php";
  include "preprocessing/spliting.php";
  include "preprocessing/filtering.php";
  include "ekstraksi_fitur.php";
  include "config.php";

  if($_POST['page'] == 'image-to-text') {
    $target_dir = "../dokumen/";
    $target_file = $target_dir . basename($_FILES["data"]["name"]);
    move_uploaded_file($_FILES["data"]["tmp_name"], $target_file);
    // echo "<h3>Image Upload Success</h3>";
    // echo '<img src="'.$target_file.'" style="width:100%">';
    //
    // shell_exec('"C:\Program Files (x86)\Tesseract-OCR\tesseract" "C:\xampp\htdocs\svm\dokumen\\'.$target_file.'" out');
    //
    // echo "<br><h3>OCR after reading</h3><br><pre>";
    //
    // $myfile = fopen("out.txt", "r") or die("Unable to open file!");
    // $text = fread($myfile,filesize("out.txt"));
    // echo $text;
    // fclose($myfile);
    // echo "</pre>";

    //
    // $a = new PDF2Text();
    // $a->setFilename($target_file);
    // $a->decodePDF();
    // $data = $a->output();
    // echo "<pre>".$data."</pre>";

    // Include Composer autoloader if not already done.
    include 'pdfparser-master/vendor/autoload.php';

    // Parse pdf file and build necessary objects.
    $parser = new \Smalot\PdfParser\Parser();
    $pdf    = $parser->parseFile($target_file);

    $text = $pdf->getText();
    // $text = str_replace(array('&', '%', '$'), ' ', $text);
    // echo "<pre>".$text."<pre>";

    // $pages  = $pdf->getPages();

    // $text = null;

    // Loop over each page to extract text.
    // $i = 0;

    // foreach ($pages as $page) {
    //   if($i == 0){
    //     $text = $page->getText();
    //   }
    //
    //   $i++;
    // }

    //cek database
    $sql_cek = mysqli_query($conn, "select id from data_training where nama_file like '%".basename($_FILES["data"]["name"]."%' and type = '".$_POST['tipe']."' and tahun = '".$_POST['tahun']."'"));
    if (mysqli_num_rows($sql_cek) == 0){
      $sql_insert = "insert into data_training (nama_file, text, type, tahun) VALUES ('".basename($_FILES["data"]["name"])."', '".$text."', '".$_POST['tipe']."', '".$_POST['tahun']."')";
      if(mysqli_query($conn, $sql_insert)){
          echo "Data Sukses Ditambah";
      }else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }else {
      echo "Data Sudah Ada";
    }


  }

  // ekstraksi fitur

  elseif($_POST['page'] == 'tokenizing'){
    $data = $_POST['data'];
    $a=1;
    $query = mysqli_query($conn, "select * from data_training limit $data");
    while ($row = mysqli_fetch_array($query)){
        $dataFilter = Filtering::perhitungan($row['text']);
        $splitting = Spliting::perhitungan($dataFilter);
        // $tokenizing = Tokenizing::perhitungan($splitting);
        // echo "<tr><td rowspan='".(count($splitting)+1)."'><pre>".$row['text']."</pre></td>";
        // echo "<tr>";
        for ($i=0; $i < count($splitting) ; $i++) {
          $tokenizing = Tokenizing::perhitungan($splitting[$i]);
          echo "<tr>";
          echo "<td rowspan='".ceil(count($tokenizing)/4)."'>S(".($i+1).")</td>";
          echo "<td rowspan='".ceil(count($tokenizing)/4)."'>".$splitting[$i]."</td>";
          $d = 0;
            for ($c=0; $c < count($tokenizing); $c++) {
              $baru = $c;
              // echo "<td>".($baru+1)."</td>";
              if(($baru+1) % 4 != 0){
                $d++;
                echo "<td>".$tokenizing[$c]."</td>";
              }else {
                $d++;
                echo "<td>".$tokenizing[$c]."</td>";
                echo "</tr><tr>";
                $d = 0;
              }
            }

            for ($x=0; $x < (4-$d); $x++) {
              echo "<td></td>";
              // code...
            }
            echo "</tr>";
          // if($i == 0){
          //   echo "<td rowspan='".floor(count($tokenizing)/4)."'>S(".($i+1).")</td><td rowspan='".floor(count($tokenizing)/4)."'>".$splitting[$i]."</td>";
          //   for ($c=0; $c < count($tokenizing); $c++) {
          //     if(($i % 4) == 0){
          //       echo "<td>".$tokenizing[$c]."</td>";
          //       // code...
          //     }else {
          //       echo "</tr><tr><td>".$tokenizing[$c]."</td>";
          //       // code...
          //     }
          //     if($i == (count($tokenizing) -1)){
          //       echo "</tr>";
          //     }
          //   }
          // }else {
          //   echo "<tr><td>S(".($i+1).")</td><td>".$splitting[$i]."</td></tr>";
          // }
        }
        echo "<tr><td colspan='6' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }
  }elseif($_POST['page'] == 'splitting') {
    $data = $_POST['data'];
    $a=1;
    $query = mysqli_query($conn, "select * from data_training where type = 'sampul' limit $data");
    while ($row = mysqli_fetch_array($query)){
        $dataFilter = Filtering::perhitungan($row['text']);
        $splitting = Spliting::perhitungan($dataFilter);
        echo "<tr><td rowspan='".(count($splitting)+1)."'><pre>".$row['text']."</pre></td>";
        for ($i=0; $i < count($splitting) ; $i++) {
          if($i == 0){
            echo "<td>S(".($i+1).")</td><td>".$splitting[$i]."</td></tr>";
          }else {
            echo "<tr><td>S(".($i+1).")</td><td>".$splitting[$i]."</td></tr>";
          }
        }
        echo "<tr><td colspan='3' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'filtering') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    while ($row = mysqli_fetch_array($query)){
        echo "<tr><td><pre>".$row['text']."</pre></td><td><pre>".Filtering::perhitungan($row['text'])."</pre></td></tr>";
    }
  }

  // ekstraksi fitur

  elseif($_POST['page'] == 'initcaps') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    $a = 1;
    while($row = mysqli_fetch_array($query)){
    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSplitting = Spliting::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::initcaps($dataSplitting);

    for ($i=0; $i < count($dataSplitting) ; $i++) {
        echo "<tr><td style='text-align:center'>S(".($i+1).")</td><td>scoref1 = ".$ekstraksi_fitur[$i]['hasil']." / ".$ekstraksi_fitur[$i]['jumlahKata']." = ".number_format($ekstraksi_fitur[$i]['hasil']/$ekstraksi_fitur[$i]['jumlahKata'],2)." </td></tr>";
      }

      echo "<tr><td colspan='2' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'allcaps') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    $a = 1;
    while($row = mysqli_fetch_array($query)){
    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSplitting = Spliting::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::allcaps($dataSplitting);

    for ($i=0; $i < count($dataSplitting) ; $i++) {
        echo "<tr><td style='text-align:center'>S(".($i+1).")</td><td>scoref1 = ".$ekstraksi_fitur[$i]['hasil']." / ".$ekstraksi_fitur[$i]['jumlahKata']." = ".number_format($ekstraksi_fitur[$i]['hasil']/$ekstraksi_fitur[$i]['jumlahKata'],2)." </td></tr>";
      }

      echo "<tr><td colspan='2' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'containsdigit') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    $a = 1;
    while($row = mysqli_fetch_array($query)){
    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSplitting = Spliting::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::containsdigit($dataSplitting);

    for ($i=0; $i < count($dataSplitting) ; $i++) {
        echo "<tr><td style='text-align:center'>S(".($i+1).")</td><td>scoref1 = ".$ekstraksi_fitur[$i]['hasil']." / ".$ekstraksi_fitur[$i]['jumlahKata']." = ".number_format($ekstraksi_fitur[$i]['hasil']/$ekstraksi_fitur[$i]['jumlahKata'],2)." </td></tr>";
      }

      echo "<tr><td colspan='2' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'alldigit') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    $a = 1;
    while($row = mysqli_fetch_array($query)){
    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSplitting = Spliting::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::alldigit($dataSplitting);

    for ($i=0; $i < count($dataSplitting) ; $i++) {
        echo "<tr><td style='text-align:center'>S(".($i+1).")</td><td>scoref1 = ".$ekstraksi_fitur[$i]['hasil']." / ".$ekstraksi_fitur[$i]['jumlahKata']." = ".number_format($ekstraksi_fitur[$i]['hasil']/$ekstraksi_fitur[$i]['jumlahKata'],2)." </td></tr>";
      }

      echo "<tr><td colspan='2' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'lowercase') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    $a = 1;
    while($row = mysqli_fetch_array($query)){
    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSplitting = Spliting::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::lowercase($dataSplitting);

    for ($i=0; $i < count($dataSplitting) ; $i++) {
        echo "<tr><td style='text-align:center'>S(".($i+1).")</td><td>scoref1 = ".$ekstraksi_fitur[$i]['hasil']." / ".$ekstraksi_fitur[$i]['jumlahKata']." = ".number_format($ekstraksi_fitur[$i]['hasil']/$ekstraksi_fitur[$i]['jumlahKata'],2)." </td></tr>";
      }

      echo "<tr><td colspan='2' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'punctuation') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    $a = 1;
    while($row = mysqli_fetch_array($query)){
    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSplitting = Spliting::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::punctuation($dataSplitting);

    for ($i=0; $i < count($dataSplitting) ; $i++) {
        echo "<tr><td style='text-align:center'>S(".($i+1).")</td><td>scoref1 = ".$ekstraksi_fitur[$i]['hasil']." / ".$ekstraksi_fitur[$i]['jumlahKata']." = ".number_format($ekstraksi_fitur[$i]['hasil']/$ekstraksi_fitur[$i]['jumlahKata'],2)." </td></tr>";
      }

      echo "<tr><td colspan='2' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'containsdots') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    $a = 1;
    while($row = mysqli_fetch_array($query)){
    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSplitting = Spliting::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::containsdots($dataSplitting);

    for ($i=0; $i < count($dataSplitting) ; $i++) {
        echo "<tr><td style='text-align:center'>S(".($i+1).")</td><td>scoref1 = ".$ekstraksi_fitur[$i]['hasil']." / ".$ekstraksi_fitur[$i]['jumlahKata']." = ".number_format($ekstraksi_fitur[$i]['hasil']/$ekstraksi_fitur[$i]['jumlahKata'],2)." </td></tr>";
      }

      echo "<tr><td colspan='2' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'eightdigit') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    $a = 1;
    while($row = mysqli_fetch_array($query)){
    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSplitting = Spliting::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::eightdigit($dataSplitting);

    for ($i=0; $i < count($dataSplitting) ; $i++) {
        echo "<tr><td style='text-align:center'>S(".($i+1).")</td><td>scoref1 = ".$ekstraksi_fitur[$i]['hasil']." / ".$ekstraksi_fitur[$i]['jumlahKata']." = ".number_format($ekstraksi_fitur[$i]['hasil']/$ekstraksi_fitur[$i]['jumlahKata'],2)." </td></tr>";
      }

      echo "<tr><td colspan='2' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'word') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    $a = 1;
    while($row = mysqli_fetch_array($query)){
    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSplitting = Spliting::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::word($dataSplitting);

    for ($i=0; $i < count($dataSplitting) ; $i++) {
        echo "<tr><td>".$dataSplitting[$i]."</td><td>scoref1 = ".$ekstraksi_fitur[$i]['hasil']." / ".$ekstraksi_fitur[$i]['jumlahKata']." = ".number_format($ekstraksi_fitur[$i]['hasil']/$ekstraksi_fitur[$i]['jumlahKata'],2)." </td></tr>";
      }

      echo "<tr><td colspan='2' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'test') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training where id = 59");
    $row = mysqli_fetch_array($query);
    // $replace = '';
    // $search = array("\t","\n");
    // $word = str_replace($search, $replace, $row['text']);
    // $data = explode(' ', $word);
    // echo "<table><tr><th>Kata</th><th></th><th>Hasil</th></tr>";
    // for ($i=0; $i < count($data) ; $i++) {
    //   echo "<tr><td>".$data[$i]."</td><td>-</td><td>".ctype_lower($data[$i])."</td></tr>";
    // }
    //
    // echo "</table>";

    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSplitting = Spliting::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::line($dataSplitting);
    echo "<table>";
            "<tr>
              <td rowspan='".(count($dataSplitting)+1)."'><pre>".$row['text']."</pre></td>
              <td colspan='2'>Hasil</td>
            </tr>";
    // // // echo '<pre>'.$row['text'].'</pre>';
    for ($i=0; $i < count($dataSplitting) ; $i++) {
    //   // echo $dataSplitting[$i]."<br>";
      echo "<tr><td style='border:1px solid'> ".$dataSplitting[$i]." </td><td style='text-align:center;border:1px solid'>S(".($i+1).")</td><td style='border:1px solid'>scoref1 = ".$ekstraksi_fitur[$i]['hasil']." / ".$ekstraksi_fitur[$i]['jumlahKata']." = ".number_format($ekstraksi_fitur[$i]['hasil']/$ekstraksi_fitur[$i]['jumlahKata'],2)." </td></tr>";
    //   // echo "<tr><td style='text-align:center'>S(".($i+1).")</td><td>".$dataSplitting[$i]." </td></tr>";
    }
    // echo "</table>";

  }
 ?>