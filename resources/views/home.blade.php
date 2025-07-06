@extends('layouts.app')

@section('content')
<div class="">
    <section class="min-height-100vh container" data-aos="fade-up">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold mb-3">Nurani Pet Care</h1>
                <p class="lead">Melayani sepenuh hati dengan hati nurani</p>
                <div class="d-grid gap-2 d-md-flex mt-4">
                    <a href="{{ url('/#tentang') }}" class="btn btn-primary btn-lg px-4">
                        Selengkapnya
                    </a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block text-end rounded">
                <img class="img-fluid" style="max-height: 523px;" src="{{ asset('images/header-right.png') }}" alt="Cat Health">
            </div>
        </div>
    </section>

    <section class="container" data-aos="fade-right" id="tentang">
        <div class="flex row align-items-center mb-5">
            <div class="col-lg-6">
                <img class="img-fluid" src="{{ asset('images/nurani.svg') }}" alt="foto nurani">
            </div>
            <div class="col-lg-6 text-start">
                <h2 class="display-6 fw-bold mb-3">Tentang Kami</h2>
                <p style="font-size: 20px;"><b>Klinik Hewan Nurani</b> adalah klinik hewan terpercaya yang berlokasi di Kota Yogyakarta. Dikenal dengan pelayanan yang ramah dan profesional, klinik ini fokus memberikan layanan kesehatan terbaik untuk kucing serta hewan peliharaan lainnya. Klinik ini melayani berbagai kebutuhan medis seperti penanganan hewan sakit, keracunan, infeksi jamur, parasit, hingga konsultasi kesehatan hewan secara menyeluruh.

                Dengan dukungan tim dokter hewan berpengalaman, Klinik Hewan Nurani memastikan setiap pengobatan dilakukan secara aman, tepat, dan berkualitas. Selain itu, biaya perawatan di klinik ini juga tergolong terjangkau, menjadikannya pilihan ideal bagi para pecinta hewan di Yogyakarta.</p>
            </div>
        </div>
    </section>

    <section data-aos="fade-up">
        <div class="statistics-section position-relative w-full py-5">
            <div class="overlay"></div>
            <div class="container position-relative z-3">
                <div class="align-items-center justify-center text-center text-white mb-5">
                    <h1>Mengapa memilih kami?</h1>
                </div>
                <div class="row text-center text-white">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h2 class="display-4 fw-bold">500+</h2>
                        <p class="lead">Customer senang</p>
                    </div>

                    <div class="col-md-4 mb-4 mb-md-0">
                        <h2 class="display-4 fw-bold">4</h2>
                        <p class="lead">Dokter Hewan Berpengalaman</p>
                    </div>

                    <div class="col-md-4">
                        <h2 class="display-4 fw-bold">4.6/5.0</h2>
                        <p class="lead">Rating di Google Maps</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container" data-aos="fade-up" id="layanan">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <h2 class="display-6 fw-bold mb-3">Layanan Kami</h2>
                <p class="lead">Kami menawarkan berbagai layanan untuk menjaga kesehatan dan kebahagiaan hewan peliharaan Anda.</p>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <div class="col">
                <div class="card h-100 card-img-top">
                    <img src="{{ asset('images/medical-checkup.png') }}" class="card-img-top" alt="Medical Checkup">
                    <div class="card-body">
                        <h5 class="card-title">Medical Checkup</h5>
                        <p class="card-text">Periksa kesehatan hewan Anda secara menyeluruh untuk deteksi dini masalah medis.</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('images/vaksinasi.png') }}" class="card-img-top" alt="Vaksinasi">
                    <div class="card-body">
                        <h5 class="card-title">Vaksinasi</h5>
                        <p class="card-text">Perlindungan terhadap penyakit menular dengan vaksinasi berkala.</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('images/grooming.jpg') }}" class="card-img-top" alt="Grooming">
                    <div class="card-body">
                        <h5 class="card-title">Grooming</h5>
                        <p class="card-text">Perawatan penampilan hewan Anda, termasuk cuci, cukur, dan perawatan bulu.</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('images/operasi.png') }}" class="card-img-top" alt="Operasi">
                    <div class="card-body">
                        <h5 class="card-title">Operasi</h5>
                        <p class="card-text">Penanganan bedah profesional oleh tim dokter hewan berpengalaman untuk kesehatan optimal hewan kesayangan Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-5" data-aos="fade-up" id="lokasi">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-12 text-center">
                <div class="p-5 rounded position-relative">
                    <h2 class="display-6 fw-bold mb-3">Lokasi Kami</h2>
                    <p class="lead">Temukan lokasi kami di Yogyakarta dengan mudah!</p>
                    <div class="mb-3 ratio ratio-16x9">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.4792601564604!2d110.3471953114479!3d-7.738879692247399!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a58941622a1ef%3A0x4bd2707b1eb1c517!2sKlinik%20Hewan%20Nurani!5e0!3m2!1sid!2sid!4v1745765293903!5m2!1sid!2sid"
                            style="border: 2px;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    <p class="mt-3"><strong>Alamat:</strong> Kronggahan, Jl. Kabupaten, RT.4/RW.2, Kranggahan I, Trihanggo, Kec. Gamping, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55291</p>
                    <p><strong>Telp:</strong> +62-8122-6005-692</p>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-5" data-aos="fade-up" id="jadwal-praktik">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8 text-center">
                <h2 class="display-6 fw-bold mb-3">Jam Operasional</h2>
                <p class="lead">Klinik Hewan Nurani buka setiap hari untuk memberikan pelayanan terbaik bagi hewan kesayangan Anda.</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>Hari</th>
                                <th>Jam Praktik</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Senin</td>
                                <td>09.00 - 21.00 WIB</td>
                            </tr>
                            <tr>
                                <td>Selasa</td>
                                <td>09.00 - 21.00 WIB</td>
                            </tr>
                            <tr>
                                <td>Rabu</td>
                                <td>09.00 - 21.00 WIB</td>
                            </tr>
                            <tr>
                                <td>Kamis</td>
                                <td>09.00 - 21.00 WIB</td>
                            </tr>
                            <tr>
                                <td>Jumat</td>
                                <td>09.00 - 21.00 WIB</td>
                            </tr>
                            <tr>
                                <td>Sabtu</td>
                                <td>09.00 - 21.00 WIB</td>
                            </tr>
                            <tr>
                                <td>Minggu</td>
                                <td>09.00 - 21.00 WIB</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-5 position-relative" data-aos="fade-up">
        <div class="row align-items-center">
            <div class="flex col">
                <div class="bg-primary-custom p-5 pe-0 rounded position-relative">
                    <h2 class="display-6 fw-bold mb-3 text-white">Hubungi Kami</h2>
                    <p class="lead text-white">Hubungi WhatsApp kami untuk mendapatkan informasi <br> lebih lanjut tentang Klinik Hewan Nurani.</p>
                    <a href="https://api.whatsapp.com/send/?phone=6281226005692&text=Halo+admin+Nurani+Pet Care%2C+saya+mau+tanya...&type=phone_number&app_absent=0" class="btn btn-light btn-lg px-4" target="_blank">
                        Hubungi Kami
                    </a>
                    <div class="contact-image position-absolute top-0 end-0 h-100">
                        <img src="{{ asset('images/contact.png') }}" class="w-100 h-100 object-cover rounded-end" alt="Contact Us">
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
