<!DOCTYPE html>
<html>

<head>
    <title>Creating Database Table</title>
</head>

<body>

<?php
$servername = "zainabsproject";
$username = "root";
$password = "";
$dbname = "lighthouse_enthusiasts_db";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// // Drop database if exists
// $sql = "DROP DATABASE IF EXISTS $dbname;";
// if ($conn->query($sql) === TRUE) {
//   echo "Database DROPPED successfully<br>";
// } else {
//   echo "Error creating database: " . $conn->error;
// }

// Create database
$sql = "CREATE DATABASE $dbname;";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully<br>";
} else {
  echo "Error creating database: " . $conn->error;
}

$conn->close();

//$conn = new mysqli("zainabsproject", "root", "", $dbname);
$conn = new mysqli("zainabsproject", "root", "", $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255)  NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
";

if ($conn->query($sql) === TRUE) {
  echo "Table created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error;
}


// sql to create table
$sql = "CREATE TABLE orders (
  order_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  total_amount DECIMAL(10,2),
  status ENUM('available', 'unavailable') DEFAULT 'available',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB;
";

if ($conn->query($sql) === TRUE) {
  echo "Table created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE merchandise (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR (100) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL (10,2) NOT NULL,
    stock_quantity INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  ) ENGINE=InnoDB;
  ";
  
  if ($conn->query($sql) === TRUE) {
    echo "Table created successfully<br>";
  } else {
    echo "Error creating table: " . $conn->error;
  }

// sql to create table

$sql = "CREATE TABLE order_items (
  order_item_id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  item_id INT NOT NULL,
  quantity INT NOT NULL,
  price DECIMAL (10,2) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
  FOREIGN KEY (item_id) REFERENCES merchandise(item_id) ON DELETE CASCADE
) ENGINE=InnoDB;";

if ($conn->query($sql) === TRUE) {
  echo "Table created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error;
}





$sql = "CREATE TABLE lighthouses (
  lighthouse_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR (100) NOT NULL,
  location VARCHAR (100) NOT NULL,
  coordinates VARCHAR (50) NOT NULL,
  year_built INT NOT NULL,
  height DECIMAL NOT NULL,
  description TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;";

if ($conn->query($sql) === TRUE) {
  echo "Table created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE events (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    lighthouse_id INT NOT NULL,
    event_name VARCHAR (100) NOT NULL,
    event_date DATETIME NOT NULL,
    location VARCHAR (100) NOT NULL,
    description TEXT NOT NULL,
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (lighthouse_id) REFERENCES lighthouses(lighthouse_id) ON DELETE CASCADE
) ENGINE=InnoDB;
";

if ($conn->query($sql) === TRUE) {
  echo "Table created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error;
}







$sql = "INSERT INTO users(username, password, email) VALUES
('user1', 'password1', 'user1@example.com'),
('user2', 'password2', 'user2@example.com'),
('user3', 'password3', 'user3@example.com'),
('user4', 'password4', 'user4@example.com'),
('user5', 'password5', 'user5@example.com'),
('user6', 'password6', 'user6@example.com'),
('user7', 'password7', 'user7@example.com'),
('user8', 'password8', 'user8@example.com'),
('user9', 'password9', 'user9@example.com'),
('user10', 'password10', 'user10@example.com'),
('user11', 'password11', 'user11@example.com'),
('user12', 'password12', 'user12@example.com'),
('user13', 'password13', 'user13@example.com'),
('user14', 'password14', 'user14@example.com'),
('user15', 'password15', 'user15@example.com'),
('user16', 'password16', 'user16@example.com'),
('user17', 'password17', 'user17@example.com'),
('user18', 'password18', 'user18@example.com'),
('user19', 'password19', 'user19@example.com'),
('user20', 'password20', 'user20@example.com');

";

if ($conn->query($sql) === TRUE) {
    echo "Table entries created successfully<br>";
  } else {
    echo "Error creating table: " . $conn->error;
  }
  

  
    
