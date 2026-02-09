@extends('layouts.app')

@section('content')

@if(session('login_success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: '¡Bienvenido!',
                text: '{{ session('login_success') }}',
                timer: 2000,
                showConfirmButton: false,
            });
        });
    </script>
@endif


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">


    <style>
      .hero {
        background-image: url('https://dynamic-media-cdn.tripadvisor.com/media/photo-o/27/8e/d4/58/el-amor-es-nuestro-ingrediente.jpg?w=800&h=-1&s=1');
        background-size: cover;
        background-position: center;
        height: 70vh;
        color: rgba(246, 253, 254, 1);
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
      }
      .hero h1 {
        font-size: 4rem;
        font-weight: bold;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
      }
      .hero h2{
          font-size: 2rem;
          font-weight: 300;
          text-shadow: 1px 1px 5px rgba(0,0,0,0.5);
      }
      .btn-hero-cta {
          background-color: rgba(217, 140, 82, 1);
          border-color: rgba(217, 140, 82, 1);
          color: rgba(246, 253, 254, 1);
          font-weight: 600;
          border-radius: 50px;
          padding: 12px 30px;
          font-size: 1.2rem;
          margin-top: 20px;
          transition: all 0.3s ease;
          box-shadow: 0 5px 15px rgba(0,0,0,0.3);
      }
      .btn-hero-cta:hover {
          background-color: rgba(197, 120, 62, 1);
          border-color: rgba(197, 120, 62, 1);
          transform: translateY(-3px);
          box-shadow: 0 8px 20px rgba(0,0,0,0.4);
          color: rgba(246, 253, 254, 1);
      }
      .section-title {
        font-size: 2.5rem;
        margin-top: 40px;
      }
      .carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: #000;
    border-radius: 10%; 
}
footer {
    background: linear-gradient(90deg, rgba(18, 33, 61, 1), rgba(28, 43, 71, 1), rgba(18, 33, 61, 1));
    color: rgba(246, 253, 254, 1);
    padding: 20px 0 0 0; /* Menos padding arriba */
    text-align: center;
    font-family: 'Segoe UI', Arial, sans-serif;
    font-size: 0.98rem; /* Letra un poco más pequeña */
    letter-spacing: 0.01em;
}
.footer-content {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    gap: 40px; /* Menos espacio entre columnas */
    flex-wrap: wrap;
    padding-bottom: 5px; /* Menos padding abajo */
}
.footer-section {
    min-width: 180px;
    max-width: 260px;
    margin-bottom: 6px;
    text-align: left;
}
.footer-section h3 {
    font-size: 1.08rem;
    font-weight: 700;
    margin-bottom: 8px;
    color: rgba(217, 140, 82, 1);
    letter-spacing: 0.03em;
}
.footer-section p,
.footer-section a {
    font-size: 0.98rem;
    margin-bottom: 5px;
    color: rgba(246, 253, 254, 1);
    text-decoration: none;
    transition: color 0.2s;
    display: block;
    word-break: break-word;
}
.footer-section a:hover {
    color: rgba(217, 140, 82, 1);
    text-decoration: none;
}
.footer-bottom {
    margin-top: 10px;
    border-top: 1px solid #444;
    padding: 8px 0 5px 0;
    font-size: 0.93rem;
    color: #e0e0e0;
    letter-spacing: 0.02em;
}
@media (max-width: 900px) {
    .footer-content {
        flex-direction: column;
        align-items: center;
        gap: 0;
    }
    .footer-section {
        width: 90%;
        max-width: 400px;
        text-align: center;
    }
}
@media (max-width: 600px) {
    .footer-section {
        width: 100%;
        min-width: 0;
        max-width: 100%;
        padding: 0 6px;
    }
    .footer-content {
        gap: 0;
    }
}

.content{
    height: 50vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

}
.about{
    height: 100vh;
    background-color:#eefaf39c;
 }
 .p1{
    margin-bottom: 10px;
    font-size: 30px;
    color: rgb(0, 0, 0);
    -webkit-text-stroke: .30px rgb(0, 0, 0);
    justify-content: center;
    margin-left: 60px;
    margin-right: 60px
    
}
.title2 {
    font-size: 40px;
    font-weight: 400;
    text-transform: uppercase;
    color: rgba(18, 33, 61, 1);
    text-align: center;
}
.text-success{

    --bs-text-opacity: 1;
    color: rgba(18, 33, 61, 1) !important;
}

