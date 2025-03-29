<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Your Cart</h1>
    <ul id="cartItems"></ul>
    <p id="emptyCartMessage" style="display: none;">Your cart is empty.</p>

    <a href="index-cart.php">Back to Products</a>

    <script>
        // JavaScript for displaying cart items from localStorage
        document.addEventListener('DOMContentLoaded', () => {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const cartItems = document.getElementById('cartItems');
            const emptyCartMessage = document.getElementById('emptyCartMessage');

            if (cart.length === 0) {
                emptyCartMessage.style.display = 'block';
            } else {
                emptyCartMessage.style.display = 'none';

                cart.forEach((product, index) => {
                    const listItem = document.createElement('li');
                    listItem.innerHTML = `
                        ${product.name} - $${product.price}
                        <button onclick="removeFromCart(${index})">Remove</button>
                    `;
                    cartItems.appendChild(listItem);
                });
            }
        });

        // JavaScript for removing items from the cart
        function removeFromCart(index) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart.splice(index, 1); // Remove item from cart
            localStorage.setItem('cart', JSON.stringify(cart)); // Update localStorage
            location.reload(); // Reload to update cart display
        }
    </script>
</body>
</html>
