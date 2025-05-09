<?php
require_once __DIR__ . '/../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $expertise = mysqli_real_escape_string($conn, $_POST['expertise']);
    $enroll_date = mysqli_real_escape_string($conn, $_POST['enroll-date']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);
    $section_id = mysqli_real_escape_string($conn, $_POST['section-id']);


    if (empty($username)) {
        die("Username is required");
    }

    $sql = "INSERT INTO user(userName, address, contactInfo, department, Expertise) 
            VALUES ('$username', '$address', '$contact', '$department', '$expertise')";


    if (mysqli_query($conn, $sql)) {
        header("Location: profile_success.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
}
?>

<!-- Your HTML form here -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
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


<form method="POST" action="profile.php" class="px-10">
    <div class="space-y-12 mx-10 py-10">
      <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base/7 font-semibold text-gray-900">Profile</h2>
        <p class="mt-1 text-sm/6 text-gray-600">This information will be displayed publicly so be careful what you share.</p>
  
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-4">
            <label for="username" class="block text-sm/6 font-medium text-gray-900">Username</label>
            <div class="mt-2">
              <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                <div class="shrink-0 text-base text-gray-500 select-none sm:text-sm/6">bracunexus.com/</div>
                <input type="text" name="username" id="username" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" placeholder="janesmith">
              </div>
            </div>
          </div>
  
          <div class="col-span-full">
            <label for="address" class="block text-sm/6 font-medium text-gray-900">Address</label>
            <div class="mt-2">
              <input rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 type=" type="text" name="address" placeholder="Address">
            </div>
            <div class="col-span-full">
                <label for="about" class="block text-sm/6 font-medium text-gray-900">Contact Info</label>
                <div class="mt-2">
                  <input rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" type="text" name="contact" placeholder="Contact Info">
                </div>
                <div class="col-span-full">
                    <label for="about" class="block text-sm/6 font-medium text-gray-900">Department</label>
                    <div class="mt-2">
                      <input name="desired-course" id="desired-course" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" type="text" name="department" placeholder="Department">
                    </div>
                    <div class="col-span-full">
                        <label for="about" class="block text-sm/6 font-medium text-gray-900">Expertise</label>
                        <div class="mt-2">
                          <input rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"type="text" name="expertise" placeholder="Expertise">
                        </div>
          </div>

      <div class="col-span-full">
        <label for="about" class="block text-sm/6 font-medium text-gray-900">Enroll Date</label>
        <div class="mt-2">
          <input rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" type="date" name="enroll-date" placeholder="Enrollment Date">
        </div>
        <div class="col-span-full">
            <label for="about" class="block text-sm/6 font-medium text-gray-900">Semester</label>
            <div class="mt-2">
              <input  rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" type="text" name="semester" placeholder="Semester">
            </div>
            <div class="col-span-full">
                <label for="about" class="block text-sm/6 font-medium text-gray-900">Section ID</label>
                <div class="mt-2">
                  <input rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" type="text" name="section-id" placeholder="Section ID">
                </div>
                
      </div>

      <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm/6 font-semibold text-black shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
      
          </div>
        </div>
      </div>
    </div>
  </div>