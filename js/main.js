function set_slide_show() {
  let slideshowSlides = document.querySelector(".slideshow_slides");
  let slideshowImage = document.querySelectorAll(".slideshow_slides > img");
  let slideshowCount = slideshowImage.length;

  let currentIndex = 0;
  let timer = null;

  let previous = document.querySelector(".previous");
  let next = document.querySelector(".next");
  let indicators = document.querySelectorAll(".slideshow_indicator a");

  for (let i = 0; i < slideshowCount; i++) {
    let newLeft = i * 100 + "%";
    slideshowImage[i].style.left = newLeft;
  }
  setTimer();

  function setSlide(index) {
    currentIndex = index;
    let newLeft = index * -100 + "%";
    slideshowSlides.style.left = newLeft;

    indicators.forEach((obj) => {
      obj.classList.remove("active");
    });
    indicators[index].classList.add("active");
  }

  function setTimer() {
    timer = setInterval(function () {
      let nextIndex = (currentIndex + 1) % slideshowCount;
      setSlide(nextIndex);
    }, 1000 * 1);
  }

  // clearInterval and setTimer using mouseenter, mouseleave, click
  slideshowSlides.addEventListener("mouseenter", () => {
    clearInterval(timer);
  });

  slideshowSlides.addEventListener("mouseleave", () => {
    setTimer();
  });

  previous.addEventListener("mouseenter", () => {
    clearInterval(timer);
  });

  previous.addEventListener("click", (e) => {
    e.preventDefault();

    currentIndex -= 1;
    if (currentIndex < 0) currentIndex = 2;

    setSlide(currentIndex);
  });

  next.addEventListener("mouseenter", () => {
    clearInterval(timer);
  });

  next.addEventListener("click", (e) => {
    e.preventDefault();

    currentIndex += 1;
    if (currentIndex > 2) currentIndex = 0;

    setSlide(currentIndex);
  });

  // click to move screen
  indicators.forEach((obj) => {
    obj.addEventListener("mouseenter", () => {
      clearInterval(timer);
    });
  });

  for (let i = 0; i < indicators.length; i++) {
    indicators[i].addEventListener("click", (e) => {
      e.preventDefault();
      setSlide(i);
    });
  }
}
