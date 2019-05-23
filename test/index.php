
<?php
  $lvl = '../';
  $menu1 = ['', '', 'collapsed', 'collapsed', 'active'];
  $menu2 = ['', '', ''];
  $menu3 = ['', '', '', ''];
  $menuShow = ['', ''];

  include $lvl."layouts/header.php"
?>

<div class="container-fluid">
  <div class="ms-paper">
    <div class="row">
      <div class="col-lg-3 ms-paper-menu-left-container">

        <?php include $lvl."layouts/menu.php" ?>

      </div>
      <!-- col-lg-3 -->
      <div class="col-lg-9 ms-paper-content-container">
        <div class="ms-paper-content">
          <h1>Filtering</h1>
          <section class="ms-component-section">
            <div class="row">
              <div class="col-md-12">
                <h2 class="section-title no-margin-top">Data</h2>
                <div class="card">
                  <div class="card-block">
                    <form id="form-filtering" action="<?php echo $lvl; ?>functions/extraction_information.php" method="post">
                      <input type="hidden" name="page" value="test">
                      <input class="form-control" name="data" type="number" placeholder="Masukan Jumlah Data">
                      <button class="btn btn-primary btn-raised pull-right">
                        <i class="zmdi zmdi-flower"></i> Filtering Teks
                      </button>
                    </form>
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
