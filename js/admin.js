// ==========================================
// ADMIN.JS - TECHSTORE
// ==========================================

// Al cargar la página
document.addEventListener('DOMContentLoaded', () => {

    cargarProductosAdmin();

});


// ==========================================
// CREAR PRODUCTO
// ==========================================

document.getElementById('form-nuevo-producto')
.addEventListener('submit', async function(event) {

    event.preventDefault();

    const nuevoProducto = {

        nombre: document.getElementById('admin-nombre').value,

        descripcion: document.getElementById('admin-descripcion').value,

        precio: parseFloat(
            document.getElementById('admin-precio').value
        ),

        categoria: document.getElementById('admin-categoria').value

    };

    try {

        const respuesta = await fetch(
            './backend/crearProducto.php',
            {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(nuevoProducto)
            }
        );

        const resultado = await respuesta.json();

        if (resultado.status === 'success') {

            alert('✅ Producto agregado correctamente');

            document
                .getElementById('form-nuevo-producto')
                .reset();

            cargarProductosAdmin();

        } else {

            alert('❌ ' + resultado.mensaje);

        }

    } catch (error) {

        console.error(error);

        alert('❌ Error al conectar con el servidor');

    }

});


// ==========================================
// CARGAR PRODUCTOS
// ==========================================

async function cargarProductosAdmin() {

    try {

        const respuesta = await fetch(
            './backend/getProductos.php'
        );

        const productos = await respuesta.json();

        actualizarContador(productos);

        renderizarTabla(productos);

    } catch (error) {

        console.error(error);

    }

}


// ==========================================
// ACTUALIZAR CONTADOR
// ==========================================

function actualizarContador(productos) {

    const contador =
        document.getElementById('total-productos');

    contador.textContent = productos.length;

}


// ==========================================
// RENDERIZAR TABLA
// ==========================================

function renderizarTabla(productos) {

    const tbody =
        document.getElementById(
            'lista-productos-admin'
        );

    tbody.innerHTML = '';

    if (productos.length === 0) {

        tbody.innerHTML = `
            <tr>
                <td colspan="4">
                    No hay productos registrados
                </td>
            </tr>
        `;

        return;

    }

    productos.forEach(producto => {

        tbody.innerHTML += `

            <tr>

                <td>
                    ${producto.id}
                </td>

                <td>
                    ${producto.nombre}
                </td>

                <td>
                    $${producto.precio}
                </td>

                <td>
                    ${producto.categoria}
                </td>

            </tr>

        `;

    });

}