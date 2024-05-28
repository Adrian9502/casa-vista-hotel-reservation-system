<?php
session_start();
if ($_SESSION['role'] !== 'customer') {
  header("Location: ../login/login.html");
  exit();
}

if (isset($_SESSION['username'])) {
  // Get the logged-in username
  $user_id = $_SESSION['user_id'];
  $username = $_SESSION['username'];
} else {
  $username = null;
  header("location: ../login/login.html");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Casa Vista</title>
  <link rel="icon" href="../img/icon.png" type="image/x-icon" />
  <link rel="stylesheet" href="../styles/general.css" />
  <link rel="stylesheet" href="../styles/customerDashboard-header.css" />
  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="../styles/customerDashboard.css" />
  <!-- box icons -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../styles/footer.css">
  <link rel="stylesheet" href="../styles/customerDashboard/hotel-images.css">
</head>

<body class="bg-secondary">
  <header class="header circle  sticky">
    <section class="header-left">
      <span class="header-left-logo-container">
        <a href="../pages/customerDashboard.php">
          <img class="header-logo" src="../img/logo-header.png" alt="brand logo" />
        </a>
      </span>
    </section>

    <section class="header-right" id="header-links">
      <a class="text-primary font-md1" href="#hotel">Hotel</a>
      <a class="text-primary font-md1" href="#rooms">Rooms</a>
      <a class="text-primary font-md1" id="myReservation">My Reservations</a>
      <a class="text-primary font-md1" href="#about">About</a>
      <a class="text-primary font-md1" href="#about">Contact</a>
      <a class="text-primary font-md1" href="../accounts/logout.php">Log out</a>
      <span class="user-container-mobile">
        <i class='bx bxs-user'></i>
        <?php echo "&nbsp $username"; ?>
      </span>
    </section>

  </header>
  <!-- 1st image group -->
  <section class="image-container fade-in-left">
    <span class="img-title">Discover your new favorite stay</span>
    <div class="img-grid">
      <div><img src="https://images.unsplash.com/photo-1563911302283-d2bc129e7570?q=80&w=1935&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
        <span class="image-type">Resort</span>
      </div>
      <div><img src="https://images.unsplash.com/photo-1613977257365-aaae5a9817ff?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt=""><span class="image-type">Villa</span>
      </div>
      <div><img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?q=80&w=1980&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt=""><span class="image-type">Apartment</span>
      </div>
      <div><img src="https://images.unsplash.com/photo-1622644874224-7bdb61351dca?q=80&w=1935&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt=""><span class="image-type">Condo</span>
      </div>
      <div><img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?q=80&w=1949&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt=""><span class="image-type">All exclusive</span>
      </div>
    </div>
  </section>
  <!-- 2nd image group -->
  <section class="image-container-locations fade-in-right">
    <div class="img-title-locations">
      Explore stays in different destinations
    </div>
    <div class="img-grid-loc">
      <div>
        <img src="https://arreorealty.com/wp-content/uploads/2022/08/Hotel-Resort-for-Sale-in-Calamba-Laguna-1.jpg" alt="">
        <span class="image-type-loc">Calamba, Laguna </span>
      </div>
      <div>
        <img src="https://www.philippinetraveler.com/wp-content/uploads/manila-city.jpg" alt="">
        <span class="image-type-loc">Taytay, Rizal</span>
      </div>
      <div>
        <img src="https://megaworldmnl.com/wp-content/uploads/2022/02/Makati-City.jpg" alt="">
        <span class="image-type-loc">Bonifacio Global City, Taguig</span>
      </div>
      <div>
        <img src="https://a.cdn-hotels.com/gdcs/production41/d1859/0e3e7394-9ef7-48b3-9318-49fb1c4e060a.jpg?impolicy=fcrop&w=800&h=533&q=medium" alt="">
        <span class="image-type-loc">Manila, Philippines</span>
      </div>
    </div>
    <div id="hotel"></div>
  </section>
  <!-- Hotel -->
  <div class="container  bg-tertiary" id="hotel">
    <div class="container-title circle fade-in-left">Hotels</div>
    <div class="hotel-con fade-in-left">
      <div class="slider">
        <!-- Hotel 1 -->
        <div class="slider__slide slider__slide--active" data-slide="1">
          <div class="slider__wrap">
            <div class="slider__back"></div>
          </div>
          <div class="slider__inner">
            <div class="slider__content">
              <h1>Sunset Inn</h1>
              <a class="go-to-next">next</a>
            </div>
            <div class="desc-con">
              <div class="hotel-desc">
                Welcome to Sunset Inn, a seaside retreat offering stunning views
                and top-notch amenities. Located at 123 Ocean Drive, Miami, our
                resort provides the perfect escape with its serene atmosphere
                and panoramic ocean vistas.
              </div>
              <div class="features">
                <span>
                  <i class="bx bx-wifi"></i> High-speed Wi-Fi connection
                </span>
                <span><i class="bx bxs-user"></i> Max guest : 2</span>
                <span><i class="bx bxs-bed"></i> Bed size(s) : King/Twin</span>
                <span><i class="bx bxs-door-open"></i> Room size : 34m²</span>
                <span><i class="bx bx-water"></i> Luxury pools</span>
                <span>
                  <i class="bx bxs-tv"></i>
                  70" Smart Television
                </span>
              </div>
            </div>
          </div>
        </div>
        <!-- Hotel 2 -->
        <div class="slider__slide slider__slide--active" data-slide="2">
          <div class="slider__wrap">
            <div class="slider__back"></div>
          </div>
          <div class="slider__inner">
            <div class="slider__content">
              <h1>Mountain View</h1>
              <a class="go-to-next">next</a>
            </div>
            <div class="desc-con">
              <div class="hotel-desc">
                Discover Mountain View at 456 Mountain Rd, Denver. Embrace the
                Rockies' beauty and enjoy luxury accommodations with exclusive
                ski access for a truly relaxing adventure. Experience a beauty
                of nature at Mountain View
              </div>
              <div class="features">
                <span>
                  <i class="bx bx-wifi"></i> High-speed Wi-Fi connection
                </span>
                <span><i class="bx bxs-user"></i> Max guest : 2</span>
                <span><i class="bx bxs-bed"></i> Bed size(s) : King/Twin</span>
                <span><i class="bx bxs-door-open"></i> Room size : 34m²</span>
                <span><i class="bx bxs-bath"></i> Luxury bathroom amenities</span>
                <span><i class="bx bxs-checkbox-minus"></i> Living room</span>
              </div>
            </div>
          </div>
        </div>
        <!-- Hotel 3 -->
        <div class="slider__slide slider__slide--active" data-slide="3">
          <div class="slider__wrap">
            <div class="slider__back"></div>
          </div>
          <div class="slider__inner">
            <div class="slider__content">
              <h1>City Central</h1>
              <a class="go-to-next">next</a>
            </div>
            <div class="desc-con">
              <div class="hotel-desc">
                Welcome to City Central at 789 Downtown Blvd, NY, where urban
                sophistication meets comfort. Immerse yourself in the vibrant
                energy of NYC while enjoying the convenience and luxury of our
                centrally located resort.
              </div>
              <div class="features">
                <span><i class="bx bxs-bath"></i> Jacuzzi</span>
                <span>
                  <i class="bx bx-wifi"></i> High-speed Wi-Fi connection
                </span>
                <span><i class="bx bxs-user"></i> Max guest : 2</span>
                <span><i class="bx bxs-bed"></i> Bed size(s) : King</span>
                <span><i class="bx bxs-door-open"></i> Room size : 39m²</span>
                <span><i class="bx bxs-bath"></i> Bathtub & Shower</span>
              </div>
            </div>
          </div>
        </div>
        <!-- Hotel 4 -->
        <div class="slider__slide slider__slide--active" data-slide="4">
          <div class="slider__wrap">
            <div class="slider__back"></div>
          </div>
          <div class="slider__inner">
            <div class="slider__content">
              <h1>Urban Oasis</h1>
              <a class="go-to-next">next</a>
            </div>
            <div class="desc-con">
              <div class="hotel-desc">
                Escape the hustle and bustle in this tranquil retreat, where
                contemporary elegance meets urban allure.
              </div>
              <div class="features">
                <span>
                  <i class="bx bx-wifi"></i> High-speed Wi-Fi connection
                </span>
                <span><i class="bx bxs-user"></i> Max guest : 5</span>
                <span><i class="bx bxs-bed"></i> Bed size(s) : King</span>
                <span><i class="bx bxs-door-open"></i> Room size : 54m²</span>
                <span><i class="bx bx-water"></i> Luxury pools</span>
                <span>
                  <i class="bx bxs-tv"></i>
                  76" Smart Television
                </span>
              </div>
            </div>
          </div>
        </div>
        <!-- Hotel 5 -->
        <div class="slider__slide slider__slide--active" data-slide="5">
          <div class="slider__wrap">
            <div class="slider__back"></div>
          </div>
          <div class="slider__inner">
            <div class="slider__content">
              <h1>Opuluxe Palazzo</h1>
              <a class="go-to-next">next</a>
            </div>
            <div class="desc-con">
              <div class="hotel-desc">
                Enter a world of opulence and grandeur at this palatial
                destination, where luxury knows no bounds and every whim is
                catered to.
              </div>
              <div class="features">
                <span>
                  <i class="bx bx-wifi"></i> High-speed Wi-Fi connection
                </span>
                <span><i class="bx bxs-user"></i> Max guest : 2</span>
                <span><i class="bx bxs-bed"></i> Bed size(s) : King</span>
                <span><i class="bx bxs-door-open"></i> Room size : 68m²</span>
                <span><i class="bx bx-water"></i> Bathtub & Shower</span>
                <span><i class="bx bxs-tv"></i> Living room</span>
                <span><i class="bx bxs-coffee"></i> Coffee machine</sp>
              </div>
            </div>
          </div>
        </div>
        <div class="slider__indicators"></div>
      </div>
    </div>
  </div>
  <div id="rooms" class="container-title circle bg-tertiary">Rooms</div>



  <div id="rooms">
    <!-- function to retrieve data from database -->
    <?php
    // Establish database connection
    include('../accounts/db.php');

    // Function to get hotel name by ID
    function getHotelName($hotelId)
    {
      global $conn;
      // Retrieve hotel name from the Hotels table
      $sql = "SELECT name FROM Hotel WHERE hotel_id = $hotelId";
      $result = $conn->query($sql);

      // Check for errors
      if (!$result) {
        // Log the error or display it
        echo "Error: " . $conn->error;
        return "Unknown Hotel";
      }

      // Check if query was successful
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['name'];
      } else {
        // No hotel found with the specified ID
        return "Unknown Hotel";
      }
    }


    // Function to display rooms for a given hotel ID
    function displayRooms($hotelId, $descriptions,)
    {
      global $conn;
      $sql = "SELECT * FROM Rooms WHERE hotel_id = $hotelId";
      $result = $conn->query($sql);

      // Check if rooms are found
      if ($result && $result->num_rows > 0) {
        $index = 0;
        // Loop through each room
        while ($row = $result->fetch_assoc()) {
          // Display room information
    ?>
          <div class="rooms-container fade-in-left">
            <div class="room-img-con">
              <img src="<?php echo $row["img_link"]; ?>" alt="">
            </div>
            <div class="room-description">
              <h2><?php echo "ROOM " . $row["room_number"]; ?></h2>
              <h3>$<?php echo $row["price"]; ?> per night</h3>
              <p><?php echo $descriptions[$index]; ?></p>
              <div class="avail yes <?php echo ($row["status"]); ?>">
                <i class='bx bxs-circle'></i> <?php echo ucfirst($row["status"]); ?>
              </div>
              <div class="type-con">
                <span class="type"><?php echo $row["type"]; ?></span>
              </div>
            </div>
            <div class="button-container">
              <button class="book-now-button-small">
                <span>BOOK NOW</span>
              </button>
            </div>
          </div>
    <?php
          $index++;
        }
      } else {
        echo "<p>No rooms found for this hotel.</p>";
      }
    }

    ?>
    <!-- Sunset Inn Rooms -->
    <div class="container-rooms white-bg bg-secondary">
      <div class="rooms-grid-wrapper">
        <!-- Get hotel name -->
        <?php $hotelName = getHotelName(1); ?>
        <h1 class="hotel-name fade-in-left"><?php echo $hotelName; ?></h1>
        <div class="rooms-grid">
          <?php
          // Room descriptions for Sunset Inn
          $descriptions = [
            "Enter a stylishly appointed room featuring modern décor, ample natural light, and comfortable furnishings, providing a tranquil retreat for your stay.",
            "Step into a chic room, modernly adorned with ample natural light, offering serene comfort and relaxation with its comfortable amenities.",
            "Enjoy a spacious room with elegant décor, a king-size bed, and a stunning city view. Ideal for both business and leisure travelers.",
            "Experience luxury in a beautifully designed suite with a separate living area, premium bedding, and a private balcony overlooking the garden."
          ];
          // Display rooms for Sunset Inn
          displayRooms(1, $descriptions);
          ?>
        </div>
      </div>
    </div>

    <!-- Mountain View Rooms -->
    <div class="container-rooms circle bg-tertiary">

      <div class="rooms-grid-wrapper">
        <!-- Get hotel name -->
        <?php $hotelName = getHotelName(2); ?>
        <h1 class="hotel-name hotel-dark fade-in-left"><?php echo $hotelName; ?></h1>
        <div class="rooms-grid">
          <?php
          // Room descriptions for Sunset Inn
          $descriptions = [
            "Relax in a chic room with modern décor and ample natural light, offering a serene stay with comfortable amenities.",
            "Enjoy a stylishly furnished room with contemporary design and a soothing ambiance for a comfortable retreat.",
            "Indulge in an opulent suite featuring a lavish living space, a jacuzzi tub, and panoramic ocean views. Perfect for a romantic getaway.",
            "Stay in a tastefully decorated room with modern amenities, a scenic mountain view, offering a serene and relaxing environment."
          ];
          // Display rooms for Sunset Inn
          displayRooms(2, $descriptions);
          ?>
        </div>
      </div>
    </div>

    <!-- City Central Rooms -->
    <div class="container-rooms white-bg bg-secondary">
      <div class="rooms-grid-wrapper">
        <!-- Get hotel name -->
        <?php $hotelName = getHotelName(3); ?>
        <h1 class="hotel-name fade-in-left"><?php echo $hotelName; ?></h1>
        <div class="rooms-grid">
          <?php
          // Room descriptions for Sunset Inn
          $descriptions = [
            "Unwind in a tastefully decorated room with comfortable amenities and abundant natural light, ensuring a tranquil and peaceful stay.",
            "Experience relaxation in a well-appointed room with contemporary elements and expansive windows, providing a serene and comfortable atmosphere.",
            "Unwind in this beautifully decorated deluxe room, offering a comfortable king-sized bed and a stylish seating area to relax after a long day.",
            "This luxurious suite features a separate living room, a spacious bedroom with a king-sized bed, and an opulent bathroom with a rain shower."
          ];
          // Display rooms for Sunset Inn
          displayRooms(3, $descriptions);
          ?>
        </div>
      </div>
    </div>

    <!-- Urban Oasis Rooms -->
    <div class="container-rooms circle bg-tertiary">
      <div class="rooms-grid-wrapper">
        <div class="rooms-grid-wrapper">
          <!-- Get hotel name -->
          <?php $hotelName = getHotelName(4); ?>
          <h1 class="hotel-name hotel-dark fade-in-left"><?php echo $hotelName; ?></h1>
          <div class="rooms-grid">
            <?php
            // Room descriptions for Sunset Inn
            $descriptions = [
              "Indulge in this deluxe room with floor-to-ceiling windows, a plush king-sized bed, and a spacious bathroom with premium amenities.",
              "Relax in this expansive suite, offering a separate living area, a king-sized bed, and a luxurious marble bathroom with a deep soaking tub.",
              "Experience ultimate luxury in this penthouse suite, featuring panoramic views, a spacious living area, and a private terrace.",
              "This deluxe room offers stylish decor, a comfortable king-sized bed, and a private balcony with garden views."
            ];
            // Display rooms for Sunset Inn
            displayRooms(4, $descriptions);
            ?>
          </div>
        </div>
      </div>

      <!-- Opuluxe Palazzo Rooms -->
      <div class="container-rooms white-bg bg-secondary">
        <div class="rooms-grid-wrapper">
          <!-- Get hotel name -->
          <?php $hotelName = getHotelName(5); ?>
          <h1 class="hotel-name fade-in-left"><?php echo $hotelName; ?></h1>
          <div class="rooms-grid">
            <?php
            // Room descriptions for Sunset Inn
            $descriptions = [
              "Stay in this modern standard room, equipped with a queen-sized bed, contemporary furnishings, and a convenient work area.",
              "Enjoy the comfort of this deluxe room, featuring elegant furnishings, a king-sized bed, and a spacious bathroom with a walk-in shower.",
              "Unwind in this beautifully decorated deluxe room, offering a comfortable king-sized bed and a stylish seating area to relax after a long day.",
              "Relax in this sophisticated suite, offering a separate living area, a king-sized bed, and a luxurious bathroom with a whirlpool tub."
            ];
            // Display rooms for Sunset Inn
            displayRooms(5, $descriptions);
            ?>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Overlay -->
  <div class="overlay" id="overlay"></div>
  <!-- Room Booking form -->
  <div class="booking-form-container fade-in-bck" id="bookingFormContainer">
    <form id="bookingForm" class="booking-form">
      <div class="form-header">
        <h2 class="form-title">Room Booking</h2>
        <button class="close-button" title="close" id="closeFormButton">×</button>
      </div>
      <!-- Include a hidden input field for user_id -->
      <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

      <div class="form-group">
        <label for="hotelSelect" class="form-label">Select Hotel:</label>
        <select id="hotelSelect" name="hotel_id" class="form-control" required>
          <?php
          include("../accounts/db.php");

          $sql = "SELECT hotel_id, name FROM Hotel";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo '<option value="' . $row["hotel_id"] . '">' . $row["name"] . '</option>';
            }
          } else {
            echo '<option value="">No hotels available</option>';
          }
          $conn->close();
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="roomSelect" class="form-label">Select Room:</label>
        <select id="roomSelect" name="room_id" class="form-control" required>
          <!-- Options for rooms will be dynamically populated -->
          <option value="">Select a room</option>
        </select>
      </div>
      <div class="form-group">
        <label for="checkIn" class="form-label">Check-in Date:</label>
        <input type="date" id="checkIn" name="check_in" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="checkOut" class="form-label">Check-out Date:</label>
        <input type="date" id="checkOut" name="check_out" class="form-control" required>
      </div>
      <div class="form-group button-center">
        <button type="submit" class="btn-primary" id="submitForm">Book Room</button>
      </div>
    </form>
  </div>
  <!-- Overlay -->
  <div class="overlay overlay1" id="overlay1"></div>
  <!-- My Reservation -->
  <?php
  include("../accounts/db.php");

  $user_id = mysqli_real_escape_string($conn, $user_id);

  $query = "SELECT Hotel.name AS hotel_name, Rooms.room_number, Rooms.type, Reservations.check_in, Reservations.check_out, Rooms.price
          FROM Reservations
          INNER JOIN Users ON Reservations.user_id = Users.user_id
          INNER JOIN Rooms ON Reservations.room_id = Rooms.room_id
          INNER JOIN Hotel ON Rooms.hotel_id = Hotel.hotel_id
          WHERE Users.user_id = '$user_id'";

  $result = mysqli_query($conn, $query);
  ?>

  <div class="reservation-container fade-in-bck" id="reservationContainer">
    <div class="form-header">
      <h2 class="form-title">My Reservation</h2>
      <button class="close-button" title="close" id="closeConButton">×</button>
    </div>
    <div class="reservation-details">
      <?php if (mysqli_num_rows($result) > 0) { ?>
        <table>
          <thead>
            <tr>
              <th>Hotel</th>
              <th>Room Number</th>
              <th>Room Type</th>
              <th>Check-in Date</th>
              <th>Check-out Date</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Display reservation details
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?php echo $row['hotel_name']; ?></td>
                <td><?php echo $row['room_number']; ?></td>
                <td><?php echo $row['type']; ?></td>
                <td><?php echo $row['check_in']; ?></td>
                <td><?php echo $row['check_out']; ?></td>
                <td>$<?php echo $row['price']; ?></td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      <?php } else { ?>
        <div class="no-booked">"No Booked Room"</div>
      <?php } ?>
    </div>
  </div>


  <!-- About and contact -->
  <footer class="footer-container bg-tertiary">
    <div class="about-container">
      <div class="footer-about" id="about">
        <div class="footer-title text-secondary">About Casa Vista</div>
        <p class="text-dark footer-description">
          Welcome to Casa Vista, your premier destination for discovering the
          finest accommodations in every city across the Philippines. Nestled
          amidst the stunning landscapes and rich cultural heritage of the
          Philippines, Casa Vista offers a curated selection of hotels,
          ensuring a memorable stay wherever your adventures take you.
        </p>
        <div class="footer-title text-secondary">Personalized Service</div>
        <p class="text-dark footer-description">
          At Casa Vista, personalized service is our priority. Our dedicated
          team is committed to anticipating your needs and providing
          assistance whenever required. Whether it's arranging transportation
          or recommending local attractions, we're here to ensure your
          experience is seamless and stress-free.
        </p>
        <div class="contact-container">
          <div class="footer-title text-secondary">Contact Us</div>
          <div class="social-icons">
            <i class="bx bxl-facebook-circle text-dark"></i>
            <i class="bx bxs-envelope text-dark"></i>
            <i class="bx bxl-twitter text-dark"></i>
            <i class="bx bxl-instagram-alt text-dark"></i>
          </div>
        </div>
      </div>
      <div class="footer-get-in-touch">
        <div class="footer-title text-secondary">Get in Touch</div>
        <p class="text-dark footer-description">
          Ready to begin your Philippine journey? Book your accommodations
          with Casa Vista today and embark on an unforgettable exploration of
          the Philippines. Have inquiries or special requests? Our friendly
          team is always available to assist you. Contact us to discover more
          about our offerings, amenities, and exclusive deals.
        </p>
        <div class="footer-title text-secondary">Explore and Indulge</div>
        <p class="text-dark footer-description">
          Discover the beauty of the Philippines with Casa Vista as your
          trusted guide. Whether you're eager to explore iconic landmarks,
          savor delicious cuisine at our partner hotels, or unwind by pristine
          beaches, there's something for every traveler to enjoy. Let Casa
          Vista be your gateway to remarkable adventures and cherished
          memories throughout the Philippines.
        </p>
      </div>
      <div class="footer-map">
        <div class="map-container">
          <div class="footer-title text-secondary location-title">
            Our Location
          </div>
          <div class="footer-map-container">
            <img src="https://storage.googleapis.com/support-forums-api/attachment/thread-216441714-17222946594181417489.png" alt="hotel map" />
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script src="../../hotel_reservation_system/scripts/customer-dashboard/customer.js"></script>
  <script src="../../hotel_reservation_system/scripts/customer-dashboard/hotel-images.js"></script>
</body>

</html>