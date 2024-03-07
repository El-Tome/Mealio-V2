document.addEventListener("DOMContentLoaded", function() {
    // Attend que le document soit chargé

    // formaulaire d'inscription
    let inscriptionForm = document.getElementById("inscription-form");
    inscriptionForm.addEventListener("submit", function(event) {
        event.preventDefault();

        let lastName = document.getElementById("lastName").value;
        let firstName = document.getElementById("firstName").value;
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;
        let passwordConfirm = document.getElementById("passwordConfirm").value;

        let dataInscript = new FormData();
        dataInscript.append("firstName", firstName);
        dataInscript.append("lastName", lastName);
        dataInscript.append("email", email);
        dataInscript.append("password", password);
        dataInscript.append("passwordConfirm", passwordConfirm);

        fetch('inscription.php', {
            method : 'POST',
            body: dataInscript
        })
            .then(response => response.json())
            .then(dataInscript => {
                if (dataInscript.success) {
                    // afficher un bouton se connecter
                    document.getElementById("error_message-inscript").textContent = dataInscript.message;
                } else {
                    document.getElementById("error_message-inscript").textContent = dataInscript.message;
                }
            })
            .catch(error => {
                console.error('Erreur: ' + error);
            })
    });
});