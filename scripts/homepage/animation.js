export function fadeInAnimation() {
  // Initialize Intersection Observer
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      // If element is in view, add animation class
      if (entry.isIntersecting) {
        entry.target.classList.add("play-animation");
      } else {
        // If element is out of view, remove animation class
        entry.target.classList.remove("play-animation");
      }
    });
  });

  // Select all elements with animation class and observe them
  const animatedElements = document.querySelectorAll(
    ".home-container, .amenities-container, .rooms-and-suites-container, .footer-container"
  );
  animatedElements.forEach((element) => {
    observer.observe(element);
  });
}

export function animateOnClick() {
  // Function to animate scroll to target element
  function scrollToTarget(targetElement) {
    // Calculate the offset of the target element
    const offsetTop =
      targetElement.getBoundingClientRect().top + window.scrollY;

    // Smooth scroll animation
    window.scrollTo({
      top: offsetTop,
      behavior: "smooth",
    });
  }

  // Get all the links
  const links = document.querySelectorAll(".header-right a");

  // Add click event listener to each link
  links.forEach((link) => {
    link.addEventListener("click", function (event) {
      // Prevent default behavior of the link
      event.preventDefault();

      // Get the target ID from the href attribute
      const targetId = link.getAttribute("href");

      // Get the target element
      const targetElement = document.querySelector(targetId);

      // Add animation class to target element
      if (targetElement) {
        targetElement.classList.add("play-animation");

        // Scroll to the target element after animation completes

        scrollToTarget(targetElement);
      }
    });
  });
}