$sql = "INSERT INTO lighthouses (name, location, coordinates, year_built, height, description, created_at, updated_at) VALUES
('Cape Cod Lighthouse', 'Cape Cod, Massachusetts, USA', '41.9883° N, 70.2270° W', 1797, 66.5, 'A historic lighthouse built to guide ships around Cape Cod. It stands tall on the shoreline, providing visibility for miles around.', '2024-12-01 08:30:00', '2024-12-01 08:30:00'),
('Pigeon Point Lighthouse', 'Pescadero, California, USA', '37.1836° N, 122.3886° W', 1872, 115, 'One of the tallest lighthouses on the West Coast, known for its white and black stripes. Its a popular spot for tourists and photographers.', '2024-12-02 09:00:00', '2024-12-02 09:00:00'),
('Lighthouse of Alexandria', 'Alexandria, Egypt', '31.2156° N, 29.8855° E', 280, 130, 'One of the Seven Wonders of the Ancient World, this lighthouse was destroyed by earthquakes in the 14th century but was a marvel in its time.', '2024-12-03 10:15:00', '2024-12-03 10:15:00'),
('Point Reyes Lighthouse', 'Point Reyes, California, USA', '37.9926° N, 123.0163° W', 1870, 62, 'Located on the rugged Point Reyes, this lighthouse has been guiding ships safely through dangerous waters for over 150 years.', '2024-12-04 11:30:00', '2024-12-04 11:30:00'),
('Bodie Island Lighthouse', 'Nags Head, North Carolina, USA', '35.9703° N, 75.5285° W', 1872, 56, 'A distinctive black-and-white striped lighthouse, it has guided sailors through the treacherous waters of the Outer Banks.', '2024-12-05 12:00:00', '2024-12-05 12:00:00'),
('Eastern Point Lighthouse', 'Gloucester, Massachusetts, USA', '42.6158° N, 70.6559° W', 1832, 35, 'This lighthouse is a prominent feature of Gloucester Harbor and has helped protect ships from the dangerous rocks near the shore.', '2024-12-06 13:45:00', '2024-12-06 13:45:00'),
('Heceta Head Lighthouse', 'Florence, Oregon, USA', '44.1432° N, 124.1111° W', 1894, 56, 'A scenic lighthouse located on a bluff, offering breathtaking views of the Pacific Ocean and surrounding coastline.', '2024-12-07 14:15:00', '2024-12-07 14:15:00'),
('St. Augustine Lighthouse', 'St. Augustine, Florida, USA', '29.8668° N, 81.2768° W', 1874, 165, 'One of the most iconic lighthouses in the United States, known for its black and white spiral stripes and its role in guiding ships to Floridas coast.', '2024-12-08 15:30:00', '2024-12-08 15:30:00'),
('Lizard Point Lighthouse', 'Lizard Peninsula, Cornwall, UK', '49.9950° N, 5.2160° W', 1619, 35, 'The southernmost point of mainland Britain, this lighthouse has been a beacon for sailors navigating the English Channel for centuries.', '2024-12-09 16:00:00', '2024-12-09 16:00:00'),
('Cape Hatteras Lighthouse', 'Buxton, North Carolina, USA', '35.2583° N, 75.5328° W', 1803, 208, 'Famous for its black-and-white spiral pattern, Cape Hatteras is the tallest brick lighthouse in America and a major symbol of the Outer Banks.', '2024-12-10 17:00:00', '2024-12-10 17:00:00'),
('Phare de la Jument', 'Ouessant Island, France', '48.4413° N, 5.0503° W', 1911, 44, 'A rugged lighthouse located on a remote island off the coast of Brittany, known for its dramatic and picturesque settings.', '2024-12-11 18:00:00', '2024-12-11 18:00:00'),
('Lanterna di Genova', 'Genoa, Italy', '44.4091° N, 8.9309° E', 1543, 76, 'The oldest lighthouse in Italy, located at the entrance of the harbor of Genoa. It serves as both a symbol of the city and a beacon for ships.', '2024-12-12 19:30:00', '2024-12-12 19:30:00'),
('Terry Island Lighthouse', 'Terry Island, South Carolina, USA', '32.3167° N, 79.9253° W', 1859, 48, 'Located in the coastal waters of South Carolina, this lighthouse has stood the test of time, offering crucial guidance to sailors.', '2024-12-13 20:15:00', '2024-12-13 20:15:00'),
('Sail Rock Lighthouse', 'Sail Rock, Maine, USA', '43.6875° N, 69.6820° W', 1835, 40, 'This lighthouse is perched on a small rock off the coast of Maine, offering a striking image against the Atlantic Ocean backdrop.', '2024-12-14 21:00:00', '2024-12-14 21:00:00'),
('Southwold Lighthouse', 'Southwold, Suffolk, UK', '52.3202° N, 1.6771° E', 1890, 35, 'This lighthouse has stood at the entrance to Southwold Harbour, guiding ships along the Suffolk coast for over a century.', '2024-12-15 08:30:00', '2024-12-15 08:30:00'),
('Punta del Este Lighthouse', 'Punta del Este, Uruguay', '34.9820° S, 54.9330° W', 1860, 45, 'A historical lighthouse situated on the southern coast of Uruguay, offering spectacular views of the Atlantic Ocean.', '2024-12-16 09:00:00', '2024-12-16 09:00:00'),
('Fisgard Lighthouse', 'Colwood, British Columbia, Canada', '48.4003° N, 123.4338° W', 1860, 20, 'Fisgard Lighthouse is the first lighthouse built on Canadas west coast, offering a glimpse into maritime history and an iconic sight for locals.', '2024-12-17 10:15:00', '2024-12-17 10:15:00'),
('Tremiti Islands Lighthouse', 'Tremiti Islands, Italy', '42.2634° N, 15.4981° E', 1905, 25, 'Situated on a tiny island, this lighthouse helps guide vessels through the clear waters surrounding the Tremiti Islands.', '2024-12-18 11:30:00', '2024-12-18 11:30:00'),
('Norderney Lighthouse', 'Norderney, Germany', '53.7182° N, 7.1492° E', 1874, 60, 'Built to help ships navigate the treacherous North Sea, Norderney Lighthouse is one of the most iconic landmarks in Germanys East Frisian Islands.', '2024-12-19 12:00:00', '2024-12-19 12:00:00');

