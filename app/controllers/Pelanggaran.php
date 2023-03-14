<?php

class Pelanggaran extends Controller
{
  public function index()
  {
    $data["judul"] = "Jenis Pelanggaran";
    // $data["name"] = $this->model("Model_user")->getUser();

    $this->view("templates/header", $data);
    $this->view("pelanggaran/index", $data);
    $this->view("templates/footer");
  }

  public function jenis($url = "")
  {
    if ($url == "") {
      $data["judul"] = "Jenis Pelanggaran";
      $data["jenis_pelanggaran"] = $this->model("Model_pelanggaran")->getAllJenis();

      $this->view("templates/header", $data);
      $this->view("pelanggaran/jenis", $data);
      $this->view("templates/footer");
    } else if ($url == "hapus") {
      $errMsg = "";
      $query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
      $params = array();
      parse_str($query, $params);

      if (!isset($params["id"])) {
        $errMsg = "Invalid GET query";
        Flasher::setflash("Gagal", "dihapus! dikarenakan: " . $errMsg, "danger");
        header("Location: " . BASEURL . "/pelanggaran/jenis");
        exit;
      }

      if ($this->model("Model_pelanggaran")->hapusJenis($params["id"]) > 0) {
        Flasher::setflash("Berhasil", "dihapus!", "success");
        header("Location: " . BASEURL . "/pelanggaran/jenis");
      } else {
        $errMsg = "Failed to delete";
        Flasher::setflash("Gagal", "dihapus! dikarenakan: " . $errMsg, "danger");
        header("Location: " . BASEURL . "/pelanggaran/jenis");
        exit;
      }
    }
  }

  public function catat($id = "")
  {
    $data["jenis_pelanggaran"] = $this->model("Model_pelanggaran")->getAllJenis();
    $data["siswa"] = $this->model("Model_pelanggaran")->getAllSiswa();

    if ($id == "") {
      $data["judul"] = "Catat Pelanggaran";
      $data["pelanggar"] = $this->model("Model_pelanggaran")->getAllPelanggar();

      $this->view("templates/header", $data);
      $this->view("pelanggaran/catat", $data);
      $this->view("templates/footer");
    } else {

      $data["judul"] = "Detail Pelanggaran";
      $data["pelanggar"] = $this->model("Model_pelanggaran")->getPelanggarById($id);

      $this->view("templates/header", $data);
      $this->view("pelanggaran/detail_pelanggaran", $data);
      $this->view("templates/footer");
    }
  }


