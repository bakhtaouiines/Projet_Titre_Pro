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
 * Tiny MCE
 */
tinymce.init({
    selector: 'textarea#miniPostContent',
    height: 500,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount',
        'emoticons'
    ],
    toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help' +
        'emoticons',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});

/**
 * suppression utilisateur
 */
function deleteIdUser(id) {
    document.getElementById('deleteInfo').value = id;
}

/**
 * Barre de recherche Ajax
 */
function clearElement(elementId) {
    document.getElementById(elementId).innerHTML = "";
}

function searchOst(searchContent) {
    let xhr

    xhr = new XMLHttpRequest()
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { //4: request finished and response is ready, 200: "OK"
            //On commence par vider le contenue de la div parent
            clearElement("resultSearch")
            let selectParent = document.getElementById("resultSearch")
            let element = JSON.parse(this.response)
                //faire une boucle
            for (let i = 0; i < element.length; i++) {
                let optionChild = document.createElement('option')
                optionChild.value = element[i].id
                optionChild.innerText = element[i].ostName
                selectParent.appendChild(optionChild)
            }
            console.log(this)
        } else {
            document.getElementById('resultSearch').innerHtml = '<option>OST non trouvée.</option>'
        }
    }
    xhr.open('GET', '../controllers/ajaxCtrl.php?search=' + encodeURIComponent(searchContent), true)
    xhr.send()
}

// RAPPEL : créer une fonction pour le popover (fichier ost.php)
















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