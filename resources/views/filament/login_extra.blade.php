<h3 id="slogan">
    Welcome to Our Clinic, <br> 
    where care comes first!
</h3>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Contact Info -->
    <div class="contact-info">
        <div class="contact-item">
            <a href="https://wa.me/1234567890">
                <i class="fab fa-whatsapp"></i> 
                WhatsApp
            </a>
        </div>
        <div class="contact-item">
            <a href="mailto:info@clinic.com">
                <i class="fas fa-envelope"></i> 
                Email
            </a>
        </div>
        <div class="contact-item">
            <a href="tel:+621234567890">
                <i class="fas fa-phone"></i> 
                Telepon
            </a>
        </div>
    </div>




<style>

/* CSS untuk body dan media query */
body {
    /* Background color gradient */
    background: rgb(0, 92, 139); /* Adjusted Dark Cyan */
    background: linear-gradient(0deg, rgba(0, 92, 139, 1) 0%, rgb(47, 79, 79) 100%);
}

@media screen and (min-width: 1024px) {
    main {
        position: absolute; 
        right: 100px;
    }

    main:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: darkcyan;
        border-radius: 12px;
        z-index: -9;
        transform: rotate(7deg);
    }

    .fi-logo {
        position: fixed;
        left: 100px;
        font-size: 3em;
        color: cornsilk;
    }

    #slogan {
        position: fixed;
        left: 22%;
        transform: translateX(-50%);
        margin-top: 6rem;
        color: white;
        font-family: 'Arial', sans-serif; /* Menggunakan font yang lebih jelas */
        font-size: 2.5em;
        font-weight: bold;
        text-shadow: #000000 2px 2px 5px;
        text-align: center; /* Mengatur teks agar rata tengah */
    }

    .contact-info {
        position: fixed;
        left: 8%;
        margin-top: 15rem;
        display: flex;
        gap: 1rem;
    }

    .contact-info .contact-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.2em;
        color: white; /* Mengubah warna teks menjadi putih */
    }

    .contact-info a {
        color: #ffffff;
        text-decoration: none;
        font-weight: bold;
        display: flex;
        align-items: center;
    }

    .contact-info a:hover {
        color: cyan; /* Mengubah warna teks saat dihover */
    }

    .contact-item i {
        font-size: 1.5em; /* Sesuaikan ukuran ikon */
        transition: color 0.3s ease; /* Animasi perubahan warna ikon */
        color: white; /* Ubah warna ikon menjadi putih */
        padding-right: 5px; /* Tambahkan spasi di kanan ikon */
    }

    .contact-info a:hover .fab.fa-whatsapp,
    .contact-info a:hover .fas.fa-envelope,
    .contact-info a:hover .fas.fa-phone {
        color: cyan; /* Mengubah warna ikon saat dihover */
    }
}


</style>