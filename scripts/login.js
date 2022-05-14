document.querySelector("#username-input").addEventListener('input', function(event){
    event.preventDefault();
    let username = document.querySelector("#username-input").value;
    const formData = new FormData();
    formData.append('username', username);
    fetch('./ajax/check_username.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        if(result.body === true){
            document.getElementById('username-input').style.marginBottom='0px';
            let usernameError = document.createElement('p');
            usernameError.classList.add("usernameError");
            usernameError.style.fontSize='15px';
            usernameError.innerHTML = "This username already exists. Please pick another one";
            document.querySelector("#usernameInputSection").appendChild(usernameError);
        }else{
            if (document.contains(document.querySelector(".usernameError"))) {
                document.querySelector(".usernameError").remove();
                document.getElementById('username-input').style.marginBottom='10%';
            }
        }

    })
    .catch(error => {
        console.error('Error:', error);
    });
});
document.querySelector("#email-input").addEventListener("input", function(event){
    event.preventDefault();
    let email = document.querySelector("#email-input").value;
    const formData = new FormData();
    formData.append('email', email);
    fetch('./ajax/check_email.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        if(result.body === true){
            document.getElementById('email-input').style.marginBottom='0px';
            let emailError = document.createElement('p');
            emailError.classList.add("emailError");
            emailError.style.fontSize='15px';
            emailError.innerHTML = "This email has already been used by another user. Please use another one";
            document.querySelector("#emailInputSection").appendChild(emailError);
        }else{
            if (document.contains(document.querySelector(".emailError"))) {
                document.querySelector(".emailError").remove();
                document.getElementById('email-input').style.marginBottom='10%';
            }
        }

    })
    .catch(error => {
        console.error('Error:', error);
    });
});
