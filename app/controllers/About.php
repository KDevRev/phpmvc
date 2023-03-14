<?php

class About extends Controller
{
  public function index($name = "Kasnan", $job = "Penyihir", $age = 25)
  {
    // echo "Hello, nama ku adalah $name, dan aku seorang $job";
    $data["name"] = $name;
    $data["job"] = $job;
    $data["age"] = $age;
    $data["judul"] = "About";

    $this->view("templates/header", $data);
    $this->view("about/index", $data);
    $this->view("templates/footer");
  }

  public function page()
  {
    $data["judul"] = "Pages";

    $this->view("templates/header", $data);
    $this->view("about/page", $data);
    $this->view("templates/footer");
  }
}
