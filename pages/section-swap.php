<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Section Swap - BRACU Nexus</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
  <!-- Core theme TailwindCSS-->
  <link rel="stylesheet" href="../public/css/output.css">
  <!-- Core theme CSS-->
  <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body class="bg-gray-900 text-white">

<?php require_once("../partials/navbar.php"); ?>

<div class="container mx-auto px-4 py-8">
  <!-- Section Swap Form -->
  <div class="mb-12">
    <form id="swapForm" class="mx-auto max-w-4xl bg-gray-800 rounded-lg p-8 shadow-lg">
      <div class="space-y-8">
        <div>
          <h2 class="text-2xl font-bold mb-6">Section Swap Request</h2>
          <p class="text-gray-400 mb-6">Fill out this form to request a section swap. Your request will be visible to other students who might want to swap with you.</p>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Current Course -->
            <div>
              <label for="currentCourse" class="block text-sm font-medium mb-2">Current Course Code</label>
              <input type="text" id="currentCourse" name="currentCourse" required
                class="w-full px-4 py-2 rounded-md bg-gray-700 border border-gray-600 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
            </div>
            
            <!-- Current Section -->
            <div>
              <label for="currentSection" class="block text-sm font-medium mb-2">Current Section</label>
              <input type="text" id="currentSection" name="currentSection" required
                class="w-full px-4 py-2 rounded-md bg-gray-700 border border-gray-600 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
            </div>
            
            <!-- Desired Course -->
            <div>
              <label for="desiredCourse" class="block text-sm font-medium mb-2">Desired Course Code</label>
              <input type="text" id="desiredCourse" name="desiredCourse" required
                class="w-full px-4 py-2 rounded-md bg-gray-700 border border-gray-600 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
            </div>
            
            <!-- Desired Section -->
            <div>
              <label for="desiredSection" class="block text-sm font-medium mb-2">Desired Section</label>
              <input type="text" id="desiredSection" name="desiredSection" required
                class="w-full px-4 py-2 rounded-md bg-gray-700 border border-gray-600 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
            </div>
          </div>
          
          <div class="mt-8">
            <button type="submit" class="w-full md:w-auto px-6 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-md font-medium transition duration-200">
              Submit Request
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>

  <!-- Available Swap Requests Table -->
  <div class="bg-gray-800 rounded-lg p-8 shadow-lg">
    <h2 class="text-2xl font-bold mb-6">Available Swap Requests</h2>
    
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-700">
        <thead class="bg-gray-700">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Request ID</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Current Course</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Current Section</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Desired Course</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Desired Section</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
          </tr>
        </thead>
        <tbody id="requestsTable" class="divide-y divide-gray-700">
          <!-- Dynamic content will be inserted here by JavaScript -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php require_once("../partials/footer.php"); ?>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Form submission
    const swapForm = document.getElementById('swapForm');
    swapForm.addEventListener('submit', async function(e) {
      e.preventDefault();
      
      const formData = {
        currentCourse: document.getElementById('currentCourse').value,
        currentSection: document.getElementById('currentSection').value,
        desiredCourse: document.getElementById('desiredCourse').value,
        desiredSection: document.getElementById('desiredSection').value
      };
      
      try {
        const response = await fetch('submit_swap_request.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(formData)
        });
        
        const result = await response.json();
        
        if (result.success) {
          alert('Swap request submitted successfully!');
          swapForm.reset();
          fetchSwapRequests(); // Refresh the table
        } else {
          alert('Error: ' + result.message);
        }
      } catch (error) {
        console.error('Error:', error);
        alert('An error occurred while submitting the request.');
      }
    });
    
    // Fetch and display swap requests
    async function fetchSwapRequests() {
      try {
        const response = await fetch('get_swap_requests.php');
        const requests = await response.json();
        
        const tableBody = document.getElementById('requestsTable');
        tableBody.innerHTML = '';
        
        if (requests.length === 0) {
          tableBody.innerHTML = `
            <tr>
              <td colspan="7" class="px-6 py-4 text-center text-gray-400">No swap requests available</td>
            </tr>
          `;
          return;
        }
        
        requests.forEach(request => {
          const row = document.createElement('tr');
          row.className = 'hover:bg-gray-700';
          
          row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap">${request.RequestID}</td>
            <td class="px-6 py-4 whitespace-nowrap">${request.currentCourse}</td>
            <td class="px-6 py-4 whitespace-nowrap">${request.currentSection}</td>
            <td class="px-6 py-4 whitespace-nowrap">${request.DesiredCourse}</td>
            <td class="px-6 py-4 whitespace-nowrap">${request.desiredSection}</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                ${request.Status === 'Pending' ? 'bg-yellow-500 text-yellow-100' : 
                  request.Status === 'Approved' ? 'bg-green-500 text-green-100' : 
                  'bg-red-500 text-red-100'}">
                ${request.Status}
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              ${request.Status === 'Pending' ? 
                `<button onclick="takeRequest(${request.RequestID})" class="text-indigo-400 hover:text-indigo-300">
                  Take Request
                </button>` : 
                'No action available'}
            </td>
          `;
          
          tableBody.appendChild(row);
        });
      } catch (error) {
        console.error('Error fetching swap requests:', error);
        document.getElementById('requestsTable').innerHTML = `
          <tr>
            <td colspan="7" class="px-6 py-4 text-center text-red-500">Error loading requests</td>
          </tr>
        `;
      }
    }
    
    // Initial load
    fetchSwapRequests();
  });
  
  // Global function for taking a request
  async function takeRequest(requestId) {
    if (confirm('Are you sure you want to take this swap request?')) {
      try {
        const response = await fetch(`take_swap_request.php?requestId=${requestId}`);
        const result = await response.json();
        
        if (result.success) {
          alert('Swap request accepted!');
          document.dispatchEvent(new Event('DOMContentLoaded')); // Refresh the page
        } else {
          alert('Error: ' + result.message);
        }
      } catch (error) {
        console.error('Error:', error);
        alert('An error occurred while accepting the request.');
      }
    }
  }
</script>

</body>
</html> 