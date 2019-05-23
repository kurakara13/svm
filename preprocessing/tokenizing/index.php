
<?php
  $lvl = '../../';
  $menu1 = ['', '', '', 'collapsed'];
  $menu2 = ['', '', 'active'];
  $menu3 = ['', '', '', ''];
  $menuShow = ['show', ''];

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
          <h1>Tokenizing</h1>
          <section class="ms-component-section">
            <div class="row">
              <div class="col-md-12">
                <h2 class="section-title no-margin-top">Data</h2>
                <div class="card">
                  <div class="card-block">
                    <form id="form-tokenizing">
                      <input type="hidden" name="page" value="tokenizing">
                      <input class="form-control" name="data" type="number" placeholder="Masukan Jumlah Data">
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
                  <div class="card-block">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th style="width:50%" colspan="2">Sebelum</th>
                            <th style="width:50%" colspan="4">Sesudah</th>
                          </tr>
                        </thead>
                        <tbody id="hasil-tokenizing">
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

<script>

$("#form-tokenizing").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: '<?php echo $lvl ?>functions/extraction_information.php',
        type: 'POST',
        data: formData,
        success: function (data) {
            console.log(data);
            $('#hasil-tokenizing').html(data);
        },
        cache: false,
        contentType: false,
        processData: false
    });
});
</script>
