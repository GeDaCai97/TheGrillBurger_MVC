import Swal from "sweetalert2";
(function() {
    const btnEliminar = document.querySelectorAll('#registrado__eliminar');
    btnEliminar.forEach(boton => boton.addEventListener('click', alertaEliminar));
    function alertaEliminar(e) {
        e.preventDefault();
        const id = e.target.dataset.id;
        Swal.fire( {
            title: '¿Estás seguro?',
            text: 'Esta acción no se puede deshacer',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'No, regresar'
        }).then(result => {
            if (result.isConfirmed) {
                eliminarUsuario(id);
            } 
        });
    }
    async function eliminarUsuario(id) {
        const datos = new FormData();
        datos.append('id', id);
        const url = '/administrador/registrados/eliminar';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });
        const resultado = await respuesta.json();
        if(resultado.resultado) {
            Swal.fire({
                title: resultado.mensaje,
                text: 'Tu registro se eliminará de forma permanente',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then( () => location.reload());
        } else {
            Swal.fire({
                title: resultado.mensaje,
                text: 'Tu registro no se eliminará',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then( () => location.reload());
        }
    }
})();