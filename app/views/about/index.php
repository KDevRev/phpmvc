 <!DOCTYPE html>
 <html lang="en">

 <head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About Index</title>
 </head>

 <body>
   <div class="container">
     <h1>About me!</h1>
     <img src="<?= BASEURL; ?>/img/foto1.jpg" alt="foto saya" width="800" class="rounded-circle">
     <p><?= "Hello, nama ku adalah " . $data["name"] . ", dan aku seorang " . $data["job"] . " yang berumur " . $data["age"] . " tahun" ?></p>
   </div>

 </body>

 </html>