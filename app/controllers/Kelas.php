<?php

class Kelas extends Controller
{
  public function index()
  {
    $data["judul"] = "Kelas";

    $data["kelas"] = $this->model("Model_kelas")->getAllKelas();

    $this->view("templates/header", $data);
    $this->view("kelas/index", $data);
    $this->view("templates/footer");
  }

  public function getkelasdata()
  {
    echo json_encode($this->model("Model_kelas")->getKelasById($_POST["id"]));
  }


  public function tambah()
  {
    $errMsg = "";
    if (count($_POST) > 0) {
      if ($this->model("Model_kelas")->tambahKelas($_POST) > 0) {
        Flasher::setflash("Berhasil", "ditambahkan!", "success");
        header("Location: " . BASEURL . "/kelas");
        exit;
      } else {
        $errMsg = "Fail insert to database";
        Flasher::setflash("Gagal", "ditambahkan! dikarenakan: " . $errMsg, "danger");
        header("Location: " . BASEURL . "/kelas");
        exit;
      }
    } else {
      $errMsg = "Fail invalid POST JSON type";
      Flasher::setflash("Gagal", "ditambahkan! dikarenakan: " . $errMsg, "danger");
      header("Location: " . BASEURL . "/kelas");
      exit;
    }
  }

  public function ubah()
  {
    $errMsg = "";

    if (count($_POST) > 0) {
      if ($this->model("Model_kelas")->ubahKelas($_POST) > 0) {
        Flasher::setflash("Berhasil", "diubah!", "success");
        header("Location: " . BASEURL . "/kelas");
        exit;
      } else {
        $errMsg = "Fail update to database";
        Flasher::setflash("Gagal", "diubah! dikarenakan: " . $errMsg, "danger");
        header("Location: " . BASEURL . "/kelas");
        exit;
      }
    } else {
      $errMsg = "Fail invalid POST JSON type";
      Flasher::setflash("Gagal", "ditambahkan! dikarenakan: " . $errMsg, "danger");
      header("Location: " . BASEURL . "/kelas");
      exit;
    }
  }

  public function hapus($id)
  {
    $errMsg = "";

    if ($this->model("Model_kelas")->hapus($id) > 0) {
      Flasher::setflash("Berhasil", "dihapus!", "success");
      header("Location: " . BASEURL . "/kelas");
      exit;
    } else {
      $errMsg = "Fail delete kelas";
      Flasher::setflash("Gagal", "dihapus! dikarenakan: " . $errMsg, "danger");
      header("Location: " . BASEURL . "/kelas");
      exit;
    }
  }
}
