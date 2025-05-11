<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Section Swap - BRACU Nexus</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
  <!-- TailwindCSS -->
  <link href="../public/css/output.css" rel="stylesheet">
  <style>
    .badge-open { background-color: #28a745; }
    .badge-taken { background-color: #ffc107; color: #000; }
    .badge-completed { background-color: #17a2b8; }
    .badge-cancelled { background-color: #dc3545; }
    .request-card {
      transition: all 0.3s ease;
      border-left: 4px solid;
    }
    .request-card.open { border-left-color: #28a745; }
    .request-card.taken { border-left-color: #ffc107; }
    .request-card.completed { border-left-color: #17a2b8; }
    .request-card.cancelled { border-left-color: #dc3545; }
  </style>
</head>

<body class="bg-gray-900 text-white">

<?php require_once("../partials/navbar.php"); ?>

<div class="container mx-auto px-4 py-8 space-y-12">
  <!-- Section Swap Form -->
  <div>
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

  <!-- My Requests Section (Card View) -->
  <div class="bg-gray-800 rounded-lg p-8 shadow-lg">
    <h2 class="text-2xl font-bold mb-6">My Swap Requests</h2>
    
    <div id="myRequestsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Dynamic content will be inserted here by JavaScript -->
      <div class="text-center py-8 text-gray-400" id="myRequestsPlaceholder">
        Loading your requests...
      </div>
    </div>
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
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Taken By</th>
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
        const response = await fetch('api/create_request.php', {
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
          fetchAllRequests(); // Refresh all request displays
        } else {
          alert('Error: ' + result.message);
        }
      } catch (error) {
        console.error('Error:', error);
        alert('An error occurred while submitting the request.');
      }
    });
    
    // Fetch and display all requests
    async function fetchAllRequests() {
      await fetchSwapRequests();
      await fetchMyRequests();
    }
    
    // Fetch and display available swap requests
    async function fetchSwapRequests() {
      try {
        const response = await fetch('api/get_requests.php');
        const data = await response.json();
        
        if (!data.success) {
          throw new Error(data.message);
        }
        
        const tableBody = document.getElementById('requestsTable');
        tableBody.innerHTML = '';
        
        // Display open requests
        if (data.openRequests.length === 0) {
          tableBody.innerHTML = `
            <tr>
              <td colspan="8" class="px-6 py-4 text-center text-gray-400">No available swap requests</td>
            </tr>
          `;
        } else {
          data.openRequests.forEach(request => {
            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-700';
            
            row.innerHTML = `
              <td class="px-6 py-4 whitespace-nowrap">${request.RequestID}</td>
              <td class="px-6 py-4 whitespace-nowrap">${request.currentCourse}</td>
              <td class="px-6 py-4 whitespace-nowrap">${request.currentSection}</td>
              <td class="px-6 py-4 whitespace-nowrap">${request.DesiredCourse}</td>
              <td class="px-6 py-4 whitespace-nowrap">${request.desiredSection}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full badge-open">
                  ${request.Status}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-400">-</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <button onclick="takeRequest(${request.RequestID})" class="text-indigo-400 hover:text-indigo-300">
                  Take Request
                </button>
              </td>
            `;
            
            tableBody.appendChild(row);
          });
        }
        
        // Process taken requests in the table
        if (data.takenRequests.length > 0) {
          data.takenRequests.forEach(request => {
            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-700';
            
            row.innerHTML = `
              <td class="px-6 py-4 whitespace-nowrap">${request.RequestID}</td>
              <td class="px-6 py-4 whitespace-nowrap">${request.currentCourse}</td>
              <td class="px-6 py-4 whitespace-nowrap">${request.currentSection}</td>
              <td class="px-6 py-4 whitespace-nowrap">${request.DesiredCourse}</td>
              <td class="px-6 py-4 whitespace-nowrap">${request.desiredSection}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full badge-taken">
                  ${request.Status}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">${request.requestor || '-'}</td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-400">No action available</td>
            `;
            
            tableBody.appendChild(row);
          });
        }
      } catch (error) {
        console.error('Error fetching swap requests:', error);
        document.getElementById('requestsTable').innerHTML = `
          <tr>
            <td colspan="8" class="px-6 py-4 text-center text-red-500">Error loading requests: ${error.message}</td>
          </tr>
        `;
      }
    }
    
    // Fetch and display my requests in card view
    async function fetchMyRequests() {
      try {
        const response = await fetch('api/get_requests.php');
        const data = await response.json();
        
        if (!data.success) {
          throw new Error(data.message);
        }
        
        const container = document.getElementById('myRequestsContainer');
        const placeholder = document.getElementById('myRequestsPlaceholder');
        
        if (data.myRequests && data.myRequests.length > 0) {
          if (placeholder) placeholder.remove();
          
          container.innerHTML = '';
          
          data.myRequests.forEach(request => {
            const card = document.createElement('div');
            card.className = `request-card ${request.Status.toLowerCase()} bg-gray-700 rounded-lg p-6 shadow-md`;
            
            const statusBadgeClass = {
              'Open': 'badge-open',
              'Taken': 'badge-taken',
              'Completed': 'badge-completed',
              'Cancelled': 'badge-cancelled'
            }[request.Status] || 'bg-gray-500';
            
            card.innerHTML = `
              <div class="flex justify-between items-start mb-4">
                <h3 class="text-lg font-semibold">Request #${request.RequestID}</h3>
                <span class="px-3 py-1 text-xs font-semibold rounded-full ${statusBadgeClass}">
                  ${request.Status}
                </span>
              </div>
              
              <div class="space-y-3">
                <div>
                  <p class="text-sm text-gray-400">Current Course</p>
                  <p>${request.currentCourse} (${request.currentSection})</p>
                </div>
                
                <div>
                  <p class="text-sm text-gray-400">Desired Course</p>
                  <p>${request.DesiredCourse} (${request.desiredSection})</p>
                </div>
                
                <div>
                  <p class="text-sm text-gray-400">Created</p>
                  <p>${new Date(request.created_at).toLocaleString()}</p>
                </div>
                
                ${request.taken_by_username ? `
                <div>
                  <p class="text-sm text-gray-400">Taken By</p>
                  <p>${request.taken_by_username}</p>
                </div>
                ` : ''}
                
                ${request.Status === 'Open' ? `
                <div class="pt-2">
                  <button onclick="cancelRequest(${request.RequestID})" class="text-red-400 hover:text-red-300 text-sm">
                    Cancel Request
                  </button>
                </div>
                ` : ''}
              </div>
            `;
            
            container.appendChild(card);
          });
        } else {
          placeholder.textContent = 'You have no active swap requests';
        }
      } catch (error) {
        console.error('Error fetching my requests:', error);
        container.innerHTML = `
          <div class="col-span-3 text-center py-8 text-red-500">
            Error loading your requests: ${error.message}
          </div>
        `;
      }
    }
    
    // Initial load
    fetchAllRequests();
  });
  
  // Global function for taking a request
  async function takeRequest(requestId) {
    if (confirm('Are you sure you want to take this swap request?')) {
      try {
        const response = await fetch('api/take_request.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ requestId: requestId })
        });
        
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
  
  // Global function for canceling a request
  async function cancelRequest(requestId) {
    if (confirm('Are you sure you want to cancel this swap request?')) {
      try {
        const response = await fetch('api/cancel_request.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ requestId: requestId })
        });
        
        const result = await response.json();
        
        if (result.success) {
          alert('Request cancelled successfully!');
          document.dispatchEvent(new Event('DOMContentLoaded')); // Refresh the page
        } else {
          alert('Error: ' + result.message);
        }
      } catch (error) {
        console.error('Error:', error);
        alert('An error occurred while cancelling the request.');
      }
    }
  }
</script>

</body>
</html>