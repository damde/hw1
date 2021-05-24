function validateform(signup) {
    let username = signup.username.value;
    let password = signup.password.value;
    let email = signup.email.value;
    let ppasword = signup.ppassword.value;

    if (username.length >= 4 && username.length <= 32) {
        alert("username non valido");
        return false;
    } else if (password.length >= 8) {
        alert("La password deve essere almeno formata di 8 caratteri.");
        return false;
    } else if(password != ppasword) {
        alert("Le password non coincidono")
        return false;
    }
}
