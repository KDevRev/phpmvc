$(function () {
  $(".TombolTambah").on("click", function () {
    $("#judulModalLabel").html("Tambah Data siswa");
    $("#nama").val("");
    $("#nis").val("");
    $("#email").val("");
    $("#jurusan").val("Silahkan pilih jurusan");
    $("#id").val("");

    $(".modal-footer button[type=submit]").html("Tambahkan");
    $(".modal-body form").attr("action", "http://localhost/phpmvc/public/siswa/tambah");
  });

  $(".tampilModalUbah").on("click", function () {
    $("#judulModalLabel").html("Ubah Data Siswa");
    $(".modal-footer button[type=submit]").html("Ubah Data");
    $(".modal-body form").attr("action", "http://localhost/phpmvc/public/siswa/ubah");

    const id = $(this).data("id");

    $.ajax({
      url: "http://localhost/phpmvc/public/siswa/getdata",
      data: { id },
      method: "POST",
      dataType: "JSON",
      success: (data) => {
        console.log(data);
        $("#nama").val(data.nama);
        $("#nis").val(data.nis);
        $("#email").val(data.email);
        $("#jurusan").val(data.jurusan);
        $("#id").val(data.id);
      },
      /**
       * @param {Error} err
       */
      error: (err) => {
        console.error("err", err);
      }
    });
  });
});
