<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('soal.store') }}" method="POST">
        @csrf
        <input type="text" name="soal" placeholder="Masukkan Soal">
        <input type="text" name="jawaban" placeholder="Masukkan Jawaban">
        <button type="submit">Submit</button> 
    </form>
</body>
</html>