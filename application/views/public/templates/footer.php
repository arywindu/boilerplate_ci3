</main> <footer class="text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-md-start mb-2 mb-md-0">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> Nama Situs Berita Anda. Semua Hak Cipta Dilindungi.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item"><a href="<?php echo base_url(); ?>#home" class="text-white text-decoration-none">Home</a></li>
                    <li class="list-inline-item">|</li>
                    <li class="list-inline-item"><a href="<?php echo base_url(); ?>#articles" class="text-white text-decoration-none">Artikel</a></li>
                    <li class="list-inline-item">|</li>
                    <li class="list-inline-item"><a href="<?php echo base_url(); ?>#about" class="text-white text-decoration-none">Tentang</a></li>
                    <li class="list-inline-item">|</li>
                    <li class="list-inline-item"><a href="<?php echo base_url(); ?>#contact" class="text-white text-decoration-none">Kontak</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
    new WOW().init(); // Initialize WOW.js

    // Smooth scrolling for internal links (optional, if browser scroll-behavior: smooth isn't enough)
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>