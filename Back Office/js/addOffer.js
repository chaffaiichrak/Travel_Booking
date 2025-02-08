function validerFormulaire() {
    var titre = document.getElementById("title").value;
    var des = document.getElementById("destination").value;
    var date1 = document.getElementById("departure_date").value;
    var date2 = document.getElementById("return_date").value;
    var prix = document.getElementById("price").value;

    //variable pour vérifier si le formulaire est valide
    let isValid =true;

    // verification du titre
    // console.log("title ", titre)
    if (titre.length < 3) {
        alert("the title must contain at least 3 caracters");
        isValid =false;
    }

    //verification du des
    //console.log("des ", des)
    var regexDes = /^[a-zA-Z\s]*$/;

    if (des.length < 3 || !regexDes.test(des)) {
        alert("the destination not valid");
        isValid=false;
    }

    //verification des dates 2>1
    //console.log("date ", date1)
    if (date1 == "" || date2 == "") {
        alert('you have to enter dates')
        isValid =false;
    } else {
        const date1Conv = new Date(date1);
        const date2Conv = new Date(date2);
        if ((date2Conv <= date1Conv)) {
            alert('Date return must be greater than date Depature');
            isValid= false;
        }
    }
    //verification du prix
    console.log("prix", prix);
    if (prix < 0) {
        alert("the price must be positive");
        isValid= false;
    }
  return isValid
}



// partie 2:

document.addEventListener('DOMContentLoaded', function () {
    // Récupérer le formulaire
    const form = document.getElementById('addTravelOfferForm');

    // Ajouter un écouteur d'événement pour l'événement 'submit'
    form.addEventListener('submit', function (event) {
        // Empêcher la soumission du formulaire par défaut
        event.preventDefault();

        // Réinitialiser les messages d'erreur et de succès précédents
        clearMessages();

        // Récupérer les valeurs des champs
        const titre = document.getElementById('title').value.trim();
        const destination = document.getElementById('destination').value.trim();
        const departureDateValue = document.getElementById('departure_date').value;
        const returnDateValue = document.getElementById('return_date').value;
        const price = parseFloat(document.getElementById('price').value);

        let isValid = true;

        // Validation du titre
        if (titre.length < 3) {
            showError('title-error', 'The title must contain at least 3 characters.');
            isValid = false;
        } else {
            showSuccess('title-error', 'Correct');
        }

        // Validation de la destination
        const destinationRegex = /^[A-Za-z\s]{3,}$/;
        if (!destinationRegex.test(destination)) {
            showError('destination-error', 'The destination must contain only letters and at least 3 characters.');
            isValid = false;
        } else {
            showSuccess('destination-error', 'Correct');
        }

        // Validation des dates
        if (!departureDateValue) {
            showError('departure_date-error', 'Please select a valid departure date.');
            isValid = false;
        } else {
            showSuccess('departure_date-error', 'Correct');
        }

        if (!returnDateValue) {
            showError('return_date-error', 'Please select a valid return date.');
            isValid = false;
        } else {
            showSuccess('return_date-error', 'Correct');
        }

        if (departureDateValue && returnDateValue) {
            const departureDate = new Date(departureDateValue);
            const returnDate = new Date(returnDateValue);

            if (returnDate <= departureDate) {
                showError('return_date-error', 'The return date must be after the departure date.');
                isValid = false;
            } else {
                showSuccess('return_date-error', 'Correct');
            }
        }

        // Validation du prix
        if (isNaN(price) || price <= 0) {
            showError('price-error', 'The price must be a positive number.');
            isValid = false;
        } else {
            showSuccess('price-error', 'Correct');
        }

        // Si tout est valide
        if (isValid) {
            showGlobalSuccess('The form is valid. The offer can be added.');

            // Réinitialiser tous les champs du formulaire
            form.reset();

            // Effacer les messages après 3 secondes
            setTimeout(() => {
                clearMessages();
            }, 3000);
        }
    });

    // Fonction pour afficher un message d'erreur sous un champ
    function showError(errorId, message) {
        const errorMessage = document.getElementById(errorId);
        if (errorMessage) {
            errorMessage.textContent = message;
            errorMessage.style.color = 'red';
        }
    }

    // Fonction pour afficher un message de succès sous un champ
    function showSuccess(errorId, message) {
        const successMessage = document.getElementById(errorId);
        if (successMessage) {
            successMessage.textContent = message;
            successMessage.style.color = 'green';
        }
    }

    // Fonction pour afficher un message de succès global
    function showGlobalSuccess(message) {
        const existingMessage = document.getElementById('global-success-message');
        if (existingMessage) {
            existingMessage.remove();
        }

        const globalMessage = document.createElement('div');
        globalMessage.id = 'global-success-message';
        globalMessage.textContent = message;
        globalMessage.style.color = 'green';
        globalMessage.style.marginTop = '20px';
        globalMessage.style.textAlign = 'center';
        form.appendChild(globalMessage);
    }

    // Fonction pour effacer tous les messages d'erreur et de succès précédents
    function clearMessages() {
        document.querySelectorAll('.error-message').forEach(function (message) {
            message.textContent = '';
        });

        const globalMessage = document.getElementById('global-success-message');
        if (globalMessage) {
            globalMessage.remove();
        }
    }
});

