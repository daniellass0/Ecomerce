<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TechStore | Tecnología al Mejor Precio</title>

    <link rel="stylesheet" href="./css/styles.css">

</head>

<body>

<header>

    <nav class="navbar">

        <div class="logo">
            <h1>🚀 TechStore</h1>
        </div>

        <ul class="nav-links">

            <li><a href="#">Inicio</a></li>

            <li><a href="#contenedor-productos">Productos</a></li>

            <li><a href="#beneficios">Beneficios</a></li>

            <li><a href="login.php">Admin</a></li>

        </ul>

        <div
            class="cart-icon"
            onclick="abrirCarrito()"
        >
            🛒 Carrito
            (
            <span id="cart-count">0</span>
            )
        </div>

    </nav>

</header>

<main>

    <!-- HERO -->

<section class="hero">

    <div class="hero-content">

        <div class="hero-text">

            <span class="badge-hero">
                🔥 Ofertas de la Semana
            </span>

            <h2>
                Tecnología de Última Generación
            </h2>

            <p>
                Encuentra laptops, smartphones,
                componentes y accesorios con los
                mejores precios del mercado.
            </p>

            <div class="hero-buttons">

                <a href="#contenedor-productos" class="btn-hero">
                    Comprar Ahora
                </a>

                <a href="#beneficios" class="btn-secundario">
                    Ver Beneficios
                </a>

            </div>

        </div>

        <div class="hero-image">

            <img
                src="./assets/hero-laptop.jpg"
                alt="Laptop Gamer"
            >

        </div>

    </div>

</section>

<section class="estadisticas">

    <div class="estadistica">
        <h3>+5000</h3>
        <p>Clientes Satisfechos</p>
    </div>

    <div class="estadistica">
        <h3>+1200</h3>
        <p>Productos Disponibles</p>
    </div>

    <div class="estadistica">
        <h3>24/7</h3>
        <p>Soporte Técnico</p>
    </div>

    <div class="estadistica">
        <h3>98%</h3>
        <p>Calificación Positiva</p>
    </div>

</section>

<section class="buscador">

    <input
        type="text"
        id="buscador-productos"
        placeholder="🔍 Buscar productos..."
    >

</section>

    <!-- CATEGORÍAS -->

    <section class="filtros-categorias">

        <div id="contenedor-categorias"></div>

    </section>

    <!-- BENEFICIOS -->

    <section
    id="beneficios"
    class="beneficios"
    >

    <div class="beneficio">

        <div>

            <h2>🚚</h2>

            <h3>Envíos rápidos</h3>

            <p>
                Recibe tu pedido
                en tiempo récord.
            </p>

        </div>

    </div>

    <div class="beneficio">

        <div>

            <h2>🔒</h2>

            <h3>Pagos seguros</h3>

            <p>
                Transacciones
                totalmente protegidas.
            </p>

        </div>

    </div>

    <div class="beneficio">

        <div>

            <h2>⭐</h2>

            <h3>Garantía oficial</h3>

            <p>
                Todos nuestros productos
                cuentan con garantía.
            </p>

        </div>

    </div>

    <div class="beneficio">

        <div>

            <h2>📞</h2>

            <h3>Atención personalizada</h3>

            <p>
                Soporte especializado
                cuando lo necesites.
            </p>

        </div>

    </div>

    </section>

    <!-- PRODUCTOS -->

    <section class="titulo-seccion">

    <h2>
        Productos Destacados
    </h2>

    <p>
        Descubre los equipos más vendidos de nuestra tienda.
    </p>

</section>

    <section
        id="contenedor-productos"
        class="productos-grid"
    >
    </section>

</main>

<footer>

    <div class="footer-grid">

        <div>

            <h3>TechStore</h3>

            <p>
                Tu tienda tecnológica de confianza.
            </p>

        </div>

        <div>

            <h3>Categorías</h3>

            <p>Laptops</p>

            <p>Smartphones</p>

            <p>Componentes</p>

        </div>

        <div>

            <h3>Contacto</h3>

            <p>info@techstore.com</p>

            <p>+57 300 000 0000</p>

        </div>

    </div>

</footer>


<!-- MODAL CARRITO -->

<div
    id="modal-carrito"
    class="modal-oculto"
>

    <div class="modal-contenido">

        <span
            class="cerrar-modal"
            onclick="cerrarCarrito()"
        >
            &times;
        </span>

        <h2>
            Tu Carrito de Compras
        </h2>

        <div id="items-carrito"></div>

        <div class="carrito-total">

            <h3>
                Total:
                $
                <span id="precio-total">
                    0.00
                </span>
            </h3>

            <button
                class="btn-pagar"
                onclick="procesarPago()"
            >
                Proceder al Pago
            </button>

        </div>

    </div>

</div>


<!-- MODAL PAGO -->

<div
    id="modal-pago"
    class="modal-oculto"
>

    <div class="modal-contenido modal-checkout">

        <span
            class="cerrar-modal"
            onclick="cerrarPago()"
        >
            &times;
        </span>

        <h2>💳 Pago Seguro</h2>

        <p class="resumen-pago">

            Total a cobrar:

            $

            <span id="checkout-total">
                0.00
            </span>

        </p>

        <form id="form-pago">

            <div class="grupo-input">

                <label>
                    Nombre en la tarjeta
                </label>

                <input
                    type="text"
                    required
                >

            </div>

            <div class="grupo-input">

                <label>
                    Número de tarjeta
                </label>

                <input
                    type="text"
                    maxlength="16"
                    required
                >

            </div>

            <div class="fila-inputs">

                <div class="grupo-input">

                    <label>
                        Vencimiento
                    </label>

                    <input
                        type="text"
                        placeholder="MM/AA"
                        required
                    >

                </div>

                <div class="grupo-input">

                    <label>
                        CVV
                    </label>

                    <input
                        type="password"
                        maxlength="3"
                        required
                    >

                </div>

            </div>

            <button
                type="submit"
                class="btn-confirmar-pago"
                id="btn-procesar"
            >
                Pagar Ahora
            </button>

        </form>

    </div>

</div>

<script src="./js/main.js"></script>

</body>

</html>