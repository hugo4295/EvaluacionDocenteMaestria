<?php
    session_start();
    require_once '../includes/connectbd.php';
    $conexion = new DB_Connect();
    $conn = $conexion->connect();
    if ($conn -> connect_errno) {
        die("No se estableció la conexión: (".$conn -> mysqli_connect_errno().")".$conn -> mysqli_connect_error());
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluacion Docente</title>
    <style>
        .new-navbar-container {
            background-color: rgb(255, 255, 255);
            padding: 5px 20px;
            width: 100%;
            box-sizing: border-box;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .image-left {
            display: flex;
            justify-content: flex-start;
            width: auto;
        }

        .images-right {
            display: flex;
            flex-direction: column; /* Asegura que las imágenes y los botones estén en una columna */
            align-items: flex-end;
        }

        .images-right-content {
            display: flex;
            flex-direction: row; /* Mantiene las imágenes alineadas en una fila */
            gap: 15px; /* Espacio entre las imágenes */
            margin-top: 100px; /* Ajusta este valor para bajar las imágenes */
        }

        .navbar-image {
            width: 100px;
            height: auto;
            max-height: 100px;
        }

        .button-container {
            display: flex;
            justify-content: flex-end; /* Mantiene los botones alineados a la derecha */
            width: 100%; /* Asegura que los botones ocupen todo el ancho disponible */
            margin-top: 50px; /* Ajusta este valor para bajar los botones */
        }

        .new-nav {
            list-style: none;
            display: flex;
            justify-content: flex-end;
            padding: 0;
            margin: 0;
            gap: 10px;
        }

        .new-nav li {
            display: inline;
        }

        .new-nav a {
            color: rgb(7, 7, 7); /* Color del texto del botón */
            text-decoration: none;
            padding: 10px;
            display: inline-block;
            border: 2px solid rgb(70, 4, 4);
            border-radius: 10px; /* Bordes redondeados */
            transition: background-color 0.3s ease; /* Animación suave al hacer hover */
        }

        .new-nav a:hover {
            background-color: green; /* Cambia el fondo a verde cuando el mouse pasa por encima */
            color: white; /* Cambia el color del texto a blanco para mejor contraste */
        }

        .templatemo_blog {
            text-align: center;
        }

        .templatemo_blog .container {
            display: inline-block;
            text-align: left;
        }

        table {
            width: 600px; /* Tamaño aumentado */
            margin: 0 auto;
            background-color:#8df888;
            border: 3px solid;
            border-collapse: collapse;
            cellpadding: 1;
            cellspacing: 1;
        }

        .btn-rect {
            display: inline-block;
            text-decoration: none;
            padding: 10px 20px; /* Aumenta el padding para hacerlo más grande */
            border: 2px solid #800000; /* Color vino */
            border-radius: 0; /* Hace el borde recto */
            color: black; /* Color del texto */
            background-color: #fafafa; /* Color de fondo */
            transition: background-color 0.3s ease;
            margin: 20px auto;
            text-align: center;
            
        }

        .btn-rect:hover {
            background-color: greenyellow; /* Cambia el fondo a verde cuando el mouse pasa por encima */
            color: black; /* Cambia el color del texto a blanco para mejor contraste */
        }
        table, th, td {
            text-align: center;
            vertical-align: middle;
        }

    </style>
</head>
<body>
<header>
    <nav class="navbar">
        <div class="new-navbar-container">
            <div class="image-left">
                <img src="../assets/resources/images/edoMex.jpg" alt="edomex" class="navbar-image">
            </div>
            <div class="images-right">
                <div class="images-right-content">
                    <img src="../assets/resources/images/tecMX.png" alt="TECNOLOGICO" class="navbar-image">
                    <img src="../assets/resources/images/logoTeso.png" alt="tesoem" class="navbar-image">
                </div>
                <div class="button-container">
                    <ul class="new-nav">
                        <li><a href="../index.php">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
<div align="center">
    <br>
    <label>INSTRUMENTO DE EVALUACIÓN AL DESEMPEÑO DOCENTE</label><br>
    <label>SEMESTRE 2024-1</label><br>
</div>
<div class="templatemo_blog" id="templatemo_blog">
    <div class="container">
    <a type="button" class="btn-rect" href="graficar.php">Graficar</a>
        <table class="table">
            <tr>
                <?php
                    $queryAR = "SELECT COUNT(*) from encuestado";
                    $llenadoAR = $conn->query($queryAR);
                    if ($llenadoAR) {
                        $filaAR = $llenadoAR->fetch_row();
                        $totalAR = $filaAR[0];
                        echo "<td>Alumnos registrados</td>";
                        echo "<td>".$totalAR."</td>";
                        $llenadoAR->close();
                    } else {
                        echo "Error al obtener el conteo de alumnos";
                    }
                ?>
            </tr>
        </table>
        <br>
        <table class="table">
            <tr>
                <?php
                    $queryAF = "SELECT COUNT(*) from encuestado as e where e.status = 'R'";
                    $llenadoAF = $conn->query($queryAF);
                    if ($llenadoAF) {
                        $filaAF = $llenadoAF->fetch_row();
                        $totalAF = $filaAF[0];
                        echo "<td>Alumnos Encuestados</td>";
                        echo "<td>".$totalAF."</td>";
                    }
                ?>
            </tr>
        </table>
        <br>
        <table class="table">
            <tr>
                <?php
                    $queryAF = "SELECT COUNT(*) from encuestado as e where e.status = 'N'";
                    $llenadoAF = $conn->query($queryAF);
                    if ($llenadoAF) {
                        $filaAF = $llenadoAF->fetch_row();
                        $totalAF = $filaAF[0];
                        echo "<td>Alumnos Faltantes</td>";
                        echo "<td>".$totalAF."</td>";
                    }
                ?>
            </tr>
        </table>
        <br>
        <h3>Faltantes por grupo</h3>
        <table class="table">
            <tr>
                <th>Grupo</th>
                <th>Faltantes</th>
            </tr>
            <?php
                $queryAFMat = "SELECT eg.idG as Grupo, count(e.matricula) as faltantes from encuestado as e inner join encuestadogrupo eg on e.matricula = eg.matricula where e.status = 'N' group by eg.idG order by eg.idG";
                $llenadoAFMat = $conn->query($queryAFMat);
                while($fila = $llenadoAFMat->fetch_row()){
                    echo "<tr><td>".$fila[0]."</td>";
                    echo "<td>".$fila[1]."</td></tr>";
                }
            ?>
        </table>
        <br>
        <h3>Alumnos Faltantes:</h3>
        <table class="table">
            <tr>
                <th>Matricula</th>
                <th>Grupo</th>
            </tr>
            <?php
                $queryAFMat = "SELECT eg.idG as Grupo, e.matricula as Faltantes from encuestado as e inner join encuestadogrupo eg on e.matricula = eg.matricula where e.status = 'N' order by eg.idG";
                $llenadoAFMat = $conn->query($queryAFMat);
                while($fila = $llenadoAFMat->fetch_row()){
                    echo "<tr><td>".$fila[1]."</td>";
                    echo "<td>".$fila[0]."</td></tr>";
                }
            ?>
        </table>
    </div>
        </div>

    <!-- Bottom End -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://code.jquery.com/jquery.js"></script> -->
    <script src="../css/js/jquery-1.10.2.min.js"></script>
    <script src="../css/js/bootstrap.min.js"></script>
    <script src="../css/js/jquery.cycle2.min.js"></script>2023-2024/1
    <script src="../css/js/jquery.cycle2.carousel.min.js"></script>
    <script src="../css/js/jquery.nivo.slider.pack.js"></script>
    <script>$.fn.cycle.defaults.autoSelector = '.slideshow';</script>
    <script type="text/javascript">
        $(function () {
        var default_view = 'grid';
        if ($.cookie('view') !== 'undefined') {
        $.cookie('view', default_view, {expires: 7, path: '/'});
        }
        function get_grid() {
        $('.list').removeClass('list-active');
        $('.grid').addClass('grid-active');
        $('.prod-cnt').animate({opacity: 0}, function () {
        $('.prod-cnt').removeClass('dbox-list');
        $('.prod-cnt').addClass('dbox');
        $('.prod-cnt').stop().animate({opacity: 1});
        });
        }
        function get_list() {
        $('.grid').removeClass('grid-active');
        $('.list').addClass('list-active');
        $('.prod-cnt').animate({opacity: 0}, function () {
        $('.prod-cnt').removeClass('dbox');
        $('.prod-cnt').addClass('dbox-list');
        $('.prod-cnt').stop().animate({opacity: 1});
        });
        }
        if ($.cookie('view') == 'list') {
        $('.grid').removeClass('grid-active');
        $('.list').addClass('list-active');
        $('.prod-cnt').animate({opacity: 0});
        $('.prod-cnt').removeClass('dbox');
        $('.prod-cnt').addClass('dbox-list');
        $('.prod-cnt').stop().animate({opacity: 1});
        }

        if ($.cookie('view') == 'grid') {
        $('.list').removeClass('list-active');
        $('.grid').addClass('grid-active');
        $('.prod-cnt').animate({opacity: 0});
        $('.prod-cnt').removeClass('dboxlist');
        $('.prod-cnt').addClass('dbox');
        $('.prod-cnt').stop().animate({opacity: 1});
        }

        $('#list').click(function () {
        $.cookie('view', 'list');
        get_list()
        });
        $('#grid').click(function () {
        $.cookie('view', 'grid');
        get_grid();
        });
        /* filter */
        $('.menuSwitch ul li').click(function () {
        var CategoryID = $(this).attr('category');
        $('.menuSwitch ul li').removeClass('cat-active');
        $(this).addClass('cat-active');
        $('.prod-cnt').each(function () {
        if (($(this).hasClass(CategoryID)) == false) {
        $(this).css({'display': 'none'});
        }
        ;
        });
        $('.' + CategoryID).fadeIn();
        });
        });
    </script>
    <script src="../css/js/jquery.singlePageNav.js"></script>

    <script type="text/javascript">
        $(window).load(function () {
        $('#slider').nivoSlider({
        prevText: '',
                nextText: '',
                controlNav: false,
        });
        });
    </script>
    <script>
        $(document).ready(function () {

        // hide #back-top first
        $("#back-top").hide();
        // fade in #back-top
        $(function () {
        $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
        $('#back-top').fadeIn();
        } else {
        $('#back-top').fadeOut();
        }
        });
        // scroll body to 0px on click
        $('#back-top a').click(function () {
        $('body,html').animate({
        scrollTop: 0
        }, 800);
        return false;
        });
        });
        });
    </script>
    <script type="text/javascript">
        <!--
                function toggle_visibility(id) {
        var e = document.getElementById(id);
        if (e.style.display == 'block') {
        e.style.display = 'none';
        $('#togg').text('show footer');
        } else {
        e.style.display = 'block';
        $('#togg').text('hide footer');
        }
        }
        //-->
        </scri            pt>
        <script type="text/javascript" src="../asset/js/jquery.mousewheel-3.0.6.pack.js"> < /scrip            t>

        <script type="text/javascript">
        $(function () {
                $('a[href*=#]:not([href=#])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        if (target.length) {
        $('html,body').animate({
        scrollTop: target.offset().top},1000);
                return false;
                }
                }
                });
                });
                </script>
                <script src="../css/js/stickUp.min.js" type="text/javascript"></script>
        <script type="text/javascrip                t">
        //initiating jQuery
                jQuery(function ($) {
            $(document).ready(function () {
            //enabling stickUp on the '.navbar-wrapper' class
            $('.mWrapper').stickUp();
                    });
                        });
                </script>
                <script>
                $('a                .menu').click(function () {
        $('a.menu').removeClass("active");
        $(this).addClass("active");
                });
                </script>

                <script> < !-- scroll to specific id when click on menu -- >
                // Cache sel                ectors
                var lastId,
        topMenu = $(                "#top            -menu"),