";

if ($conn->query($sql) === TRUE) {
    echo "Table entries created successfully<br>";
  } else {
    echo "Error creating table: " . $conn->error;
  }

  

$sql = "INSERT INTO events (lighthouse_id, event_name, event_date, location, description) VALUES
(1, 'Annual Coastal Festival', '2024-07-15 10:00:00', 'Golden Bay Lighthouse', 'A celebration of coastal life with live music, local food, and marine conservation talks.'),
(2, 'Sunset Viewing Party', '2024-06-20 18:30:00', 'Harbor Point Lighthouse', 'Join us for a scenic sunset view, complete with wine and hors d\'oeuvres.'),
(3, 'Lighthouse Lantern Lighting', '2024-09-05 19:00:00', 'Clearview Lighthouse', 'A ceremony to relight the lantern in the historic lighthouse. Includes a short history presentation.'),
(4, 'Marine Awareness Day', '2024-08-10 09:00:00', 'Whale Watch Lighthouse', 'Educational talks and activities focused on marine wildlife and the importance of protecting our oceans.'),
(5, 'Full Moon Beach Walk', '2024-07-06 20:00:00', 'Seaside View Lighthouse', 'A guided beach walk under the full moon, ending at the lighthouse with a bonfire.'),
(6, 'Volunteer Lighthouse Keeper Program', '2024-05-12 08:00:00', 'Cape Breeze Lighthouse', 'A program where visitors can experience a day in the life of a lighthouse keeper, including maintaining the lighthouse and guiding ships.'),
(7, 'Coastal Photography Workshop', '2024-06-25 11:00:00', 'Rocky Point Lighthouse', 'A hands-on workshop focused on capturing coastal landscapes and lighthouse photography.'),
(8, 'Lighthouse History Walk', '2024-08-22 10:30:00', 'Blue Harbor Lighthouse', 'A historical walking tour around the lighthouse and surrounding area, learning about its construction and past role.'),
(9, 'Tidal Pool Exploration', '2024-09-03 14:00:00', 'Tidewatch Lighthouse', 'Explore the tide pools near the lighthouse with a marine biologist and learn about the local sea life.'),
(10, 'Winter Solstice Gathering', '2024-12-21 16:00:00', 'Stormy Point Lighthouse', 'Celebrate the longest night of the year with storytelling, music, and a cozy gathering inside the lighthouse.'),
(11, 'Lighthouse Art Exhibition', '2024-10-17 12:00:00', 'Sunset Cliffs Lighthouse', 'A special art exhibit showcasing lighthouse-inspired artwork from local artists.'),
(12, 'Coastal Cleanup Day', '2024-11-03 09:00:00', 'Pine Ridge Lighthouse', 'Join us in cleaning the beaches around the lighthouse, followed by a light lunch.'),
(13, 'Shipwreck Remembrance Ceremony', '2024-05-30 11:00:00', 'Fisherman’s Bluff Lighthouse', 'A solemn ceremony remembering the shipwrecks in the area, with a moment of silence and wreath-laying.'),
(14, 'Bird Watching and Photography', '2024-04-10 07:00:00', 'Seagull Bay Lighthouse', 'An early morning bird-watching tour with opportunities for photography of local seabirds.'),
(15, 'Lighthouse Night Tour', '2024-10-01 19:30:00', 'Crystal Shores Lighthouse', 'A special nighttime tour of the lighthouse and its grounds, including stargazing and storytelling.'),
(16, 'Coastal Cuisine Cooking Class', '2024-07-18 16:00:00', 'Silver Beach Lighthouse', 'Learn how to prepare coastal dishes with local ingredients in this hands-on cooking class.'),
(17, 'Lighthouse Yoga Retreat', '2024-06-14 08:00:00', 'Eagle’s Nest Lighthouse', 'A peaceful retreat offering morning yoga sessions with breathtaking views of the coastline.'),
(18, 'National Lighthouse Day Celebration', '2024-08-07 09:00:00', 'Baywatch Lighthouse', 'Celebrate National Lighthouse Day with a community event featuring history talks, live music, and a lighthouse tour.'),
(19, 'Oceanside Music Festival', '2024-07-30 12:00:00', 'Silver Sands Lighthouse', 'A day-long music festival with live performances from local bands, food trucks, and games for all ages.');

