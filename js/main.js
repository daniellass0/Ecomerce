// Ruta: /js/main.js

// ==========================================
// 1. VARIABLES GLOBALES
// ==========================================

let catalogoGlobal = [];

let carrito = JSON.parse(localStorage.getItem('carrito')) || [];


// ==========================================
// 2. AL CARGAR LA PÁGINA
// ==========================================

document.addEventListener('DOMContentLoaded', () => {

    cargarCategorias();

    cargarProductos();

    actualizarContadorCarrito();

    const formularioPago = document.getElementById('form-pago');

    if (formularioPago) {
        formularioPago.addEventListener('submit', simularTransaccion);
    }

    // BUSCADOR
    document.getElementById('buscador-productos').addEventListener('input', (e) => {

        const termino = e.target.value.toLowerCase().trim();

        if (termino === '') {

            renderizarProductos(catalogoGlobal);

        } else {

            const filtrados = catalogoGlobal.filter(p =>
                p.nombre.toLowerCase().includes(termino) ||
                p.descripcion.toLowerCase().includes(termino) ||
                p.categoria.toLowerCase().includes(termino)
            );

            renderizarProductos(filtrados);

        }

    });

});


// ==========================================
// 3. CARGAR PRODUCTOS DESDE PHP
// ==========================================

async function cargarProductos() {

    try {

        const respuesta = await fetch('./backend/getProductos.php');

        if (!respuesta.ok) {
            throw new Error('Error al conectar con el servidor');
        }

        catalogoGlobal = await respuesta.json();

        renderizarProductos(catalogoGlobal);

    } catch (error) {

        console.error('Error:', error);

        document.getElementById('contenedor-productos').innerHTML = `
            <p>Hubo un problema al cargar el catálogo de tecnología.</p>
        `;
    }
}


// ==========================================
// 4. CARGAR CATEGORÍAS DESDE PHP
// ==========================================

async function cargarCategorias() {

    try {

        const respuesta = await fetch('./backend/getCategorias.php');

        const categorias = await respuesta.json();

        const contenedorCategorias = document.getElementById('contenedor-categorias');

        contenedorCategorias.innerHTML = '';

        contenedorCategorias.innerHTML += `
            <button class="btn-filtro activo" onclick="filtrarProductos('Todos')">Todos</button>
        `;

        categorias.forEach(cat => {
            contenedorCategorias.innerHTML += `
                <button class="btn-filtro" onclick="filtrarProductos('${cat.nombre}')">${cat.nombre}</button>
            `;
        });

    } catch (error) {

        console.error('Error al cargar categorías:', error);

    }

}


// ==========================================
// 5. FORMATO PESOS COLOMBIANOS
// ==========================================

function formatCOP(valor) {
    return Number(valor).toLocaleString('es-CO', {
        style: 'currency',
        currency: 'COP',
        minimumFractionDigits: 0
    });
}


// ==========================================
// 6. RENDERIZAR PRODUCTOS
// ==========================================

function renderizarProductos(productos) {

    const contenedor = document.getElementById('contenedor-productos');

    contenedor.innerHTML = '';

    if (productos.length === 0) {

        contenedor.innerHTML = `
            <p style="
                text-align: center;
                padding: 3rem;
                color: #6b7280;
                font-size: 1.1rem;
                grid-column: 1 / -1;
            ">
                😔 No se encontraron productos.
            </p>
        `;

        return;

    }

    productos.forEach(producto => {

        const tarjeta = document.createElement('div');

        tarjeta.classList.add('tarjeta-producto');

        tarjeta.innerHTML = `
            <div class="imagen-producto">
                <img
                    src="${producto.imagen}"
                    alt="${producto.nombre}"
                    onerror="this.src='https://images.unsplash.com/photo-1518770660439-4636190af475?w=400'"
                >
            </div>

            <h3>${producto.nombre}</h3>

            <div class="rating">
                ⭐⭐⭐⭐⭐
            </div>

            <p class="descripcion">
                ${producto.descripcion}
            </p>

            <p class="precio">
                ${formatCOP(producto.precio)}
            </p>

            <button
                class="btn-agregar"
                onclick="agregarAlCarrito(${producto.id})"
            >
                Agregar al Carrito
            </button>
        `;

        contenedor.appendChild(tarjeta);

    });

}


// ==========================================
// 7. AGREGAR AL CARRITO
// ==========================================

function agregarAlCarrito(id) {

    const productoSeleccionado = catalogoGlobal.find(
        producto => producto.id === id
    );

    const productoExistente = carrito.find(
        item => item.id === id
    );

    if (productoExistente) {

        productoExistente.cantidad++;

    } else {

        carrito.push({
            ...productoSeleccionado,
            cantidad: 1
        });

    }

    localStorage.setItem(
        'carrito',
        JSON.stringify(carrito)
    );

    actualizarContadorCarrito();

    alert(`✅ ${productoSeleccionado.nombre} agregado al carrito`);

}


