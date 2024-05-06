// Function to calculate the total price based on form values
function calculatePrice(departure, people, hotel) {
    // Dummy calculation based on some criteria
    var basePrice = 500;
    var pricePerPerson = 200;
    var hotelPrice = 0;
    switch (hotel) {
        case "hotel1":
            hotelPrice = 100;
            break;
        case "hotel2":
            hotelPrice = 150;
            break;
        case "hotel3":
            hotelPrice = 200;
            break;
        case "hotel4":
            hotelPrice = 250;
            break;
        default:
            break;
    }
    return basePrice + (people * pricePerPerson) + hotelPrice;
}

// Function to display the price dynamically
function displayPrice() {
    // Get form values
    var departure = document.getElementById("departure").value;
    var people = parseInt(document.getElementById("people").value);
    var hotel = document.getElementById("hotel").value;

    // Calculate price based on form values
    var price = calculatePrice(departure, people, hotel);

    // Display price
    document.getElementById("priceDisplay").innerText = "Total Price: $" + price.toFixed(2);
}

// Attach event listeners to form elements to update price dynamically
document.getElementById("departure").addEventListener("change", displayPrice);
document.getElementById("people").addEventListener("change", displayPrice);
document.getElementById("hotel").addEventListener("change", displayPrice);

// Display default price when page loads
window.onload = function() {
    // Set default values
    var defaultDeparture = "lisbon";
    var defaultPeople = 1;
    var defaultHotel = "hotel1";

    // Calculate and display default price
    var defaultPrice = calculatePrice(defaultDeparture, defaultPeople, defaultHotel);
    document.getElementById("priceDisplay").innerText = "Total Price: $" + defaultPrice.toFixed(2);
};
