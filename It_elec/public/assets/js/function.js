function incrementQuantity(productId, maxQuantity) {
    var quantityElement = document.getElementById("quantity" + productId);
    var currentValue = parseInt(quantityElement.textContent);
    if (currentValue < maxQuantity) {
        quantityElement.textContent = currentValue + 1;
    }
}

function decrementQuantity(productId) {
    var quantityElement = document.getElementById("quantity" + productId);
    var currentValue = parseInt(quantityElement.textContent);
    if (currentValue > 1) {
        quantityElement.textContent = currentValue - 1;
    }
}

// Function to update quantity in the modal
function updateQuantityInModal(quantity) {
    document.getElementById("quantitySpan").innerText = quantity;
    document.getElementById("modalQuantity").value = quantity;
}

// Function to increment quantity
function incrementQuantity(productId, maxQuantity) {
    var quantityElement = document.getElementById("quantity" + productId);
    var currentQuantity = parseInt(quantityElement.innerText);
    if (currentQuantity < maxQuantity) {
        currentQuantity++;
        quantityElement.innerText = currentQuantity;
        updateQuantityInModal(currentQuantity);
    }
}

// Function to decrement quantity
function decrementQuantity(productId) {
    var quantityElement = document.getElementById("quantity" + productId);
    var currentQuantity = parseInt(quantityElement.innerText);
    if (currentQuantity > 1) {
        currentQuantity--;
        quantityElement.innerText = currentQuantity;
        updateQuantityInModal(currentQuantity);
    }
}
