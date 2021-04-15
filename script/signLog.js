const inputs = document.querySelectorAll('.SignUpForm .col1 input');
const password = inputs[3];
const Cpassword = inputs[4];

Cpassword.addEventListener('input', () => {
    if (Cpassword.value != password.value) {
        Cpassword.style.backgroundColor = "rgba(208, 83, 83, 0.35)";
    } else {
        Cpassword.style.backgroundColor = "rgba(104, 176, 171, 0.50)";
    }
});

//  $file = '../xml/users.xml';

//  $dom = new DOMDocument("1.0");
//  $dom - > preserveWhiteSpace = false;
//  $dom - > formatOutput = true;
//  $dom - > load($file);

//  $users = $dom - > documentElement;

//  // $user->addChild('firstName', $firstname);
//  // $user->addChild('lastName', $lastname);
//  // $user->addChild('Email', $email);
//  // $user->addChild('Password', $password);

//  $user = $dom - > createElement('user');
//  $user - > appendChild($dom - > createElement('firstName', $firstname));
//  $user - > appendChild($dom - > createElement('lastName', $lastname));
//  $user - > appendChild($dom - > createElement('Email', $email));
//  $user - > appendChild($dom - > createElement('Password', $password));

//  $users.appendChild($user);

//  $dom - > save($file); //save the XML file