";

if ($conn->query($sql) === TRUE) {
    echo "Table entries created successfully<br>";
  } else {
    echo "Error creating table: " . $conn->error;
  }
  

    
  $sql = "INSERT INTO merchandise (name, description, price, stock_quantity, created_at, updated_at) VALUES
  ('Lighthouse Table Lamp', 'A beautifully crafted table lamp with a lighthouse design, perfect for nautical-themed rooms.', 39.99, 150, NOW(), NOW()),
  ('Lighthouse Wall Art', 'Canvas print of a majestic lighthouse by the sea, bringing coastal charm to any room.', 45.00, 100, NOW(), NOW()),
  ('Miniature Lighthouse Model', 'Handcrafted miniature lighthouse model, ideal for collectors or as a decorative piece.', 24.99, 200, NOW(), NOW()),
  ('Lighthouse Wind Chimes', 'Set of wind chimes with lighthouse-shaped designs, producing a soothing sound with every breeze.', 19.95, 180, NOW(), NOW()),
  ('Lighthouse Pendant Necklace', 'Sterling silver necklace with a small, elegant lighthouse pendant.', 29.99, 150, NOW(), NOW()),
  ('Lighthouse Outdoor Lantern', 'Weather-resistant outdoor lantern with a lighthouse-inspired design, perfect for patios or gardens.', 59.99, 80, NOW(), NOW()),
  ('Lighthouse Garden Flag', 'Decorative flag with a beautiful lighthouse scene, perfect for brightening up your garden or porch.', 14.99, 250, NOW(), NOW()),
  ('Lighthouse Puzzle', '500-piece jigsaw puzzle featuring a scenic lighthouse view at sunset.', 18.50, 120, NOW(), NOW()),
  ('Lighthouse Desk Clock', 'Classic desk clock with a lighthouse motif, bringing coastal vibes to your office space.', 35.00, 75, NOW(), NOW()),
  ('Lighthouse Keychain', 'Metal keychain in the shape of a lighthouse, great for gifts or personal use.', 7.99, 300, NOW(), NOW()),
  ('Lighthouse Picture Frame', 'Wooden picture frame with a lighthouse carving, perfect for photos of coastal vacations.', 22.50, 180, NOW(), NOW()),
  ('Lighthouse Shower Curtain', 'Shower curtain with a stunning lighthouse and ocean design, adding nautical flair to your bathroom.', 39.99, 140, NOW(), NOW()),
  ('Lighthouse Coasters', 'Set of four cork coasters featuring vintage lighthouse illustrations.', 12.99, 200, NOW(), NOW()),
  ('Lighthouse Tote Bag', 'Durable canvas tote bag with a charming lighthouse print, perfect for beach trips or daily use.', 19.00, 250, NOW(), NOW()),
  ('Lighthouse Tea Set', 'Porcelain tea set with a lighthouse pattern, ideal for afternoon tea with a coastal twist.', 49.99, 60, NOW(), NOW()),
  ('Lighthouse Salt Lamp', 'Himalayan salt lamp shaped like a lighthouse, offering both soothing light and a unique decor piece.', 65.00, 40, NOW(), NOW()),
  ('Lighthouse Candle Holder', 'Candle holder designed in the shape of a lighthouse, providing a warm, cozy glow to any room.', 29.99, 100, NOW(), NOW()),
  ('Lighthouse Beach Towel', 'Soft, absorbent beach towel featuring a vibrant lighthouse scene, perfect for your next beach day.', 23.99, 180, NOW(), NOW()),
  ('Lighthouse Nightlight', 'LED nightlight with a soft, ambient lighthouse design, perfect for kids or coastal lovers.', 16.95, 250, NOW(), NOW()),
  ('Lighthouse Decor Figurine', 'Hand-painted lighthouse figurine, perfect for adding a nautical touch to your home.', 27.50, 150, NOW(), NOW());
  ";
  
  
  if ($conn->query($sql) === TRUE) {
      echo "Table entries created successfully<br>";
    } else {
      echo "Error creating table: " . $conn->error;
    }

    
