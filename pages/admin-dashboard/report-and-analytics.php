<!DOCTYPE html>
<html lang="en">

<head>
  <!-- THIS FILE FOR THE AJAX REQUEST FOR DYNAMIC PAGE  -->
  <!-- Report and analytics -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <!-- css -->
  <link rel="stylesheet" href="../../../hotel_reservation_system/styles/report-and-analytics.css">
</head>
<?php
include('../report-and-analytics/report-analytics-data.php');
?>

<body>
  <div class="main-container">
    <div class="container" id="main-content">
      <div class="title-con">
        <h2 class="section-heading">Reporting & Analytics</h2>
        <div class="crud-btn">
          <div class="stat-box">
            <h3>Total Reservations</h3>
            <p><?php echo $totalReservations; ?></p>
          </div>
          <div class="stat-box">
            <h3>Total Revenue</h3>
            <p>$<?php echo number_format($totalRevenue, 2); ?></p>
          </div>
        </div>
      </div>

      <div class="table-wrapper">
        <div class="table-container">
          <div class="table-title-con">
            <h2 class="occupancy-text">Occupancy Rates</h2>
          </div>
          <table>
            <thead>
              <tr>
                <th>Hotel Name</th>
                <th>Total Bookings</th>
                <th>Occupancy Rate (%)</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($occupancyRates as $rate) : ?>
                <tr>
                  <td><?php echo $rate['name']; ?></td>
                  <td><?php echo $rate['total_bookings']; ?></td>
                  <td><?php echo number_format($rate['occupancy_rate'], 2); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div class="table-container">
          <div class="table-title-con">
            <h2 class="occupancy-text">Booking Trends</h2>
          </div>
          <table>
            <thead>
              <tr>
                <th>Year - Month</th>
                <th>Total Bookings</th>

              </tr>
            </thead>
            <tbody>
              <?php foreach ($bookingTrends as $trend) : ?>
                <tr>
                  <td><?php echo $trend['year'] . '-' . $trend['month']; ?></td>
                  <td><?php echo $trend['total_bookings']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>

  </div>
  <script src="../../scripts/admin.js" type="module"></script>
</body>

</html>