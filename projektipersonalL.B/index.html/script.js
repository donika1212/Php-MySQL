document.addEventListener('DOMContentLoaded', () => {
  const cart = [];

  document.querySelectorAll('.btn').forEach(button => {
    button.addEventListener('click', event => {
      event.preventDefault();
      const product = event.target.closest('.product');
      const productName = product.querySelector('h3').innerText;
      const productPrice = product.querySelector('span').innerText;
      const productImage = product.querySelector('img').src;

      const productDetails = {
        name: productName,
        price: productPrice,
        image: productImage
      };

      cart.push(productDetails);
      localStorage.setItem('cart', JSON.stringify(cart));
      alert(`${productName} has been added to your cart!`);
    });
  });

  function searchProducts() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const products = document.querySelectorAll('.product');

    products.forEach(product => {
      const productName = product.querySelector('h3').innerText.toLowerCase();
      if (productName.includes(input)) {
        product.style.display = '';
      } else {
        product.style.display = 'none';
      }
    });
  }

  document.getElementById('searchInput').addEventListener('input', searchProducts);
});
