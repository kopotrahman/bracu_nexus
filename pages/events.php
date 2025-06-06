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

<!-- If you want to change the primary color from green to something else. Change it with the tailwind.config.js in the Project Root Folder -->

<body class="">

<?php require_once("../partials/navbar.php");
?>
  <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2 lg:grid-cols-3 py-10 px-20" id="events-container">

  
  </div>

  <?php require_once("../partials/footer.php"); ?>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      fetchEvents();
      
      async function fetchEvents() {
        try {
          const response = await fetch('get_events.php');
          const events = await response.json();
          
          if (events.length > 0) {
            displayEvents(events);
          } else {
            document.getElementById('events-container').innerHTML = 
              '<p class="text-center col-span-full text-gray-500">No upcoming events found. Check back later!</p>';
          }
        } catch (error) {
          console.error('Error fetching events:', error);
          document.getElementById('events-container').innerHTML = 
            '<p class="text-center col-span-full text-red-500">Error loading events. Please try again later.</p>';
        }
      }
      
      function displayEvents(events) {
        const container = document.getElementById('events-container');
        container.innerHTML = '';
        
        events.forEach(event => {
          const eventDate = new Date(event.DateTime);
          const formattedDate = eventDate.toLocaleDateString('en-US', { 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
          });
          
          const eventCard = `
            <a href="#" class="block rounded-lg p-4 border border-gray-700 text-white">
    <img
      alt=""
      src="https://placehold.co/600x400?text=${event.title}"
      class="h-56 w-full rounded-md object-cover"
    />
  
    <div class="mt-2">
      <dl>
        <div>
          <dt class="sr-only">Price</dt>
  
          <dd class="text-sm text-gray-200">${formattedDate}</dd>
        </div>
  
        <div>
          <dt class="sr-only">Address</dt>
  
          <dd class="font-medium">${event.title}</dd>
          <dd class="text-sm text-gray-200 flex gap-2 mt-5">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="height:20px;color:skyblue">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
</svg>

          ${event.eventType}</dd>
          <dd class="text-sm text-gray-200 flex gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="height:20px;color:skyblue">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
</svg>

          ${event.location}</dd>
          <dd class="text-sm text-gray-200 flex gap-2">
           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="height:20px;color:skyblue">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z" />
</svg>

${event.SpeakerName}</dd>
        </div>
        
      </dl>
  
      
          </div>
        </div>
      </div>
    </div>
  </a>
          `;
          
          container.insertAdjacentHTML('beforeend', eventCard);
        });
      }
    });
  </script>

</body>
</html>