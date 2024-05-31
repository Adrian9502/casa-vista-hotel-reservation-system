import sweetalert2 from "https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/+esm";
// popup registration form
function popUpRegistration() {
  const signupBtn = document.getElementById("signup-btn");
  const registrationPopup = document.getElementById("registration-popup");

  const closeBtn = document.getElementById("close-btn");

  signupBtn.addEventListener("click", function (event) {
    event.preventDefault();
    registrationPopup.style.display = "block";
  });
  closeBtn.addEventListener("click", function (event) {
    event.preventDefault();
    registrationPopup.style.display = "none";
  });
}
// popup account test
function popUpTestAcc() {
  const signupBtn = document.getElementById("acc");
  const testPopup = document.getElementById("test-popup");

  const closeBtn = document.getElementById("close-btn-test");

  signupBtn.addEventListener("click", function (event) {
    event.preventDefault();
    testPopup.style.display = "block";
  });
  closeBtn.addEventListener("click", function (event) {
    event.preventDefault();
    testPopup.style.display = "none";
  });
}
// check if login is valid then redirect to dashboard
function loginFetch() {
  document.addEventListener("submit", function (event) {
    if (event.target && event.target.id === "login-form") {
      event.preventDefault();

      // Collect form data
      const formData = new FormData(event.target);

      fetch("../../../hotel_reservation_system/accounts/login.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Network response was not ok");
          }
          return response.json();
        })
        .then((data) => {
          // Check if login was successful
          if (data.success) {
            // Redirect to appropriate dashboard based on role
            if (data.role === "admin") {
              sweetalert2.fire({
                title: "Login Success!",
                text: "Admin Login Successful! Redirecting...",
                icon: "success",
              });
              setTimeout(function () {
                window.location.href = "../pages/adminDashboard.php";
              }, 3000);
            } else {
              sweetalert2.fire({
                title: "Login Success!",
                text: "Customer Login Successful! Redirecting...",
                icon: "success",
              });
              setTimeout(function () {
                window.location.href = "../pages/customerDashboard.php";
              }, 3000);
            }
          } else {
            console.log(data.error);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }
  });
}
// function to process user registration
function registrationFetch() {
  document.addEventListener("submit", function (event) {
    if (event.target && event.target.id === "add-user-form") {
      event.preventDefault();

      // Collect form data
      const formData = new FormData(event.target);

      fetch("../../../hotel_reservation_system/accounts/userRegistration.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Network response was not ok");
          }
          return response.text(); // Read response as plain text
        })
        .then((text) => {
          // Check if registration was successful
          if (text.includes("New User added successfully!")) {
            sweetalert2.fire({
              title: "Registration Success!",
              text: "Registration successful!",
              icon: "success",
            });
            event.target.reset();
          } else {
            sweetalert2.fire({
              title: "Registration Error!",
              text: text,
              icon: "error",
            });
          }
        })
        .catch((error) => {
          sweetalert2.fire({
            title: "Registration Error!",
            text: error.message,
            icon: "error",
          });
        });
    }
  });
}
function showHidePassword() {
  document.addEventListener("DOMContentLoaded", function () {
    const togglePassword = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("password");

    togglePassword.addEventListener("click", function () {
      const type =
        passwordInput.getAttribute("type") === "password" ? "text" : "password";
      passwordInput.setAttribute("type", type);
    });
  });
}
popUpTestAcc();
showHidePassword();
popUpRegistration();
registrationFetch();
loginFetch();
