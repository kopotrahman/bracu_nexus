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
  <nav
    class="flex flex-col sm:flex-row flex-wrap md:items-center px-4 md:px-5 lg:px-16 py-2 justify-between border-b border-gray-600 fixed top-0 z-20 w-full bg-slate-900">


    <div class="flex items-center justify-between sm:justify-around gap-x-2 text-white">

      <!-- Link To Direct to Home Page -->
      <!-- This can be a logo or a simple text (or both). Just write it in-between the anchor tag below-->
      <a href="#!" class="py-1 flex items-center text-2xl">
        BRACU NEXUS
      </a>


      <!-- Hamburger -->
      <button class="sm:hidden cursor-pointer flex flex-col justify-center gap-y-1" id="hamburger" aria-label="menu">
        <div class="w-6 h-1 rounded-lg bg-white bar duration-300"></div>
        <div class="w-4 h-1 rounded-lg bg-white bar duration-300"></div>
        <div class="w-6 h-1 rounded-lg bg-white bar duration-300"></div>
      </button>

    </div>


    <ul class="hidden sm:flex text-gray-400 justify-end items-center gap-x-7 gap-y-5 tracking-wide mt-5 sm:mt-0"
      id="links">
      <li class="table-caption mb-5 sm:mb-0">
        <a href="index.php" class="active">Home</a>
      </li>
      <li class="table-caption mb-5 sm:mb-0">
        <a href="./pages/about.php" class="hover:text-gray-300">About</a>
      </li>
      <li class="mb-5 sm:mb-0 mx-0">
        <a href="./pages/login.php" class="hover:text-gray-300">Login</a>
      </li>

    </ul>

  </nav>

  <main>


<!-- Page Content -->
<section class="relative min-h-[400px] flex items-center justify-center">
  <!-- Background image with opacity control -->
  <div 
    class="absolute inset-0 bg-cover bg-center"
    style="background-image: url('./public/img/bg1.jpg')"
  ></div>
  
  <!-- Dark overlay -->
  <div class="absolute inset-0 bg-black/40 z-10"></div>
  
  <!-- Content -->
  <div class="relative z-10 text-center px-4 py-32 w-full">
    <h1 class="font-bold text-3xl md:text-4xl lg:text-5xl pb-7 text-white tracking-500">BRACU Nexus</h1>
    <p class="text-gray-300 mb-3 text-lg">Your daily Companion to survive BRACU🥲</p>
  </div>
</section>


    <!-- Footer -->
    <footer class="bg-slate-900 pb-3 pt-10 lg:pt-20 text-white display-flex justify-center">

      <div class="flex flex-wrap justify-between gap-y-16 gap-x-7 mb-16">

        <!-- About -->
        <div class="text-center mx-2 mb-5">
          <h2 class="font-bold text-2xl mb-3 tracking-wider">Events</h2>
          <p class="pt-1">There's no upcoming events</p>

          <!-- Get Icons From Wherever and use it here -->
          <div class="flex flex-wrap gap-x-7 justify-center gap-y-5 mt-5">
            <a href="#!" class="text-primary-color hover:opacity-90">
              icon
            </a>
            <a href="#!" class="text-primary-color hover:opacity-90">
              icon
            </a>
            <a href="#!" class="text-primary-color hover:opacity-90">
              icon
            </a>
          </div>
        </div>

        <div class="flex flex-wrap gap-y-8">
        <!-- Heading -->
        <div class="mx-10 lg:mx-16">
          <h2 class="font-bold text-xl mb-4">Menu</h2>
          <ul class="flex flex-col justify-space-between gap-y-2 text-left font-semibold text-gray-400">
            <li><a href="public\pages\section-swap.html" class="hover:text-primary-color">Section Swap</a></li>
            <li><a href="#!" class="hover:text-primary-color">Club Information</a></li>
            <li><a href="#!" class="hover:text-primary-color">Research Details</a></li>
            <li><a href="#!" class="hover:text-primary-color">Events</a></li>
          </ul>
        </div>

      


      

      </div>

      
      <!-- Sub Footer -->
      <div class="h-1 w-full bg-gradient-to-r from-primary-color to-green-500 "></div>
      <!-- Copyright -->
      <p class="text-center mt-8 mb-4 font-semibold">Template Raven - Copyright &copy; <span id="year"></span>. All
        Rights
        Reserved</p>

    </footer>


  </main>


  <!-- Core Navbar JS-->
  <script src="./public/js/navbar.js"></script>
  <!-- Core theme JS-->
  <script src="./public/js/scripts.js"></script>
</body>

</html>