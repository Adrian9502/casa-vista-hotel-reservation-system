import { Slider,featureSlider,roomAndSuitesSlider } from "./homepage/slider.js";
import { stickyHeader } from "./homepage/stickyHeader.js";
import { fadeInAnimation,animateOnClick } from "./homepage/animation.js";
document.addEventListener('DOMContentLoaded', function() {
  stickyHeader();
  animateOnClick();
  Slider();
  featureSlider();
  roomAndSuitesSlider();
  fadeInAnimation();
});
