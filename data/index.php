
<?php
  $lvl = '../';
  $menu1 = ['', 'active', 'collapsed', 'collapsed'];
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
          <h1>Testing</h1>
          <section class="ms-component-section">
            <div class="row">
              <div class="col-md-12">
                <h2 class="section-title no-margin-top">Data</h2>
                <div class="card">
                  <div class="card-block">
                    <form id="form-pdf-to-text" enctype="multipart/form-data">
                      <input type="hidden" name="page" value="image-to-text">
                      <div class="row">
                        <div class="col-sm-6">
                            <label>Upload Dokumen</label>
                            <br>
                            <input type="file" name="data"/>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Pilih Tahun</label>
                            <select name="tipe" class="form-control" style="height:50px" required>
                              <option value="">-Pilih Tipe-</option>
                              <option value="sampul">Sampul</option>
                              <option value="abstrak">Abstrak</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Pilih Tahun</label>
                            <select name="tahun" class="form-control" style="height:50px" required>
                              <option value="">-Pilih Tahun-</option>
                              <option value="2018">2018</option>
                              <option value="2013">2013</option>
                            </select>
                          </div>
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
$("#form-pdf-to-text").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: '../functions/extraction_information.php',
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
</script>
