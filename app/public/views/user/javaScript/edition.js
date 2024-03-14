document.addEventListener("DOMContentLoaded", function() {
    // Attend que le document soit chargé

    // formaulaire d'inscription
    let editionForm = document.getElementById("edition-form");
    editionForm.addEventListener("submit", function(event) {
        event.preventDefault();

        let lastName = document.getElementById("lastName").value;
        let firstName = document.getElementById("firstName").value;
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;
        let passwordConfirm = document.getElementById("passwordConfirm").value;

        let dataEdition = new FormData();
        dataEdition.append("firstName", firstName);
        dataEdition.append("lastName", lastName);
        dataEdition.append("email", email);
        dataEdition.append("password", password);
        dataEdition.append("passwordConfirm", passwordConfirm);

        fetch('techFile/edition.php', {
            method : 'POST',
            body: dataEdition
        })
            .then(response => response.json())
            .then(dataInscript => {
                if (dataEdition.success) {
                    // afficher un bouton se connecter
                    document.getElementById("error_message-edition").textContent = dataEdition.message;
                } else {
                    document.getElementById("error_message-edition").textContent = dataEdition.message;
                }
            })
            .catch(error => {
                console.error('Erreur: ' + error);
            })
    });
});