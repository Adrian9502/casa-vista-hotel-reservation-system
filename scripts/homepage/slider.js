export function Slider() {
  const carouselSlides = document.querySelectorAll(".slide");
  const btnPrev = document.querySelector(".prev");
  const btnNext = document.querySelector(".next");
  const dotsSlide = document.querySelector(".dots-container");
  let currentSlide = 0;
  let intervalId;

  const activeDot = function (slide) {
    document
      .querySelectorAll(".dot")
      .forEach((dot) => dot.classList.remove("active"));
    document
      .querySelector(`.dot[data-slide="${slide}"]`)
      .classList.add("active");
  };
  activeDot(currentSlide);

  const changeSlide = function (slides) {
    carouselSlides.forEach(
      (slide, index) =>
        (slide.style.transform = `translateX(${100 * (index - slides)}%)`)
    );
    // Add or remove the slide-transition class to trigger the transition
    carouselSlides.forEach((slide) => slide.classList.add("slide-transition"));
  };
  changeSlide(currentSlide);

  const nextSlide = function () {
    currentSlide++;
    if (carouselSlides.length <= currentSlide) {
      currentSlide = 0;
    }
    changeSlide(currentSlide);
    activeDot(currentSlide);
  };

  btnNext.addEventListener("click", function () {
    nextSlide();
    clearInterval(intervalId);
    startInterval();
  });

  const prevSlide = function () {
    currentSlide--;
    if (currentSlide < 0) {
      currentSlide = carouselSlides.length - 1;
    }
    changeSlide(currentSlide);
    activeDot(currentSlide);
  };

  btnPrev.addEventListener("click", function () {
    prevSlide();
    clearInterval(intervalId);
    startInterval();
  });

  dotsSlide.addEventListener("click", function (e) {
    if (e.target.classList.contains("dot")) {
      const slide = e.target.dataset.slide;
      changeSlide(slide);
      activeDot(slide);
      clearInterval(intervalId);
      startInterval();
    }
  });

  const startInterval = function () {
    intervalId = setInterval(nextSlide, 4000);
  };

  startInterval();
}

// feature section slider
export function featureSlider() {
  const cardParts = document.querySelectorAll(".card_part");
  let currentIndex = 0;

  function showNextSlide() {
    // Hide the current slide
    cardParts[currentIndex].style.opacity = 0;

    // Update index to show next slide
    currentIndex = (currentIndex + 1) % cardParts.length;

    // Show the next slide
    cardParts[currentIndex].style.opacity = 1;
  }

  setInterval(showNextSlide, 4000);
}

export function roomAndSuitesSlider() {
  const slides = document.querySelectorAll(".slide99");
  let currentSlide = 0;

  // Function to show a specific slide
  function showSlide(n) {
    slides.forEach((slide) => {
      slide.classList.remove("active");
    });
    slides[n].classList.add("active");
  }

  // Function to show the next slide
  function nextSlide() {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
  }

  // Function to show the previous slide
  function previousSlide() {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    showSlide(currentSlide);
  }

  // Event listener for next button
  document.querySelector(".next-button").addEventListener("click", nextSlide);

  // Event listener for previous button
  document
    .querySelector(".previous-button")
    .addEventListener("click", previousSlide);

  // Show the initial slide
  showSlide(currentSlide);
}
