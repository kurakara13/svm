<?php
  include "preprocessing/tokenizing.php";
  include "preprocessing/spliting.php";
  include "preprocessing/filtering.php";
  include "functions/config.php";

  if($_POST['page'] == 'tokenizing'){
    $data = $_POST['data'];

    Tokenizing::perhitungan($data);
  }elseif($_POST['page'] == 'pdf-to-text') {
    $target_dir = "dokumen/";
    $target_file = $target_dir . basename($_FILES["data"]["name"]);
    move_uploaded_file($_FILES["data"]["tmp_name"], $target_file);
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

    // $text = $pdf->getText();
    // $text = str_replace(array('&', '%', '$'), ' ', $text);
    // echo "<pre>".$text."<pre>";

    $pages  = $pdf->getPages();

    $text = null;

    // Loop over each page to extract text.
    $i = 0;

    foreach ($pages as $page) {
      if($i == 0){
        $text = $page->getText();
      }

      $i++;
    }

    //cek database
    $sql_cek = mysqli_query($conn, "select id from data_training where nama_file like '%".basename($_FILES["data"]["name"]."%'"));
    if (mysqli_num_rows($sql_cek) == 0){
      $sql_insert = "insert into data_training (nama_file, text) VALUES ('".basename($_FILES["data"]["name"])."', '".$text."')";
      if(mysqli_query($conn, $sql_insert)){
          echo "Data Sukses Ditambah";
      }else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }else {
      echo "Data Sudah Ada";
    }


  }elseif($_POST['page'] == 'splitting') {
    $data = $_POST['data'];

    $dataFilter = Filtering::perhitungan($data);

    $proses = Spliting::perhitungan($dataFilter);

    for ($i = 0; $i < count($proses) ; $i++) {
      echo "Word = ".$proses[$i]."<br>";
    }
    // echo "<pre>".$proses."</pre>";

  }elseif($_POST['page'] == 'filtering') {
    $data = $_POST['data'];

    $proses = Filtering::perhitungan($data);

    echo "<pre>".$proses."</pre>";

  }
 ?>
