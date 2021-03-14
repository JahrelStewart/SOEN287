var currentURLs = new URL(window.location.href).pathname.split("/");
let parseCurrentURL = "SOEN287/" + currentURLs[1];

function checkURLchange(currentURL) {
    if (strcmp(currentURL, "SOEN287/ProductDescriptions") != 0) {
        sessionStorage.setItem('inputQuantity', 1);
    }

    // setTimeout(function () {
    //     checkURLchange(parseCurrentURL);
    // }, 1000);
}

checkURLchange(parseCurrentURL);


function strcmp(a, b) {
    return (a < b ? -1 : (a > b ? 1 : 0));
}
