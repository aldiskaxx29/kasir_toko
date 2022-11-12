<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tutorial Laravel Mail | ayongoding.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Tinggalkan Balasan</h3>
                <form method="post" action="/kirim">
                    @csrf
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input class="form-control" type="text" name="nama">
                    </div>
                    <div class="form-group">
                        <label>Website</label>
                        <input class="form-control" type="text" name="website">
                    </div>
                    <div class="form-group">
                        <label>Komentar</label>
                        <textarea class="form-control" name="komentar" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Alamat Email Saya</label>
                        <input class="form-control" type="text" name="email">
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Kirim ke Email Saya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>
