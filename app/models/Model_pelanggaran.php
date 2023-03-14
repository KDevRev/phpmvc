<?php

class Model_pelanggaran
{

  private $table = "siswa";
  private $db;

  function __construct()
  {
    $this->db = new Database;
  }

  public function getAllPelanggar()
  {
    $this->db->query("SELECT pelanggaran.id as id_pelanggaran, pelanggaran.id_jenis_pelanggaran, pelanggaran.id_siswa, pelanggaran.file_foto, siswa.nama, jenis_pelanggaran.keterangan FROM pelanggaran, siswa, jenis_pelanggaran WHERE pelanggaran.id_siswa=siswa.id AND pelanggaran.id_jenis_pelanggaran=jenis_pelanggaran.id");

    return $this->db->resultSet();
  }

  public function getPelanggarById($id)
  {

    $this->db->query("SELECT pelanggaran.id as id_pelanggaran, pelanggaran.id_siswa, pelanggaran.file_foto, siswa.nama, jenis_pelanggaran.id as id_jenis_pelanggaran, jenis_pelanggaran.keterangan, jenis_pelanggaran.skor FROM pelanggaran, siswa, jenis_pelanggaran WHERE pelanggaran.id=:id AND pelanggaran.id_siswa=siswa.id AND pelanggaran.id_jenis_pelanggaran=jenis_pelanggaran.id");
    $this->db->bind("id", $id);

    return $this->db->Single();
  }

  public function getAllJenis()
  {
    $this->db->query("SELECT * FROM jenis_pelanggaran");

    return $this->db->resultSet();
  }

  public function getAllSiswa()
  {
    $this->db->query("SELECT siswa.id, siswa.nama, siswa.nis, siswa.jurusan, kelas.nama_kelas FROM siswa, kelas WHERE siswa.id_kelas=kelas.id");

    return $this->db->resultSet();
  }

  public function tambahPelanggaran($data, $files)
  {
    $this->db->query("INSERT INTO `pelanggaran`(`id`, `id_jenis_pelanggaran`, `id_siswa`, `tgl_pelanggaran`, `file_foto`) VALUES (NULL, :jenis, :id_siswa, CURRENT_DATE, :foto)");

    $this->db->bind("jenis", $data["keterangan"]);
    $this->db->bind("id_siswa", $data["siswa"]);
    $this->db->bind("foto", $files["file"]["name"]);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function ubahCatat($data, $files, $oldFoto)
  {
    $this->db->query("UPDATE `pelanggaran` SET `id_jenis_pelanggaran`=:id_jenis_pelanggaran,`id_siswa`=:id_siswa,`tgl_pelanggaran`=CURRENT_DATE,`file_foto`=:file_foto WHERE id=:id");

    $this->db->bind("id_jenis_pelanggaran", $data["keterangan"]);
    $this->db->bind("id_siswa", $data["siswa"]);
    $this->db->bind("file_foto", $files["file"]["name"]);
    $this->db->bind("id", $data["id"]);

    $this->db->execute();


    unlink(UPLOAD_DIR . "\\" . $oldFoto);
    return $this->db->rowCount();
  }

  public function getJenisById($id)
  {
    $this->db->query("SELECT * FROM `jenis_pelanggaran` WHERE id=:id");

    $this->db->bind("id", $id);

    return $this->db->Single();
  }


  public function tambahJenis($data)
  {
    $this->db->query("INSERT INTO `jenis_pelanggaran`(`id`, `keterangan`, `skor`) VALUES (NULL, :keterangan, :skor)");

    $this->db->bind("keterangan", $data["keterangan"]);
    $this->db->bind("skor", $data["skor"]);

    $this->db->execute();

    return $this->db->rowCount();
  }


  public function ubahJenis($data)
  {
    $this->db->query("UPDATE `jenis_pelanggaran` SET `keterangan`=:keterangan,`skor`=:skor WHERE id=:id");

    $this->db->bind("keterangan", $data["keterangan"]);
    $this->db->bind("skor", $data["skor"]);
    $this->db->bind("id", $data["id"]);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function hapusJenis($id)
  {
    $this->db->query("DELETE FROM `jenis_pelanggaran` WHERE id=:id");

    $this->db->bind("id", $id);
    $this->db->execute();

    return $this->db->rowCount();
  }
}
