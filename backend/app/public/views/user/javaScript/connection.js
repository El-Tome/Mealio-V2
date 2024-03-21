document.addEventListener("DOMContentLoaded", function() {
    // Attend que le document soit chargé

    // formaulaire d'inscription
    let connectionForm = document.getElementById("connection-form");
    connectionForm.addEventListener("submit", function(event) {
        event.preventDefault();

        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;

        let dataConnection = new FormData();
        dataConnection.append("email", email);
        dataConnection.append("password", password);

        let json = {};

        for (const [key, value] of dataConnection.entries()) {
            json[key] = value;
        }

        fetch('techFile/connection.php', {
            method : 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(json)
        })
            .then(response => response.json())
            .then(dataConnection => {
                if (dataConnection.success) {
                    //redirretion to the profile page
                    window.location.href = "profile.php";
                } else {
                    document.getElementById("error_message-connection").textContent = dataConnection.message;
                }
            })
            .catch(error => {
                console.error('Erreur: ' + error);
            })
    });
});