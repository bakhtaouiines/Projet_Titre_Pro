// RAPPEL : créer une fonction pour le popover (fichier ost.php)

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
 * SnackBar 
 * 
 */
function snackbarValidation() {
    // Get the snackbar DIV
    var x = document.getElementById("snackbar");

    // Add the "show" class to DIV
    x.className = "show";

    // After 3 seconds, remove the show class from DIV
    setTimeout(function() { x.className = x.className.replace("show", ""); }, 3000);
}
/**
 * Tiny MCE
 */
tinymce.init({
    selector: 'textarea',
    height: 250,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'undo redo | formatselect | ' +
        'bold italic | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',

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

/**
 * Affichage de l'image uploadé
 * 
 */
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#imageResult')
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}


/**
 * Affichage du popup pour l'avatar
 */
function popup() {
    let popup = document.getElementById("avatarPopup");
    popup.classList.toggle("show");
}
/**
 * Affichage du popup 
 */
function popupUser() {
    let popup = document.getElementById("userPopup");
    popup.classList.toggle("show");
}