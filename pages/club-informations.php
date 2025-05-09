<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clubs - TailwindCSS</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
  <!-- Core theme TailwindCSS-->
  <link rel="stylesheet" href="../public/css/output.css">
  <!-- Core theme CSS-->
  <link rel="stylesheet" href="../public/css/styles.css">

<body class="">

<?php require_once("../partials/navbar.php"); ?>
  <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2 lg:grid-cols-3 py-10 px-20" id="clubs-container">

  </div>

  <?php require_once("../partials/footer.php"); ?>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      fetchClubs();
      
      async function fetchClubs() {
        try {
          const response = await fetch('get_clubs.php');
          const clubs = await response.json();
          
          if (clubs.length > 0) {
            displayClubs(clubs);
          } else {
            document.getElementById('clubs-container').innerHTML = 
              '<p class="text-center col-span-full text-gray-500">No clubs found.</p>';
          }
        } catch (error) {
          console.error('Error fetching clubs:', error);
          document.getElementById('clubs-container').innerHTML = 
            '<p class="text-center col-span-full text-red-500">Error loading clubs. Please try again later.</p>';
        }
      }
      
      function displayClubs(clubs) {
        const container = document.getElementById('clubs-container');
        container.innerHTML = '';
        
        clubs.forEach(club => {
          const foundDate = new Date(club.FoundDate);
          const formattedDate = foundDate.toLocaleDateString('en-US', { 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric'
          });
          
          const clubCard = `
            <div class="block rounded-lg p-4 border border-gray-700 text-white">
              <img
                alt="${club.ClubName}"
                src="https://placehold.co/600x400?text=${club.ClubName}"
                class="h-56 w-full rounded-md object-cover"
              />
            
              <div class="mt-2">
                <dl>
                  <div>
                    <dt class="sr-only">Founded Date</dt>
                    <dd class="text-sm text-gray-200">Founded: ${formattedDate}</dd>
                  </div>
            
                  <div>
                    <dt class="sr-only">Club Name</dt>
                    <dd class="font-medium text-xl">${club.ClubName}</dd>
                    <dd class="text-sm text-gray-200 mt-3">${club.Description}</dd>
                    <dd class="text-sm text-gray-200 flex gap-2 mt-5">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="height:20px;color:skyblue">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                      </svg>
                      ${club.Email}
                    </dd>
                    <dd class="text-sm text-gray-200 flex gap-2 mt-2">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="height:20px;color:skyblue">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                      </svg>
                      Assistant ID: ${club.AssistantID}
                    </dd>
                  </div>
                </dl>
              </div>
            </div>
          `;
          
          container.insertAdjacentHTML('beforeend', clubCard);
        });
      }
    });
  </script>

</body>
</html>