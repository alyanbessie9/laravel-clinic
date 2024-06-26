<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Doctors</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Ganti css/app.css dengan lokasi CSS Anda jika berbeda -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }
        header {
            background-color: #00376c;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-left {
            display: flex;
            align-items: center;
        }
        .header-left a {
            color: #fff;
            text-decoration: none;
            font-size: 24px;
            margin-right: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        .doctor {
            display: flex;
            align-items: center;
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .doctor img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 20px;
            border: 2px solid #00376c;
        }
        .doctor .info {
            flex: 1;
        }
        .doctor .info h2 {
            margin: 0 0 10px;
            font-size: 1.5em;
            color: #00376c;
        }
        .doctor .info p {
            margin: 5px 0;
            color: #666;
        }
        .search-container {
            display: flex;
            align-items: center;
        }
        .search-container input {
            padding: 5px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            margin-right: 10px;
        }
        .search-container button {
            padding: 5px 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #1976d2;
            color: #fff;
            cursor: pointer;
        }
        .search-container button:hover {
            background-color: #90caf9;
        }
        .email-icon {
            margin-left: 10px;
            color: #00376c;
            font-size: 20px;
            cursor: pointer;
        }
        .fa-envelope:before {
            color: red;
            margin-left: 49rem;
        }
    </style>
    <!-- Link ke FontAwesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <div class="header-left">
            <a href="{{ url('/') }}" class="back-button"><i class="fas fa-home"></i></a>
            <h1>Our Doctors</h1>
        </div>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search doctors...">
            <button onclick="searchDoctor()">Search</button>
        </div>
    </header>

    <div class="container" id="doctorList">
        @foreach($doctors as $doctor)
            <div class="doctor">
                <img src="{{ $doctor['profile_photo_path'] }}" alt="{{ $doctor['name'] }}">
                <div class="info">
                    <h2>{{ $doctor['name'] }}</h2>
                    <p>Specialization: {{ $doctor['specialization'] }}</p>
                    <a href="mailto:{{ $doctor['email'] }}" class="email-icon"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        function searchDoctor() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const doctorList = document.getElementById('doctorList');
            const doctors = doctorList.getElementsByClassName('doctor');
            for (let i = 0; i < doctors.length; i++) {
                const name = doctors[i].getElementsByClassName('info')[0].getElementsByTagName('h2')[0].innerText.toLowerCase();
                if (name.includes(input)) {
                    doctors[i].style.display = '';
                } else {
                    doctors[i].style.display = 'none';
                }
            }
        }
    </script>
</body>
</html>
