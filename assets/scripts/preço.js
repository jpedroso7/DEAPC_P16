function confirmBooking() {
    return confirm("Are you sure you want to book this trip?");
}

function calcularPreco(nPessoas, hotel) {
    var precoInicial = 500;
    var precoPessoa = 200;
    var precoHotel = 0;
    switch (hotel) {
        case "hotel1":
            precoHotel = 100;
            break;
        case "hotel2":
            precoHotel = 150;
            break;
        case "hotel3":
            precoHotel = 200;
            break;
        case "hotel4":
            precoHotel = 250;
            break;
        default:
            break;
    }
    return precoInicial + (nPessoas * precoPessoa) + precoHotel;
}

function displayPrice() {
    var partida = document.getElementById("departure").value;
    var nPessoas = parseInt(document.getElementById("people").value);
    var hotel = document.getElementById("hotel").value;

    var precoTotal = calcularPreco(nPessoas, hotel);

    document.getElementById("priceDisplay").innerText = "Preço Total: $" + precoTotal.toFixed(2);

    // Update hidden input for price
    var priceInput = document.getElementById("price");
    priceInput.value = precoTotal.toFixed(2);
}

document.getElementById("departure").addEventListener("change", displayPrice);
document.getElementById("people").addEventListener("change", displayPrice);
document.getElementById("hotel").addEventListener("change", displayPrice);

window.onload = function() {
    var defaultpartida = "lisbon";
    var defaultPeople = 1;
    var defaultHotel = "hotel1";

    var defaultPrice = calcularPreco(defaultPeople, defaultHotel);
    document.getElementById("priceDisplay").innerText = "Preço Total: $" + defaultPrice.toFixed(2);

    var priceInput = document.getElementById("price");
    priceInput.value = defaultPrice.toFixed(2);
};
