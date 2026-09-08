<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="">
        <a class="btn" href="{{ route('soal.create') }}"> <div class="btn">Add new soal</div></a>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Soal</th>
                    <th>Jawaban</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($soals as $soal)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $soal->soal }}</td>
                        <td>{{ $soal->jawaban }}</td>
                    </tr>
                @endforeach
            </tbody>
    </div>
</body>
</html>