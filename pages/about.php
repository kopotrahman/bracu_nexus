<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bracu Nexus - About</title>
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
        <?php require_once("../partials/navbar.php");
        ?>

<!-- Please let this <main></main> tag cover everything in your webpage except the navbar. This enables the navbar links to disappear when the outer parts is clicked. -->
<!-- If you have a better way of doing this without including the <main> tag. Kindly submit a pull request at https://github.com/abrahamebij/tailwind-boilerplate -->
  <main>


    <!-- Page Content -->
    <section class="text-center py-32">
      <h1 class="font-bold text-3xl md:text-4xl lg:text-5xl pb-7">Page 1</h1>
      <p class="text-gray-600">Tailwind v3.0</p>
    </section>



    <?php require_once("../partials/footer.php");
    ?>

  </main>


  <!-- Core Navbar JS-->
  <script src="../js/navbar.js"></script>
  <!-- Core theme JS-->
  <script src="../js/scripts.js"></script>
</body>

</html>