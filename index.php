<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BRACU Nexus</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="./public/img/favicon.ico" type="image/x-icon">
  <!-- Core theme TailwindCSS-->
  <link rel="stylesheet" href="./public/css/output.css">
  <!-- Core theme CSS-->
  <link rel="stylesheet" href="./public/css/styles.css">
</head>

<!-- If you want to change the primary color from green to something else. Change it with the tailwind.config.js in the Project Root Folder -->

<body class="bg-gray-100">

  <!-- Responsive navbar-->
  <?php require_once('./partials/navbar.php');
  showNavbar('home');
  ?>

  <main>


<!-- Page Content -->
<section class="relative min-h-[400px] w-full flex items-center justify-center bg-red-500">
  <!-- Background image with opacity control -->
  <!-- <div 
    class="absolute inset-0 h-[200px] bg-cover bg-center"
    style="background-image: url('/bracu_nexus/public/img/bg1.jpg')"
  ></div> -->

  <img class="hidden left-0 right-0 bottom-0 top-0 object-cover -z-10" src="/bracu_nexus/public/img/bg1.jpg" alt="" >

  
  <!-- Dark overlay -->
  <div class="absolute top-0 left-0 right-0 bottom-0 inset-0 bg-black/40 z-10">
 <!-- Content -->
 <div class=" z-10 text-center px-4 py-32 w-full">
    <h1 class="font-bold text-3xl md:text-4xl lg:text-5xl pb-7 text-white tracking-500">BRACU Nexus</h1>
    <p class="text-gray-300 mb-3 text-lg">Your daily Companion to survive BRACU🥲</p>
  </div>
  </div>
  
 
</section>


<?php
 include_once('./partials/footer.php');
?>


  </main>


  <!-- Core Navbar JS-->
  <script src="./public/js/navbar.js"></script>
  <!-- Core theme JS-->
  <script src="./public/js/scripts.js"></script>
</body>

</html>