<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            font-size: 12px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Laporan Peminjaman Buku</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loans as $index => $loan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $loan->user->name ?? auth()->user()->name }}</td>
                    <td>{{ $loan->book->title }}</td>
                    <td>{{ $loan->borrow_date }}</td>
                    <td>{{ $loan->return_date ?? '-' }}</td>
                    <td>{{ ucfirst($loan->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
