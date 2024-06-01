# Hotel Reservation System Documentation

## Group Members

- Member 1: John Adrian D. Bonto - Front End Development, Back End Development, Database Design, UI/UX Designing, Responsive Design, Testing, Deployment, and Documentation.

- Member 2: Harley Dave L. Andal - Front end (login.html).
- Member 3: Mark Peneil Basi - Video editor.

## LIVE LINK

This project is finished, tested and deployed at May 31, 2024.

Live Project link via 000webhost - https://casavista.000webhostapp.com/hotel_reservation_system/index.html

if the website doesn't load, try a different browser.

## Development Tools

-XAMPP: Used for setting up a local server environment.
-VS Code: Used as the primary code editor for development.

## References and acknowledgements

Boxicons: Used for various icons throughout the website.
Google Fonts: Used for custom fonts to enhance the visual appeal of the site.
Font Awesome: Used for additional icons.
Hero Pattern : Used for svg backgrounds.
Unsplash: Used for hotel images.

## Project Overview

The "Hotel Reservation System" is a web application designed to manage hotel bookings, allowing users to book rooms, manage reservations, and access hotel information conveniently online. It targets both customers and hotel administrators, enhancing the booking process through a user-friendly interface.

### Frontend Files

- index.html: The landing page.
- login/login.html: Login and registration page.
- pages/customerDashboard.php: Dashboard for customers to manage bookings, provides feedback.
- pages/adminDashboard.php: Admin dashboard for managing the system.

### Libraries and Frameworks

- **HTML/CSS**: Used for the structure and styling of the pages.
- **JavaScript**: Used for dynamic content and form submissions.
- **PHP**: Used for server-side processing and database interaction.
- **MySQL**: Used for database management.

## Video Presentation

Please see the attached video presentation demonstrating the features and functionality of the project.

## NOTE!!
-Change the Database Connection Details: Ensure you update the database connection details in accounts/db.php according to your server configuration.
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "hotel_reservation_system";


## File Structure

hotel_reservation_system/
├── accounts/
│ ├── bookRoom.php
│ ├── db.php
│ ├── displayRoom.php
│ ├── feedbackFetch.php
│ ├── login.php
│ ├── logout.php
│ ├── sanitize-data.php
│ └── userRegistration.php
├── img (images)
├── login/
│ └── login.html - (Login page after homepage)
├── pages/
│ ├── admin-dashboard/
│ │ ├── feedback.php
│ │ ├── hotel-management.php
│ │ ├── report-and-analytics.php
│ │ ├── reservation-management.php
│ │ ├── room-management.php
│ │ └── user-management.php
│ ├── hotel-management/
│ │ ├── addHotel.php
│ │ ├── deleteHotel.php
│ │ └── updateHotel.php
│ │── report-and-analytics/
│ │ └── report-analytics-data.php
│ │── reservation-management/
│ │ ├── deleteReservation.php
│ │ └── updateReservation.php
│ │── room-management/
│ │ ├── addRoom.php
│ │ ├── deleteRoom.php
│ │ └── updateRoom.php
│ │── user-management/
│ │ ├── deleteUser.php
│ │ └── updateUser.php
│ ├── adminDashboard.php
│ ├── customerDashboard.php
│ └── footer.php
├── scripts/
│ │── customer-dashboard/
│ │ │── customer.js
│ │ └── hotel-images.js
│ │── homepage/
│ │ │── animation.js
│ │ │── slider.js
│ │ └── stickyHeader.js
│ │── login/
│ │ └── login-and-register.js
│ ├── admin.js
│ └── main.js
├── styles/
│ │── customerDashboard/
│ │ └── hotel-images.css
│ ├── admin-management.css
│ ├── adminDashboard-sidebar.css
│ ├── adminDashboard.css
│ ├── animation.css
│ ├── customerDashboard-header.css
│ ├── customerDashboard.css
│ ├── footer.css
│ ├── general.css
│ ├── header.css
│ ├── login.css
│ ├── report-and-analytics.css
│ ├── reservation.css
│ └── style.css
├── documentation.md
└── index.html(landing page)
