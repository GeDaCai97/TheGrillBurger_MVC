import Swal from "sweetalert2";
(function() {
    let total = 0;
    let articulos = [];
    const pedidoResumen = document.querySelector('#pedido-registro-resumen');
    if(pedidoResumen) {
        const articulosBoton = document.querySelectorAll('.articulo-menu__agregar');
        const totalContenedor = document.querySelector('#total');
        articulosBoton.forEach(boton => boton.addEventListener('click', agregarArticulo));
        const formularioCrearpedido = document.querySelector('#crear-pedido');
        formularioCrearpedido.addEventListener('submit', submitFormulario);
        mostrarArticulos();
        calcularTotal();
        function agregarArticulo(e) {
            e.target.disabled = true;
            articulos = [...articulos, {
                id: e.target.dataset.id,
                titulo: e.target.parentElement.parentElement.querySelector('.articulo-menu__nombre').textContent.trim(),
                cantidad: e.target.parentElement.querySelector('.formulario-articulo__input').value,
                precio: e.target.parentElement.parentElement.querySelector('.articulo-menu__precio').textContent.trim()
            }];
            mostrarArticulos();
        }
        function mostrarArticulos() {
            //LIMPIAR HTML
            limpiarArticulos();
            calcularTotal();
            if(articulos.length > 0) {
                
                articulos.forEach(articulo => {
                    const articuloDOM = document.createElement('DIV');
                    articuloDOM.classList.add('articulo-menu--agregado');
                    const titulo = document.createElement('H4');
                    titulo.classList.add('articulo-menu__nombre');
                    titulo.textContent = articulo.titulo;
                    const contenedor = document.createElement('DIV');
                    contenedor.classList.add('articulo-menu__contenedor');
                    const cantidad = document.createElement('P');
                    cantidad.classList.add('articulo-menu__descripcion');
                    cantidad.textContent = "Cantidad: " + articulo.cantidad
                    const precio = document.createElement('P');
                    precio.classList.add('articulo-menu__precio--agregado');
                    let subtotal = articulo.precio * articulo.cantidad;
                    precio.textContent = "Subtotal: $" + (subtotal);
                    const botonEliminar = document.createElement('BUTTON');
                    botonEliminar.classList.add('articulo-menu__eliminar')
                    botonEliminar.innerHTML = '<i class="fa-solid fa-trash"></i>';
                    botonEliminar.onclick = function() {
                        eliminarArticulo(articulo.id);
                    }


                    
                    //renderizar el DOM
                    articuloDOM.appendChild(titulo);
                    contenedor.appendChild(cantidad);
                    contenedor.appendChild(precio);
                    contenedor.appendChild(botonEliminar);
                    articuloDOM.appendChild(contenedor);
                    pedidoResumen.appendChild(articuloDOM);
                    
                })
            } else {
                const noArticulos = document.createElement('P');
                noArticulos.classList.add('articulo-menu__descripcion');
                noArticulos.textContent = "No hay Artículos Seleccionados"
                pedidoResumen.appendChild(noArticulos);
            }
            
        }
        function calcularTotal() {
            total = 0;
            articulos.forEach(articulo => {
                total = (+total + (+articulo.precio * articulo.cantidad));
            });
            totalContenedor.textContent = 'Total: ' + total;
        }
        function eliminarArticulo(id) {
            articulos = articulos.filter(articulo => articulo.id !== id);
            const botonAgregar = document.querySelector(`[data-id="${id}"]`);
            botonAgregar.disabled = false;
            mostrarArticulos();
        }
        function limpiarArticulos() {
            while(pedidoResumen.firstChild) {
                pedidoResumen.removeChild(pedidoResumen.firstChild);
            }
        }
        async function submitFormulario(e) {
            e.preventDefault();
            //Obtener el comentario
            const comentario = document.querySelector('#comentario').value;
            const domicilio = document.querySelector('#domicilio').value;
            let hora = new Date().getHours();
            let minutos = new Date().getMinutes();
            let segundos = new Date().getSeconds();
            let tiempo = `${hora}:${minutos}:${segundos}`;
            

            //Tener al menos 1 articulo
            const articulosId = articulos.map(articulo => articulo.id);
            const cantidad = articulos.map(articulo => articulo.cantidad);
            if(articulosId.length === 0 || domicilio === '') {
                Swal.fire({
                    title: 'Error',
                    text: "Debes tener por lo menos 1 Artículo añadido y seleccionar el tipo de entrega.",
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
                return;
            }
            const datos = new FormData();
            datos.append('Articulos_id', articulosId);
            datos.append('cantidad', cantidad);
            datos.append('hora', tiempo);
            datos.append('comentario', comentario);
            datos.append('domicilio', domicilio);
            datos.append('precio_total', total);
            
            const url = '/crear-pedido';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            })
            const resultado = await respuesta.json();
            if(resultado.resultado) {
                Swal.fire({
                    title: 'Pedido Exitoso',
                    text: 'Tu Pedido se ha enviado correctamente',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then( () => location.reload());
            } else if(resultado.domicilio) {
                Swal.fire({
                    title: 'Error',
                    text: resultado.mensaje,
                    icon: 'error',
                    confirmButtonText: 'OK',
                    footer: '<a href="/perfil/domicilio">Añadir Domicilio</a>'
                })
            } else {
                Swal.fire({
                    title: 'Error',
                    text: resultado.mensaje,
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
            }
        }
    }
    
})();