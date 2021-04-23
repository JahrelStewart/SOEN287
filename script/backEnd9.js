const userList = document.querySelector('.UserList .list');

//Making use of Event Bubbling

userList.addEventListener('click', (event) => {
    if (event.target.matches('#userDelete')) {
        event.preventDefault();

        let deletedID = event.target.parentNode.querySelector('#getUserID').value;
        // console.log(deletedID);

        const deletedUserID = new XMLHttpRequest();
        deletedUserID.onreadystatechange = function () {
            if (deletedUserID.readyState == 4 && deletedUserID.status == 200) {
                userList.innerHTML = deletedUserID.responseText;
            }
        };

        deletedUserID.open("GET", "../../BackEndPhp/User.php?deleteUserID=" + deletedID, true);
        deletedUserID.send();
    }


});