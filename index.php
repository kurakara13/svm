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
      <div class="container container-full">
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
                <div class="panel-menu collapse" id="collapseMenu">
                  <ul class="panel-group ms-collapse-nav" id="components-nav" role="tablist" aria-multiselectable="true">
                    <li>
                      <a class="withripple" href="">
                        <i class="fa fa-font"></i> Testing</a>
                    </li>
                    <li class="card" role="tab" id="e1">
                      <a role="button" data-toggle="collapse" data-parent="#components-nav" href="#c1" aria-expanded="true" aria-controls="c1" class="collapsed withripple">
                        <i class="fa fa-bold"></i> Training</a>
                      <ul id="c1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="e1">
                        <li>
                          <a class="withripple" href="component-typography.html">
                            <i class="fa fa-font"></i> Training Data</a>
                        </li>
                        <li>
                          <a class="withripple" href="component-headers.html">
                            <i class="fa fa-header"></i> Statistic</a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  <!-- ms-collapse-nav -->
                </div>
              </div>
            </div>
            <!-- col-lg-3 -->
            <div class="col-lg-9 ms-paper-content-container">
              <div class="ms-paper-content">
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
            </div>
          </div>
          <!-- ms-paper-content -->
        </div>
        <!-- col-lg-9 -->
      </div>
      <!-- row -->
    </div>

    <script src="assets/js/plugins.min.js"></script>
    <script src="assets/js/app.min.js"></script>
  </body>
</html>
