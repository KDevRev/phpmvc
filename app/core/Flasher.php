<?php

class Flasher
{
  public static function setflash($pesan, $aksi, $tipe)
  {
    $_SESSION["flash"] = [
      "pesan" => $pesan,
      "aksi" => $aksi,
      "tipe" => $tipe
    ];
  }

  public static function flash()
  {
    if (isset($_SESSION["flash"])) {
      echo '<div class="alert alert-' . $_SESSION["flash"]["tipe"] . ' alert-dismissible" role="alert">
        Data <strong>' . $_SESSION["flash"]["pesan"] . '</strong> ' . $_SESSION["flash"]["aksi"] . ' <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
      </div>
      ';

      unset($_SESSION["flash"]);
    }
  }
}
