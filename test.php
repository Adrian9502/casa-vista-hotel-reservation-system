
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
    function displayRooms($hotelId, $descriptions, )
    {
      global $conn;
      $limit = 5; // Number of rooms per page
      $offset = ($page - 1) * $limit; // Calculate offset
      // Retrieve rooms from the Rooms table for the given hotel ID
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
     // Get page number from query string
     $page = isset($_GET['page']) ? $_GET['page'] : 1;
    ?>
    <!-- Sunset Inn Rooms -->
    <div class="container-rooms bg-secondary">
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
    <div class="container-rooms bg-tertiary">
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
    <div class="container-rooms bg-secondary">
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
    <div class="container-rooms bg-tertiary">
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
    <div class="container-rooms bg-secondary">
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