.py-5{
    padding-top: 5px !important;
    padding-bottom: 5px !important;
}
.mapa {
    width: 100%;
    display: flex;
    justify-content: center;
    padding: 15px 0;
    box-sizing: border-box;
}
.mapa .container {
    max-width: 1100px; /* igual que el resto de tu contenido */
    width: 100%;
    padding: 0 15px;
}
.mapa1 {
    width: 100%;
    height: 53vh;
    min-height: 320px;
    border-radius: 5px;
    border: none;
    display: block;
    margin: 0 auto;
    max-width: 100%;
}
@media (max-width: 900px) {
    .mapa .container {
        max-width: 98vw;
        padding: 0 5px;
    }
    .mapa1 {
        height: 40vh;
        min-height: 200px;
    }
}
@media (max-width: 600px) {
    .mapa {
        padding: 8px 0;
    }
    .mapa .container {
        padding: 0 2px;
    }
    .mapa1 {
        height: 200px;
        min-height: 120px;
    }
}
 #btn-ir-arriba {
    position: fixed;
    bottom: 40px;
    right: 40px;
    z-index: 999;
    background: linear-gradient(90deg, rgba(18, 33, 61, 1), rgba(28, 43, 71, 1), rgba(18, 33, 61, 1));
    color: rgba(246, 253, 254, 1);
    border: none;
    border-radius: 100px;
    padding: 14px 28px;
    font-size: 1.1rem;
    font-weight: bold;
    box-shadow: 0 4px 16px rgba(0,0,0,0.18);
    cursor: pointer;
    transition: background 0.3s, transform 0.2s, box-shadow 0.3s;
    display: none;
}
#btn-ir-arriba:hover {
    background: rgba(217, 140, 82, 1);
    color: rgba(246, 253, 254, 1);
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 8px 24px rgba(18, 33, 61, 0.25);
}
@media (max-width: 600px) {
    #btn-ir-arriba {
        right: 16px;
        bottom: 16px;
        padding: 10px 18px;
        font-size: 0.95rem;
    }
}



/* Imagen con efecto de escala al hacer hover */
.image-wrapper {
  overflow: hidden;
  border-radius: 5px;
  position: relative;
  box-shadow: 0 4px 8px rgba(5, 1, 1, 2.9);"
}

.image-wrapper img {
  transition: transform 0.5s ease;
}

.image-wrapper:hover img {
  transform: scale(1.05);
}

/* Overlay de texto sobre la imagen */
.image-overlay {
  position: absolute;
  bottom: 20px;
  right: 20px;
  background-color: linear-gradient(90deg, rgb(15, 46, 27), rgb(20, 65, 38), rgb(18, 56, 32));
  padding: 10px 20px;
  border-radius: 15px;
  opacity: 0;
  transition: 0.4s ease;
}

.image-wrapper:hover .image-overlay {
  opacity: 1;
}

/* Ajustes para animaciones de entrada */
.animate__animated {
  opacity: 0;
}

    .btn-hero-cta {
        background-color: rgba(217, 140, 82, 1);
        border-color: rgba(217, 140, 82, 1);
        color: rgba(246, 253, 254, 1);
        font-weight: 600;
        border-radius: 50px;
        padding: 10px 25px;
        font-size: 1.1rem;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        display: inline-flex;
        align-items: center;
        text-decoration: none;
    }
    .btn-hero-cta:hover {
        background-color: rgba(197, 120, 62, 1);
        border-color: rgba(197, 120, 62, 1);
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.3);
        color: rgba(246, 253, 254, 1);
    }
    .animate__fadeInUp {
  animation-name: fadeInUp;
  animation-duration: 1s;
  opacity: 1 !important;
}

</style>


