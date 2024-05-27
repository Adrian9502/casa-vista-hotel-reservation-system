import sweetalert2 from "https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/+esm";
// ! ajax request for dynamic grid containers and sidebar
function handleAjaxRequest(container) {
  let phpFile;

  // Determine the PHP file based on the clicked container
  switch (container) {
    case "hotel-management":
      phpFile = "../pages/admin-dashboard/hotel-management.php";
      break;
    case "room-management":
      phpFile = "../pages/admin-dashboard/room-management.php";
      break;
    case "reservation-management":
      phpFile = "../pages/admin-dashboard/reservation-management.php";
      break;
    case "report-and-analytics":
      phpFile = "../pages/admin-dashboard/report-and-analytics.php";
      break;
    case "user-management":
      phpFile = "../pages/admin-dashboard/user-management.php";
      break;

    default:
      console.error("Unknown container clicked:", container);
      return;
  }

  // Make AJAX request to the corresponding PHP file
  const xhr = new XMLHttpRequest();
  xhr.open("GET", phpFile, true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document.getElementById("main-content").innerHTML = xhr.responseText;
    }
  };
  xhr.send();
}
// active nav link
const navLinks = document.querySelectorAll(".nav-link");

// Add click event listener to each nav link
navLinks.forEach((link) => {
  link.addEventListener("click", function (event) {
    // Remove active class from all nav links
    navLinks.forEach((link) => {
      link.classList.remove("active");
    });
    // Add active class to the clicked link
    this.classList.add("active");
  });
});
// make search by id work
function handleSearch(tableId, searchButtonClass) {
  // Event delegation for search filtering
  document.addEventListener("click", function (event) {
    if (event.target.matches(searchButtonClass)) {
      event.preventDefault();
      const searchInput = document.getElementById("search").value.toUpperCase();
      const table = document.getElementById(tableId);
      if (table) {
        // Ensure table element exists
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
      } else {
        console.error(`Table with ID ${tableId} not found.`);
      }
    }
  });
}
// pop up form and fetch to database function
function popUpAndFetch(config) {
  const {
    buttonSelector,
    popupOverlaySelector,
    formSelector,
    formActionUrl,
    successMessage,
    errorMessage,
    ajaxAfterSubmitUrl,
  } = config;
  function ajaxAfterSubmit(ajaxAfterSubmitUrl) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", ajaxAfterSubmitUrl, true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        document.getElementById("main-content").innerHTML = xhr.responseText;
      }
    };
    xhr.send();
  }
  // Event delegation for showing the popup form
  document.addEventListener("click", function (event) {
    if (event.target.matches(buttonSelector)) {
      const popupOverlay = document.querySelector(popupOverlaySelector);
      if (popupOverlay) {
        setTimeout(function () {
          popupOverlay.classList.toggle("active");
          popupOverlay.classList.add("fade-in-left");
        }, 50);
      }
    }
  });

  // Event delegation for closing the popup overlay
  document.addEventListener("click", function (event) {
    if (event.target.matches(".close-btn")) {
      const popupOverlay = document.querySelector(popupOverlaySelector);
      if (popupOverlay) {
        // Remove the fade-in-left animation class when closing the popup
        popupOverlay.classList.remove("fade-in-left");
        // Close the popup overlay
        popupOverlay.classList.remove("active");
      }
    }
  });
  // Event delegation for fetching form submission
  document.addEventListener("submit", function (event) {
    if (event.target.matches(formSelector)) {
      event.preventDefault();

      const formData = new FormData(event.target);
      fetch(formActionUrl, {
        method: "POST",
        body: formData,
      })
        .then((response) => {
          if (!response.ok) {
            // Handle error responses
            throw new Error("Server error: " + response.status);
          }
          return response.text();
        })
        .then((data) => {
          // Check the response for different scenarios
          if (data.includes(successMessage)) {
            // Both hotel and rooms deleted successfully
            sweetalert2
              .fire({
                title: "Success!",
                text: successMessage,
                icon: "success",
              })
              .then(() => {
                // After showing the success message, fetch the updated data
                ajaxAfterSubmit(ajaxAfterSubmitUrl);
              });
          } else {
            sweetalert2.fire({
              title: "Error!",
              text: errorMessage,
              icon: "error",
            });
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          sweetalert2.fire({
            title: "Error Occured!",
            text: "An error occurred. Please try again later.",
            icon: "error",
          });
        });
    }
  });
}

