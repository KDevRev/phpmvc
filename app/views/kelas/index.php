<div class="container mt-4">
  <?php Flasher::flash(); ?>

  <button type="button" class="btn btn-primary TombolTambah" data-bs-toggle="modal" data-bs-target="#jenisPelanggaran">
    Tambah Kelas
  </button>

  <h3 class="mt-3">Daftar Kelas</h3>

  <div class="row">
    <div class="col-6">
      <ul class="list-group">
        <?php
        foreach ($data["kelas"] as $sw) { ?>
          <li class="list-group-item">
            <?= $sw["nama_kelas"] ?>
            <a href="<?= BASEURL; ?>/kelas/ubah/<?= $sw["id"]; ?>" data-id="<?= $sw["id"]; ?>" data-bs-toggle="modal" data-bs-target="#jenisPelanggaran" class="btn btn-success btn-sm float-end ms-2 tampilModalUbah">Ubah</a>
            <a href="<?= BASEURL; ?>/kelas/hapus/<?= $sw["id"]; ?>" class="btn btn-danger btn-sm float-end" onclick="return confirm('Anda yakin ingin menghapus?')">Hapus</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>

  <div class="modal fade" id="jenisPelanggaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="jenisPelanggaran" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="judulJenis">Tambah Kelas</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?php echo (BASEURL) ?>/kelas/tambah" method="POST">
            <div class="mb-3">
              <input type="hidden" name="id" id="id">
              <label for="nama_kelas">Nama Kelas</label>
              <input class="form-control" type="text" name="nama_kelas" id="nama_kelas" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Tambahkan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(function() {
    $(".TombolTambah").on("click", function() {
      $("#judulJenis").html("Tambah Kelas");
      $("#nama_kelas").val("");
      $("#id").val("");

      $(".modal-footer button[type=submit]").html("Tambahkan");
      $(".modal-body form").attr("action", "<?php echo (BASEURL) ?>/kelas/tambah");
    });

    $(".tampilModalUbah").on("click", function() {
      $("#judulJenis").html("Ubah Kelas");
      $(".modal-footer button[type=submit]").html("Ubah Data");
      $(".modal-body form").attr("action", "<?php echo (BASEURL) ?>/kelas/ubah");

      const id = $(this).data("id");
      $("#id").val(id);

      $.ajax({
        url: "<?php echo (BASEURL) ?>/kelas/getkelasdata",
        data: {
          id
        },
        method: "POST",
        dataType: "JSON",
        success: (data) => {
          $("#nama_kelas").val(data.nama_kelas);
        },
        /**
         * @param {Error} err
         */
        error: (err) => {
          console.error("err", err);
        }
      })
    });
  });
</script>