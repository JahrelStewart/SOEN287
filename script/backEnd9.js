const userList = document.querySelector('.UserList .list');

//Making use of Event Bubbling

userList.addEventListener('click', (event) => {
    if (event.target.matches('#userDelete')) {
        let deletedID = event.target.parentNode.querySelector('#getUserID').value;

        const deletedUserID = new XMLHttpRequest();
        deletedUserID.onreadystatechange = function () {
            if (deletedUserID.readyState == 4 && deletedUserID.status == 200) {
                userList.innerHTML = deletedUserID.responseText;
            }
        };

        deletedUserID.open("GET", "../../BackEndPhp/User.php?deleteUserID=" + deletedID, true);
        deletedUserID.send();
    }

    if (event.target.matches('#userEdit')) {
        let editID = event.target.parentNode.querySelector('#getUserID').value;

        const editUserID = new XMLHttpRequest();

        editUserID.open("GET", "../../BackEndPhp/User.php?editUserID=" + editID, true);
        editUserID.send();
    }


});
