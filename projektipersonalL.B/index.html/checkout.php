<?php if (!empty($cartItems)): ?>
    <ul>
        <?php foreach ($cartItems as $item): ?>
            <li>
                <?php echo htmlspecialchars($item['product']); ?> - €<?php echo htmlspecialchars($item['price']); ?>
                <form action="cart.php" method="post" style="display:inline;">
                    <input type="hidden" name="action" value="remove">
                    <input type="hidden" name="product" value="<?php echo htmlspecialchars($item['product']); ?>">
                    <button type="submit">Remove</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    <form action="checkout.php" method="post">
        <button type="submit" style="padding: 10px; background-color: #333; color: #fff; border: none; border-radius: 4px; cursor: pointer;">Checkout</button>
    </form>
<?php else: ?>
    <p>I qkyfsh</p>
<?php endif; ?>
