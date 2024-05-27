// ? Create hotel ajax and popup form
export function createRoomFetch() {
  // Event listener for creating a hotel
  document.addEventListener("click", function (event) {
    // Check if the clicked element is the create hotel button
    if (event.target && event.target.id === "add-room-btn") {
      // Get the popup overlay element
      const popupOverlay = document.getElementById("popup-overlay");
      if (popupOverlay) {
        // Toggle the visibility of the popup overlay with a delay to allow the transition effect
        setTimeout(function () {
          popupOverlay.classList.toggle("active");
          popupOverlay.classList.add("fade-in-left"); // Add fade-in-left animation class
        }, 50); // Adjust the delay as needed for smoother animation
      }
    }
  });

  // Event listener for closing the popup overlay
  document.addEventListener("click", function (event) {
    // Check if the clicked element is the close button
    if (event.target && event.target.id === "close-btn") {
      // Get the popup overlay element
      const popupOverlay = document.getElementById("popup-overlay");
      if (popupOverlay) {
        // Remove the fade-in-left animation class when closing the popup
        popupOverlay.classList.remove("fade-in-left");
        // Close the popup overlay
        popupOverlay.classList.remove("active");
      }
    }
  });

  // Event listener for form submission
  document.addEventListener("submit", function (event) {
    const addRoomForm = event.target.closest("form");

    if (addRoomForm && addRoomForm.id === "add-room-form") {
      event.preventDefault();

      const formData = new FormData(addRoomForm);
      const url =
        "../../hotel_reservation_system/pages/room-management/addRoom.php";

      fetch(url, {
        method: "POST",
        body: formData,
      })
        .then((response) => {
          if (response.ok) {
            // successfully added the data to the hotel
            alert("Room Added Successfully!");
            // Get the popup overlay element
            const popupOverlay = document.getElementById("popup-overlay");
            if (popupOverlay) {
              // Remove the fade-in-left animation class when closing the popup
              popupOverlay.classList.remove("fade-in-left");
              // Close the popup overlay
              popupOverlay.classList.remove("active");
            }
            // location.reload();
          } else {
            // Handle failed form submission
            alert("Error Adding Hotel!");
          }
        })
        .catch((error) => {
          // Handle network errors
          console.error("Error:", error);
          alert("An error occurred. Please try again later.");
        });
    }
  });
}
// ? View hotel ajax
export function viewRooms() {
  // Add event listener to a parent element
  document.addEventListener("click", function (event) {
    // Check if the clicked element is the view hotels button
    if (event.target && event.target.id === "view-rooms-btn") {
      // Make an AJAX request
      let xhr = new XMLHttpRequest();
      xhr.open("GET", "./room-management/viewRoom.php", true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          document.getElementById("main-content").innerHTML = xhr.responseText;
        }
      };
      xhr.send();
    }
  });
}
// ? makes back button works
export function roomManagementBackButton() {
  document.addEventListener("click", function (event) {
    if (event.target && event.target.id === "room-back-button") {
      // Make an AJAX request
      let xhr = new XMLHttpRequest();
      xhr.open("GET", "./admin-dashboard/room-management.php", true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          document.getElementById("main-content").innerHTML = xhr.responseText;
        }
      };
      xhr.send();
    }
  });
}
// ? update hotel ajax and fetch
export function updateRoom() {
  // Add event listener to a parent element
  document.addEventListener("click", function (event) {
    // Check if the clicked element is the view hotels button
    if (event.target && event.target.id === "update-rooms-room-btn") {
      // Make an AJAX request
      let xhr = new XMLHttpRequest();
      xhr.open("GET", "./room-management/updateRoom.php", true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          document.getElementById("main-content").innerHTML = xhr.responseText;
        }
      };
      xhr.send();
    }
  });
}
export function updateRoomFetch() {
  document.addEventListener("submit", function (event) {
    if (event.target && event.target.id === "update-room-form") {
      event.preventDefault();
      // Collect form data
      const formData = new FormData(event.target);
      // Send AJAX request to update the database
      fetch(
        "../../../hotel_reservation_system/pages/room-management/updateRoom.php",
        {
          method: "POST",
          body: formData,
        }
      )
        .then((response) => response.text())
        .then((data) => {
          if (data.includes("Room updated successfully")) {
            // Handle successful update
            alert("Room updated successfully!");
            // Make an AJAX request
            let xhr = new XMLHttpRequest();
            xhr.open("GET", "./room-management/updateRoom.php", true);
            xhr.onreadystatechange = function () {
              if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("main-content").innerHTML =
                  xhr.responseText;
              }
            };
            xhr.send();
          } else {
            // Unexpected response
            alert(data);
            console.log(data);
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
// ? delete hotel ajax and fetch
export function deleteRoom() {
  // Add event listener to a parent element
  document.addEventListener("click", function (event) {
    if (event.target && event.target.id === "delete-room-btn") {
      // Make an AJAX request
      let xhr = new XMLHttpRequest();
      xhr.open("GET", "./room-management/deleteRoom.php", true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          document.getElementById("main-content").innerHTML = xhr.responseText;
        }
      };
      xhr.send();
    }
  });
}
export function deleteRoomFetch() {
  document.addEventListener("submit", function (event) {
    if (event.target && event.target.id === "delete-room-form") {
      event.preventDefault();
      // Collect form data
      const formData = new FormData(event.target);

      // Send AJAX request to update the database
      fetch(
        "../../../hotel_reservation_system/pages/room-management/deleteRoom.php",
        {
          method: "POST",
          body: formData,
        }
      )
        .then((response) => response.text())
        .then((data) => {
          if (data.includes("Room deleted successfully")) {
            // Handle successful deletion
            alert("Room deleted successfully!");
            let xhr = new XMLHttpRequest();
            xhr.open("GET", "./room-management/deleteRoom.php", true);
            xhr.onreadystatechange = function () {
              if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("main-content").innerHTML =
                  xhr.responseText;
              }
            };
            xhr.send();
          } else if (data.includes("Room ID does not exist.")) {
            // Handle error: Room ID not found
            alert("Error: Room ID does not exist.");
          } else {
            // Handle other unexpected responses
            alert("An unexpected error occurred.");
            console.log(data);
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

