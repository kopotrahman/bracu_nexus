<?php
require_once __DIR__ . '/../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables
    $errors = [];
    
    // Sanitize inputs
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $expertise = mysqli_real_escape_string($conn, $_POST['expertise']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Validation
    if (empty($username)) {
        $errors[] = "Username is required";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters";
    } elseif ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // If no errors, proceed with database insertion
    if (empty($errors)) {
        $sql = "INSERT INTO user (userName, address, contactInfo, department, Expertise, password) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", 
            $username, $address, $contact, 
            $department, $expertise, $hashed_password);
        
        if (mysqli_stmt_execute($stmt)) {
            header("Location: profile_success.php");
            exit();
        } else {
            $errors[] = "Database error: " . mysqli_error($conn);
        }
        
        mysqli_stmt_close($stmt);
    }
    
    // Close database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../public/css/output.css">
  <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body class="bg-gray-100">

  <?php require_once("../partials/navbar.php"); ?>

  <?php if (!empty($errors)): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-10 mt-4" role="alert">
      <ul>
        <?php foreach ($errors as $error): ?>
          <li><?php echo htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <form method="POST" action="profile.php" class="px-10">
    <div class="space-y-12 mx-10 py-10">
      <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base/7 font-semibold text-gray-900">Profile Registration</h2>
        
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          
          <!-- Username -->
          <div class="sm:col-span-4">
            <label for="username" class="block text-sm/6 font-medium text-gray-900">Username*</label>
            <div class="mt-2">
              <input type="text" name="username" id="username" required
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" 
                placeholder="janesmith">
            </div>
          </div>

          <!-- Password -->
          <div class="sm:col-span-3">
            <label for="password" class="block text-sm/6 font-medium text-gray-900">Password*</label>
            <div class="mt-2">
              <input type="password" name="password" id="password" required
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                placeholder="At least 8 characters">
            </div>
          </div>

          <!-- Confirm Password -->
          <div class="sm:col-span-3">
            <label for="confirm-password" class="block text-sm/6 font-medium text-gray-900">Confirm Password*</label>
            <div class="mt-2">
              <input type="password" name="confirm-password" id="confirm-password" required
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                placeholder="Confirm your password">
            </div>
          </div>

          <!-- Address -->
          <div class="col-span-full">
            <label for="address" class="block text-sm/6 font-medium text-gray-900">Address</label>
            <div class="mt-2">
              <input type="text" name="address" id="address"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" 
                placeholder="Your address">
            </div>
          </div>

          <!-- Contact Info -->
          <div class="col-span-full">
            <label for="contact" class="block text-sm/6 font-medium text-gray-900">Contact Information</label>
            <div class="mt-2">
              <input type="text" name="contact" id="contact"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" 
                placeholder="Phone or email">
            </div>
          </div>

          <!-- Department -->
          <div class="sm:col-span-3">
            <label for="department" class="block text-sm/6 font-medium text-gray-900">Department</label>
            <div class="mt-2">
              <input type="text" name="department" id="department"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" 
                placeholder="Your department">
            </div>
          </div>

          <!-- Expertise -->
          <div class="sm:col-span-3">
            <label for="expertise" class="block text-sm/6 font-medium text-gray-900">Expertise</label>
            <div class="mt-2">
              <input type="text" name="expertise" id="expertise"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" 
                placeholder="Your expertise">
            </div>
          </div>

          <!-- Submit Button -->
          <div class="col-span-full">
            <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
              Register Profile
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</body>
</html>