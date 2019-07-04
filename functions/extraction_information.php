<?php
  include "preprocessing/tokenizing.php";
  include "preprocessing/segmentasi.php";
  include "preprocessing/filtering.php";
  include "ekstraksi_fitur.php";
  include "svm.php";
  include "config.php";
  include "../vendor/autoload.php";


  use \ConvertApi\ConvertApi;

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
        $segmentasi = Segmentasi::perhitungan($dataFilter);
        // $tokenizing = Tokenizing::perhitungan($segmentasi);
        // echo "<tr><td rowspan='".(count($segmentasi)+1)."'><pre>".$row['text']."</pre></td>";
        // echo "<tr>";
        for ($i=0; $i < count($segmentasi) ; $i++) {
          $tokenizing = Tokenizing::perhitungan($segmentasi[$i]);
          echo "<tr>";
          echo "<td rowspan='".ceil(count($tokenizing)/4)."'>S(".($i+1).")</td>";
          echo "<td rowspan='".ceil(count($tokenizing)/4)."'>".$segmentasi[$i]."</td>";
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
          //   echo "<td rowspan='".floor(count($tokenizing)/4)."'>S(".($i+1).")</td><td rowspan='".floor(count($tokenizing)/4)."'>".$segmentasi[$i]."</td>";
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
          //   echo "<tr><td>S(".($i+1).")</td><td>".$segmentasi[$i]."</td></tr>";
          // }
        }
        echo "<tr><td colspan='6' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }
  }elseif($_POST['page'] == 'segmentasi') {
    $data = $_POST['data'];
    $a=1;
    $query = mysqli_query($conn, "select * from data_training limit $data");
    while ($row = mysqli_fetch_array($query)){
        $dataFilter = Filtering::perhitungan($row['text']);
        $segmentasi = Segmentasi::perhitungan($dataFilter);
        echo "<tr>";
        for ($i=0; $i < count($segmentasi) ; $i++) {
          if($i == 0){
            echo "<td>S(".($i+1).")</td><td>".$segmentasi[$i]."</td></tr>";
          }else {
            echo "<tr><td>S(".($i+1).")</td><td>".$segmentasi[$i]."</td></tr>";
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
    $dataSegmentasi = Segmentasi::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::initcaps($dataSegmentasi);

    for ($i=0; $i < count($dataSegmentasi) ; $i++) {
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
    $dataSegmentasi = Segmentasi::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::allcaps($dataSegmentasi);

    for ($i=0; $i < count($dataSegmentasi) ; $i++) {
        echo "<tr><td style='text-align:center'>S(".($i+1).")</td><td>scoref2 = ".$ekstraksi_fitur[$i]['hasil']." / ".$ekstraksi_fitur[$i]['jumlahKata']." = ".number_format($ekstraksi_fitur[$i]['hasil']/$ekstraksi_fitur[$i]['jumlahKata'],2)." </td></tr>";
      }

      echo "<tr><td colspan='2' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'containsdigit') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    $a = 1;
    while($row = mysqli_fetch_array($query)){
    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSegmentasi = Segmentasi::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::containsdigit($dataSegmentasi);

    for ($i=0; $i < count($dataSegmentasi) ; $i++) {
        echo "<tr><td style='text-align:center'>S(".($i+1).")</td><td>scoref3 = ".$ekstraksi_fitur[$i]['hasil']." / ".$ekstraksi_fitur[$i]['jumlahKata']." = ".number_format($ekstraksi_fitur[$i]['hasil']/$ekstraksi_fitur[$i]['jumlahKata'],2)." </td></tr>";
      }

      echo "<tr><td colspan='2' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'alldigit') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    $a = 1;
    while($row = mysqli_fetch_array($query)){
    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSegmentasi = Segmentasi::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::alldigit($dataSegmentasi);

    for ($i=0; $i < count($dataSegmentasi) ; $i++) {
        echo "<tr><td style='text-align:center'>S(".($i+1).")</td><td>scoref4 = ".$ekstraksi_fitur[$i]['hasil']." / ".$ekstraksi_fitur[$i]['jumlahKata']." = ".number_format($ekstraksi_fitur[$i]['hasil']/$ekstraksi_fitur[$i]['jumlahKata'],2)." </td></tr>";
      }

      echo "<tr><td colspan='2' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'lowercase') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    $a = 1;
    while($row = mysqli_fetch_array($query)){
    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSegmentasi = Segmentasi::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::lowercase($dataSegmentasi);

    for ($i=0; $i < count($dataSegmentasi) ; $i++) {
        echo "<tr><td style='text-align:center'>S(".($i+1).")</td><td>scoref6 = ".$ekstraksi_fitur[$i]['hasil']." / ".$ekstraksi_fitur[$i]['jumlahKata']." = ".number_format($ekstraksi_fitur[$i]['hasil']/$ekstraksi_fitur[$i]['jumlahKata'],2)." </td></tr>";
      }

      echo "<tr><td colspan='2' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'punctuation') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    $a = 1;
    while($row = mysqli_fetch_array($query)){
    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSegmentasi = Segmentasi::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::punctuation($dataSegmentasi);

    for ($i=0; $i < count($dataSegmentasi) ; $i++) {
        echo "<tr><td style='text-align:center'>S(".($i+1).")</td><td>scoref7 = ".$ekstraksi_fitur[$i]['hasil']." / ".$ekstraksi_fitur[$i]['jumlahKata']." = ".number_format($ekstraksi_fitur[$i]['hasil']/$ekstraksi_fitur[$i]['jumlahKata'],2)." </td></tr>";
      }

      echo "<tr><td colspan='2' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'containsdots') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    $a = 1;
    while($row = mysqli_fetch_array($query)){
    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSegmentasi = Segmentasi::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::containsdots($dataSegmentasi);

    for ($i=0; $i < count($dataSegmentasi) ; $i++) {
        echo "<tr><td style='text-align:center'>S(".($i+1).")</td><td>scoref5 = ".$ekstraksi_fitur[$i]['hasil']." / ".$ekstraksi_fitur[$i]['jumlahKata']." = ".number_format($ekstraksi_fitur[$i]['hasil']/$ekstraksi_fitur[$i]['jumlahKata'],2)." </td></tr>";
      }

      echo "<tr><td colspan='2' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'eightdigit') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    $a = 1;
    while($row = mysqli_fetch_array($query)){
    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSegmentasi = Segmentasi::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::eightdigit($dataSegmentasi);

    for ($i=0; $i < count($dataSegmentasi) ; $i++) {
        echo "<tr><td style='text-align:center'>S(".($i+1).")</td><td>scoref8 = ".$ekstraksi_fitur[$i]['hasil']." / ".$ekstraksi_fitur[$i]['jumlahKata']." = ".number_format($ekstraksi_fitur[$i]['hasil']/$ekstraksi_fitur[$i]['jumlahKata'],2)." </td></tr>";
      }

      echo "<tr><td colspan='2' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'word') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    $a = 1;
    while($row = mysqli_fetch_array($query)){
    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSegmentasi = Segmentasi::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::word($dataSegmentasi);

    for ($i=0; $i < count($dataSegmentasi) ; $i++) {
        echo "<tr><td style='text-align:center'>S(".($i+1).")</td><td>scoref9 = ".$ekstraksi_fitur[$i]['hasil']." / ".$ekstraksi_fitur[$i]['jumlahKata']." = ".number_format($ekstraksi_fitur[$i]['hasil']/$ekstraksi_fitur[$i]['jumlahKata'],2)." </td></tr>";
      }

      echo "<tr><td colspan='2' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'linestart') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    $a = 1;
    while($row = mysqli_fetch_array($query)){
    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSegmentasi = Segmentasi::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::linestart($dataSegmentasi);

    for ($i=0; $i < count($dataSegmentasi) ; $i++) {
        echo "<tr><td style='text-align:center'>S(".($i+1).")</td><td style='text-align:center'>scoref10 = ".$ekstraksi_fitur[$i]['hasil']." </td></tr>";
      }

      echo "<tr><td colspan='2' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'lineend') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    $a = 1;
    while($row = mysqli_fetch_array($query)){
    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSegmentasi = Segmentasi::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::lineend($dataSegmentasi);

    for ($i=0; $i < count($dataSegmentasi) ; $i++) {
        echo "<tr><td style='text-align:center'>S(".($i+1).")</td><td style='text-align:center'>scoref12 = ".$ekstraksi_fitur[$i]['hasil']." </td></tr>";
      }

      echo "<tr><td colspan='2' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'line') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    $a = 1;
    while($row = mysqli_fetch_array($query)){
    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSegmentasi = Segmentasi::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::line($dataSegmentasi);

    for ($i=0; $i < count($dataSegmentasi) ; $i++) {
        echo "<tr><td style='text-align:center'>S(".($i+1).")</td><td>scoref13 = ".$ekstraksi_fitur[$i]['hasil']." / ".$ekstraksi_fitur[$i]['jumlahKata']." = ".number_format($ekstraksi_fitur[$i]['hasil']/$ekstraksi_fitur[$i]['jumlahKata'],2)." </td></tr>";
      }

      echo "<tr><td colspan='2' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'linein') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    $a = 1;
    while($row = mysqli_fetch_array($query)){
    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSegmentasi = Segmentasi::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::linein($dataSegmentasi);

    for ($i=0; $i < count($dataSegmentasi) ; $i++) {
        echo "<tr><td style='text-align:center'>S(".($i+1).")</td><td style='text-align:center'>scoref11 = ".$ekstraksi_fitur[$i]['hasil']." </td></tr>";
      }

      echo "<tr><td colspan='2' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'year') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    $a = 1;
    while($row = mysqli_fetch_array($query)){
    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSegmentasi = Segmentasi::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::year($dataSegmentasi);

    for ($i=0; $i < count($dataSegmentasi) ; $i++) {
        echo "<tr><td style='text-align:center'>S(".($i+1).")</td><td>scoref14 = ".$ekstraksi_fitur[$i]['hasil']." / ".$ekstraksi_fitur[$i]['jumlahKata']." = ".number_format($ekstraksi_fitur[$i]['hasil']/$ekstraksi_fitur[$i]['jumlahKata'],2)." </td></tr>";
      }

      echo "<tr><td colspan='2' style='text-align:center'>Dokumen ".($a++)."</td></tr>";
    }

  }elseif($_POST['page'] == 'hasil') {
    $data = $_POST['data'];

    $query = mysqli_query($conn, "select * from data_training limit $data");
    $a = 1;
    $b = 1;
    $z=2;
    while($row = mysqli_fetch_array($query)){
    $dataFilter = Filtering::perhitungan($row['text']);
    $dataSegmentasi = Segmentasi::perhitungan($dataFilter);
    $ekstraksi_fitur = EkstraksiFitur::hasil($dataSegmentasi);
    for ($i=0; $i < count($dataSegmentasi) ; $i++) {
        echo "<tr>
                <td>S(".($z).")</td>
                <td>".$ekstraksi_fitur[$i]['f(1)']."</td>
                <td>".$ekstraksi_fitur[$i]['f(2)']."</td>
                <td>".$ekstraksi_fitur[$i]['f(3)']."</td>
                <td>".$ekstraksi_fitur[$i]['f(4)']."</td>
                <td>".$ekstraksi_fitur[$i]['f(5)']."</td>
                <td>".$ekstraksi_fitur[$i]['f(6)']."</td>
                <td>".$ekstraksi_fitur[$i]['f(7)']."</td>
                <td>".$ekstraksi_fitur[$i]['f(8)']."</td>
                <td>".$ekstraksi_fitur[$i]['f(9)']."</td>
                <td>".$ekstraksi_fitur[$i]['f(10)']."</td>
                <td>".$ekstraksi_fitur[$i]['f(11)']."</td>
                <td>".$ekstraksi_fitur[$i]['f(12)']."</td>
                <td>".$ekstraksi_fitur[$i]['f(13)']."</td>
                <td>".$ekstraksi_fitur[$i]['f(14)']."</td>
              </tr>";
        $a++;
        $z++;
      }
      echo "<tr><td colspan='15' style='text-align:center'>Dokumen ".($b++)."</td></tr>";
  }

  }elseif($_POST['page'] == 'test') {

    // phpinfo();

    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);

    // $test = shell_exec('python quadratic-programming.py 2>&1');
    // if($test){
    //     var_dump($test);
    // }else{
    //   var_dump($test);
    // }

    // exec('python | runas /user:administrator test.py',$output);
    // var_dump($output);

    // exec("python test.py", $output, $return_var);
    // exec('python test.py', $output, $return_var);
    //
    // var_dump($output, $return_var);
    //
    // echo system('ls');

    // putenv('PATH=' . $_SERVER['PATH']);
    // phpinfo(INFO_ENVIRONMENT);
    // var_dump($_SERVER['PATH']);
    //quadratic-programming
    // $kernel = '1,0.17377394,0.60653066,0.03019738,0.082085 0.17377394,1,0.25924026,0.23457029,0.23457029 0.60653066,0.25924026,1,0.04978707,0.13533528 0.03019738,0.23457029,0.04978707,1,0.36787944 0.082085,0.23457029,0.13533528,0.36787944,1';
    // exec('python quadratic-programming.py '.$kernel.' 1,-1,-1,-1,-1 5 2>&1',$output);

    // var_dump($output);
    // echo "<br><br>";

    $query = mysqli_query($conn, "select * from data_training limit 1");
    $row = mysqli_fetch_array($query);

    // $myfile = fopen("../documentText/1.10113279_GREEN+GRANDIS_COVER.txt", "r") or die("Unable to open file!");
    // $txt = fread($myfile,filesize("../documentText/1.10113279_GREEN+GRANDIS_COVER.txt"));
    // echo "<pre>".$txt."</pre>";
    // fclose($myfile);

    // ConvertApi::setApiSecret('0nI6WMopSCVO3dBS');
    //
    // $result = ConvertApi::convert('txt', [
    //     'File' => '../dokumen/1.10113279_GREEN GRANDIS_COVER.pdf',
    //     ], 'pdf'
    // );
    //
    // $result->saveFiles('../documentText');

    // $data = array(
    //     array(-1, 1 => 0.43, 3 => 0.12, 9284 => 0.2),
    //     array(1, 1 => 0.22, 5 => 0.01, 94 => 0.11),
    // );
    //
    // $svm = new SVM();
    // $model = $svm->train($data);
    echo SVM::init($row['text']);

  }
 ?>
