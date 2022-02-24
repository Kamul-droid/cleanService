window.onload = () => {
    //Variables
    let stripe = Stripe('pk_test_51K2DhxG8gwbuMcw3yUVLrom2wGlxddR0fv4Kv1RLzeLXexkPfcxOmfgWRwHRujQ2aLBZCvnidlBAO3pJTM6YDkvv00VQdoQC8d');
    let elements = stripe.elements();
    let redirect = "/index.php"

    //Pages objects
    let cardHolderName = document.getElementById("cardholder-name")
    let cardButton = document.getElementById("card-button")
    let clientSecret = cardButton.dataset.secret;

    //Create bank card elements for the form
    let card = elements.create("card")
    card.mount("#card-elements");

    // check data
    card.addEventListener("change", (event) => {
        let displayError = document.getElementById("card-errors")
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = "";
        }
    })

    //payement section

    cardButton.addEventListener("click", () => {
        stripe.handleCardPayment(
            clientSecret, card, {
                payment_method_data: {
                    billing_details: {
                        name: cardHolderName.value
                    }
                }
            }
        ).then((result) => {
            if (result.error) {
                document.getElementById("errors").innerText = result.error.message;
            } else {
                document.location.href = redirect;

            }
        })
    })

}