/*this is for the login stuff*/
$sql = "INSERT INTO orders (user_id, order_date, total_amount, status, created_at, updated_at) VALUES
(1, '2024-12-01 08:30:00', 100.50, 'available', '2024-12-01 08:30:00', '2024-12-01 08:30:00'),
(2, '2024-12-02 09:15:00', 250.75, 'available', '2024-12-02 09:15:00', '2024-12-02 09:15:00'),
(3, '2024-12-03 10:45:00', 300.00, 'unavailable', '2024-12-03 10:45:00', '2024-12-03 10:45:00'),
(4, '2024-12-04 11:00:00', 50.20, 'available', '2024-12-04 11:00:00', '2024-12-04 11:00:00'),
(5, '2024-12-05 12:30:00', 80.30, 'unavailable', '2024-12-05 12:30:00', '2024-12-05 12:30:00'),
(6, '2024-12-06 13:00:00', 120.00, 'available', '2024-12-06 13:00:00', '2024-12-06 13:00:00'),
(7, '2024-12-07 14:15:00', 220.45, 'available', '2024-12-07 14:15:00', '2024-12-07 14:15:00'),
(8, '2024-12-08 15:30:00', 150.60, 'unavailable', '2024-12-08 15:30:00', '2024-12-08 15:30:00'),
(9, '2024-12-09 16:00:00', 200.90, 'available', '2024-12-09 16:00:00', '2024-12-09 16:00:00'),
(10, '2024-12-10 17:30:00', 300.25, 'available', '2024-12-10 17:30:00', '2024-12-10 17:30:00'),
(11, '2024-12-11 18:00:00', 75.40, 'unavailable', '2024-12-11 18:00:00', '2024-12-11 18:00:00'),
(12, '2024-12-12 19:00:00', 180.10, 'available', '2024-12-12 19:00:00', '2024-12-12 19:00:00'),
(13, '2024-12-13 20:45:00', 110.35, 'unavailable', '2024-12-13 20:45:00', '2024-12-13 20:45:00'),
(14, '2024-12-14 21:30:00', 145.80, 'available', '2024-12-14 21:30:00', '2024-12-14 21:30:00'),
(15, '2024-12-15 22:00:00', 205.95, 'available', '2024-12-15 22:00:00', '2024-12-15 22:00:00'),
(16, '2024-12-16 23:30:00', 500.60, 'unavailable', '2024-12-16 23:30:00', '2024-12-16 23:30:00'),
(17, '2024-12-17 08:45:00', 350.25, 'available', '2024-12-17 08:45:00', '2024-12-17 08:45:00'),
(18, '2024-12-18 09:00:00', 60.50, 'unavailable', '2024-12-18 09:00:00', '2024-12-18 09:00:00'),
(19, '2024-12-19 10:00:00', 135.70, 'available', '2024-12-19 10:00:00', '2024-12-19 10:00:00'),
(20, '2024-12-20 11:15:00', 90.90, 'available', '2024-12-20 11:15:00', '2024-12-20 11:15:00');

";

if ($conn->query($sql) === TRUE) {
    echo "Table entries created successfully<br>";
  } else {
    echo "Error creating table: " . $conn->error;
  }
  
$conn->close()
?>
</body>
</html>