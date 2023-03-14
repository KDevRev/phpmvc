<?php

class Home extends Controller
{
  public function index()
  {
    $data["judul"] = "Home";
    $data["name"] = $this->model("Model_user")->getUser();

    $this->view("templates/header", $data);
    $this->view("home/index", $data);
    $this->view("templates/footer");
  }
}
