



<script>


    let alertMessages;

    function alertMessageTimeout() {
        setTimeout(() => {
            alertMessages = document.getElementsByClassName('alert-message');

            // Verifico se ci sono elementi con la classe alert-message
            if (alertMessages.length > 0) {

                // faccio un ciclo su tutti gli elementi con la classe alert-message e aggiungo la classe "hide"
                for (alertMessage of alertMessages) {
                    alertMessage.classList.add("hide");
                }
            }
        }, 3000);
    }

    // Chiamare la funzione
    alertMessageTimeout();





    // funzione per far scomparire la classe is-invalid

    function hideErrorMessages() {
    setTimeout(() => {
        const errorDivs = document.querySelectorAll('.is-invalid');

        // Verifico se ci sono elementi con la classe "is-invalid"
        if (errorDivs.length > 0) {
            // faccio un ciclo su tutti gli elementi con la classe e rimuovo la classe "is-invalid"
            for (const errorDiv of errorDivs) {
                errorDiv.classList.remove('is-invalid');

            }
        }
    }, 3000);
}

    // Chiamo la funzione
    hideErrorMessages();




</script>
