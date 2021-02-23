const smallCarousel = document.querySelector('.smallCarousel');
const moreDescription = document.querySelector('#moreDescription');
const goBack = document.querySelector('.smallCarousel .goBack');

moreDescription.addEventListener('click', () => {
    smallCarousel.style.marginLeft = "0px";
});

goBack.addEventListener('click', () => {
    smallCarousel.style.marginLeft = "800px";
});
