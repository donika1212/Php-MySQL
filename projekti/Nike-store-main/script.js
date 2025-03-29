const wrapper = document.querySelector(".sliderWrapper");
const menuItems = document.querySelectorAll(".menuItem");

const products = [
  {
    id: 1,
    title: "Air Force",
    price: 119,
    colors: [
      {
        code: "black",
        img: "./img/air.png",
      },
      {
        code: "darkblue",
        img: "./img/air2.png",
      },
    ],
  },
  {
    id: 2,
    title: "Air Jordan",
    price: 149,
    colors: [
      {
        code: "lightgray",
        img: "./img/jordan.png",
      },
      {
        code: "green",
        img: "./img/jordan2.png",
      },
    ],
  },
  {
    id: 3,
    title: "Blazer",
    price: 109,
    colors: [
      {
        code: "lightgray",
        img: "./img/blazer.png",
      },
      {
        code: "green",
        img: "./img/blazer2.png",
      },
    ],
  },
  {
    id: 4,
    title: "Crater",
    price: 129,
    colors: [
      {
        code: "black",
        img: "./img/crater.png",
      },
      {
        code: "lightgray",
        img: "./img/crater2.png",
      },
    ],
  },
  {
    id: 5,
    title: "Hippie",
    price: 99,
    colors: [
      {
        code: "gray",
        img: "./img/hippie.png",
      },
      {
        code: "black",
        img: "./img/hippie2.png",
      },
    ],
  },
];

let choosenProduct = products[0];

const currentProductImg = document.querySelector(".productImg");
const currentProductTitle = document.querySelector(".productTitle");
const currentProductPrice = document.querySelector(".productPrice");
const currentProductColors = document.querySelectorAll(".color");
const currentProductSizes = document.querySelectorAll(".size");

menuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
   
    wrapper.style.transform = `translateX(${-100 * index}vw)`;

   
    choosenProduct = products[index];

   
    currentProductTitle.textContent = choosenProduct.title;
    currentProductPrice.textContent = "$" + choosenProduct.price;
    currentProductImg.src = choosenProduct.colors[0].img;

   
    currentProductColors.forEach((color, index) => {
      color.style.backgroundColor = choosenProduct.colors[index].code;
    });
  });
});

currentProductColors.forEach((color, index) => {
  color.addEventListener("click", () => {
    currentProductImg.src = choosenProduct.colors[index].img;
  });
});

currentProductSizes.forEach((size, index) => {
  size.addEventListener("click", () => {
    currentProductSizes.forEach((size) => {
      size.style.backgroundColor = "white";
      size.style.color = "black";
    });
    size.style.backgroundColor = "black";
    size.style.color = "white";
  });
});

const productButton = document.querySelector(".productButton");
const payment = document.querySelector(".payment");
const close = document.querySelector(".close");

productButton.addEventListener("click", () => {
  payment.style.display = "flex";
});

close.addEventListener("click", () => {
  payment.style.display = "none";
});
//ani text from left 
document.addEventListener('DOMContentLoaded', function() {
  const features = document.querySelectorAll('.feature');

  function checkScroll() {
      features.forEach(feature => {
          const featureTop = feature.getBoundingClientRect().top;
          const featureBottom = feature.getBoundingClientRect().bottom;
          const windowHeight = window.innerHeight;

         
          const isVisible = (featureTop < windowHeight && featureBottom > 0);

          if (isVisible) {
              feature.classList.add('animate');
          } else {
              feature.classList.remove('animate');
          }
      });
  }

  
  checkScroll();

 
  window.addEventListener('scroll', checkScroll);
});

document.addEventListener('DOMContentLoaded', function() {
  const catalogText = document.querySelector('.catalog-text');

  function checkScroll() {
      const catalogTextTop = catalogText.getBoundingClientRect().top;
      const catalogTextBottom = catalogText.getBoundingClientRect().bottom;
      const windowHeight = window.innerHeight;

      const isVisible = (catalogTextTop < windowHeight && catalogTextBottom > 0);

      if (isVisible) {
          catalogText.classList.add('animate');
      } else {
          catalogText.classList.remove('animate');
      }
  }


  checkScroll();


  window.addEventListener('scroll', checkScroll);
});


document.addEventListener('DOMContentLoaded', function() {
  const textElements = document.querySelectorAll('.text');

  function isInViewport(element) {
      const rect = element.getBoundingClientRect();
      return (
          rect.top >= 0 &&
          rect.left >= 0 &&
          rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
          rect.right <= (window.innerWidth || document.documentElement.clientWidth)
      );
  }

  function checkVisibility() {
      textElements.forEach(function(textElement) {
          if (isInViewport(textElement)) {
              textElement.classList.add('animate');
          } else {
              textElement.classList.remove('animate');
          }
      });
  }

  window.addEventListener('scroll', checkVisibility);
  window.addEventListener('resize', checkVisibility);
  checkVisibility();
});
