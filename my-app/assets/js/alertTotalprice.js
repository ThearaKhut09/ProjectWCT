 // Function to extract query parameters from the URL
 function getQueryParams() {
    const params = new URLSearchParams(window.location.search);
    return {
        totalPrice: params.get("totalPrice"),
        basketLength: params.get("basketLength")
    };
}

// Retrieve the query parameters and display them
const { totalPrice, basketLength } = getQueryParams();

if (totalPrice) {
    document.getElementById("totalPrice").textContent = `Total Price: $${parseFloat(totalPrice).toFixed(2)}`;
} else {
    document.getElementById("totalPrice").textContent = "Total Price: N/A";
}

if (basketLength) {
    document.getElementById("basketLength").textContent = `Your Product : ${basketLength}`;
} else {
    document.getElementById("basketLength").textContent = "Number of Items: N/A";
}