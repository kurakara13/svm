<?php

include "functions/config.php";

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#333">
    <title>Ekstraksi Informasi</title>
    <meta name="description" content="Material Style Theme">
    <link rel="shortcut icon" href="assets/img/favicon.png?v=3">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="assets/css/preload.min.css">
    <link rel="stylesheet" href="assets/css/plugins.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.material.min.css">
    <link rel="stylesheet" href="assets/css/style.light-blue-500.min.css">
    <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div id="ms-preload" class="ms-preload">
      <div id="status">
        <div class="spinner">
          <div class="dot1"></div>
          <div class="dot2"></div>
        </div>
      </div>
    </div>
    <div class="ms-site-container">
      <nav class="navbar navbar-expand-md  navbar-static ms-navbar ms-navbar-primary navbar-mode" style="height:70px">
        <div class="container container-full">
          <div class="navbar-header">
            <a class="navbar-brand" href="index.html">
              <!-- <img src="assets/img/demo/logo-navbar.png" alt=""> -->
              <span class="ms-logo ms-logo-md" style="font-size:20px">SVM</span>
              <span class="ms-title">SupportVector
                <strong>Machine</strong>
              </span>
            </a>
          </div>
        </div>
        <!-- container -->
      </nav>
      <div class="material-background"></div>
      <div class="container-fluid">
        <div class="ms-paper">
          <div class="row">
            <div class="col-lg-3 ms-paper-menu-left-container">
              <div class="ms-paper-menu-left">
                <h3 class="ms-paper-menu-title">
                  <i class="zmdi zmdi-apps"></i> Menu
                  <a role="button" data-toggle="collapse" href="#collapseMenu" aria-expanded="false" aria-controls="collapseMenu" class="withripple">
                    <i class="zmdi zmdi-menu"></i>
                  </a>
                </h3>
                <div class="panel-menu collapse">
                  <ul class="panel-group ms-collapse-nav nav" style="display:contents" role="tablist" aria-multiselectable="true">
                    <li>
                      <a class="withripple active" href="#home" aria-controls="home" role="tab" data-toggle="tab">
                        <i class="fa fa-font"></i> Testing
                      </a>
                    </li>
                    <hr>
                    <li>
                      <a class="withripple" href="#data-training" aria-controls="data-training" role="tab" data-toggle="tab">
                        <i class="fa fa-font"></i> Data Training
                      </a>
                    </li>
                    <li>
                      <a class="withripple" href="">
                        <i class="fa fa-font"></i> Training
                      </a>
                    </li>
                    <li>
                      <a class="withripple" href="">
                        <i class="fa fa-font"></i> Statistic
                      </a>
                    </li>
                    <li>
                      <a class="withripple" href="#filtering" aria-controls="filtering" role="tab" data-toggle="tab">
                        <i class="fa fa-font"></i> Filtering
                      </a>
                    </li>
                    <li>
                      <a class="withripple" href="#splitting" aria-controls="splitting" role="tab" data-toggle="tab">
                        <i class="fa fa-font"></i> Splitting
                      </a>
                    </li>
                    <li>
                      <a class="withripple"  href="#tokenizing" aria-controls="tokenizing" role="tab" data-toggle="tab">
                        <i class="fa fa-font"></i> Tokenizing
                      </a>
                    </li>
                  </ul>
                  <!-- ms-collapse-nav -->
                </div>
              </div>
            </div>
            <!-- col-lg-3 -->
            <div class="col-lg-9 ms-paper-content-container tab-content">
              <div class="ms-paper-content tab-pane fade active show" role="tabpanel" id="home">
                <h1>Testing</h1>
                <section class="ms-component-section">
                  <div class="row">
                    <div class="col-md-12">
                      <h2 class="section-title no-margin-top">Data</h2>
                      <div class="card">
                        <div class="card-block">
                          <textarea class="form-control" rows="10" id="textArea"></textarea>
                          <span class="help-block">Masukan teks yang akan di Ekstraksi</span>
                          <a href="javascript:void(0)" class="btn btn-primary btn-raised pull-right">
                            <i class="zmdi zmdi-flower"></i> Ekstraksi Teks</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <h2 class="section-title no-margin-top">Hasil</h2>
                      <div class="card">
                        <div class="card-block">
                          <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                              <colgroup>
                                <col class="col-xs-1">
                                <col class="col-xs-7"> </colgroup>
                              <thead>
                                <tr>
                                  <th>Class</th>
                                  <th>Description</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td> <code>.active</code> </td>
                                  <td>Applies the hover color to a particular row or cell</td>
                                </tr>
                                <tr>
                                  <td> <code>.success</code> </td>
                                  <td>Indicates a successful or positive action</td>
                                </tr>
                                <tr>
                                  <td> <code>.info</code> </td>
                                  <td>Indicates a neutral informative change or action</td>
                                </tr>
                                <tr>
                                  <td> <code>.warning</code> </td>
                                  <td>Indicates a warning that might need attention</td>
                                </tr>
                                <tr>
                                  <td> <code>.danger</code> </td>
                                  <td>Indicates a dangerous or potentially negative action</td>
                                </tr>
                                <tr>
                                  <td> <code>.royal</code> </td>
                                  <td>Indicates a special informative change or action</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </div>

              <!-- data training -->
              <div class="ms-paper-content tab-pane fade" role="tabpanel" id="data-training">
                <h1>Data Training</h1>
                <hr>
                <section class="ms-component-section">
                  <div class="row">
                    <div class="col-md-12">
                      <h2 class="section-title no-margin-top">Data</h2>
                      <div class="card">
                        <div class="card-block">
                          <form id="form-pdf-to-text" enctype="multipart/form-data">
                            <input type="hidden" name="page" value="pdf-to-text">

                            <input type="file" name="data" id="input-data">
                            <div class="row">
                              <div class="col-sm-6">
                                <div class="col-sm-12">
                                  <label>Pilih Tahun</label>
                                  <select name="tipe" class="form-control" style="height:50px" required>
                                    <option value="">-Pilih Tipe-</option>
                                    <option value="sampul">Sampul</option>
                                    <option value="abstrak">Abstrak</option>
                                  </select>
                                </div>
                                <div class="col-sm-12">
                                  <label>Pilih Tahun</label>
                                  <select name="tahun" class="form-control" style="height:50px" required>
                                    <option value="">-Pilih Tahun-</option>
                                    <option value="2018">2018</option>
                                    <option value="2013">2013</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <h2>Data</h2>
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th>2018</th>
                                      <th>2013</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php $query = mysqli_query($conn, "select COUNT(case when tahun = '2018' then 1 else null end) DIV 2 as '2018', COUNT(case when tahun = '2013' then 1 else null end) DIV 2 as '2013' from data_training"); ?>
                                    <?php while ($row = mysqli_fetch_array($query)){ ?>
                                      <tr>
                                        <td>Tinggal <?php echo 40-$row['2018']; ?> lagi</td>
                                        <td>Tinggal <?php echo 40-$row['2013']; ?> lagi</td>
                                      </tr>
                                    <?php } ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <br><span class="help-block">Upload dokumen yang akan di Ekstraksi</span>
                            <button class="btn btn-primary btn-raised pull-right">
                              <i class="zmdi zmdi-flower"></i> Submit
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <h2 class="section-title no-margin-top">Tabel Data</h2>
                      <hr>
                      <table id="example" class="mdl-data-table table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Text</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php $index = 1; ?>
                          <?php $query = mysqli_query($conn, "select * from data_training"); ?>
                          <?php while ($row = mysqli_fetch_array($query)){ ?>
                            <tr>
                                <td><?php echo $index++; ?></td>
                                <td>
                                  <pre><?php echo $row['text']; ?></pre>
                                </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </section>
              </div>

              <!-- filtering -->
              <div class="ms-paper-content tab-pane fade" role="tabpanel" id="filtering">
                <h1>Filtering</h1>
                <section class="ms-component-section">
                  <div class="row">
                    <div class="col-md-12">
                      <h2 class="section-title no-margin-top">Data</h2>
                      <div class="card">
                        <div class="card-block">
                          <form id="form-filtering" action="extraction_information.php" method="post">
                            <input type="hidden" name="page" value="filtering">
                            <textarea class="form-control" name="data" rows="10" id="input-filtering"></textarea>
                            <span class="help-block">Masukan teks yang akan di Filtering</span>
                            <button class="btn btn-primary btn-raised pull-right">
                              <i class="zmdi zmdi-flower"></i> Filtering Teks
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <h2 class="section-title no-margin-top">Hasil</h2>
                      <div class="card">
                        <div class="card-block" id="hasil-filtering">
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </div>

              <!-- splitting -->
              <div class="ms-paper-content tab-pane fade" role="tabpanel" id="splitting">
                <h1>Splitting</h1>
                <section class="ms-component-section">
                  <div class="row">
                    <div class="col-md-12">
                      <h2 class="section-title no-margin-top">Data</h2>
                      <div class="card">
                        <div class="card-block">
                          <form id="form-splitting" action="extraction_information.php" method="post">
                            <input type="hidden" name="page" value="splitting">
                            <textarea class="form-control" name="data" rows="10" id="input-splitting"></textarea>
                            <span class="help-block">Masukan teks yang akan di Ekstraksi</span>
                            <button class="btn btn-primary btn-raised pull-right">
                              <i class="zmdi zmdi-flower"></i> Splitting Teks
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <h2 class="section-title no-margin-top">Hasil</h2>
                      <div class="card">
                        <div class="card-block" id="hasil-splitting">
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </div>


              <!-- Tokenizing -->
              <div class="ms-paper-content tab-pane fade" role="tabpanel" id="tokenizing">
                <h1>Tokenizing</h1>
                <section class="ms-component-section">
                  <div class="row">
                    <div class="col-md-12">
                      <h2 class="section-title no-margin-top">Data</h2>
                      <div class="card">
                        <div class="card-block">
                          <form id="form-tokenizing">
                            <input type="hidden" name="page" value="tokenizing">
                            <textarea class="form-control" name="data" rows="10" id="input-tokenizing"></textarea>
                            <span class="help-block">Masukan teks yang akan di Ekstraksi</span>
                            <button class="btn btn-primary btn-raised pull-right">
                              <i class="zmdi zmdi-flower"></i> Tokenizing Teks
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <h2 class="section-title no-margin-top">Hasil</h2>
                      <div class="card">
                        <div class="card-block" id="hasil-tokenizing">
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </div>

            </div>
          </div>
          <!-- ms-paper-content -->
        </div>
        <!-- col-lg-9 -->
      </div>
      <!-- row -->
    </div>

    <script src="assets/js/plugins.min.js"></script>
    <script src="assets/plugins/datatable/datatables.js"></script>
    <script src="assets/js/app.min.js"></script>
  </body>
</html>
<script>

$(document).ready(function() {
    $('#example').DataTable();
} );

var request;

$("#form-pdf-to-text").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'extraction_information.php',
        type: 'POST',
        data: formData,
        success: function (data) {
            // $('#hasil-pdf-to-text').html(data);
            alert(data);
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

$("#form-tokenizing").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'extraction_information.php',
        type: 'POST',
        data: formData,
        success: function (data) {
            $('#hasil-tokenizing').html(data);
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

$("#form-splitting").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'extraction_information.php',
        type: 'POST',
        data: formData,
        success: function (data) {
            console.log(data);
            $('#hasil-splitting').html(data);
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

$("#form-filtering").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'extraction_information.php',
        type: 'POST',
        data: formData,
        success: function (data) {
            console.log(data);
            $('#hasil-filtering').html(data);
        },
        cache: false,
        contentType: false,
        processData: false
    });
});
</script>
<style>
div.dataTables_wrapper div.dataTables_filter {
    text-align: right;
    float: right;
}

div.dataTables_wrapper div.dataTables_length {
    float: left;
}
</style>
