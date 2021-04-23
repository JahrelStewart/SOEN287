const orderEditButton = document.querySelector('.addDeleteEditbutton .inner-addDeleteEditbutton:nth-child(2)');
const orderDeleteButton = document.querySelector('.addDeleteEditbutton .inner-addDeleteEditbutton:nth-child(3)');
const orderTable = document.querySelector('.tableOrderList .tableOrderBody');
const orderRows = document.querySelectorAll('.tableOrderList .tableOrderBody tr');

orderEditButton.style.pointerEvents = "none";
orderDeleteButton.style.pointerEvents = "none";

orderEditButton.addEventListener('click', () => {
    for (let i = 0; i < orderRows.length; i++) {
        const orderID = orderRows[i].querySelector('td:nth-child(1)');
        const orderRadio = orderRows[i].querySelector('th input');

        if (orderRadio.checked == true) {
            const sendEditID = new XMLHttpRequest();
            // sendEditID.onreadystatechange = function () {
            //     if (sendEditID.readyState == 4 && sendEditID.status == 200) {
            //         console.log(sendEditID.responseText);
            //     }
            // };

            sendEditID.open("GET", "../../BackEndPhp/Order.php?editOrderID=" + orderID.textContent, true);
            sendEditID.send();

            break;
        }
    }

});

for (let i = 0; i < orderRows.length; i++) {
    const orderRadio = orderRows[i].querySelector('th input');

    orderRadio.addEventListener('input', () => {
        orderEditButton.style.pointerEvents = "auto";
        orderDeleteButton.style.pointerEvents = "auto";
    });
}

orderDeleteButton.addEventListener('click', () => {
    const oRows = document.querySelectorAll('.tableOrderList .tableOrderBody tr');

    for (let i = 0; i < oRows.length; i++) {
        const orderID = oRows[i].querySelector('td:nth-child(1)');
        const orderRadio = oRows[i].querySelector('th input');

        if (orderRadio.checked == true) {
            const sendDeleteID = new XMLHttpRequest();
            sendDeleteID.onreadystatechange = function () {
                if (sendDeleteID.readyState == 4 && sendDeleteID.status == 200) {
                    orderTable.innerHTML = sendDeleteID.responseText;
                    // console.log(sendDeleteID.responseText);
                }
            };

            sendDeleteID.open("GET", "../../BackEndPhp/Order.php?deleteOrderID=" + orderID.textContent, true);
            sendDeleteID.send();

            break;
        }
    }

});