
<?php
  $lvl = '';
  $menu1 = ['active', '', 'collapsed', 'collapsed'];
  $menu2 = ['', '', '', ''];
  $menu3 = ['', '', '', ''];
  $menuShow = ['', ''];

  include $lvl."layouts/header.php"
?>

<div class="container-fluid">
  <div class="ms-paper">
    <div class="row">
      <div class="col-lg-3 ms-paper-menu-left-container">

        <?php include "layouts/menu.php" ?>

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
        <!-- ms-paper-content -->
      </div>
      <!-- col-lg-9 -->
    </div>
    <!-- row -->
  </div>
  <!-- ms-paper -->
</div>

<?php include $lvl."layouts/footer.php" ?>
