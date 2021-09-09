/**
 *  On vérifie que les formulaires sont remplis , sinon, validation impossible
 */
// pour le formulaire de connexion
function checkLogForm() {
    let formInput = document.forms["logForm"].elements;
    //contient le tableau des éléments du formulaire et permet l'accès
    let canSubmit = false;
    for (let i = 0; i < formInput.length; i++) { //length donne le nombre d'éléments
        if (formInput[i].value.length === 0) {
            canSubmit = true;
        }
    }
    document.getElementById("loginBtn").disabled = canSubmit;
}
// pour le formulaire d'inscription
function checkRegisterForm() {
    let formInput = document.forms["registerForm"].elements;
    let canSubmit = false;
    for (let i = 0; i < formInput.length; i++) {
        if (formInput[i].value.length === 0) {
            canSubmit = true;
        }
    }
    document.getElementById("registerBtn").disabled = canSubmit;
}

/**
 * suppression utilisateur
 */
function deleteIdUser(id) {
    document.getElementById('deleteInfo').value = id;
}
// créer une fonction pour le popover (fichier ost.php)
















// ///////////////////////////////////////////// PARTIE LOG IN ////////////////////////////////////////////
// // verification du champs mot de passe
// function verif(a, b) {
//     if (a.value != b.value) {
//         color = "border-color: red"
//     } else {
//         color = "border-color: green"
//     }
//     a.style.cssText = color
//     b.style.cssText = color
// }
// ///////////////////////////////////////////// PARTIE CREATION DE COMPTE ////////////////////////////////////////////
// // verification regex du nom, mail, mdp
// function checkName() {
//     let nameValue = document.getElementById('lastName').value
//     let nameRGEX = /^[A-Za-zÉÈËéèëÀÂÄàäâÎÏïîÔÖôöÙÛÜûüùÆŒÇç][A-Za-zÉÈËéèëÀÂÄàäâÎÏïîÔÖôöÙÛÜûüùÆŒÇç\-\s\']*$/
//     let result = nameRGEX.test(nameValue)
//     console.log(result)
//     if (result == false) {
//         formErrorName.innerText = ("Format invalide")
//         formErrorName.style.color = 'red'
//     }
// }


// // function checkMail() {
// //     let mail = document.getElementById('inputEmail').value
// //     let mailRGEX = /^[A-Za-z0-9]*[\-\.\_\]*@[A-Za-z0-9\-\_]+.[a-zA-Z0-9]{2,3}$/
// //     let result = mailRGEX.test(mail)
// //     if (result == false) {
// //         formErrorEmail.innerText = ("Format invalide")
// //         formErrorEmail.style.color = 'red'
// //     }
// // }