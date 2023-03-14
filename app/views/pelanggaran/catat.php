<div class="container mt-4">
  <?php Flasher::flash(); ?>

  <button type="button" class="btn btn-primary TombolTambah" data-bs-toggle="modal" data-bs-target="#catatPelanggaran">
    Tambah Pelanggaran
  </button>

  <h3 class="mt-3">Daftar Siswa</h3>

  <div class="row">
    <div class="col-6">
      <ul class="list-group">
        <?php
        foreach ($data["pelanggar"] as $sw) { ?>
          <li class="list-group-item">
            <?= $sw["nama"] . " - " . $sw["keterangan"] ?>
            <a href="<?= BASEURL; ?>/pelanggaran/catat/<?= $sw["id_pelanggaran"]; ?>" class="btn btn-primary btn-sm float-end ms-2">Detail</a>
            <a href="<?= BASEURL; ?>/pelanggaran/catat/ubah/<?= $sw["id_pelanggaran"]; ?>" data-id="<?= $sw["id_pelanggaran"]; ?>" data-bs-toggle="modal" data-bs-target="#catatPelanggaran" class="btn btn-success btn-sm float-end ms-2 tampilModalUbah">Ubah</a>
            <a href="<?= BASEURL; ?>/pelanggaran/catat/hapus/<?= $sw["id_pelanggaran"]; ?>" class="btn btn-danger btn-sm float-end" onclick="return confirm('Anda yakin ingin menghapus?')">Hapus</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>

  <div class="modal fade" id="catatPelanggaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="judulJenis">Tambah pelanggaran siswa</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?php echo (BASEURL) ?>/pelanggaran/tambahcatat" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
              <input type="hidden" name="id" id="id">
              <label for="siswa">Siswa</label>
              <select name="siswa" id="siswa" class="form-select" required>
                <option selected value="">Silahkan pilih siswa</option>
                <?php
                foreach ($data["siswa"] as $d) { ?>
                  <option value="<?php echo $d["id"]; ?>"><?php echo $d["nama"] . " - " . $d["nama_kelas"] . " - " . $d["jurusan"]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="keterangan">Keterangan</label>
              <select name="keterangan" id="keterangan" class="form-select" required>
                <option selected value="">Silahkan pilih jenis keterangan</option>
                <?php
                foreach ($data["jenis_pelanggaran"] as $d) { ?>
                  <option value="<?php echo $d["id"]; ?>"><?php echo $d["keterangan"]; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="file">Upload foto</label>
              <input class="form-control" name="file" id="file" type="file" accept="image/*" required>
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
      $("#judulJenis").html("Tambah pelanggaran siswa");
      $("#siswa").val("");
      $("#keterangan").val("");
      $("#file").val("");
      $("#id").val("");

      $(".modal-footer button[type=submit]").html("Tambahkan");
      $(".modal-body form").attr("action", "<?php echo (BASEURL) ?>/pelanggaran/tambahcatat");
    });

    $(".tampilModalUbah").on("click", function() {
      $("#judulJenis").html("Ubah pelanggaran siswa");

      $(".modal-footer button[type=submit]").html("Ubah");
      $(".modal-body form").attr("action", "<?php echo (BASEURL) ?>/pelanggaran/ubahcatat");

      const id = $(this).data("id");
      $("#id").val(id);

      $.ajax({
        url: "<?php echo (BASEURL) ?>/pelanggaran/getpelanggaransiswa",
        data: {
          id
        },
        method: "POST",
        dataType: "JSON",
        success: (data) => {
          $("#siswa").val(data.id_siswa);
          $("#keterangan").val(data.id_jenis_pelanggaran);
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