topMenuHeigh                t = topMenu.outerH            eight() + 15,
    // All list                 it            ems
            menuItems = topMenu.                find("a"),
            //             Anchors corre                sponding to menu items
                scrollItems = menuItems.                            map(function () {
                var item = $($(this).attr("href"));
        if (ite            m.length) {
        return item;
                }
                });

                // Bind click handler to                 menu items
                // so we ca                n get a fancy scroll animation
             menuItems.clic                k(function (e) {
                var href = $(this).attr                ("href"),
                offsetTop = href === "#" ? 0 : $(hre                f).offset().top - topMenuHeight + 1;
        $('html, body').stop().animate({
        scrollTop: offsetTop
                      }, 300);
                      e.preventDefault();
                      });

                        // Bind to scroll
                        $(window).scroll(function () {
                // Get container scro                ll position
                var f                romTop = $(this).scrollTop() + topMenuHeight;
        // Get id of curr            ent scroll                item
        var cur = scrollItems.ma                p(function () {
        if ($(this).offset().top < fromTop)
                return this;
             });
             // Get the id of the current element
                        cur = cur[cur.length - 1];
                        var id = cur && cur.length ? cur[0].id : "";
                    if (lastId !== id) {
                lastId = id;
        // Set/remove active class
        menuItems
                .parent().removeClass("active")
                .end().filter("[href=#" + id + "]").parent().addClass("active");
    }
    });
    </script>
    </body>
</html>
</body>
</HTML>
