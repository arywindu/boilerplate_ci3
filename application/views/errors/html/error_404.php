<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>404 Halaman Tidak Ditemukan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style type="text/css">
        body {
            background-color: #f8f9fa;
            color: #495057;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container-404 {
            text-align: center;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            max-width: 600px;
            width: 90%;
        }
        .error-code {
            font-size: 10em;
            font-weight: bold;
            color: #dc3545; /* Bootstrap danger color */
            line-height: 1;
            margin-bottom: 20px;
        }
        .error-message {
            font-size: 1.5em;
            margin-bottom: 20px;
        }
        .btn-home {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            padding: 10px 25px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn-home:hover {
            background-color: #0056b3;
            color: #fff;
            text-decoration: none;
        }
        .icon-warning {
            font-size: 3em;
            color: #dc3545;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container-404">
        <i class="fas fa-exclamation-triangle icon-warning"></i>
        <div class="error-code">404</div>
        <div class="error-message">Oops! Halaman yang Anda cari tidak ditemukan.</div>
        <p>Sepertinya Anda tersesat. Jangan khawatir, mari kembali ke jalan yang benar.</p>
        <a href="/boilerplate_ci3/" class="btn btn-home"> <i class="fas fa-home"></i> Kembali ke Beranda
		</a>
        
    </div>
</body>
</html>