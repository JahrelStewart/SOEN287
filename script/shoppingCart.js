const shopInputQuantity = document.querySelectorAll('.itemList .item .column:nth-child(4) .input-quantity');
const shopMinus = document.querySelectorAll('.itemList .item .column:nth-child(4) .plusMinus:nth-child(1)');
const shopPlus = document.querySelectorAll('.itemList .item .column:nth-child(4) .plusMinus:last-child');
const shopPrice = document.querySelectorAll('.itemList .item .column:nth-child(5)');
const summaryPrice = document.querySelector('.summary .totalPrice .price:nth-child(1)');
const summaryNumber = document.querySelector('.summary .totalPrice .price:nth-child(2)');

for (let i = 0; i < shopInputQuantity.length; i++) {
    shopInputQuantity[i].addEventListener('input', () => {
        shopPrice[i].innerHTML = "$" + (shopPrice[i].getAttribute('data-value') * Math.max(shopInputQuantity[i].value, 1)).toFixed(2);

        let totalPrice = 0;
        for (let j = 0; j < shopInputQuantity.length; j++) {
            totalPrice += new Number(shopPrice[j].innerHTML.substring(1));
        }

        totalPrice = (0.05 * totalPrice) + (0.0998 * totalPrice) + totalPrice;
        summaryPrice.childNodes[1].nodeValue = " $" + totalPrice.toFixed(2);
    });
}

for (let i = 0; i < shopMinus.length; i++) {
    shopMinus[i].addEventListener('click', () => {
        const newMinus = shopInputQuantity[i].value - 1;
        shopInputQuantity[i].value = Math.max(newMinus, 1);
        shopPrice[i].innerHTML = "$" + (shopPrice[i].getAttribute('data-value') * shopInputQuantity[i].value).toFixed(2);

        let amtofItems = 0;
        let totalPrice = 0;

        for (let j = 0; j < shopInputQuantity.length; j++) {
            amtofItems += new Number(shopInputQuantity[j].value);
            totalPrice += new Number(shopPrice[j].innerHTML.substring(1));
        }

        summaryNumber.childNodes[1].nodeValue = " " + amtofItems;

        totalPrice = (0.05 * totalPrice) + (0.0998 * totalPrice) + totalPrice;
        summaryPrice.childNodes[1].nodeValue = " $" + totalPrice.toFixed(2);
    });
}

for (let i = 0; i < shopPlus.length; i++) {
    shopPlus[i].addEventListener('click', () => {
        const newPlus = new Number(shopInputQuantity[i].value) + 1;
        shopInputQuantity[i].value = Math.max(newPlus, 1);
        shopPrice[i].innerHTML = "$" + (shopPrice[i].getAttribute('data-value') * shopInputQuantity[i].value).toFixed(2);

        let amtofItems = 0;
        let totalPrice = 0;

        for (let j = 0; j < shopInputQuantity.length; j++) {
            amtofItems += new Number(shopInputQuantity[j].value);
            totalPrice += new Number(shopPrice[j].innerHTML.substring(1));
        }

        summaryNumber.childNodes[1].nodeValue = " " + amtofItems;

        totalPrice = (0.05 * totalPrice) + (0.0998 * totalPrice) + totalPrice;
        summaryPrice.childNodes[1].nodeValue = " $" + totalPrice.toFixed(2);
    });
}

for (let i = 0; i < shopInputQuantity.length; i++) {
    shopInputQuantity[i].addEventListener('input', () => {
        let amtofItems = 0;
        for (let j = 0; j < shopInputQuantity.length; j++) {
            amtofItems += Math.max(new Number(shopInputQuantity[j].value), 1);
        }

        summaryNumber.childNodes[1].nodeValue = " " + amtofItems;
    });
}