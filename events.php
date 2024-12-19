<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Upcoming Events</title>
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
    padding: 50px;
    text-align: center;
    color: #000; /* black text */
}

header h1 {
    margin: 20;
    font-size: 2.5em;
}

header p {
    margin: 10;
    font-size: 1.2em;
}

.search-container {
    background-color: #a2bcd6; /* blue-grey */
    padding: 40px;
    text-align: center;
}

.search-bar {
    width: 80%;
    padding: 10px;
    font-size: 1em;
    border: 1px solid #93e2fc; /* medium blue border */
    border-radius: 5px;
}

.clear-search {
    background-color: #93e2fc; /* medium blue */
    border: none;
    color: white;
    font-size: 1.2em;
    cursor: pointer;
    padding: 0 10px;
    margin-left: -30px;
    border-radius: 5px;
    position: absolute;
    
}

.clear-search:hover {
    background-color: #a2bcd6; /* blue-grey */
}

#event-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    padding: 20px;
    background-color: #a2bcd6; /* blue-grey */
}

.event-card {
    background-color: white;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    transition: transform 0.3s ease;
    text-align: center;
}

.event-card:hover {
    transform: scale(1.05);
}

.event-card h2 {
    color: #333;
}

.event-card p {
    margin: 8px 0;
    color: #555;
    font-size: 14px;
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
 <!-- Navigation Bar -->
 <body>
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


</div>
    <header>
<div class="search-container">
    <input type="text" id="search-bar" class="search-bar" placeholder="Search events..." onkeyup="searchEvents()">
    <button id="clear-search" class="clear-search" onclick="clearSearch()">&#10006;</button>
    <ul id="event-list" class="event-list"></ul>
        <h1>Upcoming Lighthouse Events</h1>
        <p>Join us for exciting events at our beautiful lighthouses.</p>
    </header>

    <section id="event-container">
        <!-- Event data will be dynamically loaded here -->
    </section>

    <footer>
        <p>&copy; 2024 Lighthouse Enthusiasts</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'fetch_events.php',  // This is the PHP file that fetches event data
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length > 0) {
                        data.forEach(function(event) {
                            let eventDate = new Date(event.event_date);
                            let formattedDate = eventDate.toLocaleString('en-US', {
                                weekday: 'long',
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric',
                                hour: 'numeric',
                                minute: 'numeric'
                            });

                            let html = `
                                <div class="event-card">
                                    <h2>${event.event_name}</h2>
                                    <p><strong>Date:</strong> ${formattedDate}</p>
                                    <p><strong>Location:</strong> ${event.location}</p>
                                    <p><strong>Description:</strong> ${event.description}</p>
                                </div>
                            `;
                            $('#event-container').append(html);
                        });
                    } else {
                        $('#event-container').html('<p>No upcoming events found.</p>');
                    }
                },
                error: function() {
                    $('#event-container').html('<p>Error loading data.</p>');
                }
            });
        });

        function searchEvents() {
        var query = document.getElementById('search-bar').value;
        
        // AJAX request to fetch events based on search query
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "search_events.php?q=" + query, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var events = JSON.parse(xhr.responseText);
                displayEvents(events);
            }
        };
        xhr.send();
    }

    function displayEvents(events) {
        var eventList = document.getElementById('event-list');
        eventList.innerHTML = ''; // Clear previous results
        
        if (events.length > 0) {
            events.forEach(function(event) {
                var li = document.createElement('li');
                li.classList.add('event-item');
                li.innerHTML = '<h4>' + event.event_name + '</h4><p>' + event.location + ' - ' + event.event_date + '</p>';
                eventList.appendChild(li);
            });
        } else {
            eventList.innerHTML = '<li>No events found.</li>';
        }
    }
    function clearSearch() {
    document.getElementById('search-bar').value = '';
    document.getElementById('event-list').innerHTML = ''; // Clear the event list
}
    </script>
</body>
</html>
