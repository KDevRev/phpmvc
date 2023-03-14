<div class="container mt-4">
  <?php Flasher::flash(); ?>

  <button type="button" class="btn btn-primary TombolTambah" data-bs-toggle="modal" data-bs-target="#jenisPelanggaran">
    Tambah Jenis Pelanggaran
  </button>

  <h3 class="mt-3">Daftar Jenis Pelanggaran</h3>

  <div class="row">
    <div class="col-6">
      <ul class="list-group">
        <?php
        foreach ($data["jenis_pelanggaran"] as $sw) { ?>
          <li class="list-group-item">
            <?= $sw["keterangan"] . " - " . $sw["skor"] ?>
            <a href="<?= BASEURL; ?>/pelanggaran/jenis/ubah?id=<?= $sw["id"]; ?>" data-id="<?= $sw["id"]; ?>" data-bs-toggle="modal" data-bs-target="#jenisPelanggaran" class="btn btn-success btn-sm float-end ms-2 tampilModalUbah">Ubah</a>
            <a href="<?= BASEURL; ?>/pelanggaran/jenis/hapus?id=<?= $sw["id"]; ?>" class="btn btn-danger btn-sm float-end" onclick="return confirm('Anda yakin ingin menghapus?')">Hapus</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>

  <div class="modal fade" id="jenisPelanggaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="jenisPelanggaran" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="judulJenis">Tambah jenis pelanggaran</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?php echo (BASEURL) ?>/pelanggaran/tambahjenis" method="POST">
            <div class="mb-3">
              <input type="hidden" name="id" id="id">
              <label for="keterangan">Keterangan</label>
              <input class="form-control" type="text" name="keterangan" id="keterangan" required>
            </div>
            <div class="mb-3">
              <label for="skor">Skor</label>
              <input class="form-control" type="number" name="skor" id="skor" required>
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
      $("#judulJenis").html("Tambah jenis pelanggaran");
      $("#keterangan").val("");
      $("#skor").val("");
      $("#id").val("");

      $(".modal-footer button[type=submit]").html("Tambahkan");
      $(".modal-body form").attr("action", "<?php echo (BASEURL) ?>/pelanggaran/tambahjenis");
    });

    $(".tampilModalUbah").on("click", function() {
      $("#judulJenis").html("Ubah jenis pelanggaran");
      $(".modal-footer button[type=submit]").html("Ubah Data");
      $(".modal-body form").attr("action", "<?php echo (BASEURL) ?>/pelanggaran/ubahjenis");

      const id = $(this).data("id");
      $("#id").val(id);

      $.ajax({
        url: "<?php echo (BASEURL) ?>/pelanggaran/getjenisdata",
        data: {
          id
        },
        method: "POST",
        dataType: "JSON",
        success: (data) => {
          $("#keterangan").val(data.keterangan);
          $("#skor").val(data.skor);
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