@extends('layouts.app')

@section('content')
<div class="">
    <section class="max-height-100vh container" data-aos="fade-up">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold mb-3">Nurani Pet Care</h1>
                <p class="lead">Pecinta Hewan dan Kopi itu sama, Selalu pake hati dan gak ada pensiun</p>
                <div class="d-grid gap-2 d-md-flex mt-4">
                    <a href="{{ url('/#tentang') }}" class="btn btn-primary btn-lg px-4">
                        Selengkapnya
                    </a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block text-end rounded">
                <img style="height: 523px;" src="{{ asset('images/header-right.png') }}" alt="Cat Health">
            </div>
        </div>
    </section>

    <section class="container" data-aos="fade-right" id="tentang">
        <div class="flex row align-items-center mb-5">
            <div class="col-lg-6">
                <img style="width: 430px;" src="{{ asset('images/nurani.svg') }}" alt="foto nurani">
            </div>
            <div class="col-lg-6 text-start">
            <h2 class="display-6 fw-bold mb-3">Tentang Kami</h2>
                <p style="font-size: 20px;"><b>Klinik Hewan Nurani</b> adalah klinik hewan di Yogyakarta yang dikenal dengan pelayanan ramah dan profesional. Klinik ini tidak hanya menyediakan layanan kesehatan untuk kucing, tetapi juga menawarkan pengalaman berbeda dengan adanya kedai kopi bernuansa alam di halaman belakang.Pelanggan dapat bersantai menikmati hidangan sambil menunggu, ditemani musik pilihan. Selain itu, klinik ini juga memiliki area bermain kucing, menjadikannya tempat yang ideal bagi para pecinta hewan peliharaan.</p>

            </div>
        </div>
    </section>

    <section data-aos="fade-up">
    <div class="statistics-section position-relative w-full py-5">
        <!-- Background overlay -->
        <div class="overlay"></div>
            <div class="container position-relative z-3">
            <div class="align-items-center justify-center text-center text-white mb-5">
            <h1>Mengapa memilih kami?</h1>
        </div>
                <div class="row text-center text-white">
                    <!-- Kolom Statistik 1 -->
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h2 class="display-4 fw-bold">500+</h2>
                        <p class="lead">Customer senang</p>
                    </div>

                    <!-- Kolom Statistik 2 -->
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h2 class="display-4 fw-bold">4</h2>
                        <p class="lead">Dokter Hewan Berpengalaman</p>
                    </div>

                    <!-- Kolom Statistik 3 -->
                    <div class="col-md-4">
                        <h2 class="display-4 fw-bold">4.6/5.0</h2>
                        <p class="lead">Rating di Google Maps</p>
                    </div>
                </div>
            </div>
    </div>
    </section>

    <!-- Layanan Kami -->
<section class="container" data-aos="fade-up" id="layanan">
    <div class="row align-items-center mb-5">
        <div class="col-lg-6">
            <h2 class="display-6 fw-bold mb-3">Layanan Kami</h2>
            <p class="lead">Kami menawarkan berbagai layanan untuk menjaga kesehatan dan kebahagiaan hewan peliharaan Anda.</p>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <!-- Kartu Layanan 1: Medical Checkup -->
        <div class="col">
            <div class="card h-100 card-img-top">
                <img src="{{ asset('images/medical-checkup.png') }}" class="card-img-top" alt="Medical Checkup">
                <div class="card-body">
                    <h5 class="card-title">Medical Checkup</h5>
                    <p class="card-text">Periksa kesehatan hewan Anda secara menyeluruh untuk deteksi dini masalah medis.</p>
                </div>
            </div>
        </div>

        <!-- Kartu Layanan 2: Vaksinasi -->
        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('images/vaksinasi.png') }}" class="card-img-top" alt="Vaksinasi">
                <div class="card-body">
                    <h5 class="card-title">Vaksinasi</h5>
                    <p class="card-text">Perlindungan terhadap penyakit menular dengan vaksinasi berkala.</p>
                </div>
            </div>
        </div>

        <!-- Kartu Layanan 3: Grooming -->
        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('images/grooming.jpg') }}" class="card-img-top" alt="Grooming">
                <div class="card-body">
                    <h5 class="card-title">Grooming</h5>
                    <p class="card-text">Perawatan penampilan hewan Anda, termasuk cuci, cukur, dan perawatan bulu.</p>
                </div>
            </div>
        </div>

        <!-- Kartu Layanan 4: Coffee Shop -->
        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('images/coffee-shop.png') }}" class="card-img-top" alt="Coffee Shop">
                <div class="card-body">
                    <h5 class="card-title">Coffee Shop</h5>
                    <p class="card-text">Tempat bersantai dengan suasana alam dan hidangan nikmat sambil menunggu.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Lokasi -->
