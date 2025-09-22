<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/estiloportada.css" />
    <title>Evaluación Docente</title>
    </title>
    <style></style>
  </head>
  <body>
    <header>
      <div class="contenedorimg">
        <div class="image-container">
          <img
            src="./../assets/resources/images/edoMex.jpg"
            alt="edomex"
            class="navbar-image" />
          <img
            src="./../assets/resources/images/logotecnm.png"
            alt="TECNOLOGICO"
            class="navbar-image" />
          <img
            src="./../assets/resources/images/logoTeso.png"
            alt="tesoem"
            class="navbar-image" />
        </div>
      </div>
    </header>
    <div class="container">
      <header>
        <p class="logo" style="text-align: center;">Evaluación Docente</p>
      </header>

      <div class="image-slider">
        <div class="slider-inner">
          <div class="slide">
            <img
              src="assets/resources/images/slider/tesoemservir.jpg"
              alt="Imagen minimalista 1" />
          </div>
          <div class="slide">
            <img
              src="assets/resources/images/slider/tercera.jpg"
              alt="Imagen minimalista 2" />
          </div>
          <div class="slide">
            <img
              src="assets/resources/images/slider/segunda.jpg"
              alt="Imagen minimalista 3" />
          </div>
        </div>
        <div class="slider-nav">
          <div class="slider-dot active"></div>
          <div class="slider-dot"></div>
          <div class="slider-dot"></div>
        </div>
      </div>

      <div class="login-section">
        <h2>Iniciar sesión</h2>
        <form id="loginForm" action="page/validausr.php" method="POST">
          <div class="form-group">
            <label for="matricula">Matricula</label>
            <input type="text" id="matricula" name="matricula" required />
          </div>

          <button type="submit" class="login-btn">Acceder</button>
        </form>
      </div>
    </div>

    <footer>
      <div >
        <ul  style="text-align: left; margin-left: 160px; list-style-type: none;">
            <li>
                <p>📞 (55)5986497</p>
                <p>✉️ teseom@tesoem.edu.mx</p>
                <p>🌐 <a href="http://tesoem.edomex.gob.mx">http://tesoem.edomex.gob.mx</a></p>
                <p style="margin-left: 70px;"><a href="https://www.facebook.com/TESOEMOficial/?locale=es_LA"><img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook" style="width:40px;height:40px;"></a></p>
            </li>
        </ul>
    </div>
    </footer>

    <script>
      // Script para el slider de imágenes
      document.addEventListener("DOMContentLoaded", function () {
        const sliderInner = document.querySelector(".slider-inner");
        const slides = document.querySelectorAll(".slide");
        const dots = document.querySelectorAll(".slider-dot");
        let currentIndex = 0;
        const slideCount = slides.length;

        function goToSlide(index) {
          if (index < 0) index = slideCount - 1;
          if (index >= slideCount) index = 0;

          currentIndex = index;
          sliderInner.style.transform = `translateX(-${currentIndex * 100}%)`;

          // Actualizar dots
          dots.forEach((dot, i) => {
            dot.classList.toggle("active", i === currentIndex);
          });
        }

        // Configurar dots
        dots.forEach((dot, index) => {
          dot.addEventListener("click", () => goToSlide(index));
        });

        // Auto slide cada 5 segundos
        setInterval(() => {
          goToSlide(currentIndex + 1);
        }, 5000);

        // Validación simple del formulario
        const loginForm = document.getElementById("loginForm");
        loginForm.addEventListener("submit", function (e) {
          const username = document.getElementById("username").value;
          const password = document.getElementById("password").value;

          if (!username || !password) {
            e.preventDefault();
            alert("Por favor complete todos los campos");
          }
          // En una implementación real, aquí iría la validación con el servidor
        });
      });
    </script>
  </body>
</html>
