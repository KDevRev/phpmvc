<div class="container mt-4">

  <div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="judulModalLabel">Tambah data Siswa</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?php echo (BASEURL) ?>/siswa/tambah" method="POST">
            <div class="mb-3">
              <input type="hidden" name="id" id="id">
              <label for="nama">Nama</label>
              <input type="text" name="nama" id="nama" class="form-control" placeholder="Isikan nama" required>
            </div>
            <div class="mb-3">
              <label for="nis">NIS</label>
              <input type="text" name="nis" id="nis" class="form-control" placeholder="Isikan NIS" required>
            </div>
            <div class="mb-3">
              <label for="email">E-Mail</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com" required>
            </div>
            <div class="mb-3">
              <label for="jurusan">Jurusan</label>
              <select name="jurusan" id="jurusan" class="form-select" required>
                <option selected value="">Silahkan pilih jurusan</option>
                <option value="Akuntansi">Akutansi (AK)</option>
                <option value="MPLG">MPLG</option>
                <option value="Pemasaran">Pemasaran</option>
                <option value="Desain Komunikasi Visual">Desain Komunikasi Visual (DKV)</option>
                <option value="Rekayasa Perangkat Lunak">Pengembangan Perangkat Lunak dan Game (PPLG)</option>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Tambah Data</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-6">
      <?php Flasher::flash(); ?>
      <button type="button" class="btn btn-primary TombolTambah" data-bs-toggle="modal" data-bs-target="#formModal">
        Tambah data Siswa
      </button>
      <form action="<?= BASEURL; ?>/siswa/cari" method="POST" class="mt-3">
        <div class="input-group mb-3">
          <input type="text" name="keyword" id="keyword" placeholder="Cari siswa..." autocomplete="off" class="form-control">
          <div class="input-group-append ms-1">
            <button class="btn btn-primary" type="submit" id="cari">Cari</button>
          </div>
        </div>
      </form>
      <br>
      <h3>Daftar Siswa</h3>
      <ul class="list-group">
        <?php foreach ($data["siswa"] as $sw) { ?>
          <li class="list-group-item">
            <?= $sw["nama"] ?>
            <a href="<?= BASEURL; ?>/siswa/detail/<?= $sw["id"]; ?>" class="btn btn-primary btn-sm float-end ms-2">Detail</a>
            <a href="<?= BASEURL; ?>/siswa/ubah/<?= $sw["id"]; ?>" data-id="<?= $sw["id"]; ?>" data-bs-toggle="modal" data-bs-target="#formModal" class="btn btn-success btn-sm float-end ms-2 tampilModalUbah">Ubah</a>
            <a href="<?= BASEURL; ?>/siswa/hapus/<?= $sw["id"]; ?>" class="btn btn-danger btn-sm float-end" onclick="return confirm('Anda yakin ingin menghapus?')">Hapus</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>
<script src="<?= BASEURL; ?>/js/script.js"></script>