//partie 3:
document.addEventListener('DOMContentLoaded', function () {
    // Récupérer le formulaire
    const form = document.getElementById('addTravelOfferForm');

    // Récupérer les champs
    const titleInput = document.getElementById('title');
    const destinationInput = document.getElementById('destination');

    // Ajouter les événements 'keyup' pour la validation en temps réel
    titleInput.addEventListener('keyup', function () {
        validateTitle();
    });

    destinationInput.addEventListener('keyup', function () {
        validateDestination();
    });

    // Ajouter un écouteur d'événement pour l'événement 'submit'
    form.addEventListener('submit', function (event) {
        // Empêcher la soumission du formulaire par défaut
        event.preventDefault();

        // Réinitialiser les messages d'erreur et de succès précédents
        clearMessages();

        let isValid = true;

        // Vérifier les champs en utilisant les fonctions de validation
        if (!validateTitle()) isValid = false;
        if (!validateDestination()) isValid = false;

        // Validation des autres champs
        const departureDateValue = document.getElementById('departure_date').value;
        const returnDateValue = document.getElementById('return_date').value;
        const price = parseFloat(document.getElementById('price').value);

        // Validation des dates
        if (!departureDateValue) {
            showError('departure_date-error', 'Please select a valid departure date.');
            isValid = false;
        } else {
            showSuccess('departure_date-error', 'Correct');
        }

        if (!returnDateValue) {
            showError('return_date-error', 'Please select a valid return date.');
            isValid = false;
        } else {
            showSuccess('return_date-error', 'Correct');
        }

        if (departureDateValue && returnDateValue) {
            const departureDate = new Date(departureDateValue);
            const returnDate = new Date(returnDateValue);

            if (returnDate <= departureDate) {
                showError('return_date-error', 'The return date must be after the departure date.');
                isValid = false;
            } else {
                showSuccess('return_date-error', 'Correct');
            }
        }

        // Validation du prix
        if (isNaN(price) || price <= 0) {
            showError('price-error', 'The price must be a positive number.');
            isValid = false;
        } else {
            showSuccess('price-error', 'Correct');
        }

        // Si tout est valide
        if (isValid) {
            showGlobalSuccess('The form is valid. The offer can be added.');

            // Réinitialiser tous les champs du formulaire
            form.reset();

            // Effacer les messages après 3 secondes
            setTimeout(() => {
                clearMessages();
            }, 3000);
        }
    });

    // Fonction de validation du titre
    function validateTitle() {
        const titre = titleInput.value.trim();
        if (titre.length < 3) {
            showError('title-error', 'The title must contain at least 3 characters.');
            return false;
        } else {
            showSuccess('title-error', 'Correct');
            return true;
        }
    }

    // Fonction de validation de la destination
    function validateDestination() {
        const destination = destinationInput.value.trim();
        const destinationRegex = /^[A-Za-z\s]{3,}$/;
        if (!destinationRegex.test(destination)) {
            showError('destination-error', 'The destination must contain only letters and at least 3 characters.');
            return false;
        } else {
            showSuccess('destination-error', 'Correct');
            return true;
        }
    }

    // Fonction pour afficher un message d'erreur sous un champ
    function showError(errorId, message) {
        const errorMessage = document.getElementById(errorId);
        if (errorMessage) {
            errorMessage.textContent = message;
            errorMessage.style.color = 'red';
        }
    }

    // Fonction pour afficher un message de succès sous un champ
    function showSuccess(errorId, message) {
        const successMessage = document.getElementById(errorId);
        if (successMessage) {
            successMessage.textContent = message;
            successMessage.style.color = 'green';
        }
    }

    // Fonction pour afficher un message de succès global
    function showGlobalSuccess(message) {
        const existingMessage = document.getElementById('global-success-message');
        if (existingMessage) {
            existingMessage.remove();
        }

        const globalMessage = document.createElement('div');
        globalMessage.id = 'global-success-message';
        globalMessage.textContent = message;
        globalMessage.style.color = 'green';
        globalMessage.style.marginTop = '20px';
        globalMessage.style.textAlign = 'center';
        form.appendChild(globalMessage);
    }

    // Fonction pour effacer tous les messages d'erreur et de succès précédents
    function clearMessages() {
        document.querySelectorAll('.error-message').forEach(function (message) {
            message.textContent = '';
        });

        const globalMessage = document.getElementById('global-success-message');
        if (globalMessage) {
            globalMessage.remove();
        }
    }
});