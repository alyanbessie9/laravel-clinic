<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clicik 24-Jam</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: #333; /* Warna teks utama */
        }

        header {
            background-color: #00376c; /* Warna background header */
            color: #fff;
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 999; /* Atur z-index untuk menempatkan di atas konten lain */
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo img {
            max-height: 80px; /* Atur ukuran maksimum logo */
            vertical-align: middle;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 20px;
        }

        nav ul li {
            margin: 0;
            padding: 0;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #90caf9; /* Ubah warna teks saat dihover */
        }

        .hero {
            background-color: #f5f5f5; /* Warna background untuk bagian hero */
            padding: 80px 0;
            text-align: center;
        }

        .hero h1 {
            font-size: 3em; /* Ukuran font judul besar */
            margin-bottom: 20px;
            color: #00376c; /* Warna judul hero */
        }

        .hero p {
            font-size: 1.2em;
            color: #757575; /* Warna teks untuk nomor telepon */
            margin-bottom: 40px;
        }

        .hero .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #1976d2;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .hero .button:hover {
            background-color: #90caf9; /* Ubah warna tombol saat dihover */
        }

        .about {
            padding: 60px 0;
            text-align: center;
        }

        .about h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #00376c; /* Warna judul section about */
        }

        .about p {
            font-size: 1.1em;
            color: #666;
            margin-bottom: 40px;
        }

        .services {
            background-color: #f9f9f9; /* Warna background untuk bagian services */
            padding: 80px 0;
            text-align: center;
        }

        .services h2 {
            font-size: 2.5em;
            margin-bottom: 40px;
            color: #00376c; /* Warna judul section services */
        }

        .service-item {
            padding: 40px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 40px;
            transition: transform 0.3s ease;
            background-color: #fff; /* Warna background item service */
        }

        .service-item:hover {
            transform: translateY(-5px); /* Efek mengangkat sedikit saat dihover */
        }

        .service-item img {
            max-width: 100%;
            height: auto; /* Biarkan tinggi gambar menyesuaikan agar tidak terdistorsi */
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1); /* Efek bayangan pada gambar */
        }

        .service-item h3 {
            font-size: 2em;
            margin-bottom: 10px;
            color: #00376c; /* Warna judul layanan */
        }

        .service-item p {
            font-size: 1.1em;
            color: #666;
            line-height: 1.6;
        }

        footer {
            background-color: #00376c; /* Warna background untuk footer */
            color: #fff;
            text-align: center;
            padding: 20px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        footer p {
            margin: 0;
        }

        /* Media Queries untuk Responsif */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .logo {
                margin-bottom: 20px;
            }

            nav {
                margin-top: 20px;
                text-align: center;
            }

            .hero h1 {
                font-size: 2.5em;
            }

            .hero p {
                font-size: 1em;
            }

            .service-item {
                padding: 20px;
            }
        }

    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="/images/clinic-logo.png" alt="HOPE IC">
            </div>
            <nav>
                <ul>
                    <li><a href="#hero">Home</a></li>
                    <li><a href="#services">Our service</a></li>
                    <li><a href="#" id="our-doctors-link">Our Doctors</a></li>
                    <li><a href="#" id="drugLink">Drug</a></li>
                    <li><a id="contactLink" href="javascript:void(0);">Contact Us</a></li>
                    <li><a id="loginLink" href="javascript:void(0);">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="hero" class="hero">
        <div class="container">
            <h1>Welcome to Our Clinic</h1>
            <p>+49 123 456 729</p>
            <a href="#" class="button">Find Us on Map</a>
        </div>
    </section>

    <section class="about">
        <div class="container">
            <h2>WE CARE ABOUT YOUR HEALTH</h2>
            <p>At our clinic, we prioritize your well-being above all else. Our dedicated team ensures you receive the highest quality care tailored to your needs. Whether it's routine check-ups or emergency treatments, we are committed to providing compassionate healthcare. With state-of-the-art facilities and experienced professionals, your health is in safe hands. Trust us to guide you towards a healthier tomorrow.</p>
            <a href="#" class="button">Get Free Consultation</a>
        </div>
    </section>

    <section id="services" class="services">
        <div class="container">
            <h2>OUR SERVICES</h2>
            <div class="service-item">
                <img src="https://s3-publishing-cmn-svc-prd.s3.ap-southeast-1.amazonaws.com/article/SBO5b1vleTzNoAPHAcvWv/original/004856800_1582792894-Anjuran-Cek-Kesehatan-Rutin-Berdasarkan-Usia-shutterstock_1067323655.jpg" alt="General Checkup">
                <h3>General Checkup</h3>
                <p>Regular health check-ups are essential for monitoring your well-being and detecting any potential issues early on. Our comprehensive check-up includes vital tests and consultations to ensure you're in good health.</p>
            </div>
            <div class="service-item">
                <img src="https://releva.ca/wp-content/uploads/2023/06/serviceshero.jpg" alt="Specialized Treatments">
                <h3>Specialized Treatments</h3>
                <p>For specific medical conditions requiring specialized care, our team of experts offers tailored treatment plans. From chronic diseases to acute ailments, we provide advanced therapies to address your unique health needs.</p>
            </div>
            <div class="service-item">
                <img src="https://www.sriramakrishnahospital.com/wp-content/uploads/2022/05/Importance-of-first-aid.png" alt="Emergency Care">
                <h3>Emergency Care</h3>
                <p>During emergencies, quick and effective medical intervention can save lives. Our emergency care services are equipped to handle critical situations with urgency and expertise, ensuring prompt treatment and stabilization.</p>
            </div>
        </div>
    </section>


    <footer>
        <div class="container">
            <p>&copy; 2024 IPAT TI4. thebabyalien</p>
        </div>
    </footer>
</body>
</html>

<script>
    // Smooth scrolling when clicking on navigation links
    document.querySelectorAll('nav a').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();

            const target = document.querySelector(this.getAttribute('href'));

            window.scrollTo({
                top: target.offsetTop,
                behavior: 'smooth'
            });
        });
    });

    // Ketika dokumen telah dimuat sepenuhnya
    document.addEventListener('DOMContentLoaded', function() {
        // Temukan elemen anchor dengan id 'loginLink'
        var loginLink = document.getElementById('loginLink');
        
        // Tambahkan event listener untuk menghandle klik pada link 'Login'
        loginLink.addEventListener('click', function(event) {
            // Pengalihan URL ke halaman login di server lokal Anda
            window.location.href = 'http://localhost:8000/admin/login';
        });
    });

    // Ketika dokumen telah dimuat sepenuhnya
    document.addEventListener('DOMContentLoaded', function() {
        // Temukan elemen anchor dengan id 'contactLink'
        var contactLink = document.getElementById('contactLink');
        
        // Tambahkan event listener untuk menghandle klik pada link 'Contact Us'
        contactLink.addEventListener('click', function(event) {
            // Pengalihan URL ke tautan WhatsApp
            var phoneNumber = '1234567890'; // Ganti dengan nomor WhatsApp yang sesuai
            var whatsappUrl = 'https://wa.me/' + phoneNumber;
            window.open(whatsappUrl, '_blank'); // Buka tautan WhatsApp di tab atau jendela baru
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('our-doctors-link').addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah tautan mengikuti perilaku default
            window.location.href = '{{ route("doctors") }}';
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('drugLink').addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah tautan mengikuti perilaku default
            window.location.href = '{{ route("drugs") }}';
        });
    });
    
</script>