  public function tambahcatat()
  {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    $imageFileType = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
    $newFilePath = UPLOAD_DIR . "\\" . $_FILES["file"]["name"];
    $errMsg = "";


    if (count($_POST) > 0) {
      if ($check == false) {
        $errMsg = "File is not an image";
        Flasher::setflash("Gagal", "ditambahkan! dikarenakan: " . $errMsg, "danger");
        header("Location: " . BASEURL . "/pelanggaran/catat");
        exit;
      }
      if (file_exists($newFilePath)) {
        $errMsg = "File already exist";
        Flasher::setflash("Gagal", "ditambahkan! dikarenakan: " . $errMsg, "danger");
        header("Location: " . BASEURL . "/pelanggaran/catat");
        exit;
      }
      if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
      ) {
        $errMsg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        Flasher::setflash("Gagal", "ditambahkan! dikarenakan: " . $errMsg, "danger");
        header("Location: " . BASEURL . "/pelanggaran/catat");
        exit;
      }

      if ($this->model("Model_pelanggaran")->tambahPelanggaran($_POST, $_FILES) > 0) {
        Flasher::setflash("Berhasil", "ditambahkan!", "success");
        move_uploaded_file($_FILES["file"]["tmp_name"], UPLOAD_DIR . "\\" . $_FILES["file"]["name"]);
        header("Location: " . BASEURL . "/pelanggaran/catat");
        exit;
      } else {
        $errMsg = "Fail insert to database";
        Flasher::setflash("Gagal", "ditambahkan! dikarenakan: " . $errMsg, "danger");
        header("Location: " . BASEURL . "/pelanggaran/catat");
        exit;
      }
    } else {
      $errMsg = "Fail invalid POST JSON type";
      Flasher::setflash("Gagal", "ditambahkan! dikarenakan: " . $errMsg, "danger");
      header("Location: " . BASEURL . "/pelanggaran/catat");
      exit;
    }
  }

  public function ubahcatat()
  {
    // var_dump($_POST);
    // var_dump($_FILES);

    $check = getimagesize($_FILES["file"]["tmp_name"]);
    $imageFileType = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
    $newFilePath = UPLOAD_DIR . "\\" . $_FILES["file"]["name"];
    $errMsg = "";

    if (count($_POST) > 0) {
      if ($check == false) {
        $errMsg = "File is not an image";
        Flasher::setflash("Gagal", "diubah! dikarenakan: " . $errMsg, "danger");
        header("Location: " . BASEURL . "/pelanggaran/catat");
        exit;
      }
      if (file_exists($newFilePath)) {
        $errMsg = "File already exist";
        Flasher::setflash("Gagal", "diubah! dikarenakan: " . $errMsg, "danger");
        header("Location: " . BASEURL . "/pelanggaran/catat");
        exit;
      }
      if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
      ) {
        $errMsg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        Flasher::setflash("Gagal", "diubah! dikarenakan: " . $errMsg, "danger");
        header("Location: " . BASEURL . "/pelanggaran/catat");
        exit;
      }

      $oldSiswa = $this->model("Model_pelanggaran")->getPelanggarById($_POST["id"]);

      if ($this->model("Model_pelanggaran")->ubahCatat($_POST, $_FILES, $oldSiswa["file_foto"]) > 0) {
        Flasher::setflash("Berhasil", "diubah!", "success");
        move_uploaded_file($_FILES["file"]["tmp_name"], UPLOAD_DIR . "\\" . $_FILES["file"]["name"]);
        header("Location: " . BASEURL . "/pelanggaran/catat");
        exit;
      } else {
        $errMsg = "Fail insert to database";
        Flasher::setflash("Gagal", "ditambahkan! dikarenakan: " . $errMsg, "danger");
        header("Location: " . BASEURL . "/pelanggaran/catat");
        exit;
      }
    } else {
      $errMsg = "Fail invalid POST JSON type";
      Flasher::setflash("Gagal", "diubah! dikarenakan: " . $errMsg, "danger");
      header("Location: " . BASEURL . "/pelanggaran/catat");
      exit;
    }
  }

  public function getpelanggaransiswa()
  {
    echo json_encode($this->model("Model_pelanggaran")->getPelanggarById($_POST["id"]));
  }

  public function tambahjenis()
  {
    if (count($_POST) > 0) {
      if ($this->model("Model_pelanggaran")->tambahJenis($_POST) > 0) {
        Flasher::setflash("Berhasil", "ditambahkan!", "success");
        header("Location: " . BASEURL . "/pelanggaran/jenis");
      } else {
        $errMsg = "Fail insert to database";
        Flasher::setflash("Gagal", "ditambahkan! dikarenakan: " . $errMsg, "danger");
        header("Location: " . BASEURL . "/pelanggaran/jenis");
        exit;
      }
    } else {
      $errMsg = "Fail invalid POST JSON type";
      Flasher::setflash("Gagal", "ditambahkan! dikarenakan: " . $errMsg, "danger");
      header("Location: " . BASEURL . "/pelanggaran/jenis");
      exit;
    }
  }

  public function ubahjenis()
  {
    if (count($_POST) > 0) {
      if ($this->model("Model_pelanggaran")->ubahJenis($_POST) > 0) {
        Flasher::setflash("Berhasil", "diubah!", "success");
        header("Location: " . BASEURL . "/pelanggaran/jenis");
      } else {
        $errMsg = "Fail update to database";
        Flasher::setflash("Gagal", "diubah! dikarenakan: " . $errMsg, "danger");
        header("Location: " . BASEURL . "/pelanggaran/jenis");
        exit;
      }
    } else {
      $errMsg = "Fail invalid POST JSON type";
      Flasher::setflash("Gagal", "diubah! dikarenakan: " . $errMsg, "danger");
      header("Location: " . BASEURL . "/pelanggaran/jenis");
      exit;
    }
  }
  public function getjenisdata()
  {
    echo json_encode($this->model("Model_pelanggaran")->getJenisById($_POST["id"]));
  }
}
