var itemList = document.querySelector('.itemList');
summaryCartUpdate();
//Place event listener on parent, itemList, and take advantage of event bubbling. 
//The reason for this is beacuse when we update the list of items by using innerHtml, all their event handler functionalities get deleted
//Therfore, the new list of items will no longer have event listeners: making deleteion impossible
//By using event bubbling, this means we can determine which child element has been click(via an if statement) from wherever within the parent div
itemList.addEventListener('click', updateHandeler);

function updateHandeler(event) {
    if (event.target.matches('.delete-image')) {
        const deleteItemServer = new XMLHttpRequest();

        deleteItemServer.onreadystatechange = function () {
            if (deleteItemServer.readyState == 4 && deleteItemServer.status == 200) {
                // change content within item List by recieving new list of items from server side                
                itemList.innerHTML = deleteItemServer.responseText;
                summaryCartUpdate();
            }

        }

        // console.log(event.target.parentNode.parentNode.parentNode.querySelector('.column:nth-child(3) a').href);

        //To search for the href of a particular element, we explore through the DOM by accessing parent nodes and so on. This exploration starts from the child element we clicked on!
        deleteItemURL = new URL(event.target.parentNode.parentNode.parentNode.querySelector('.column:nth-child(3) a').href);

        deleteItemServer.open("GET", "../../php/updateCart.php?itemDeleteKey=" + deleteItemURL.pathname, true);
        deleteItemServer.send();



    } else if (event.target.matches('.plusMinus:nth-child(1)')) {

        let decrement = event.target.nextElementSibling;
        decrement.setAttribute('value', Math.max(1, new Number(decrement.getAttribute('value')) - 1));
        updateCartQuantity(event, new Number(decrement.getAttribute('value')));

    } else if (event.target.matches('.plusMinus:last-child')) {

        let increment = event.target.previousElementSibling;
        increment.setAttribute('value', Math.max(1, new Number(increment.getAttribute('value')) + 1));
        updateCartQuantity(event, new Number(increment.getAttribute('value')));
    }
}

function updateCartQuantity(event, quantity) {
    let name = event.target.parentNode.parentNode.querySelector('.column:nth-child(3) a').innerHTML;
    let image = String(event.target.parentNode.parentNode.querySelector('.column:nth-child(2) div').style.backgroundImage);
    let parseImage;

    if (image.substring(0, 7) == "url(\"..") {
        parseImage = image.substring(7, image.length - 2);
    } else {
        parseImage = image.substring(5, image.length - 2);
    }

    let link = new URL(event.target.parentNode.parentNode.querySelector('.column:nth-child(3) a').href);
    let price = event.target.parentNode.parentNode.querySelector('.column:nth-child(5)').getAttribute('data-value');
    let getPrice = event.target.parentNode.parentNode.querySelector('.column:nth-child(5)');
    let setprice = event.target.parentNode.parentNode.querySelector('.column:nth-child(5)').getAttribute('data-value') * quantity;
    getPrice.innerHTML = "$" + setprice.toFixed(2);

    const itemQuantityServer = new XMLHttpRequest();

    itemQuantityServer.open("GET", "../../php/updateCart.php?itemName=" + name + "&itemImage=" + parseImage + "&itemLink=" + link.pathname + "&itemQuantity=" + quantity + "&itemPrice=" + price, true);
    itemQuantityServer.send();

    summaryCartUpdate();
};

function summaryCartUpdate() {
    //Update Summary Information:
    let shopInputQuantity = document.querySelectorAll('.itemList .item .column:nth-child(4) .input-quantity');
    let shopPrice = document.querySelectorAll('.itemList .item .column:nth-child(5)');
    let summaryPrice = document.querySelector('.summary .totalPrice .price:nth-child(1)');
    let summaryNumber = document.querySelector('.summary .totalPrice .price:nth-child(2)');

    let totalPrice = 0;
    let amtofItems = 0;
    for (let j = 0; j < shopInputQuantity.length; j++) {
        totalPrice += new Number(shopPrice[j].innerHTML.substring(1));
        amtofItems += Math.max(new Number(shopInputQuantity[j].value), 1);
    }

    summaryNumber.childNodes[1].nodeValue = " " + amtofItems;

    totalPrice = (0.05 * totalPrice) + (0.0998 * totalPrice) + totalPrice;
    summaryPrice.childNodes[1].nodeValue = " $" + totalPrice.toFixed(2);
}