</head>
<body>

    <div class="container mt-4">
          <h2 class="section-title text-center mb-2 mt-2 text-success">Te acompañamos en tus ideas y construcciones</h2>
          
          <div class="text-center mb-4">
              <a href="#pedido-express" class="btn btn-hero-cta animate__animated animate__fadeInUp">
                  <i class="fas fa-camera me-2"></i> Hacer Pedido con Foto
              </a>
          </div>

{{-- carrusel de imagenes --}}

    <div id="categoriasCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          @php
                $imagenes = [
                    'Postres' => 'https://0701.static.prezi.com/preview/v2/otksijunl3nhsozxhpzd4w3jnx6jc3sachvcdoaizecfr3dnitcq_3_0.png',
                    'Conservas' => 'https://www.farmaceuticosdesevilla.es/consejossaludables/wp-content/uploads/sites/3/2022/03/1450119467-fotolia_70795211_subscription_xxl.jpg',
                    
                    // Imágenes de hardware/ferretería
                    'otros' => 'https://images.unsplash.com/photo-1540822606822-261564aa712a?w=1200&h=600&fit=crop',
                    'Otros' => 'https://images.unsplash.com/photo-1540822606822-261564aa712a?w=1200&h=600&fit=crop',
                    
                    'ferretería' => 'https://images.unsplash.com/photo-1581235720704-06d3acfcb36f?w=1200&h=600&fit=crop',
                    'Ferretería' => 'https://images.unsplash.com/photo-1581235720704-06d3acfcb36f?w=1200&h=600&fit=crop',

                    'Material de playa' => 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?w=1200&h=600&fit=crop',
                    'material de playa' => 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?w=1200&h=600&fit=crop',
                ];
            @endphp



            @foreach ($categorias as $index => $categoria)
                <div class="carousel-item @if($index == 0) active @endif">
                    <div class="d-flex justify-content-center align-items-center flex-column" style="height: 500px;">

                        <img src="{{ $imagenes[$categoria->nombre] ?? 'https://via.placeholder.com' }}" class="" alt="{{ $categoria->nombre }}"
                        style="height: 400px; width:960px">

                        <h5 class="mt-3">{{ $categoria->descripcion }}</h5>

                        <a href="{{ route('categorias.producto', $categoria->id) }}" class="btn btn-outline-dark">
                            {{ $categoria->nombre }}
                        </a>
                    </div>
                </div>
            @endforeach

        </div>

      
        <button class="carousel-control-prev" type="button" data-bs-target="#categoriasCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#categoriasCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class=""></span>
        </button>
    </div>
   


</div>
<div class="container ">


<!-- Galería de Productos -->
<section class="py-5">
  <div class="container">
    <h2 class="section-title text-center text-success mt-2 ">Productos Importados</h2>
    <div class="row mt-4">
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
          <a href="#"><img src="https://images.unsplash.com/photo-1504148455328-c376907d081c?w=800&q=80" class="card-img-top" style="height: 250px; object-fit: cover;" alt="Taladro Percutor"></a>
          <div class="card-body">
            <h5 class="card-title">Taladros de Alta Potencia</h5>
            <p class="card-text">Perforación precisa en concreto y madera. Ideal para trabajos pesados y uso doméstico.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
          <a href="#"><img src="https://images.unsplash.com/photo-1530124566582-a618bc2615dc?w=800&q=80" class="card-img-top" style="height: 250px; object-fit: cover;" alt="Kit de Herramientas"></a>
          <div class="card-body">
            <h5 class="card-title">Kits de Herramientas</h5>
            <p class="card-text">Sets completos con llaves, destornilladores y más. Todo lo esencial en un solo maletín.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
           <a href="#"><img src="https://images.unsplash.com/photo-1572981779307-38b8cabb2407?w=800&q=80" class="card-img-top" style="height: 250px; object-fit: cover;" alt="Herramientas de Corte"></a>
          <div class="card-body">
            <h5 class="card-title">Sierras y Corte</h5>
            <p class="card-text">Sierras circulares y caladoras para cortes limpios y profesionales en cualquier material.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Historia -->
