const track = document.querySelector('.carousel__track');
const slides = Array.from(track.children);
const carouselStories = document.querySelectorAll('.carousel__story');
const nextButton = document.querySelector('.carousel__button--right');
const prevButton = document.querySelector('.carousel__button--left');
const dotsNav = document.querySelector('.carousel__nav');
const dots = Array.from(dotsNav.children);

console.log(carouselStories);

// -- gets the size of the element so we can tell the image where to move and
// what dimensions to have
const slideWidth = slides[0].getBoundingClientRect().width;
const slideHeight = slides[0].getBoundingClientRect().height;

const setSlidePosition = (slide, index) => {
  slide.style.left = slideWidth * index + 'px';
}

const setSlideImg = (slideNum, imgUrl) => {
  const slide = slides[slideNum];
  // cannot for the life of me get these images to fit properly in the carousel boxes.
  // tried something like .style.background = slideWidth + 'px' etc, but it just wouldn't work. 
  // I think I need to focus on the carousel__story divs and not the slides themselves
  slide.style.objectFit = 'contain';
  slide.style.background += imgUrl;

}

setSlideImg(0,'url(img/kimchi.jpg) no-repeat');
setSlideImg(1,'url(img/dinner.jpg) no-repeat');
setSlideImg(2,'url(img/pancakes.jpg) no-repeat');



// looks at all available slides in the array of elements and runs setSlidePosition
// on each one
slides.forEach(setSlidePosition);

const moveToSlide = (track, currentSlide, targetSlide) => {
  // takes the target slide and moves it over
  track.style.transform = 'translateX(-' + targetSlide.style.left + ')';
  // removes class from current slide in order to allow the next image
  // be the focus
  currentSlide.classList.remove('current-slide');
  // adds class so that the current slide is shown and has the correct styling
  targetSlide.classList.add('current-slide');
}

const updateDots = (currentDot, targetDot) => {
  currentDot.classList.remove('current-slide');
  targetDot.classList.add('current-slide');
}

const hideShowArrows = (slides, prevButton, nextButton, targetIndex) => {
  // sets the left button to be hidden on the initial load/when we've gone
  // all the way to the left
  console.log(targetIndex);

  if (targetIndex === 0) {
    prevButton.classList.add('is-hidden');
    nextButton.classList.remove('is-hidden');
  // does the same for the right
  } else if (targetIndex === slides.length - 1) {
    prevButton.classList.remove('is-hidden');
    nextButton.classList.add('is-hidden');
  } else {
    prevButton.classList.remove('is-hidden');
    nextButton.classList.remove('is-hidden');
  }
}

// move to previous slide
prevButton.addEventListener('click', e => {
  const currentSlide = track.querySelector('.current-slide');
  const prevSlide = currentSlide.previousElementSibling;
  const currentDot = dotsNav.querySelector('.current-slide');
  const prevDot = currentDot.previousElementSibling;
  // checks the index of the previous slide in order to determine which buttons
  // are shown with hideShowArrows()
  const prevIndex = slides.findIndex(slide => slide === prevSlide);
  
  moveToSlide(track, currentSlide, prevSlide);
  updateDots(currentDot, prevDot);
  hideShowArrows(slides, prevButton, nextButton, prevIndex);

})

// move to next slide
nextButton.addEventListener('click', e => {
  const currentSlide = track.querySelector('.current-slide');
  const nextSlide = currentSlide.nextElementSibling;
  const currentDot = dotsNav.querySelector('.current-slide');
  const nextDot = currentDot.nextElementSibling;
  const nextIndex = slides.findIndex(slide => slide === nextSlide);

  moveToSlide(track, currentSlide, nextSlide);
  updateDots(currentDot, nextDot);
  hideShowArrows(slides, prevButton, nextButton, nextIndex);
  // 
  // const nextIndex = slides.findIndex(slide => slide === nextSlide);
})

dotsNav.addEventListener('click', e => {
  // what indicator was clicked on? 
  const targetDot = e.target.closest('button');
  // if the target of the event is not a button then return
  if (!targetDot) return;

  const currentSlide = track.querySelector('.current-slide');
  const currentDot = dotsNav.querySelector('.current-Slide');
  // return the index of the dot we've clicked on
  const targetIndex = dots.findIndex(dot => dot === targetDot);
  // then the targetIndex is used to move to the appropriate slide
  const targetSlide = slides[targetIndex];

  moveToSlide(track, currentSlide, targetSlide);
  updateDots(currentDot, targetDot);
  hideShowArrows(slides, prevButton, nextButton, targetIndex);
  console.log(targetIndex);
})

// indicate current slide with nav dots
