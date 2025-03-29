<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Products</h1>
    <section id="products">
        <!-- Product 1 -->
        <div class="product">
            <h2>Product 1</h2>
            <p>Price: $100</p>
            <button class="add-to-cart" data-id="1" data-name="Product 1" data-price="100">Buy Now</button>
        </div>

        <!-- Product 2 -->
        <div class="product">
            <h2>Product 2</h2>
            <p>Price: $150</p>
            <button class="add-to-cart" data-id="2" data-name="Product 2" data-price="150">Buy Now</button>
        </div>
    </section>

    <a href="cart.php">Go to Cart</a>

    <script>
        // JavaScript for adding items to localStorage
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', () => {
                const product = {
                    id: button.getAttribute('data-id'),
                    name: button.getAttribute('data-name'),
                    price: button.getAttribute('data-price')
                };

                // Get existing cart from localStorage or initialize it
                let cart = JSON.parse(localStorage.getItem('cart')) || [];

                // Add product to the cart
                cart.push(product);

                // Save cart back to localStorage
                localStorage.setItem('cart', JSON.stringify(cart));

                alert(`${product.name} has been added to your cart!`);
            });
        });
    </script>
</body>
</html>