<section class="container mt-5" data-aos="fade-up" id="lokasi">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-12 text-center">
            <div class="p-5 rounded position-relative">
                <h2 class="display-6 fw-bold mb-3">Lokasi Kami</h2>
                <p class="lead">Temukan lokasi kami di Yogyakarta dengan mudah!</p>
                <!-- Map -->
                <div class="mb-3">
                    <iframe
                        class="w-100"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.4792601564604!2d110.3471953114479!3d-7.738879692247399!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a58941622a1ef%3A0x4bd2707b1eb1c517!2sKlinik%20Hewan%20Nurani!5e0!3m2!1sid!2sid!4v1745765293903!5m2!1sid!2sid"
                        width="800"
                        height="600"
                        style="border: 2px;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <!-- Alamat -->
                <p class="mt-3"><strong>Alamat:</strong> Kronggahan, Jl. Kabupaten, RT.4/RW.2, Kranggahan I, Trihanggo, Kec. Gamping, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55291</p>
                <p><strong>Telp:</strong> +62-8122-6005-692</p>
            </div>
        </div>
    </div>
</section>

<!-- Hubungi Kami -->
<section class="container mt-5" data-aos="fade-up">
    <div class="row align-items-center">
        <div class="flex col">
            <div class="bg-primary-custom p-5 rounded position-relative">
                <h2 class="display-6 fw-bold mb-3 text-white">Hubungi Kami</h2>
                <p class="lead text-white">Hubungi WhatsApp kami untuk mendapatkan informasi <br> lebih lanjut tentang Klinik Hewan Nurani.</p>
                <a href="https://api.whatsapp.com/send/?phone=6281226005692&text=Halo+admin+Nurani+Petshop%2C+saya+mau+tanya...&type=phone_number&app_absent=0" class="btn btn-light btn-lg px-4" target="_blank">
                    Hubungi Kami
                </a>
                <!-- Elemen untuk gambar -->
                <div class="contact-image position-absolute end-0 top-0">
                    <img src="{{ asset('images/contact.png') }}" class="img-fluid rounded" alt="Contact Us">
                </div>
            </div>
        </div>
    </div>
</section>

</div>

<style>
section {
    margin-bottom: 125px;
}

.statistics-section {
    background-image: url('{{ asset("images/kucing-banyak.png") }}');
    background-size: cover;
    background-position: center;
    min-height: 300px;
    padding: 80px 0;
    position: relative;
}

.statistics-section .overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(13, 110, 253, 0.85); /* 💙 Biru Primary transparan */
    z-index: 1;
}

.statistics-section .container {
    position: relative;
    z-index: 2;
}

.statistics-section h2 {
    margin-bottom: 0.5rem;
    font-size: 3rem;
}

/* Style untuk elemen Hubungi Kami */
.bg-primary-custom {
    background-color: #0d6efd; /* 💙 Biru Primary */
    padding: 50px;
    border-radius: 10px;
    overflow: hidden;
}

/* Tombol "Hubungi Kami" */
.btn-light-custom {
    color: #0d6efd;
    border-color: #0d6efd;
}

.btn-light-custom:hover {
    background-color: #0d6efd;
    color: white;
}

/* Gambar di pojok kanan atas */
.contact-image img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    border-radius: 50%;
}

.contact-image {
    top: 10px;
    right: 10px;
}

#map {
    height: 300px;
    width: 100%;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

@media (max-width: 768px) {
    .statistics-section h2 {
        font-size: 2.5rem;
    }
}
</style>

@endsection
