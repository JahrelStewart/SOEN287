const smallCarousel = document.querySelector('.smallCarousel');
const moreDescription = document.querySelector('#moreDescription');
const goBack = document.querySelector('.smallCarousel .goBack');

const nameOfItem = document.querySelector('.directory .message');
const pictureOfItem = document.querySelector('.picture-container .picture');
const weight = document.querySelector('.descriptionRow:nth-child(1)');
const price = document.querySelector('.descriptionRow:nth-child(2)');
const minus = document.querySelector('.descriptionRow:nth-child(3) .plusMinus:nth-child(1)');
const plus = document.querySelector('.descriptionRow:nth-child(3) .plusMinus:last-child');
const addCart = document.querySelector('.descriptionRow:nth-child(4)');

const currentURL = new URL(window.location.href).pathname.split("/");
const parseCurrentURL = currentURL[currentURL.length - 1];
const linkOfItem = new URL(window.location.href).pathname;

updateQuantity();

inputQuantity.addEventListener('input', () => {
    updateQuantity();
});

minus.addEventListener('click', () => {
    inputQuantity.value = Math.max(new Number(inputQuantity.value) - 1, 1);
    updateQuantity();
});

plus.addEventListener('click', (event) => {
    inputQuantity.value = Math.max(new Number(inputQuantity.value) + 1, 1);
    updateQuantity();
});

moreDescription.addEventListener('click', () => {
    smallCarousel.style.marginLeft = "0px";
});

goBack.addEventListener('click', () => {
    smallCarousel.style.marginLeft = "800px";
});

addCart.addEventListener('click', () => {
    backgroundImagetoString = String(pictureOfItem.style.backgroundImage);
    const parseBackgroundImage = backgroundImagetoString.substring(8, backgroundImagetoString.length - 2);

    const serverAccessCart = new XMLHttpRequest();
    serverAccessCart.onreadystatechange = function () {
        if (serverAccessCart.readyState == 4 && serverAccessCart.status == 200) {
            callBack(this);
        }
    };
    serverAccessCart.open("GET", "../../php/updateCart.php?itemName=" + nameOfItem.innerHTML + "&itemImage=" + parseBackgroundImage + "&itemLink=" + linkOfItem + "&itemQuantity=" + inputQuantity.value + "&itemPrice=" + price.getAttribute('data-value'), true);
    serverAccessCart.send();
});

function updateQuantity() {
    price.childNodes[1].nodeValue = " $" + (price.getAttribute('data-value') * Math.max(inputQuantity.value, 1)).toFixed(2);
    weight.childNodes[1].nodeValue = " " + (weight.getAttribute('data-value') * Math.max(inputQuantity.value, 1)) + weight.getAttribute('data-measure');

    const serverAccess = new XMLHttpRequest();
    serverAccess.open("GET", "../../php/updateSession.php?inputquantity=" + inputQuantity.value + "&aURL=" + parseCurrentURL, true);
    serverAccess.send();
}

//Notify user when an item has been added
function callBack(xhttp) {

    // change button content
    addCart.innerHTML = "Item Added";
    addCart.disabled = true;

    setTimeout(function () {
        // change back to original        
        addCart.disabled = false;
        addCart.innerHTML = "Add to Cart";

    }, 1000);

}