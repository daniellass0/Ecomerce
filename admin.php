<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Panel de Administración | TechStore</title>

    <link rel="stylesheet" href="./css/styles.css">

    <style>

        body{
            background:#f4f6f9;
        }

        .admin-container{
            max-width:1000px;
            margin:2rem auto;
            background:white;
            padding:2rem;
            border-radius:15px;
            box-shadow:0 10px 25px rgba(0,0,0,.08);
        }

        .form-admin{
            display:flex;
            flex-direction:column;
            gap:1rem;
        }

        .form-admin input,
        .form-admin textarea,
        .form-admin select{
            padding:.8rem;
            border:1px solid #ccc;
            border-radius:8px;
            width:100%;
        }

        .btn-guardar{
            background:#27ae60;
            color:white;
            border:none;
            padding:1rem;
            border-radius:8px;
            cursor:pointer;
            font-weight:bold;
        }

        .btn-guardar:hover{
            background:#219653;
        }

        .dashboard-cards{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
            gap:1rem;
            margin-bottom:2rem;
        }

        .card-admin{
            background:#f8f9fa;
            border-radius:12px;
            padding:1.5rem;
            text-align:center;
            border:1px solid #eee;
        }

        .card-admin p{
            font-size:1.7rem;
            font-weight:bold;
            color:#007bff;
        }

        .btn-logout{
            background:#e74c3c;
            color:white;
            border:none;
            padding:.8rem 1.2rem;
            border-radius:8px;
            cursor:pointer;
            font-weight:bold;
        }

        .btn-logout:hover{
            background:#c0392b;
        }

        .tabla-admin{
            width:100%;
            border-collapse:collapse;
            margin-top:1rem;
        }

        .tabla-admin th{
            background:#282c34;
            color:white;
            padding:.8rem;
        }

        .tabla-admin td{
            padding:.8rem;
            border-bottom:1px solid #ddd;
            text-align:center;
        }

        .volver-tienda{
            display:block;
            text-align:center;
            margin-top:1.5rem;
            color:#007bff;
            text-decoration:none;
            font-weight:bold;
        }

    </style>

</head>

<body>

<header>

    <nav class="navbar">

        <div class="logo">

            <h1>⚙️ Admin TechStore</h1>

            <p style="font-size:14px;color:#ddd;">
                Bienvenido, <?php echo $_SESSION['admin']; ?>
            </p>

        </div>

        <button
            onclick="window.location.href='logout.php'"
            class="btn-logout"
        >
            🚪 Cerrar Sesión
        </button>

    </nav>

</header>

<main class="admin-container">

    <div class="dashboard-cards">

        <div class="card-admin">
            <h3>📦 Productos</h3>
            <p id="total-productos">0</p>
        </div>

        <div class="card-admin">
            <h3>🏷️ Categorías</h3>
            <p>4</p>
        </div>

        <div class="card-admin">
            <h3>👤 Usuario</h3>
            <p><?php echo $_SESSION['admin']; ?></p>
        </div>

    </div>

    <h2>Crear Nuevo Producto</h2>

    <p style="margin-bottom:1.5rem;color:#666;">
        Agrega nuevos productos al catálogo.
    </p>

    <form id="form-nuevo-producto" class="form-admin">

        <div>
            <label>Nombre del Producto</label>
            <input
                type="text"
                id="admin-nombre"
                required
                placeholder="Ej. Teclado Mecánico RGB"
            >
        </div>

        <div>
            <label>Descripción</label>
            <textarea
                id="admin-descripcion"
                rows="3"
                required
                placeholder="Características principales..."
            ></textarea>
        </div>

        <div style="display:flex;gap:1rem;">

            <div style="flex:1;">
                <label>Precio ($)</label>
                <input
                    type="number"
                    id="admin-precio"
                    step="0.01"
                    required
                >
            </div>

            <div style="flex:1;">
                <label>Categoría</label>

                <select
                    id="admin-categoria"
                    required
                >
                    <option value="Laptops">Laptops</option>
                    <option value="Smartphones">Smartphones</option>
                    <option value="Componentes">Componentes</option>
                    <option value="Periféricos">Periféricos</option>
                </select>

            </div>

        </div>

        <button
            type="submit"
            class="btn-guardar"
        >
            💾 Guardar Producto
        </button>

    </form>

    <hr style="margin:2rem 0;">

    <h2>📋 Productos Registrados</h2>

    <table class="tabla-admin">

        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Categoría</th>
            </tr>
        </thead>

        <tbody id="lista-productos-admin">

            <tr>
                <td colspan="4">
                    Cargando productos...
                </td>
            </tr>

        </tbody>

    </table>

    <a
        href="index.php"
        class="volver-tienda"
    >
        ← Volver a la tienda pública
    </a>

</main>

<script src="./js/admin.js"></script>

</body>
</html>