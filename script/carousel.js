const carousel = document.querySelector('.carousel');
const listContainer = document.querySelector('.list-container');
const list = document.querySelector('.list');
const buttonContainer = document.querySelector('.button-container');
const leftButton = document.querySelector('.button:nth-child(1)');
const rightButton = document.querySelector('.button:nth-child(2)');
const cursor = document.querySelector('.cursors');

var currSlide = listContainer.firstElementChild;
listContainer.firstElementChild.style.opacity = "1";

//prevents opacity transition on child elements form affecting transform transition on parent
list.addEventListener('transitionend', (event) => {       
    event.stopPropagation();
});

rightButton.addEventListener('click', () => {
    const currentSlide = listContainer.querySelector(".currentSlide");

    if (currentSlide == listContainer.lastElementChild) {    
        return;
    }

    const nextSlide = currentSlide.nextElementSibling;     
    currentSlide.style.opacity = "0.3";
    nextSlide.style.opacity = "1";
    direction(listContainer, currentSlide, nextSlide);
});

rightButton.addEventListener('mouseenter', () => {
    cursor.style.transform = "rotateZ(0deg)";
});

leftButton.addEventListener('click', () => {
    const currentSlide = listContainer.querySelector(".currentSlide");

    if (currentSlide == listContainer.firstElementChild) {        
        return;
    }

    const prevSlide = currentSlide.previousElementSibling;
    currentSlide.style.opacity = "0.3";
    prevSlide.style.opacity = "1";
    direction(listContainer, currentSlide, prevSlide);
});

leftButton.addEventListener('mouseenter', () => {
    cursor.style.transform = "rotateZ(180deg)";
});

function direction(container, currentSlide, which) {
    container.style.transform = "translateX( -" + which.offsetLeft + "px)";            
    currentSlide.classList.remove("currentSlide");
    which.classList.add("currentSlide");         
    currSlide = which;    
}

buttonContainer.addEventListener('mouseenter', () => {   
    buttonContainer.style.cursor = "none";    
    cursor.style.pointerEvents = "none";
    cursor.style.opacity = "1";
    cursor.style.transform = "scale(1, 1)";
});

buttonContainer.addEventListener('mouseleave', () => {   
    buttonContainer.style.cursor = "initial";    
    cursor.style.pointerEvents = "initial";
    cursor.style.opacity = "0";
    cursor.style.transform = "scale(0.1, 0.1)";
});

buttonContainer.addEventListener('mousedown', (event) => {   
    if (event.target == leftButton) {
        if (currSlide == listContainer.firstElementChild) {
            cursor.style.filter = "invert(56%) sepia(60%) saturate(1827%) hue-rotate(318deg) brightness(79%) contrast(107%)"; 
        } 
    }

    if (event.target == rightButton) {
        if (currSlide == listContainer.lastElementChild) {
            cursor.style.filter = "invert(56%) sepia(60%) saturate(1827%) hue-rotate(318deg) brightness(79%) contrast(107%)"; 
        } 
    }

    cursor.style.height = "115px";    
    cursor.style.width = "115px";        
});

buttonContainer.addEventListener('mouseup', () => {   
    cursor.style.filter = "invert(19%) sepia(3%) saturate(6424%) hue-rotate(156deg) brightness(93%) contrast(91%)";    
    cursor.style.height = "min(130px, 20vw)";    
    cursor.style.width = "min(130px, 20vw)";   
});

buttonContainer.addEventListener('mousemove', (e) => { 
    const mouseY = e.pageY - cursor.clientHeight/2 - buttonContainer.parentElement.offsetTop;
    const mouseX = e.pageX - cursor.clientWidth/2 - buttonContainer.parentElement.offsetLeft;    
    cursor.style.top = mouseY + "px";
    cursor.style.left = mouseX + "px";
});
