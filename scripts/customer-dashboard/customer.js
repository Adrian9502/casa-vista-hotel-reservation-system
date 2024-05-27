function animation() {
  document.addEventListener("DOMContentLoaded", function () {
    const observerOptions = {
      root: null, // Use the viewport as the root
      rootMargin: "0px",
      threshold: 0.5, // 50% of the element is in view
    };

    const observerCallback = (entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          if (entry.target.classList.contains("fade-in-left")) {
            entry.target.classList.add("in-view-left");
            setTimeout(() => {
              entry.target.classList.remove("in-view-left");
            }, 2000); // Match this timeout to your animation duration (3 seconds)
          } else if (entry.target.classList.contains("fade-in-right")) {
            entry.target.classList.add("in-view-right");
            setTimeout(() => {
              entry.target.classList.remove("in-view-right");
            }, 3000); // Match this timeout to your animation duration (4 seconds)
          } else if (entry.target.classList.contains("fade-in-forward")) {
            entry.target.classList.add("in-view-fwd");
            setTimeout(() => {
              entry.target.classList.remove("in-view-fwd");
            }, 4000); // Match this timeout to your animation duration (1.5 seconds)
          }
        }
      });
    };

    const observer = new IntersectionObserver(
      observerCallback,
      observerOptions
    );

    const targetsLeft = document.querySelectorAll(".fade-in-left");
    const targetsRight = document.querySelectorAll(".fade-in-right");
    const targetsForward = document.querySelectorAll(".fade-in-forward"); // Add this line

    targetsLeft.forEach((target) => observer.observe(target));
    targetsRight.forEach((target) => observer.observe(target));
    targetsForward.forEach((target) => observer.observe(target)); // Add this line
  });
}

// room booking form pop up
function formPopUp() {
  document.addEventListener("DOMContentLoaded", function () {
    // Get all buttons with the class .book-now-button-small
    const showFormButtons = document.querySelectorAll(".book-now-button-small");
    const overlay = document.querySelector(".overlay");
    const bookingFormContainer = document.getElementById(
      "bookingFormContainer"
    );

    // Function to show the form and overlay
    function showForm() {
      if (bookingFormContainer) {
        bookingFormContainer.style.display = "block";
        overlay.style.display = "block";
      }
    }

    // Function to hide the form and overlay
    function hideForm() {
      if (bookingFormContainer) {
        bookingFormContainer.style.display = "none";
        overlay.style.display = "none";
      }
    }

    // Add click event listener to each "Book Now" button
    showFormButtons.forEach(function (button) {
      button.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent default action
        showForm();
      });
    });

    // Add click event listener to the close button
    const closeFormButton = document.getElementById("closeFormButton");
    if (closeFormButton) {
      closeFormButton.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent default action
        hideForm();
      });
    }

    // Add click event listener to the overlay to close the form
    overlay.addEventListener("click", function (event) {
      event.preventDefault(); // Prevent default action
      hideForm();
    });
  });
}
//
function formFetch() {
  // Dynamic options changing base on the selected hotel
  document
    .getElementById("hotelSelect")
    .addEventListener("change", function () {
      var hotelId = this.value;
      var roomSelect = document.getElementById("roomSelect");

      // Clear previous room options
      roomSelect.innerHTML = '<option value="">Select a room</option>';

      if (hotelId) {
        // Fetch room data from the server
        fetch(
          "../../hotel_reservation_system/accounts/displayRoom.php?hotel_id=" +
            hotelId
        )
          .then((response) => response.json())
          .then((data) => {
            if (data.length > 0) {
              data.forEach((room) => {
                var option = document.createElement("option");
                option.value = room.room_id;
                option.textContent = `Room ${room.room_number} - ${room.type} - ($${room.price}) - ${room.status}`;
                if (room.status !== "available") {
                  option.disabled = true; // Disable unavailable rooms
                }
                roomSelect.appendChild(option);
              });
            } else {
              var option = document.createElement("option");
              option.value = "";
              option.textContent = "No available rooms";
              roomSelect.appendChild(option);
            }
          })
          .catch((error) => console.error("Error fetching rooms:", error));
      }
    });
}

function reservationPopUp() {
  console.log("reservationPopUp function is called");
  document.addEventListener("DOMContentLoaded", function () {
    const showReservationButton = document.getElementById("myReservation");
    const overlay1 = document.querySelector(".overlay1");
    const reservationContainer = document.getElementById(
      "reservationContainer"
    );

    // Function to show the form and overlay
    function showForm() {
      if (reservationContainer) {
        reservationContainer.style.display = "block";
        overlay1.style.display = "block";
      }
    }

    // Function to hide the form and overlay
    function hideForm() {
      if (reservationContainer) {
        reservationContainer.style.display = "none";
        overlay1.style.display = "none";
      }
    }

    // Add click event listener to each "Book Now" button
    showReservationButton.addEventListener("click", function (event) {
      showForm();
    });

    // Add click event listener to the close button
    const closeConButton = document.getElementById("closeConButton");
    if (closeConButton) {
      closeConButton.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent default action
        hideForm();
      });
    }

    // Add click event listener to the overlay to close the form
    overlay1.addEventListener("click", function (event) {
      event.preventDefault(); // Prevent default action
      hideForm();
    });
  });
}

// Add an event listener to the form submit event
document
  .getElementById("bookingForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent default form submission behavior
    submitFormFetch(); // Call the submitFormFetch function
  });

// handle form submission
// Listen for form submission
document
  .getElementById("bookingForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the default form submission behavior

    var userId = document.getElementById("user_id").value;
    var roomId = document.getElementById("roomSelect").value;
    var checkIn = document.getElementById("checkIn").value;
    var checkOut = document.getElementById("checkOut").value;

    alert(
      "Form values: " +
        userId +
        ", " +
        roomId +
        ", " +
        checkIn +
        ", " +
        checkOut
    );
    var formData = new FormData();

    formData.append("user_id", userId);
    formData.append("room_id", roomId);
    formData.append("check_in", checkIn);
    formData.append("check_out", checkOut);

    fetch("../../hotel_reservation_system/accounts/bookRoom.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.text();
      })
      .then((text) => {
        alert(text);
        console.log(text);
      })
      .catch((error) => {
        alert("Error saving form");
        console.error("Error saving form data:", error);
      });
  });

animation();
reservationPopUp();
formFetch();
formPopUp();
