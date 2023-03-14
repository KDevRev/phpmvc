<div class="container mt-5">
  <div class="card" style="width: 18rem;">
    <img src="<?php echo BASEURL . "/foto_pelanggaran/" . $data["pelanggar"]["file_foto"] ?>" class="card-img-top" alt="Foto Pelanggaran">
    <div class="card-body">
      <h5 class="card-title"><?php echo $data["pelanggar"]["nama"] ?></h5>
      <h6 class="card-subtitle mb-2 text-muted">ID PELANGGARAN: <?php echo $data["pelanggar"]["id_pelanggaran"] ?></h6>
      <p class="card-text"><?php echo $data["pelanggar"]["keterangan"] ?></p>
      <p class="card-text">Skor: <?php echo $data["pelanggar"]["skor"] ?></p>
      <a href="<?php echo (BASEURL); ?>/pelanggaran/catat" class="card-link">Kembali</a>
    </div>
  </div>
</div>