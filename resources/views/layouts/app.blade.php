<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Reset y estilos base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8f9fa;
            color: rgba(18, 33, 61, 0.9);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Navbar principal */
        .main-navbar {
            background: linear-gradient(135deg, rgba(18, 33, 61, 1) 0%, rgba(28, 43, 71, 1) 50%, rgba(38, 53, 81, 1) 100%);
            box-shadow: 0 4px 20px rgba(18, 33, 61, 0.3);
            padding: 0.5rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .main-navbar .navbar-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        
        .logo-container {
            display: flex;
            align-items: justify-content:start;
            text-decoration: none;
            transition: transform 0.3s ease;
        }
        
        .logo-container:hover {
            transform: scale(1.02);
        }
        
        .logo-container img {
            height: 60px;
            width: 60px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        
        .brand-text {
            margin-left: 15px;
            color: rgba(246, 253, 254, 1);
        }
        
        .brand-text .brand-name {
            font-size: 1.4rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .brand-text .brand-slogan {
            font-size: 0.75rem;
            opacity: 0.9;
            font-weight: 300;
        }
        
        .user-welcome {
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 16px;
            border-radius: 25px;
            margin-left: 20px;
            backdrop-filter: blur(5px);
        }
        
        .user-welcome span {
            color: rgba(246, 253, 254, 1);
            font-weight: 500;
            font-size: 0.9rem;
        }
        
        /* Menú de navegación */
        .nav-menu {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .nav-item {
            position: relative;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 10px 18px !important;
            border-radius: 25px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .nav-link:hover,
        .nav-link.active {
            color: rgba(246, 253, 254, 1) !important;
            background: rgba(217, 140, 82, 0.3);
            transform: translateY(-2px);
        }
        
        .nav-link i {
            font-size: 1.1rem;
        }
        
        /* Dropdown styles */
        .dropdown-menu {
            background: rgba(18, 33, 61, 0.98);
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            padding: 10px;
            margin-top: 10px;
            min-width: 200px;
            backdrop-filter: blur(10px);
            animation: dropdownFadeIn 0.3s ease;
        }
        
        @keyframes dropdownFadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .dropdown-menu .dropdown-item {
            color: rgba(255, 255, 255, 0.9);
            padding: 12px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .dropdown-menu .dropdown-item:hover,
        .dropdown-menu .dropdown-item.active {
            background: rgba(217, 140, 82, 1);
            color: rgba(246, 253, 254, 1);
            transform: translateX(5px);
        }
        
        /* Carrito */
        .cart-link {
            position: relative;
            padding: 10px 15px !important;
        }
        
        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: linear-gradient(135deg, rgba(217, 140, 82, 1), rgba(237, 160, 102, 1));
            color: rgba(18, 33, 61, 1);
            font-size: 0.75rem;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(217, 140, 82, 0.5);
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        /* Botón de búsqueda */
        .search-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: rgba(246, 253, 254, 1);
            border-radius: 25px;
            padding: 8px 20px;
            transition: all 0.3s ease;
        }
        
        .search-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(217, 140, 82, 1);
            color: rgba(217, 140, 82, 1);
        }
        
        /* Navbar toggler */
        .navbar-toggler {
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            padding: 8px 12px;
            transition: all 0.3s ease;
        }
        
        .navbar-toggler:hover {
            border-color: rgba(217, 140, 82, 1);
            background: rgba(217, 140, 82, 0.2);
        }
        
        .navbar-toggler-icon {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 5px;
        }
        
        .navbar-toggler-icon span {
            display: block;
            width: 25px;
            height: 3px;
            background: rgba(217, 140, 82, 1);
            border-radius: 2px;
            transition: all 0.3s ease;
        }
        
        /* Footer */
        .main-footer {
            background: linear-gradient(135deg, rgba(18, 33, 61, 1) 0%, rgba(28, 43, 71, 1) 100%);
            color: rgba(246, 253, 254, 1);
            padding: 50px 0 20px;
            margin-top: auto;
        }
        
        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        
        .footer-section {
            margin-bottom: 30px;
        }
        
        .footer-section h5 {
            color: rgba(217, 140, 82, 1);
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 1.1rem;
            position: relative;
            padding-bottom: 10px;
        }
        
        .footer-section h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background: rgba(217, 140, 82, 1);
        }
        
        .footer-section p,
        .footer-section a {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
            line-height: 1.8;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-section a:hover {
            color: rgba(217, 140, 82, 1);
            padding-left: 5px;
        }
        
        .footer-social {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .footer-social a {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .footer-social a:hover {
            background: rgba(217, 140, 82, 1);
            transform: translateY(-3px);
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            margin-top: 30px;
            text-align: center;
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        /* Contenido principal */
        .main-content {
            flex: 1;
            padding: 30px 0;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }
        
        /* Responsive */
        @media (max-width: 991.98px) {
            .main-navbar .navbar-collapse {
                background: rgba(18, 33, 61, 0.95);
                border-radius: 15px;
                padding: 20px;
                margin-top: 15px;
                backdrop-filter: blur(10px);
            }
            
            .nav-menu {
                flex-direction: column;
                align-items: stretch;
            }
            
            .nav-link {
                justify-content: center;
                margin: 5px 0;
            }
            
            .user-welcome {
                margin: 15px 0;
                text-align: center;
            }
            
            .brand-text .brand-slogan {
                display: none;
            }
            
            .footer-section {
                text-align: center;
            }
            
            .footer-section h5::after {
                left: 50%;
                transform: translateX(-50%);
            }
            
            .footer-social {
                justify-content: center;
            }
        }
        
        @media (max-width: 576px) {
            .logo-container img {
                height: 50px;
                width: 50px;
            }
            
            .brand-text .brand-name {
                font-size: 1.1rem;
            }
            
            .nav-link {
                padding: 12px 15px !important;
                font-size: 0.95rem;
            }
        }
    </style>

</head>

<body>
    <!-- Navbar Principal -->
    <nav class="navbar navbar-expand-lg main-navbar">
        <div class="navbar-container">
            <!-- Logo y Marca -->
            <a href="{{ url('/pedidos') }}" class="logo-container">
                <img src="{{ asset('imagenes/logo.jpg') }}" alt="Logo" >
                <div class="brand-text">
                    <div class="brand-name">FERRYCOLORES RH</div>
                </div>
                @auth
                    <div class="user-welcome">
                        <span><i class="fas fa-user"></i> Bienvenid@ {{ Auth::user()->name }}</span>
                    </div>
                @endauth
            </a>

            <!-- Botón toggler para móvil -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>

            <!-- Menú de navegación -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-menu ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                                <i class="fas fa-home"></i> Inicio
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProductos" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-box"></i> Productos
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownProductos">
                                <li><a class="dropdown-item" href="{{ route('categorias.producto', 4) }}"><i class="fas fa-tools"></i> Ferretería</a></li>
                                <li><a class="dropdown-item" href="{{ route('categorias.producto', 3) }}"><i class="fas fa-umbrella-beach"></i> Material de playa</a></li>
                                <li><a class="dropdown-item" href="{{ route('categorias.producto', 2) }}"><i class="fas fa-box-open"></i> Otros</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link cart-link" href="{{ route('carrito.index') }}">
                                <i class="fas fa-shopping-cart"></i>
                                <span id="contador-carrito" class="cart-badge">0</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('login*') ? 'active' : '' }}" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                            </a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('productos*') ? 'active' : '' }}" href="{{ route('productos.index') }}">
                                <i class="fas fa-boxes"></i> Productos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('categorias*') ? 'active' : '' }}" href="{{ route('categorias.index') }}">
                                <i class="fas fa-tags"></i> Categorías
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle{{ request()->is('pedidos*') ? ' active' : '' }}"
                                href="#" id="navbarDropdownPedidos" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-list-ul"></i> <i class="fas fa-clipboard-list"></i> Pedidos
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownPedidos">
                                <li>
                                    <a class="dropdown-item{{ request()->is('pedidos') && !request()->is('pedidos/historial') ? ' active' : '' }}"
                                        href="{{ url('/pedidos') }}">
                                        <i class="fas fa-clock"></i> Pedidos pendientes
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item{{ request()->is('pedidos/historial') ? ' active' : '' }}"
                                        href="{{ url('/pedidos/historial') }}">
                                        <i class="fas fa-history"></i> Historial de pedidos
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle{{ request()->is('usuarios*') || request()->is('register*') ? ' active' : '' }}"
                                href="#" id="navbarDropdownUsuarios" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fas fa-users-cog"></i> Usuarios
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownUsuarios">
                                <li>
                                    <a class="dropdown-item{{ request()->is('usuarios') ? ' active' : '' }}"
                                        href="{{ route('usuarios.index') }}">
                                        <i class="fas fa-list-ul"></i> Ver Usuarios
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item{{ request()->is('register*') ? ' active' : '' }}"
                                        href="{{ route('register') }}">
                                        <i class="fas fa-user-plus"></i> Registrar Usuario
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                            </a>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="footer-content">
            <div class="row">
                <div class="col-lg-4 col-md-6 footer-section">
                    <h5><i class="fas fa-store"></i> Sobre Nosotros</h5>
                    <p>FERRYCOLORES RH es tu tienda de confianza para productos de ferretería y materiales de playa. Nos comprometemos a ofrecer productos de calidad con el mejor servicio.</p>
                    <div class="footer-social">
                        <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 footer-section">
                    <h5><i class="fas fa-link"></i> Enlaces Rápidos</h5>
                    <p><a href="{{ url('/') }}"><i class="fas fa-chevron-right"></i> Inicio</a></p>
                    <p><a href="{{ route('categorias.producto', 4) }}"><i class="fas fa-chevron-right"></i> Ferretería</a></p>
                    <p><a href="{{ route('categorias.producto', 2) }}"><i class="fas fa-chevron-right"></i> Material de playa</a></p>
                    <p><a href="{{ route('carrito.index') }}"><i class="fas fa-chevron-right"></i> Carrito</a></p>
                </div>
                <div class="col-lg-4 col-md-12 footer-section">
                    <h5><i class="fas fa-contact-book"></i> Contacto</h5>
                    <p><i class="fas fa-map-marker-alt"></i>El Retiro, Antioquia, Colombia</p>
                    <p><i class="fas fa-envelope"></i> ferrycoloresrh@gmail.con</p>
                     <a href="https://api.whatsapp.com/send?phone=573104393143&text=Hola%20%F0%9F%91%8B%20Ferrycolores RH" target="_blank"><i class="fab fa-whatsapp"></i> whatsapp 3104393143</a>
                    <p><i class="fas fa-clock"></i> Lun - Vie: 8:00 AM - 6:00 PM</p>
                    <p><i class="fas fa-clock"></i> Sab: 8:00 AM - 12:30 PM</p>
                </div>
            </div>
            
        </div>
        <div class="footer-bottom">
                <p><i class="fas fa-copyright"></i> {{ date('Y') }} FERRYCOLORES RH. Todos los derechos reservados.</p>
            </div>
    </footer>

    <script>
        function actualizarContadorCarrito() {
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            let total = carrito.reduce((sum, prod) => sum + prod.cantidad, 0);
            let badge = document.getElementById('contador-carrito');
            if (badge) {
                badge.textContent = total;
            }
        }

        // Actualiza al cargar la página
        document.addEventListener('DOMContentLoaded', actualizarContadorCarrito);

        // Permite que otras vistas lo llamen después de agregar productos
        window.actualizarContadorCarrito = actualizarContadorCarrito;
    </script>
</body>

</html>
