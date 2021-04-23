const editButton = document.querySelector('.addDeleteEditbutton .inner-addDeleteEditbutton:nth-child(2)');
const deleteButton = document.querySelector('.addDeleteEditbutton .inner-addDeleteEditbutton:nth-child(3)');
const productTable = document.querySelector('.tableList .tableBody');
const productRows = document.querySelectorAll('.tableList .tableBody tr');

window.addEventListener("pageshow", function (event) {
    var historyTraversal = event.persisted ||
        (typeof window.performance != "undefined" &&
            window.performance.navigation.type === 2);
    if (historyTraversal) {
        window.location.reload();
    }
});

editButton.style.pointerEvents = "none";
deleteButton.style.pointerEvents = "none";

editButton.addEventListener('click', () => {
    for (let i = 0; i < productRows.length; i++) {
        const productID = productRows[i].querySelector('td:nth-child(1)');
        const productRadio = productRows[i].querySelector('th input');

        if (productRadio.checked == true) {
            const sendEditID = new XMLHttpRequest();
            // sendEditID.onreadystatechange = function () {
            //     if (sendEditID.readyState == 4 && sendEditID.status == 200) {
            //         console.log(sendEditID.responseText);
            //     }
            // };

            sendEditID.open("GET", "../../BackEndPhp/Product.php?editID=" + productID.textContent + "&toEdit=true", true);
            sendEditID.send();

            break;
        }
    }

});

for (let i = 0; i < productRows.length; i++) {
    const productRadio = productRows[i].querySelector('th input');

    productRadio.addEventListener('input', () => {
        editButton.style.pointerEvents = "auto";
        deleteButton.style.pointerEvents = "auto";
    });
}

deleteButton.addEventListener('click', () => {
    const pRows = document.querySelectorAll('.tableList .tableBody tr');

    for (let i = 0; i < pRows.length; i++) {
        const productID = pRows[i].querySelector('td:nth-child(1)');
        const productRadio = pRows[i].querySelector('th input');

        if (productRadio.checked == true) {
            const sendDeleteID = new XMLHttpRequest();
            sendDeleteID.onreadystatechange = function () {
                if (sendDeleteID.readyState == 4 && sendDeleteID.status == 200) {
                    productTable.innerHTML = sendDeleteID.responseText;
                    // console.log(sendDeleteID.responseText);
                }
            };

            sendDeleteID.open("GET", "../../BackEndPhp/Product.php?deleteID=" + productID.textContent, true);
            sendDeleteID.send();

            break;
        }
    }

});