<!-- Historia con animación -->
<section class="py-5" style="background: white;">
  <div class="container">
    <div class="row align-items-center">
      <!-- Imagen decorativa -->
      <div class="col-md-6 mb-4 mb-md-0" data-aos="fade-right">
        <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/28/9b/f9/18/nuestra-tierra-antioquena.jpg?w=800&h=-1&s=1" 
             alt="Pasteles caseros" class="img-fluid rounded shadow-lg">
      </div>
      
      <!-- Texto de la historia -->
      <div class="col-md-6" data-aos="fade-left" data-aos-delay="200">
        <h2 class="fw-bold mb-3 text-success">Nuestra Historia</h2>
        <p class="lead" style="font-size: 1.1rem;">
          xxxx <strong>xx xxx</strong>, xxxxxxxxxxxxxxxxx
        </p>
        <p class="lead" style="font-size: 1.1rem;">
          xxxxx <strong>xxxx</strong>, xxxxx
        </p>
        <blockquote class="blockquote mt-4 text-muted" data-aos="fade-up" data-aos-delay="400">
          <p>“Listo servir dia a dia dia a dia.”</p>
        </blockquote>
      </div>
    </div>
  </div>

</section>

 
<section id="pedido-express" class="order-section py-5 position-relative" style="background: white;">
  <div class="container">
    <div class="row align-items-center g-5">
      <!-- Texto a la izquierda -->
      <div class="col-lg-6 animate__animated">
        <h2 class="fw-bold mb-3 text-success">¿Tienes una lista o una foto?</h2>
        <p class="lead" style="font-size: 1.1rem;">
          Sube la foto de tu pedido, lista de materiales o el producto que buscas, nosotros nos encargamos del resto.
        </p>
        <ul class="list-unstyled text-muted" style="font-size: 1.1rem; font-family: 'Segoe UI', Arial, sans-serif;">
            <li><i class="fas fa-camera text-success me-2"></i> Toma una foto a tu lista</li>
            <li><i class="fas fa-upload text-success me-2"></i> Súbela en el formulario</li>
            <li><i class="fas fa-check-circle text-success me-2"></i> ¡Listo! Te contactaremos</li>
        </ul>
      </div>

      <!-- Formulario a la derecha -->
      <div class="col-lg-6 animate__animated">
        <div class="card shadow-lg border-0">
            <div class="card-body p-4">
                <h4 class="card-title text-center text-success mb-4">Haz tu Pedido Express</h4>
                <form id="pedidoFotoForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control" name="nombre" placeholder="Tu Nombre" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="telefono" placeholder="Tu Teléfono / WhatsApp" required>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="metodo_pago" required>
                            <option value="">Método de Pago</option>
                            <option value="Efectivo">Efectivo</option>
                            <option value="Transferencia">Transferencia</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="comentarios" rows="2" placeholder="Comentarios adicionales (opcional)"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imagenInput" class="form-label text-muted small">Sube tu foto (Lista, producto, etc)</label>
                        <input class="form-control" type="file" id="imagenInput" name="image" accept="image/*" required>
                    </div>
                    
                    <div class="mb-3 text-center">
                        <img id="preview" src="#" class="img-fluid rounded d-none" style="max-height: 150px;">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn" id="btnSubmitFoto" style="background: rgba(217, 140, 82, 1); color: rgba(246, 253, 254, 1);">
                            <i class="fas fa-paper-plane me-2"></i> Enviar Pedido
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <script>
            // Previsualización
            document.getElementById('imagenInput').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.getElementById('preview');
                        preview.src = e.target.result;
                        preview.classList.remove('d-none');
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Envío AJAX
            document.getElementById('pedidoFotoForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const btn = document.getElementById('btnSubmitFoto');
                
                // Deshabilitar botón
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Enviando...';

                fetch('{{ url("/pedidos") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Pedido Enviado!',
                            text: 'Hemos recibido tu pedido con foto. Te contactaremos pronto.',
                            confirmButtonColor: 'rgba(18, 33, 61, 1)'
                        });
                        this.reset();
                        document.getElementById('preview').classList.add('d-none');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message || 'Hubo un problema al enviar el pedido.',
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de Conexión',
                        text: 'No se pudo conectar con el servidor.',
                    });
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-paper-plane me-2"></i> Enviar Pedido';
                });
            });
        </script>
      </div>
