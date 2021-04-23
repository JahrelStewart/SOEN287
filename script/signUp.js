const form = document.querySelector('.SignUpForm');
const inputs = document.querySelectorAll('.SignUpForm .col1 input');
const fName = inputs[0];
const lName = inputs[1];
const eMail = inputs[2];
const password = inputs[3];
const Cpassword = inputs[4];
const submit = inputs[5];

submit.disabled = true;

inputs.forEach(input => {
    input.addEventListener('input', (event) => {
        let inputData = [];
        inputs.forEach(val => inputData.push(val.value));

        if (event.target == password || event.target == Cpassword) {

            if (Cpassword.value != '' || password.value != '') {
                if (Cpassword.value != password.value) {
                    Cpassword.style.backgroundColor = "rgba(208, 83, 83, 0.35)";
                } else {
                    Cpassword.style.backgroundColor = "rgba(104, 176, 171, 0.50)";
                }
            } else {
                Cpassword.style.backgroundColor = "transparent";
            }

        }

        if (inputData.includes('') || Cpassword.value != password.value || checkEmail(eMail.value) == false) {
            submit.disabled = true;
        } else {
            submit.disabled = false;
        }

    });
});

function checkEmail(email) {
    let filter = /^(([a-zA-Z0-9_.-])+\@([a-zA-Z0-9-])+\.([a-zA-Z0-9]{2,4})$)/;
    return filter.test(email);

}