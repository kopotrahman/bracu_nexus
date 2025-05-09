<?php

function showNavbar($active = 'home') {
    $class = '';
    if ($active == 'home') {
        $class = 'active';
    }
    echo '<nav
    class="flex flex-col sm:flex-row flex-wrap md:items-center px-4 md:px-5 lg:px-16 py-2 justify-between border-b border-gray-600 fixed top-0 z-20 w-full bg-slate-900">


    <div class="flex items-center justify-between sm:justify-around gap-x-2 text-white">

      <!-- Link To Direct to Home Page -->
      <!-- This can be a logo or a simple text (or both). Just write it in-between the anchor tag below-->
      <a href="/bracu_nexus" class="py-1 flex items-center text-2xl ' . $class . '">
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
        <a href="/bracu_nexus" class="' . ($active == 'home' ? 'active' : '') . '">Home</a>
      </li>
      <li class="table-caption mb-5 sm:mb-0">
        <a href="/bracu_nexus/pages/about.php" class="' . ($active == 'about' ? 'active' : 'hover:text-gray-300') . '">About</a>
      </li>
      <li class="mb-5 sm:mb-0 mx-0">
        <a href="/bracu_nexus/pages/login.php" class="' . ($active == 'login' ? 'active' : 'hover:text-gray-300') . '">Login</a>
      </li>

    </ul>

  </nav>';
}

?>
