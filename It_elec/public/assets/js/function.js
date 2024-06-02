// Function to update quantity and total price in the modal
// function decrementQuantity(productId, price) {
//     var quantityElement = document.getElementById("quantity" + productId);
//     var currentQuantity = parseInt(quantityElement.value);

//     if (currentQuantity > 1) {
//         currentQuantity--;
//         quantityElement.value = currentQuantity;
//         document.getElementById("quantityInput" + productId).value =
//             currentQuantity; // Update hidden input
//         updateModal(productId, price);
//     }
// }

// function incrementQuantity(productId, maxQuantity, price) {
//     var quantityElement = document.getElementById("quantity" + productId);
//     var currentQuantity = parseInt(quantityElement.value);

//     if (currentQuantity < maxQuantity) {
//         currentQuantity++;
//         quantityElement.value = currentQuantity;
//         document.getElementById("quantityInput" + productId).value =
//             currentQuantity; // Update hidden input
//         updateModal(productId, price);
//     }
// }

// function updateModal(productId, price) {
//     var quantityElement = document.getElementById("quantity" + productId);
//     var currentQuantity = parseInt(quantityElement.value);
//     var totalPrice = currentQuantity * price;

//     document.getElementById("quantitySpan").innerText = currentQuantity;
//     document.getElementById("modalQuantity").value = currentQuantity;
//     document.getElementById("totalPrice").innerText = totalPrice.toFixed(2);
//     document.getElementById("modalTotalPrice").value = totalPrice.toFixed(2);
// }
// function updateCartItemQuantity(cartItemId, change) {
//     // Make an AJAX request to update the cart item quantity
//     fetch(`/updatecartitem/${cartItemId}`, {
//         method: "POST",
//         headers: {
//             "Content-Type": "application/json",
//             "X-CSRF-TOKEN": "{{ csrf_token() }}",
//         },
//         body: JSON.stringify({ change: change }),
//     })
//         .then((response) => response.json())
//         .then((data) => {
//             if (data.success) {
//                 location.reload();
//             } else {
//                 alert("Could not update the cart item.");
//             }
//         })
//         .catch((error) => console.error("Error:", error));
// }

document.addEventListener("DOMContentLoaded", function () {
    var buyNowModal = document.getElementById("buyNowModal");
    buyNowModal.addEventListener("show.bs.modal", function (event) {
        var button = event.relatedTarget;
        var productId = button.getAttribute("data-product-id");
        var productQuantity = button.getAttribute("data-product-quantity");
        var productPrice = button.getAttribute("data-product-price");

        var modal = this;
        modal.querySelector("#product_id").value = productId;
        modal.querySelector("#modalQuantity").value = productQuantity;
        modal.querySelector("#payment").value = (
            productQuantity * productPrice
        ).toFixed(2);

        // Update modal display values
        document.getElementById("quantitySpan").innerText = productQuantity;
        document.getElementById("totalPrice").innerText = (
            productQuantity * productPrice
        ).toFixed(2);
    });

    var buyNowForm = document.getElementById("buyNowForm");
    buyNowForm.addEventListener("submit", function (event) {
        var action =
            "/transaction/" + document.getElementById("product_id").value;
        this.action = action;
    });
});

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
