import Swal from "sweetalert2";
(function() {
    const bloqueadoInfo = document.querySelector('#bloqueado-info');
    if(bloqueadoInfo) {
        bloqueadoInfo.addEventListener('click', mostrarModal);

        function mostrarModal() {
            Swal.fire({
                title: '¿Estás bloqueado?',
                text: 'Si estás bloqueado, no podrás generar ningun pedido',
                icon: 'warning',
                showCancelButton: false,
                confirmButtonText: 'OK'
            })
        }
    }
})();