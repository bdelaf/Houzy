document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector(".info-form");

  form.addEventListener("submit", function (event) {
      event.preventDefault();

      const nombre = form.querySelector("input[placeholder='Nombre y apellido']").value.trim();
      const contacto = form.querySelector("input[placeholder='Contacto']").value.trim();
      const duda = form.querySelector("input[placeholder='Duda']").value.trim();

      let errores = [];

      const nombreRegex = /^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]+$/;
      if (nombre === "" || !nombreRegex.test(nombre)) {
          errores.push("El nombre solo puede contener letras y espacios. No uses números ni caracteres especiales.");
      }

      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (contacto === "" || !emailRegex.test(contacto)) {
          errores.push("Ingresa un correo electrónico válido (ejemplo: usuario@gmail.com).");
      }

      if (duda === "") {
          errores.push("Escribe tu duda antes de enviar el formulario.");
      }

      if (errores.length > 0) {
          alert("⚠️ Hay errores en el formulario:\n\n" + errores.join("\n"));
      } else {
          //alert("✅ Formulario enviado con éxito.");
          form.submit(); 
          setTimeout(() => {
              location.reload();
          }, 1000);
      }
  });
});