const sliderItem = document.querySelectorAll('.slideritem');
let i = 0;
const totalItems = sliderItem.length;

function updateSlider() {
  sliderItem.forEach(item => item.classList.remove('active'));
  sliderItem[i].classList.add('active');
}

function nextSlide() {
  i = (i + 1) % totalItems;
  updateSlider();
}

updateSlider();

setInterval(() => {
  nextSlide();
}, 2000);

document.addEventListener('DOMContentLoaded', () => {
    const elementsToAnimate = document.querySelectorAll(
        '.content1 h1, .Dichvunoibat, .content15, .content2, .hero-section'
    );

    elementsToAnimate.forEach((element, index) => {
        element.classList.add('fade-in-from-top');
        setTimeout(() => {
            element.classList.add('visible');
        }, index * 200);
    });
});