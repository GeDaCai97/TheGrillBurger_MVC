<main class="nosotros">
    <h2 class="nosotros__heading">Sobre Nosotros</h2>
    <div class="nosotros__grid">
        <div class="nosotros__imagen">
            <picture>
                <source srcset="<?php echo $_ENV['HOST'] . '/build/img/banner2'; ?>.avif" type="image/avif">
                <source srcset="<?php echo $_ENV['HOST'] . '/build/img/banner2'; ?>.webp" type="image/webp">
                <img src="<?php echo $_ENV['HOST'] . '/build/img/banner2'; ?>.png" alt="Imagen Articulo">
            </picture>
        </div>
        <div class="nosotros__contenido">
            <p class="nosotros__texto">
                En The Grill Burger House nos empeñamos en brindar la mejor experiencia a nuestros clientes, contando con nuestros deliciosos platillos completamente caseros. Invitamos a los usuarios a que nos visiten en nuestro establecimiento.
                Contamos con diferentes servicios incluyendo esta plataforma digital para mayor comodidad hacia nuestros clientes.
            </p>
        </div>
    </div>
</main>