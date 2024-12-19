let basketItems = [];
let itemCount = 0;

// Add product to basket
function addToBasket(itemName, price) {
    basketItems.push({ name: itemName, price });
    itemCount++;
    updateBasketUI();
}

// Remove product from basket
function removeItem(index) {
    basketItems.splice(index, 1);
    itemCount--;
    updateBasketUI();
}

// Clear basket
function clearBasket() {
    basketItems.length = 0;
    itemCount = 0;
    updateBasketUI();
}

// Checkout functionality
document.getElementById("checkoutButton").addEventListener("click", () => {
    if (basketItems.length > 0) {
        // Calculate total price
        let totalPrice = basketItems.reduce((sum, item) => sum + item.price, 0).toFixed(2);

        // Show the checkout alert with the total price
        alert(`You have ${basketItems.length} items in your basket. Checkout: $${totalPrice}`);

        // Redirect to checkout page with query parameters
        window.location.href = `CheckoutProduct.html?totalPrice=${totalPrice}&basketLength=${basketItems.length}`;
    } else {
        alert("No products selected for checkout.");
    }
});

// Update the basket UI
function updateBasketUI() {
    const itemCountElement = document.getElementById("item-count");
    itemCountElement.textContent = itemCount;

    const basketItemsContainer = document.getElementById("basket-items");
    basketItemsContainer.innerHTML = ""; // Clear previous items

    if (basketItems.length === 0) {
        basketItemsContainer.innerHTML = "<p class='text-white' style='color: white;'>No items in the basket</p>";
          return;
      }


    basketItems.forEach((item, index) => {
        const itemElement = document.createElement("div");
        itemElement.classList.add("d-flex", "justify-content-between", "align-items-center", "mb-2");
        itemElement.innerHTML = `
            <span>${item.name} - $${item.price.toFixed(2)}</span>
            <button class="btn btn-sm btn-outline-danger" onclick="removeItem(${index})">Remove</button>
        `;
        basketItemsContainer.appendChild(itemElement);
    });
}