document.getElementById('form-login').addEventListener('submit', async function(event) {

    event.preventDefault();

    const usuarioInput = document.getElementById('login-usuario').value;
    const passwordInput = document.getElementById('login-password').value;

    const mensajeError = document.getElementById('mensaje-error');

    mensajeError.style.display = 'none';

    try {

        const respuesta = await fetch('./backend/login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                usuario: usuarioInput,
                password: passwordInput
            })
        });

        const resultado = await respuesta.json();

        if (resultado.status === 'success') {

            window.location.href = 'admin.php';

        } else {

            mensajeError.style.display = 'block';

        }

    } catch (error) {

        console.error(error);

        alert('Error al conectar con el servidor');

    }

});