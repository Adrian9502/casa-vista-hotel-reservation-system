// ? View reservation ajax
export function viewReservation() {
  // function to filter by search
  function filterReservations() {
    const searchBtn = document.querySelector(".search-btn");

    searchBtn.addEventListener("click", function () {
      console.log("button clicked");
      const searchInput = document.getElementById("search").value.toUpperCase();
      const table = document.getElementById("reservation-table");
      const tr = table.getElementsByTagName("tr");

      for (let i = 1; i < tr.length; i++) {
        const td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          const txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(searchInput) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    });
  }
  // Add event listener to a parent element
  document.addEventListener("click", function (event) {
    // Check if the clicked element is the view hotels button
    if (event.target && event.target.id === "view-reservation-btn") {
      // Make an AJAX request
      let xhr = new XMLHttpRequest();
      xhr.open("GET", "./reservation-management/viewReservation.php", true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          document.getElementById("main-content").innerHTML = xhr.responseText;
          filterReservations();
        }
      };
      xhr.send();
    }
  });
}
// ? makes back button works
export function reservationManagementBackButton() {
  document.addEventListener("click", function (event) {
    if (event.target && event.target.id === "reservation-back-button") {
      // Make an AJAX request
      let xhr = new XMLHttpRequest();
      xhr.open("GET", "./admin-dashboard/reservation-management.php", true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          document.getElementById("main-content").innerHTML = xhr.responseText;
        }
      };
      xhr.send();
    }
  });
}
// ? update reservation ajax and fetch
export function updateReservation() {
  // Add event listener to a parent element
  document.addEventListener("click", function (event) {
    // Check if the clicked element is the view hotels button
    if (event.target && event.target.id === "update-reservation-btn") {
      // Make an AJAX request
      let xhr = new XMLHttpRequest();
      xhr.open("GET", "./reservation-management/updateReservation.php", true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          document.getElementById("main-content").innerHTML = xhr.responseText;
        }
      };
      xhr.send();
    }
  });
}
export function updateHotelFetch() {
  document.addEventListener("submit", function (event) {
    if (event.target && event.target.id === "update-form") {
      event.preventDefault();
      // Collect form data
      const formData = new FormData(event.target);
      // Send AJAX request to update the database
      fetch(
        "../../../hotel_reservation_system/pages/hotel-management/updateHotel.php",
        {
          method: "POST",
          body: formData,
        }
      )
        .then((response) => response.text()) // Parse response text
        .then((data) => {
          // Check the response message from the server
          if (data.includes("Hotel updated successfully!")) {
            // Handle successful update
            alert("Hotel updated successfully!");
            // Make an AJAX request
            let xhr = new XMLHttpRequest();
            xhr.open("GET", "./hotel-management/updateHotel.php", true);
            xhr.onreadystatechange = function () {
              if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("main-content").innerHTML =
                  xhr.responseText;
              }
            };
            xhr.send();
          } else {
            // Handle error message
            alert("Error: Hotel ID not found!");
          }
        })
        .catch((error) => {
          // Handle network errors and other errors
          console.error("Error:", error);
          alert("An error occurred. Please try again later.");
        });
    }
  });
}
// ? cancel reservation ajax 
export function cancelReservation() {
  document.addEventListener("click", function (event) {
    if (event.target && event.target.id === "delete-hotel-btn") {
      // Make an AJAX request
      let xhr = new XMLHttpRequest();
      xhr.open("GET", "./hotel-management/deleteHotel.php", true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          document.getElementById("main-content").innerHTML = xhr.responseText;
        }
      };
      xhr.send();
    }
  });
}
export function deleteHotelFetch() {
  document.addEventListener("submit", function (event) {
    if (event.target && event.target.id === "delete-form") {
      event.preventDefault();
      // Collect form data
      const formData = new FormData(event.target);

      // Send AJAX request to update the database
      fetch(
        "../../../hotel_reservation_system/pages/hotel-management/deleteHotel.php",
        {
          method: "POST",
          body: formData,
        }
      )
        .then((response) => response.text()) // Parse response text
        .then((data) => {
          // Check the response message from the server
          const trimmedData = data.trim();
          // Check the response message from the server
          if (trimmedData.includes("Hotel deleted successfully!")) {
            // Handle successful update
            alert("Hotel deleted successfully!");
            let xhr = new XMLHttpRequest();
            xhr.open("GET", "./hotel-management/deleteHotel.php", true);
            xhr.onreadystatechange = function () {
              if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("main-content").innerHTML =
                  xhr.responseText;
              }
            };
            xhr.send();
          } else {
            // Handle other response messages
            console.log(trimmedData); // Display the response message to the user
            alert("Error: " + trimmedData); // Show error message in an alert
          }
        })
        .catch((error) => {
          // Handle network errors and other errors
          console.error("Error:", error);
          alert("An error occurred. Please try again later.");
        });
    }
  });
}

// TODO: TRY TO MAKE THE DIFFERENT DASHBOARD TO BE SIMPLE
// WHEN CLICKING SPECIFIC DASHBOARD. Display the data from database and add a button for CRUD and popup form when clicked