// event listener for dynamic dashboard
document.addEventListener("DOMContentLoaded", function () {
  // Add event listeners to containers in the main content area
  const mainContainers = document.querySelectorAll(".container-grid .grid");
  mainContainers.forEach((container) => {
    container.addEventListener("click", function () {
      const containerClass = container.classList[1];
      handleAjaxRequest(containerClass);
    });
  });

  // Add event listeners to containers in the sidebar
  const sidebarContainers = document.querySelectorAll(".sidebar .nav-link");
  sidebarContainers.forEach((container) => {
    container.addEventListener("click", function () {
      const containerClass = container.classList[1];
      handleAjaxRequest(containerClass);
    });
  });

  // call search function
  handleSearch("hotel-table", ".search-btn-hotel");
  handleSearch("room-table", ".search-btn-room");
  handleSearch("reservation-table", ".search-btn-reservation");
  handleSearch("user-table", ".search-btn-user");
  // Recalling pop up and fetch for code reusability
  // ! Hotel Management
  // create hotel
  popUpAndFetch({
    buttonSelector: "#add-hotel-btn",
    popupOverlaySelector: "#create-popup-overlay",
    formSelector: "#add-hotel-form",
    formActionUrl:
      "../../hotel_reservation_system/pages/hotel-management/addHotel.php",
    successMessage: "Hotel added successfully!",
    errorMessage: "Error adding hotel",
    tableId: "#hotel-table",
    ajaxAfterSubmitUrl:
      "../../hotel_reservation_system/pages/admin-dashboard/hotel-management.php",
  });
  // update hotel
  popUpAndFetch({
    buttonSelector: "#update-hotel-btn",
    popupOverlaySelector: "#update-popup-overlay",
    formSelector: "#update-hotel-form",
    formActionUrl:
      "../../hotel_reservation_system/pages/hotel-management/updateHotel.php",
    successMessage: "Hotel updated successfully!",
    errorMessage:
      "Hotel ID does not exist in the database. Please enter a valid ID.",
    ajaxAfterSubmitUrl:
      "../../hotel_reservation_system/pages/admin-dashboard/hotel-management.php",
  });
  // delete hotel
  popUpAndFetch({
    buttonSelector: "#delete-hotel-btn",
    popupOverlaySelector: "#delete-popup-overlay",
    formSelector: "#delete-hotel-form",
    formActionUrl:
      "../../hotel_reservation_system/pages/hotel-management/deleteHotel.php",
    successMessage: "Hotel and associated rooms deleted successfully!",
    errorMessage: "Error deleting hotel or no matching hotel found.",
    ajaxAfterSubmitUrl:
      "../../hotel_reservation_system/pages/admin-dashboard/hotel-management.php",
  });
  // ! Room Management
  // create room
  popUpAndFetch({
    buttonSelector: "#create-room-btn",
    popupOverlaySelector: "#create-room-popup-overlay",
    formSelector: "#create-room-form",
    formActionUrl:
      "../../hotel_reservation_system/pages/room-management/addRoom.php",
    successMessage: "Room added successfully!",
    errorMessage: "Error adding room.",
    ajaxAfterSubmitUrl:
      "../../hotel_reservation_system/pages/admin-dashboard/room-management.php",
  });
  // update room
  popUpAndFetch({
    buttonSelector: "#update-room-btn",
    popupOverlaySelector: "#update-room-popup-overlay",
    formSelector: "#update-room-form",
    formActionUrl:
      "../../hotel_reservation_system/pages/room-management/updateRoom.php",
    successMessage: "Room updated successfully!",
    errorMessage: "Room ID does not exist.",
    ajaxAfterSubmitUrl:
      "../../hotel_reservation_system/pages/admin-dashboard/room-management.php",
  });
  // delete room
  popUpAndFetch({
    buttonSelector: "#delete-room-btn",
    popupOverlaySelector: "#delete-room-popup-overlay",
    formSelector: "#delete-room-form",
    formActionUrl:
      "../../hotel_reservation_system/pages/room-management/deleteRoom.php",
    successMessage: "Room deleted successfully!",
    errorMessage: "Error deleting room or no matching room ID found.",
    ajaxAfterSubmitUrl:
      "../../hotel_reservation_system/pages/admin-dashboard/room-management.php",
  });
  // ! Reservation Management
  // update reservation
  popUpAndFetch({
    buttonSelector: "#update-reservation-btn",
    popupOverlaySelector: "#update-reservation-popup-overlay",
    formSelector: "#update-reservation-form",
    formActionUrl:
      "../../hotel_reservation_system/pages/reservation-management/updateReservation.php",
    successMessage: "Reservation updated successfully!",
    errorMessage: "Reservation ID does not exist.",
    ajaxAfterSubmitUrl:
      "../../hotel_reservation_system/pages/admin-dashboard/reservation-management.php",
  });
  // cancel reservation
  popUpAndFetch({
    buttonSelector: "#cancel-reservation-btn",
    popupOverlaySelector: "#cancel-reservation-popup-overlay",
    formSelector: "#cancel-reservation-form",
    formActionUrl:
      "../../hotel_reservation_system/pages/reservation-management/deleteReservation.php",
    successMessage: "Reservation cancelled successfully!",
    errorMessage: "Reservation ID does not exist.",
    ajaxAfterSubmitUrl:
      "../../hotel_reservation_system/pages/admin-dashboard/reservation-management.php",
  });
  // ! User Management
  // create new user
  popUpAndFetch({
    buttonSelector: "#add-user-btn",
    popupOverlaySelector: "#create-user-popup-overlay",
    formSelector: "#add-user-form",
    formActionUrl:
      "../../hotel_reservation_system/accounts/userRegistration.php",
    successMessage: "New User added successfully!",
    errorMessage: "Error adding new user.",
    tableId: "#user-table",
    ajaxAfterSubmitUrl:
      "../../hotel_reservation_system/pages/admin-dashboard/user-management.php",
  });
  // update user
  popUpAndFetch({
    buttonSelector: "#update-user-btn",
    popupOverlaySelector: "#update-user-popup-overlay",
    formSelector: "#update-user-form",
    formActionUrl:
      "../../hotel_reservation_system/pages/user-management/updateUser.php",
    successMessage: "User updated successfully!",
    errorMessage: "Error updating user or User ID does not exist.",
    tableId: "#user-table",
    ajaxAfterSubmitUrl:
    "../../hotel_reservation_system/pages/admin-dashboard/user-management.php",
  });
  // delete user
  popUpAndFetch({
    buttonSelector: "#delete-user-btn",
    popupOverlaySelector: "#delete-user-popup-overlay",
    formSelector: "#delete-user-form",
    formActionUrl:
      "../../hotel_reservation_system/pages/user-management/deleteUser.php",
    successMessage: "User deleted successfully!",
    errorMessage: "Error deleting user or User ID does not exist.",
    tableId: "#user-table",
    ajaxAfterSubmitUrl:
    "../../hotel_reservation_system/pages/admin-dashboard/user-management.php",
  });
});
