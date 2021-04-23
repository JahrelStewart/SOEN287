const logInfo = document.querySelectorAll('.SignUpForm input');
const logIn = document.querySelector('.SignUpForm .row3 .LogIn');
logIn.style.pointerEvents = "none";
getXML = new XMLHttpRequest();
getXML.open("GET", "../xml/users.xml", true);

getXML.onload = function () {        
    getXML.responseType = 'document';
    // Force the response to be parsed as XML
    getXML.overrideMimeType('text/xml');

    if (getXML.readyState === getXML.DONE && getXML.status === 200) {
        let users = getXML.responseXML.querySelectorAll("users user");
        let getEmail = getXML.responseXML.querySelectorAll("users user Email");
        let getPassword = getXML.responseXML.querySelectorAll("users user Password");

        logInfo.forEach(info => {
            info.addEventListener('input', () => {
                let goodLogIn = false;

                if (logInfo[0].value != '' || logInfo[1].value != '') {
                    for (let i = 0; i < users.length; i++) {
                        if (logInfo[0].value == getEmail[i].innerHTML && logInfo[1].value == getPassword[i].innerHTML) {
                            goodLogIn = true;
                            break;
                        }
                    }

                    if (goodLogIn == true) {
                        logIn.style.pointerEvents = "auto";
                        logIn.style.backgroundColor = "rgba(104, 176, 171, 0.50)";

                    } else {
                        logIn.style.pointerEvents = "none";
                        logIn.style.backgroundColor = "rgba(208, 83, 83, 0.35)";
                    }

                } else {
                    logIn.style.backgroundColor = "transparent";
                }


            });
        });
    }

};

getXML.send();
