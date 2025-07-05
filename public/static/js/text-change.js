const element = document.querySelector('.color-changing-element');
const offset = 100; // Puedes ajustar este valor según tu diseño

window.addEventListener('scroll', () => {
   if (window.scrollY > 43) {
      element.classList.add('color-changed');
   } else {
      element.classList.remove('color-changed');
   }
});