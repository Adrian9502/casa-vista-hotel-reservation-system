import sweetalert2 from "https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/+esm";
// popup registration form
function popUpRegistration() {
  // student
  const signupBtn = document.getElementById("signup-btn");
  const registrationPopup = document.getElementById("registration-popup");

  const closeBtn = document.getElementById("close-btn");

  signupBtn.addEventListener("click", function (event) {
    event.preventDefault();
    registrationPopup.style.display = "block";
    document.body.style.overflow = "hidden";
  });
  closeBtn.addEventListener("click", function () {
    registrationPopup.style.display = "none";
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
            // Increment login attempts
            attempts += 1;
            localStorage.setItem("loginAttempts", attempts);

            sweetalert2.fire({
              title: "Login Error!",
              text: data.error,
              icon: "error",
            });
          }
        })
        .catch((error) => {
          sweetalert2.fire({
            title: "Login Error!",
            text: error.message,
            icon: "error",
          });
        });
    }
  });
}

popUpRegistration();
loginFetch();
