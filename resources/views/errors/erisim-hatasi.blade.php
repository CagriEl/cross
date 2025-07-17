<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erişim Yetkiniz Yok</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        h1 {
            font-size: 2em;
            color: #ff0000;
        }
        p {
            font-size: 1.2em;
            margin-top: 20px;
        }
    </style>
    <script>
        setTimeout(function() {
            window.location.href = "{{ url('/') }}"; // Ana sayfaya yönlendirme
        }, 5000);
    </script>
</head>
<body>
    <h1>403 - Erişim Yetkiniz Yok</h1>
    <p>{{ $message }}</p>
    <p>5 saniye içinde ana sayfaya yönlendirileceksiniz...</p>
</body>
</html>
