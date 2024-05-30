// function incrementQuantity(productId, maxQuantity) {
//     var quantityElement = document.getElementById("quantity" + productId);
//     var currentValue = parseInt(quantityElement.textContent);
//     if (currentValue < maxQuantity) {
//         quantityElement.textContent = currentValue + 1;
//     }
// }

// function decrementQuantity(productId) {
//     var quantityElement = document.getElementById("quantity" + productId);
//     var currentValue = parseInt(quantityElement.textContent);
//     if (currentValue > 1) {
//         quantityElement.textContent = currentValue - 1;
//     }
// }

// // Function to update quantity in the modal
// function updateQuantityInModal(quantity) {
//     document.getElementById("quantitySpan").innerText = quantity;
//     document.getElementById("modalQuantity").value = quantity;
// }

// // Function to increment quantity
// function incrementQuantity(productId, maxQuantity) {
//     var quantityElement = document.getElementById("quantity" + productId);
//     var currentQuantity = parseInt(quantityElement.innerText);
//     if (currentQuantity < maxQuantity) {
//         currentQuantity++;
//         quantityElement.innerText = currentQuantity;
//         updateQuantityInModal(currentQuantity);
//     }
// }

// // Function to decrement quantity
// function decrementQuantity(productId) {
//     var quantityElement = document.getElementById("quantity" + productId);
//     var currentQuantity = parseInt(quantityElement.innerText);
//     if (currentQuantity > 1) {
//         currentQuantity--;
//         quantityElement.innerText = currentQuantity;
//         updateQuantityInModal(currentQuantity);
//     }
// }

// Function to update quantity and total price in the modal
function decrementQuantity(productId, price) {
    var quantityElement = document.getElementById("quantity" + productId);
    var currentQuantity = parseInt(quantityElement.value);

    if (currentQuantity > 1) {
        currentQuantity--;
        quantityElement.value = currentQuantity;
        document.getElementById("quantityInput" + productId).value =
            currentQuantity; // Update hidden input
        updateModal(productId, price);
    }
}

function incrementQuantity(productId, maxQuantity, price) {
    var quantityElement = document.getElementById("quantity" + productId);
    var currentQuantity = parseInt(quantityElement.value);

    if (currentQuantity < maxQuantity) {
        currentQuantity++;
        quantityElement.value = currentQuantity;
        document.getElementById("quantityInput" + productId).value =
            currentQuantity; // Update hidden input
        updateModal(productId, price);
    }
}

function updateModal(productId, price) {
    var quantityElement = document.getElementById("quantity" + productId);
    var currentQuantity = parseInt(quantityElement.value);
    var totalPrice = currentQuantity * price;

    document.getElementById("quantitySpan").innerText = currentQuantity;
    document.getElementById("modalQuantity").value = currentQuantity;
    document.getElementById("totalPrice").innerText = totalPrice.toFixed(2);
    document.getElementById("modalTotalPrice").value = totalPrice.toFixed(2);
}
function updateCartItemQuantity(cartItemId, change) {
    // Make an AJAX request to update the cart item quantity
    fetch(`/updatecartitem/${cartItemId}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
        },
        body: JSON.stringify({ change: change }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                location.reload();
            } else {
                alert("Could not update the cart item.");
            }
        })
        .catch((error) => console.error("Error:", error));
}
