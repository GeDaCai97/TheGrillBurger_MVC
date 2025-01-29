(function () {
    let total = 0;
    let articulosCombo = [];
    const comboResumen = document.querySelector('#combo-registro-resumen');
    if (comboResumen) {
        const articulosBoton = document.querySelectorAll('.articulo-menu__agregar');
        const totalContenedor = document.querySelector('#total');

        //extras disabled
        const extrasDisabled = document.querySelectorAll('.articulo-menu__extra');
        extrasDisabled.forEach(extra => extra.classList.add('articulo-menu__extra--disabled'));
        

        articulosBoton.forEach(boton => boton.addEventListener('click', agregarArticulo));
        //const formularioActualizarcombo = document.querySelector('#actualizar-combo');
        // formularioActualizarcombo.addEventListener('submit', );
        mostrarArticulos();
        calcularTotal();
        function agregarArticulo(e) {
            e.target.disabled = true;
            articulosCombo = [...articulosCombo, {
                id: e.target.dataset.id,
                titulo: e.target.parentElement.parentElement.querySelector('.articulo-menu__nombre').textContent.trim(),
                cantidad: e.target.parentElement.querySelector('.formulario-articulo__input').value,
                precio: e.target.parentElement.parentElement.querySelector('.articulo-menu__precio').textContent.trim()
            }];
            console.log(articulosCombo);
            mostrarArticulos();
        }
        function mostrarArticulos() {
            //LIMPIAR HTML
            limpiarArticulos();
            calcularTotal();
            if(articulosCombo.length > 0) {
                
                articulosCombo.forEach(articulo => {
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
                    comboResumen.appendChild(articuloDOM);
                    
                })
            } else {
                const noArticulos = document.createElement('P');
                noArticulos.classList.add('articulo-menu__descripcion');
                noArticulos.textContent = "No hay Artículos Seleccionados"
                comboResumen.appendChild(noArticulos);
            }
            
        }
        function calcularTotal() {
            total = 0;
            articulosCombo.forEach(articulo => {
                total = (+total + (+articulo.precio * articulo.cantidad));
            });
            totalContenedor.textContent = 'Total: ' + total;
        }
        function eliminarArticulo(id) {
            articulosCombo = articulosCombo.filter(articulo => articulo.id !== id);
            const botonAgregar = document.querySelector(`[data-id="${id}"]`);
            botonAgregar.disabled = false;
            mostrarArticulos();
        }
        function limpiarArticulos() {
            while(comboResumen.firstChild) {
                comboResumen.removeChild(comboResumen.firstChild);
            }
        }
        
    }
})();