// ==========================================
// 8. CONTADOR DEL CARRITO
// ==========================================

function actualizarContadorCarrito() {

    const contadorHTML = document.getElementById('cart-count');

    const totalArticulos = carrito.reduce(
        (total, item) => total + item.cantidad,
        0
    );

    contadorHTML.innerText = totalArticulos;

}


// ==========================================
// 9. ABRIR Y CERRAR CARRITO
// ==========================================

function abrirCarrito() {

    const modal = document.getElementById('modal-carrito');

    modal.classList.remove('modal-oculto');

    modal.classList.add('modal-activo');

    renderizarCarrito();

}


function cerrarCarrito() {

    const modal = document.getElementById('modal-carrito');

    modal.classList.remove('modal-activo');

    modal.classList.add('modal-oculto');

}


// ==========================================
// 10. RENDERIZAR CARRITO
// ==========================================

function renderizarCarrito() {

    const contenedor = document.getElementById('items-carrito');

    const textoTotal = document.getElementById('precio-total');

    contenedor.innerHTML = '';

    let totalPrecio = 0;

    if (carrito.length === 0) {

        contenedor.innerHTML = `
            <p style="
                text-align: center;
                padding: 2rem 0;
                color: #888;
            ">
                Tu carrito está vacío 🛒
            </p>
        `;

    } else {

        carrito.forEach(item => {

            totalPrecio += item.precio * item.cantidad;

            contenedor.innerHTML += `
                <div class="item-carrito">

                    <div class="item-info">
                        <h4>${item.nombre}</h4>

                        <p>
                            ${formatCOP(item.precio)}
                            x
                            ${item.cantidad} unidad(es)
                        </p>
                    </div>

                    <button
                        class="btn-eliminar"
                        onclick="eliminarDelCarrito(${item.id})"
                    >
                        🗑️ Quitar
                    </button>

                </div>
            `;

        });

    }

    textoTotal.innerText = formatCOP(totalPrecio);

}


// ==========================================
// 11. ELIMINAR PRODUCTOS
// ==========================================

function eliminarDelCarrito(id) {

    carrito = carrito.filter(
        item => item.id !== id
    );

    localStorage.setItem(
        'carrito',
        JSON.stringify(carrito)
    );

    actualizarContadorCarrito();

    renderizarCarrito();

}


// ==========================================
// 12. FILTRAR POR CATEGORÍA
// ==========================================

function filtrarProductos(categoriaStr) {

    const botones = document.querySelectorAll('.btn-filtro');

    botones.forEach(btn => {
        btn.classList.remove('activo');
    });

    event.target.classList.add('activo');

    document.getElementById('buscador-productos').value = '';

    if (categoriaStr === 'Todos') {

        renderizarProductos(catalogoGlobal);

    } else {

        const productosFiltrados = catalogoGlobal.filter(
            producto => producto.categoria === categoriaStr
        );

        renderizarProductos(productosFiltrados);

    }

}


// ==========================================
// 13. PROCESAR PAGO
// ==========================================

function procesarPago() {

    if (carrito.length === 0) {

        alert('❌ Tu carrito está vacío');

        return;

    }

    cerrarCarrito();

    const totalPrecio = carrito.reduce(
        (total, item) => total + (item.precio * item.cantidad),
        0
    );

    document.getElementById('checkout-total').innerText = formatCOP(totalPrecio);

    const modalPago = document.getElementById('modal-pago');

    modalPago.classList.remove('modal-oculto');

    modalPago.classList.add('modal-activo');

}


// ==========================================
// 14. CERRAR PAGO
// ==========================================

function cerrarPago() {

    const modalPago = document.getElementById('modal-pago');

    modalPago.classList.remove('modal-activo');

    modalPago.classList.add('modal-oculto');

    document.getElementById('form-pago').reset();

}


// ==========================================
// 15. SIMULAR TRANSACCIÓN
// ==========================================

function simularTransaccion(event) {

    event.preventDefault();

    const btnProcesar = document.getElementById('btn-procesar');

    btnProcesar.disabled = true;

    btnProcesar.innerText = 'Procesando pago... ⏳';

    btnProcesar.classList.add('btn-cargando');

    setTimeout(() => {

        carrito = [];

        localStorage.removeItem('carrito');

        actualizarContadorCarrito();

        renderizarCarrito();

        cerrarPago();

        cerrarCarrito();

        btnProcesar.disabled = false;

        btnProcesar.innerText = 'Pagar Ahora';

        btnProcesar.classList.remove('btn-cargando');

        alert(`
✅ ¡Pago aprobado correctamente!

Gracias por comprar en TechStore 🚀
Tu pedido está siendo preparado.
        `);

    }, 2500);

}