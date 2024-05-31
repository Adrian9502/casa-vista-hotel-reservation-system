import sweetalert2 from "https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/+esm";
// animation will play if user is in view
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
        document.body.style.overflow = "hidden";
      }
    }

    // Function to hide the form and overlay
    function hideForm() {
      if (bookingFormContainer) {
        bookingFormContainer.style.display = "none";
        overlay.style.display = "none";
        document.body.style.overflow = "auto";
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
// fetch for the rooms in hotel in <option>
function roomOptionFetch() {
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
// my reservation pop up
function reservationPopUp() {
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
        document.body.style.overflow = "hidden";
      }
    }

    // Function to hide the form and overlay
    function hideForm() {
      if (reservationContainer) {
        reservationContainer.style.display = "none";
        overlay1.style.display = "none";
        document.body.style.overflow = "auto";
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
// function to handle room booking
function bookRoomReservation() {
  // Listen for form submission
  document
    .getElementById("bookingForm")
    .addEventListener("submit", function (event) {
      event.preventDefault(); // Prevent the default form submission behavior

      const userId = document.getElementById("user_id").value;
      const roomId = document.getElementById("roomSelect").value;
      const checkIn = document.getElementById("checkIn").value;
      const checkOut = document.getElementById("checkOut").value;

      const formData = new FormData();

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
          if (text.includes("Room Booking Successful!")) {
            sweetalert2
              .fire({
                title: "Success!",
                text: "Room Booking Successful!",
                icon: "success",
              })
              .then(() => {
                window.location.reload();
              });
          } else {
            sweetalert2.fire({
              title: "Error!",
              text: text,
              icon: "error",
            });
          }
        })
        .catch((error) => {
          alert("Error saving form");
          console.error("Error saving form data:", error);
        });
    });
}
// function to cancel the customer reservation
function cancelReservation() {
  document.addEventListener("DOMContentLoaded", function () {
    const cancelButtons = document.querySelectorAll(".cancel-btn");

    cancelButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const reservationId = this.getAttribute("data-reservation-id");

        sweetalert2
          .fire({
            title: "Confirm Cancel",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "orange",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Cancel it!",
          })
          .then((result) => {
            if (result.isConfirmed) {
              fetch(
                "../../hotel_reservation_system/pages/reservation-management/deleteReservation.php",
                {
                  method: "POST",
                  headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                  },
                  body: `reservation-id=${reservationId}`,
                }
              )
                .then((response) => response.text())
                .then((data) => {
                  sweetalert2
                    .fire({
                      title: "Deleted!",
                      text: "Your reservation has been cancelled.",
                      icon: "success",
                    })
                    .then(() => {
                      location.reload();
                    });
                })
                .catch((error) => {
                  sweetalert2.fire({
                    title: "Error!",
                    text: "There was an error cancelling your reservation.",
                    icon: "error",
                  });
                  console.error("Error:", error);
                });
            }
          });
      });
    });
  });
}
// feedback pop up
function feedbackPopUp() {
  document.addEventListener("DOMContentLoaded", function () {
    const showReservationButton = document.getElementById("feedback");
    const overlay2 = document.querySelector(".overlay2");
    const feedbackContainer = document.getElementById("feedbackContainer");

    // Function to show the form and overlay
    function showForm() {
      if (feedbackContainer) {
        feedbackContainer.style.display = "block";
        overlay2.style.display = "block";
        document.body.style.overflow = "hidden";
      }
    }

    // Function to hide the form and overlay
    function hideForm() {
      if (feedbackContainer) {
        feedbackContainer.style.display = "none";
        overlay2.style.display = "none";
        document.body.style.overflow = "auto";
      }
    }

    // Add click event listener to each "Feedback" button
    showReservationButton.addEventListener("click", function (event) {
      showForm();
    });

    // Add click event listener to the close button
    const closeConButton = document.getElementById("closeConButton-feedback");
    if (closeConButton) {
      closeConButton.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent default action
        hideForm();
      });
    }

    // Add click event listener to the overlay to close the form
    overlay2.addEventListener("click", function (event) {
      event.preventDefault(); // Prevent default action
      hideForm();
    });
  });
}

function feedbackFetch() {
  // Form submission
  const feedbackForm = document.getElementById("feedbackForm");
  feedbackForm.addEventListener("submit", (event) => {
    event.preventDefault();
    // contain all the form data
    const selectedRating = document.querySelector("#starRating").value;
    const formData = new FormData(feedbackForm);
    formData.append("rating", selectedRating);
    // Fetch the feedback.php file
    fetch("../../hotel_reservation_system/accounts/feedBackFetch.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        if (data.includes("Feedback submitted successfully")) {
          sweetalert2
            .fire({
              title: "Success!",
              text: "Feedback submitted successfully",
              icon: "success",
            })
            .then(() => {
              window.location.reload();
            });
        } else {
          console.error("Feedback submission failed", data);
          sweetalert2.fire({
            title: "Error!",
            text: "Feedback submission failed",
            data,
            icon: "error",
          });
        }
      })
      .catch((error) => {
        sweetalert2.fire({
          title: "Error!",
          text: "Feedback submission failed",
          error,
          icon: "error",
        });
      });
  });
}

feedbackFetch();
cancelReservation();
animation();
reservationPopUp();
feedbackPopUp();
roomOptionFetch();
bookRoomReservation();
formPopUp();
