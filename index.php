<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="index.css">
    <link rel="icon" type="image/png" href="Image/Upskill.png">
</head>
<style>
/* Styling untuk bagian download */
.download {
    background-color: #f7f7f7;
    padding: 60px 0;
    text-align: center;
    font-family: 'Arial', sans-serif;
}

.download h2 {
    font-size: 32px;
    color: #2c3e50;
    margin-bottom: 15px;
    font-weight: 700;
}

.download p {
    font-size: 18px;
    color: #7f8c8d;
    margin-bottom: 40px;
    max-width: 700px;
    margin: 0 auto 30px;
}

/* Styling tombol download */
.download-btn {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: linear-gradient(45deg, #34A853, #0f9d58); /* Gradien hijau */
    color: #fff;
    padding: 15px 30px;
    font-size: 18px;
    font-weight: 600;
    text-decoration: none;
    border-radius: 50px;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

/* Ikon Android dalam tombol */
.download-btn .android-icon {
    width: 28px;
    height: 28px;
    filter: brightness(0) invert(1); /* Sesuaikan warna ikon agar lebih kontras */
}

/* Efek hover dan animasi */
.download-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 300%;
    height: 100%;
    background: rgba(255, 255, 255, 0.2);
    transition: all 0.5s;
}

.download-btn:hover::before {
    left: 100%;
}

.download-btn:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
    background: linear-gradient(45deg, #0f9d58, #34A853); /* Gradien hijau lebih terang saat hover */
}

    </Style>
<body>
    <?php include 'Login/db.php'; // Menghubungkan ke database ?>

    <header class="header">
        <div class="container">
            <a href="#" class="logo">
                <img src="Image/logo1.png" class="logo-img" alt="Logo">
            </a>
            <nav class="nav">
                <div class="nav-toggle" onclick="toggleNav()">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
                <ul class="nav-links">
    <li><a href="#about" onclick="toggleNav()">About</a></li>
    <li><a href="#procedure" onclick="toggleNav()">Operating Procedure</a></li>
    <li><a href="#features" onclick="toggleNav()">Features</a></li>
    <li><a href="#download" onclick="toggleNav()">Download</a></li>
    <li><a href="#contact" onclick="toggleNav()">Contact</a></li>
</ul>

            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="carousel">
            <div class="carousel-item active" style="background-image: url('Image/slide1.png');"></div>
            <div class="carousel-item" style="background-image: url('Image/slide2.png');"></div>
            <div class="carousel-item" style="background-image: url('Image/slide3.png');"></div>
            <a class="carousel-control prev" onclick="prevSlide()">&#10094;</a>
            <a class="carousel-control next" onclick="nextSlide()">&#10095;</a>
        </div>
        <div class="container">
            <h2 style="color: #ffffff; text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;">Your Future Starts Here</h2>
            <p style="color: #ffffff; text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;">Find the best jobs and training programs to advance your career.</p>
            <a href="Login/Login.html" class="btn">Try Now</a>
        </div>
    </section>

    <section id="about" class="about">
        <div class="container">
            <h2>About Us</h2>
            <div class="video-container">
                <div class="video-wrapper">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/vdTfm4PQfhc?autoplay=1&rel=0" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <p>We connect you with the best job opportunities and training programs in your field.</p>
        </div>
    </section>
    <section id="features" class="features">
        <div class="container">
            <h2>Features</h2>
            <!--Ini Bagian Lowongan-->
            <div class="feature-item">
    <h3>Job Listings</h3>
    <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 20px; margin: 0 auto;">
    <?php
    // Query untuk mengambil maksimal 4 lowongan terbaru yang statusnya "Aktif"
    $sql = "SELECT nama_perusahaan, posisi, daerah, gaji, kuota, gambar_perusahaan 
            FROM lowongan 
            WHERE status='Aktif' 
            ORDER BY tanggal_dibuka DESC 
            LIMIT 3";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Menampilkan data lowongan dalam bentuk cards
        while($row = $result->fetch_assoc()) {
            echo "<div style='
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 20px;
                width: 250px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                text-align: center;
                background-color: #fff;
                overflow: hidden;
            '>";
            echo "<img src='Login/Image/perusahaan/" . $row['gambar_perusahaan'] . "' alt='Company Logo' style='
                width: 100%;
                height: 150px;
                object-fit: cover;
                border-radius: 8px;
                margin-bottom: 10px;
            '>";
            echo "<h4 style='color: #333;'>" . $row['posisi'] . "</h4>";
            echo "<p style='color: #666; font-size: 14px;'>Company: " . $row['nama_perusahaan'] . "</p>";
            echo "<p style='color: #666; font-size: 14px;'>Location: " . $row['daerah'] . "</p>";
            echo "<p style='color: #666; font-size: 14px;'>Salary: Rp " . number_format($row['gaji'], 2) . "</p>";
            echo "<p style='color: #666; font-size: 14px;'>Quota: " . $row['kuota'] . " positions</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No job listings available at the moment.</p>";
    }
    ?>
    </div>
</div>
            <!--Ini Bagian Lowongan-->
            <!--Ini Bagian Pelatihan-->

<div class="feature-item">
    <h3>Training Programs</h3>
    <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 20px; margin: 0 auto;">
    <?php
    // Query untuk mengambil maksimal 4 pelatihan terbaru
    $sql = "SELECT judul, kategori, pembuat, deskripsi 
            FROM pelatihan 
            ORDER BY tanggal_dibuat DESC 
            LIMIT 3";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Menampilkan data pelatihan dalam bentuk cards
        while($row = $result->fetch_assoc()) {
            echo "<div style='
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 20px;
                width: 250px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                text-align: center;
                background-color: #fff;
                overflow: hidden;
            '>";
            echo "<h4 style='color: #333;'>" . $row['judul'] . "</h4>";
            echo "<p style='color: #666; font-size: 14px;'>Category: " . $row['kategori'] . "</p>";
            echo "<p style='color: #666; font-size: 14px;'>Creator: " . $row['pembuat'] . "</p>";
            echo "<p style='color: #666; font-size: 14px;'>" . substr($row['deskripsi'], 0, 50) . "...</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No training programs available at the moment.</p>";
    }
    ?>
    </div>
</div>
    <section id="download" class="download">
    <div class="container" style="text-align: center; padding: 50px 0;">
        <h2 style="font-size: 28px; color: #333; margin-bottom: 20px;">Download Our App</h2>
        <p style="font-size: 16px; color: #666; margin-bottom: 30px;">
            Download aplikasi Upskill untuk kemudahan akses lowongan kerja dan pelatihan langsung dari perangkat Anda.
        </p>
        <button id="download-btn" class="download-btn" style="display: inline-block; padding: 12px 24px; font-size: 18px; color: white; background-color: #4CAF50; border: none; border-radius: 5px;">
            <img src="Image/Upskill.png" alt="Android Icon" class="android-icon" style="height: 24px; margin-right: 10px;">
            Download UpSkill
        </button>
    </div>
</section>
            <!--Ini Bagian Pelatihan-->
        </div>
    </section>

    <section id="contact" class="contact">
    <div style="text-align: center; padding: 50px 0; background-color: #f9f9f9;">
        <h2 style="font-size: 28px; color: #333; margin-bottom: 20px;">Contact Us</h2>
        <p style="font-size: 16px; color: #666;">Have questions? Reach out to us via email!</p>
        <div style="font-size: 18px; color: #333; margin-top: 20px;">
            Email: 
            <a href="mailto:upskillmediasocial@gmail.com" style="color: #007BFF; text-decoration: none;">
                upskillmediasocial@gmail.com
            </a>
        </div>
    </div>
</section>



    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Upskill. All rights reserved.</p>
        </div>
    </footer>
    <script>
    document.getElementById('download-btn').addEventListener('click', function() {
        const form = document.createElement('form');
        form.id = 'download-form';
        form.method = 'get';
        form.action = 'https://drive.usercontent.google.com/download';

        // Membuat input hidden untuk mengisi data
        const inputs = [
            { name: 'id', value: '1jTlR9drfdZBwKJQwj1lPoDU-Y69J4xEx' },
            { name: 'export', value: 'download' },
            { name: 'authuser', value: '0' },
            { name: 'confirm', value: 't' },
            { name: 'uuid', value: '2c4567b4-9561-4a5f-8b6b-930269a1d979' },
            { name: 'at', value: 'AENtkXYALlg2oKomFG5gKAtaKIJM:1730292906444' }
        ];

        inputs.forEach(inputData => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = inputData.name;
            input.value = inputData.value;
            form.appendChild(input);
        });

        // Menambahkan form ke body dan mengirimnya
        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form); // Hapus form setelah submit
    });
</script>
    <script src="script.js"></script>
</body>
</html>