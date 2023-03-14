<?php

class Model_siswa
{

  private $table = "siswa";
  private $db;

  function __construct()
  {
    $this->db = new Database;
  }

  public function getAllSiswa()
  {
    $this->db->query("SELECT * FROM siswa");
    return $this->db->resultSet();
  }

  public function getSiswaById($id)
  {
    $this->db->query("SELECT * FROM " . $this->table . " WHERE id=:id");
    $this->db->bind("id", $id);

    return $this->db->Single();
  }

  public function tambahDataSiswa($data)
  {
    $this->db->query("INSERT INTO siswa VALUES ('', :nama, :nis, :email, :jurusan)");
    $this->db->bind("nama", $data["nama"]);
    $this->db->bind("nis", $data["nis"]);
    $this->db->bind("email", $data["email"]);
    $this->db->bind("jurusan", $data["jurusan"]);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function hapusDataSiswa($id)
  {
    $this->db->query("DELETE FROM " . $this->table . " WHERE id=:id");
    $this->db->bind("id", $id);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function ubahDataSiswa($data)
  {
    $query = "UPDATE " . $this->table . " SET nama=:nama, nis=:nis, email=:email, jurusan=:jurusan WHERE id=:id";

    $this->db->query($query);
    $this->db->bind("nama", $data["nama"]);
    $this->db->bind("nis", $data["nis"]);
    $this->db->bind("email", $data["email"]);
    $this->db->bind("jurusan", $data["jurusan"]);
    $this->db->bind("id", $data["id"]);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function cariDataSiswa()
  {
    $keyword = $_POST["keyword"];
    $query = "SELECT * FROM " . $this->table . " WHERE nama LIKE :keyword";

    $this->db->query($query);
    $this->db->bind("keyword", "%$keyword%");

    return $this->db->resultSet();
  }
}
