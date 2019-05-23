
  </div>

    <script src="<?php echo $lvl ?>assets/js/plugins.min.js"></script>
    <script src="<?php echo $lvl ?>assets/plugins/datatable/datatables.js"></script>
    <script src="<?php echo $lvl ?>assets/js/app.min.js"></script>
    <!-- <script>
      $(document).on('change', '.filePhoto', function(e) {
        var fileUpload = $(this);
        var img = $(this).siblings('.img');
        var btn_delete = $(this).siblings('.btn-delete');
        var reader = new FileReader();
        var imageContainer = $(this).parent().parent();
        reader.onload = function (event) {
                img.attr('src',event.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);
        btn_delete.removeClass('hidden');
        btn_delete.removeClass('last');
      });

    </script> -->
  </body>
</html>
