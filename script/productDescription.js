const smallCarousel = document.querySelector('.smallCarousel');
const moreDescription = document.querySelector('#moreDescription');
const goBack = document.querySelector('.smallCarousel .goBack');

const weight = document.querySelector('.descriptionRow:nth-child(1)');
const price = document.querySelector('.descriptionRow:nth-child(2)');
const inputQuantity = document.querySelector('.descriptionRow:nth-child(3) .input-quantity');
const minus = document.querySelector('.descriptionRow:nth-child(3) .plusMinus:nth-child(1)');
const plus = document.querySelector('.descriptionRow:nth-child(3) .plusMinus:last-child');

if (sessionStorage.getItem("inputQuantity")) {
    inputQuantity.value = sessionStorage.getItem("inputQuantity");
    price.childNodes[1].nodeValue = " $" + (price.getAttribute('data-value') * Math.max(inputQuantity.value, 1)).toFixed(2);
    weight.childNodes[1].nodeValue = " " + (weight.getAttribute('data-value') * Math.max(inputQuantity.value, 1)) + weight.getAttribute('data-measure');
}

inputQuantity.addEventListener('input', () => {
    price.childNodes[1].nodeValue = " $" + (price.getAttribute('data-value') * Math.max(inputQuantity.value, 1)).toFixed(2);
    weight.childNodes[1].nodeValue = " " + (weight.getAttribute('data-value') * Math.max(inputQuantity.value, 1)) + weight.getAttribute('data-measure');

    sessionStorage.setItem('inputQuantity', inputQuantity.value);
});

minus.addEventListener('click', () => {
    const newMinus = new Number(sessionStorage.getItem('inputQuantity')) - 1;
    inputQuantity.value = Math.max(newMinus, 1);
    price.childNodes[1].nodeValue = " $" + (price.getAttribute('data-value') * inputQuantity.value).toFixed(2);
    weight.childNodes[1].nodeValue = " " + (weight.getAttribute('data-value') * Math.max(inputQuantity.value, 1)) + weight.getAttribute('data-measure');

    sessionStorage.setItem('inputQuantity', inputQuantity.value);
});

plus.addEventListener('click', () => {
    const newPlus = new Number(Math.max(sessionStorage.getItem('inputQuantity'), 1)) + 1;
    inputQuantity.value = newPlus;
    price.childNodes[1].nodeValue = " $" + (price.getAttribute('data-value') * inputQuantity.value).toFixed(2);
    weight.childNodes[1].nodeValue = " " + (weight.getAttribute('data-value') * Math.max(inputQuantity.value, 1)) + weight.getAttribute('data-measure');

    sessionStorage.setItem('inputQuantity', inputQuantity.value);
});

moreDescription.addEventListener('click', () => {
    smallCarousel.style.marginLeft = "0px";
});

goBack.addEventListener('click', () => {
    smallCarousel.style.marginLeft = "800px";
});