<!-- Animate.css (si aún no lo tienes) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<script>
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
      entry.target.classList.add('animate__fadeInRight');

      } else {
        entry.target.classList.remove('animate__fadeInUp'); // Para que se repita al volver
      }
    });
  }, {
    threshold: 0.3
  });

  document.querySelectorAll('.animate__animated').forEach(el => {
    observer.observe(el);
  });
</script>



  <section class="mapa">
    <div class="container">
        <h2 class="section-title text-center text-success mt-2 ">¡VISITANOS!</h2>
        <br>
        <center><p><i class="fas fa-map-marker-alt"></i> KILOMETRO 28 VIA LAS PALMAS SECTOR LA FE </p></center>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.8532678911404!2d-75.4889415!3d6.0950186!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e413f5e5e5e5e5e%3A0x0!2sKilometro%2028%20Via%20Las%20Palmas!5e0!3m2!1ses!2sco!4v1706812345678"
            frameborder="0" class="mapa1" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

           
    </div>
</section>
</div> <!-- Esta cierra el último .container -->
</div>
<footer style="width: 100%;">
    <div class="footer-content" id="contacto">
        <div class="footer-section">
            <h3>Contacto</h3>
            <p><i class="fa fa-envelope"></i> ferrycoloresrh@gmail.com </p>
            <a href="https://api.whatsapp.com/send?phone=573246283231&text=Hola%20%F0%9F%91%8B%20Miguelucho" target="_blank"><i class="fab fa-whatsapp"></i> whatsapp 3104393143</a>
        </div>
        {{-- <div class="footer-section">
            <h3>Síguenos</h3>
            <a href="https://web.facebook.com/dulcecontigopostres/?_rdc=1&_rdr" target="_blank"><i class="fab fa-facebook"></i> Facebook</a>
            <a href="https://www.tiktok.com/@dulcecontigo" target="_blank"><i class="fab fa-tiktok"></i> TikTok</a>
            <a href="https://www.instagram.com/dulcecontigo/" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>
        </div> --}}
        <div class="footer-section">
            <h3>Información</h3>
            {{-- <a href="https://surl.li/vnucdw" target="_blank"><i class="far fa-handshake"></i> Trabaja con nosotros</a> --}}
            <p><i class="fas fa-clock"></i> Lunes a Viernes: 7:30 AM - 6:00 PM </p>
            <p><i class="fas fa-clock"></i> Sábado 8:00 AM - 12:30 PM</p>
            
            {{-- <a href="https://drive.google.com/file/d/1VUjYkU_C-3xWxrIldJVCH6PQ7ztVPoCK/view" target="_blank"><i class="fab fa fa-clone"></i> Política y tratamiento de datos</a> --}}
        </div>
    </div>
    <div class="footer-bottom">
        &copy; 2026. Todos los derechos reservados.
    </div>
</footer>


</div>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<a id="inicio"></a>
    {{-- ...código existente... --}}

    {{-- Botón "Ir arriba" --}}
    <button id="btn-ir-arriba" title="Ir arriba">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" style="vertical-align:middle;margin-bottom:3px;" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 12a.5.5 0 0 1-.5-.5V4.707L4.354 8.854a.5.5 0 1 1-.708-.708l4-4a.5.5 0 0 1 .708 0l4 4a.5.5 0 0 1-.708.708L8.5 4.707V11.5A.5.5 0 0 1 8 12z"/>
        </svg>
        
    </button>

    {{-- ...código existente... --}}

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
      AOS.init();

      // Mostrar/ocultar el botón según el scroll
      window.addEventListener('scroll', function() {
          const btn = document.getElementById('btn-ir-arriba');
          if (window.scrollY > 300) {
              btn.style.display = 'block';
          } else {
              btn.style.display = 'none';
          }
      });

      // Animación suave al hacer click
      document.getElementById('btn-ir-arriba').addEventListener('click', function() {
          window.scrollTo({ top: 0, behavior: 'smooth' });
      });
    </script>
      
</body>
</html>



@endsection