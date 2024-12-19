<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Lighthouse Information</title>
   <link rel="stylesheet" href="css/navstyles.css">
   <style>

body {
    font-family: Arial, sans-serif;
    background-color: #e5f5ff; /* light blue background */
    margin: 0;
    padding: 0;
}

header {
    background-color: #93e2fc; /* medium blue */
    padding: 20px;
    text-align: center;
    color: #000; /* black text */
}

header h1 {
    margin: 20px;
    font-size: 2.5em;
}

header p {
    margin: 20px;
    font-size: 1.2em;
}

#lighthouse-container {
    padding: 20px;
    background-color: #a2bcd6; /* blue-grey */
}

.lighthouse-card {
    background-color: #caf0fe; /* light cyan */
    border: 1px solid #93e2fc; /* medium blue */
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.lighthouse-card h2 {
    margin-top: 0;
    color: #000; /* black text */
    font-size: 1.8em;
}

.lighthouse-card p {
    color: #000; /* black text */
    font-size: 1em;
    margin: 5px 0;
}


footer {
    background-color: #caf0fe; /* light cyan */
    text-align: center;
    padding: 10px;
    position: bottom;
    width: 100%;
    bottom: 0;
    color: #000; /* black text */
}

   </style>
</head>
<body>
   <header>
       <!-- Navigation Bar -->
       <nav class="navbar">
           <div class="logo">
               <img src="images/zalogo.jpg" alt="Logo">
           </div>
           <ul class="nav-links">
               <li><a href="index.html">Login</a></li>
               <li><a href="lighthouses.php">Lighthouses</a></li>
               <li><a href="events.php">Events</a></li>
               <li><a href="merchandise.php">Merchandise</a></li>
               <li><a href="cart.php">Shopping Cart</a></li>
           </ul>
       </nav>

       <h1>Lighthouse Information</h1>
       <p>Explore famous lighthouses from around the world.</p>
   </header>

   <section id="lighthouse-container">
       <!-- Lighthouse data will be dynamically loaded here -->
   </section>

   <footer>
       <p>&copy; 2024 Lighthouse Enthusiasts</p>
   </footer>

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
       $(document).ready(function() {
           $.ajax({
               url: 'fetch_lighthouses.php',  // This is the PHP file that fetches the lighthouse data
               method: 'GET',
               dataType: 'json',
               success: function(data) {
                   if (data.length > 0) {
                       data.forEach(function(lighthouse) {
                           let html = `
                               <div class="lighthouse-card">
                                   <h2>${lighthouse.name}</h2>
                                   <p><strong>Location:</strong> ${lighthouse.location}</p>
                                   <p><strong>Coordinates:</strong> ${lighthouse.coordinates}</p>
                                   <p><strong>Year Built:</strong> ${lighthouse.year_built}</p>
                                   <p><strong>Height:</strong> ${lighthouse.height} meters</p>
                                   <p><strong>Description:</strong> ${lighthouse.description}</p>
                               </div>
                           `;
                           $('#lighthouse-container').append(html);
                       });
                   } else {
                       $('#lighthouse-container').html('<p>No lighthouses found.</p>');
                   }
               },
               error: function() {
                   $('#lighthouse-container').html('<p>Error loading data.</p>');
               }
           });
       });
   </script>
</body>
</html>
