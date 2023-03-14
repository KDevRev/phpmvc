<?php

class Model_kelas
{
  private $table = "kelas";
  private $db;

  function __construct()
  {
    $this->db = new Database;
  }


  public function getAllKelas()
  {
    $this->db->query("SELECT * FROM kelas");

    return $this->db->resultSet();
  }

  public function getKelasById($id)
  {
    $this->db->query("SELECT * FROM `kelas` WHERE id=:id");

    $this->db->bind("id", $id);
    $this->db->execute();

    return $this->db->Single();
  }

  public function tambahKelas($data)
  {
    $this->db->query("INSERT INTO `kelas`(`id`, `nama_kelas`) VALUES (NULL, :nama_kelas)");

    $this->db->bind("nama_kelas", $data["nama_kelas"]);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function ubahKelas($data)
  {
    $this->db->query("UPDATE `kelas` SET `nama_kelas`=:nama_kelas WHERE id=:id");

    $this->db->bind("nama_kelas", $data["nama_kelas"]);
    $this->db->bind("id", $data["id"]);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function hapus($id)
  {
    $this->db->query("DELETE FROM `kelas` WHERE id=:id");

    $this->db->bind("id", $id);
    $this->db->execute();

    return $this->db->rowCount();
  }
}
