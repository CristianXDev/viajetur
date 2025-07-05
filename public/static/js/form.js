// Obtener el formulario y los campos
const form = document.getElementById('myForm');
const nameField = document.getElementById('name');
const emailField = document.getElementById('email');
const passwordField = document.getElementById('password');

// Agregar evento de submit al formulario
form.addEventListener('submit', function(event) {
  // Validar campo de nombre
  if (nameField.value === '') {
    nameField.classList.add('is-invalid');
    event.preventDefault();
  } else {
    nameField.classList.remove('is-invalid');
  }
  
  // Validar campo de email
  if (emailField.value === '' || !validateEmail(emailField.value)) {
    emailField.classList.add('is-invalid');
    event.preventDefault();
  } else {
    emailField.classList.remove('is-invalid');
  }
  
  // Validar campo de contraseña
  if (passwordField.value === '') {
    passwordField.classList.add('is-invalid');
    event.preventDefault();
  } else {
    passwordField.classList.remove('is-invalid');
  }
});

// Función para validar formato de email
function validateEmail(email) {
  const re = /\S+@\S+\.\S+/;
  return re.test(email);
}