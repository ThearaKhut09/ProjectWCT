// Initialize an empty basket
let basket = [];

// Function to add product to basket
function addProductToBasket(productName, price) {
    const product = { name: productName, price: price };
    basket.push(product);
    updateBasket();
}

// Function to update the basket display
function updateBasket() {
    const basketElement = document.getElementById("basket");
    basketElement.innerHTML = ''; // Clear current basket list
    let totalPrice = 0;

    basket.forEach((product, index) => {
        const listItem = document.createElement("li");
        listItem.classList.add("list-group-item");
        listItem.innerHTML = `
            ${product.name} - $${product.price.toFixed(2)}
            <button class="btn btn-danger btn-sm float-end" onclick="removeFromBasket(${index})"><i class="bi bi-trash-fill"></i></button>
        `;
        basketElement.appendChild(listItem);
        totalPrice += product.price;
    });

    document.getElementById("orderSummary").innerHTML = `
        <strong>Total Items:</strong> ${basket.length}<br>
        <strong>Total Price:</strong> $${totalPrice.toFixed(2)}
    `;
}

// Function to remove product from basket
function removeFromBasket(index) {
    basket.splice(index, 1);
    updateBasket();
}

// Checkout button functionality
document.getElementById("checkoutButton").addEventListener("click", () => {
    if (basket.length > 0) {
        // Calculate the total price of the basket
        let totalPrice = basket.reduce((sum, product) => sum + product.price, 0);
        
        // Show the checkout alert with the total price
        alert(`You have ${basket.length} items in your basket. Checkout: $${totalPrice.toFixed(2)}`);
        
        // Redirect to the new page with totalPrice as a query parameter
        window.location.href = `CheckoutProduct.html?totalPrice=${totalPrice.toFixed(2)}&basketLength=${basket.length}`;

    } else {
        // Show an alert if no products are selected
        alert("No products selected for checkout.");
    }
});


