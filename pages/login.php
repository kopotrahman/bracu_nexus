<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bare - TailwindCSS</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
  <!-- Core theme TailwindCSS-->
  <link rel="stylesheet" href="../public/css/output.css">
  <!-- Core theme CSS-->
  <link rel="stylesheet" href="../public/css/styles.css">
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
        <a href="./about.php" class="hover:text-gray-300">About</a>
      </li>
      <li class="mb-5 sm:mb-0 mx-0">
        <a href="./login.php" class="hover:text-gray-300">Login</a>
      </li>

    </ul>

  </nav>
<!-- Please let this <main></main> tag cover everything in your webpage except the navbar. This enables the navbar links to disappear when the outer parts is clicked. -->
<!-- If you have a better way of doing this without including the <main> tag. Kindly submit a pull request at https://github.com/abrahamebij/tailwind-boilerplate -->
  <main>


    <!-- Page Content -->
    <section class="text-center py-32">
<!--
  This example requires updating your template:

  ```
  <html class="h-full bg-white">
  <body class="h-full">
  ```
-->
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <p class="text-center text-2xl/9 font-bold tracking-tight text-gray-900">BRACU NEXUS</p>
    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" action="#" method="POST">
      <div>
        <label for="email" class="text-left block text-sm/6 font-medium text-gray-900">Email address</label>
        <div class="mt-2">
          <input type="email" name="email" id="email" autocomplete="email" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
          <div class="text-sm">
            <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
          </div>
        </div>
        <div class="mt-2">
          <input type="password" name="password" id="password" autocomplete="current-password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        </div>
      </div>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
      </div>
    </form>
      <div>
        <button href="/public/pages/signup.html" class="mt-10 flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign Up</button>
      </div>

    </p>
  </div>
</div>

    </section>



    <!-- Footer -->
    <footer class="bg-slate-900 pb-3 pt-10 lg:pt-20 text-white">

      <div class="flex flex-wrap justify-around gap-y-16 gap-x-7 mb-16">

        <!-- About -->
        <div class="text-center mx-2 mb-5">
          <h2 class="font-bold text-2xl mb-3 tracking-wider">Template<span class="text-primary-color">Raven</span></h2>
          <p class="pt-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, minima?</p>

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

        <div class="flex flex-wrap gap-y-8 sm:grid grid-cols-2">
        <!-- Heading -->
        <div class="mx-10 lg:mx-16">
          <h2 class="font-bold text-xl mb-4">Heading</h2>
          <ul class="flex flex-col items-start gap-y-2 text-left font-semibold text-gray-400">
            <li><a href="#!" class="hover:text-primary-color">link</a></li>
            <li><a href="#!" class="hover:text-primary-color">link</a></li>
            <li><a href="#!" class="hover:text-primary-color">link</a></li>
            <li><a href="#!" class="hover:text-primary-color">link</a></li>
          </ul>
        </div>

        <!-- Heading 2 -->
        <div class="mx-10 lg:mx-16">
          <h2 class="font-bold text-xl mb-4">Heading 2</h2>
          <ul class="flex flex-col items-start gap-y-2 text-left font-semibold text-gray-400">
            <li><a href="#!" class="hover:text-primary-color">link</a></li>
            <li><a href="#!" class="hover:text-primary-color">link</a></li>
            <li><a href="#!" class="hover:text-primary-color">link</a></li>
            <li><a href="#!" class="hover:text-primary-color">link</a></li>
          </ul>
        </div>

        </div>

        <!-- Resources (Delete This if your website does not support newsletter) -->
        <div class="mx-10 lg:mx-16">
          <h2 class="font-bold text-xl mb-4">Resources</h2>
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tenetur.</p>

          <form action="" class="mt-5 flex">
            <input type="email" name="email"
              class="bg-slate-800 outline-0 py-2 px-3 rounded-tl rounded-bl w-full caret-primary-color"
              placeholder="Enter email here...">
            <button type="submit"
              class="bg-primary-color px-2 font-semibold text-slate-900 rounded-tr rounded-br hover:opacity-90">Subscribe</button>

          </form>
        </div>
        <!-- Resources ends here -->

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
  <script src="../js/navbar.js"></script>
  <!-- Core theme JS-->
  <script src="../js/scripts.js"></script>
</body>

</html>