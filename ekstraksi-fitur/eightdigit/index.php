
<?php
  $lvl = '../../';
  $menu1 = ['', '', 'collapsed', ''];
  $menu2 = ['', '', ''];
  $menu3 = ['','','','','','','','active'];
  $menuShow = ['', 'show'];

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
          <h1>Ekstraksi Fitur | EIGHTDIGIT</h1>
          <section class="ms-component-section">
            <div class="row">
              <div class="col-md-12">
                <h2 class="section-title no-margin-top">Data</h2>
                <div class="card">
                  <div class="card-block">
                    <form id="form-ekstraksi_fitur">
                      <input type="hidden" name="page" value="eightdigit">
                      <input class="form-control" name="data" type="number" placeholder="Masukan Jumlah Data">
                      <button class="btn btn-primary btn-raised pull-right">
                        <i class="zmdi zmdi-flower"></i> Submit
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
                            <th style="width:50%">Kalimat</th>
                            <th style="width:50%">Bobot Teks</th>
                          </tr>
                        </thead>
                        <tbody id="hasil-ekstraksi_fitur">
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

$("#form-ekstraksi_fitur").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: '<?php echo $lvl ?>functions/extraction_information.php',
        type: 'POST',
        data: formData,
        success: function (data) {
            console.log(data);
            $('#hasil-ekstraksi_fitur').html(data);
        },
        cache: false,
        contentType: false,
        processData: false
    });
});
</script>
