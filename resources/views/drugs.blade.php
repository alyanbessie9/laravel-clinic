<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drugs List</title>
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
            display: flex;
            flex-wrap: wrap; /* Menggunakan flexbox untuk mengatur layout */
            justify-content: space-between; /* Jarak antar elemen */
        }
        .drug {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: calc(50% - 20px); /* 50% width minus margin */
            position: relative; /* Menjadikan posisi relatif untuk child */
            margin-right: 20px;
        }
        .drug:nth-child(2n) {
            margin-right: 0;
        }
        .drug h2 {
            margin: 0 0 10px;
            font-size: 1.5em;
            color: #00376c;
        }
        .drug p {
            margin: 5px 0;
            color: #666;
        }
        .payment-method {
            margin-left: 370px;
            position: absolute;
            bottom: 20px;
            left: 20px;
            display: flex;
            align-items: center;
        }
        .payment-method img {
            width: 30px;
            margin-right: 10px;
        }
        .search-container {
            margin-top: 20px;
            display: flex;
            align-items: center;
        }
        .search-container input {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .search-container button {
            padding: 8px 16px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #00376c;
            color: #fff;
            cursor: pointer;
            margin-left: 10px;
        }
        .search-container button:hover {
            background-color: #1976d2;
        }

        /* Responsiveness */
        @media only screen and (max-width: 768px) {
            .drug {
                width: 100%; /* Full width on smaller screens */
                margin-right: 0;
            }
        }
    </style>
    <!-- Link ke FontAwesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <div class="header-left">
            <a href="{{ url('/') }}" class="back-button"><i class="fas fa-home"></i></a>
            <h1>Drugs List</h1>
        </div>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search drugs...">
            <button onclick="searchDrugs()">Search</button>
        </div>
    </header>

    <div class="container" id="drugList">
        @foreach($drugs as $drug)
            <div class="drug">
                <h2>{{ $drug['drug_name'] }}</h2>
                <p><strong>Type:</strong> {{ $drug['drug_type'] }}</p>
                <p><strong>Description:</strong> {{ $drug['description'] }}</p>
                <p><strong>Composition:</strong> {{ $drug['composition'] }}</p>
                <p><strong>Packaging:</strong> {{ $drug['packaging'] }}</p>
                <p><strong>Dosage:</strong> {{ $drug['dosage'] }}</p>
                <p><strong>Contraindications:</strong> {{ $drug['contraindications'] }}</p>
                <p><strong>Side Effects:</strong> {{ $drug['side_effects'] }}</p>
                <p><strong>Price:</strong> {{ $drug['currency'] }} {{ number_format($drug['price'], 0, ',', '.') }}</p>
                <p><strong>Expiration Date:</strong> {{ \Carbon\Carbon::parse($drug['expiration_date'])->format('d M Y') }}</p>
                <div class="payment-method">
                    <img src="https://tokonindy.com/cdn/uploads/120211230174557.png" alt="Bank Transfer">
                    <img src="data:image/png;base64,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" alt="Mastercard">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAABDCAMAAABgBzGOAAAAe1BMVEX///8UNMvCx+4ALcoAHMhga9YAAMYAIskAK8oAKMkQMssAFccAJckAH8gAGcivtej29/3t7/rP0vFxfdq9wu1OXdODjN44Sc+NleClqua1uuoADcfi5PeHj97Z3PT7+/6Um+KboeN5gttodNgmPc1GVtE8TtBXZdUtQ87rbbUeAAAEfUlEQVRYhe1X17KrOgwN3ZgOyU4oCenZ//+FF2NJLoGzZ+4z6yVjY0uytFSy223YsGHDhg0bFMq9a6KyDox4YD9MqwseG7QjVXcK3sfj+9Dc3NJWgDf21pc6D8PeV8jDh3miCOFLKHS9Eli4ZHn7CrPY4xM8lvrhuzXUOihc3cAXDUWQZZ5DiA7G9wN88gKhxeFyFaJ1raPfnRDr10tOH+Or7QuhvAsSRlf7Wjc5gd2k1lacg5MPOXdMGAp+Utr3PguKJwxNjkfSm341BlWOWBWZXLFGPshhjg1fd2mv9vlzXNZMQqVT7atZIVZ3UBTNgRyPppfNIExoI+1DMuxW8ACp/Kj2OrCGe7O8Jzg2uYjVieRyFmVZNFFsOqhJfOtx8Pdril0fpKQqpZBa7Gd+Yoh+FyfKkILjNG3XtecgzqNGCawTTa8Tn9cUo1jJoxkXDPycS1PuQTAOhiOjO4avdAMtmwKDAfy9pnj34noEBZBaUtPuBiSN5/d/9ERbQAUPQSKEq4qvIJeRu5BauaRqADKyTqyOYGfaLos7SavZI9aJsQSMCX/CBlHrd16OqKoXji+Rad5rUdoI3/MKxEbFmmJVl2ADqQWZPQD7nH4+/YucjYOlFO18NAvEsGbhlARGDdg1ELVkbu5BMRShlyqHTvctDHJpCsQ1/otdbWo4BamFpkLQnPQ6L6+qHnL/bfeAS09Gu/IBnNmd7+swu8/LxCgX6olAtbLX6gPvPyZ3GkbeqTLDkUtIdLogtTzsN5jnEVjeGQWCJSdNUhUDtUS9AlIaTcAEVE3uiKAitXwIILUmitUtNHpT9lZ1+iarC+elEsseq4qxUYiCjhzmGX6ESqXdL3yjTbBf0sy4Rg/gDk9XFSOPRS86m1SiqBkFYzgk+qNjTGngE4QVC0S4yi6MhijoIJFjRKnXmBxxn5mmOoGwQGLiG4Edvk19BeTii6hFjq1Sq7wgilibMyQRMUzpybB5cfyR6CCOPVGLBiEqqEf70vhDAxC0VKwAGTR/qABr489OdZTcBQugTO/s1mTZS+7u52ymkaeZcYdX8OfX9EuAcs2xH/hU2c3WZAGqIhSbgkYTJoFmrY8/2nAHP2Sjz/9xufZ10W979ET4S0ZLuLlxUs0rGASYFkfTaRgHzit75FkW9wXiroTKvD0W0A88sdWSsmZ6bw6+h17APxqU1uwcg4ZYTyAl2izyD7e6KsexrO/EajE1qSHwG+vjD/W+GYnKeKrcckuUXy9N+ul0rv6F8FyXkEYKKHB1/KFJcpajUtb+14QRmf6r6Ybu1cjj+G1BwHK0Pv6o5ucYVZlakxzYq0V3JoI7e7Bc/umhCOpNYxkHFeRQzVJWa3IzW+mkadZLuWR239Of4w9lxsSju9o1/zXtztGX2iido3+hkdjId5jXeLzeoC69B9BLBWdyT5bEXXeMMqai68X5s5XuaSJ5MDaH3gGk9uvjTxkgtAePL9j7oMVDcT/2YZL7eRL2r3Nt3/6YNBofi9v/F9Wldt163XsbNmzYsGHDhj/xHzX9QtXCl4q5AAAAAElFTkSuQmCC" alt="Visa card">
                </div>
            </div>
        @endforeach
    </div>

    <script>
        function searchDrugs() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const drugs = document.getElementsByClassName('drug');
            Array.from(drugs).forEach(drug => {
                const drugName = drug.getElementsByTagName('h2')[0].innerText.toLowerCase();
                if (drugName.includes(input)) {
                    drug.style.display = '';
                } else {
                    drug.style.display = 'none';
                }
            });
        }
    </script>

</body>
</html>
