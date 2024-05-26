<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<center>
    <h3>
    LAPORAN DATA DPT<br/>
    KELURAHAN : <br/>
    RT :
</h3>
</center>

<table border=1 width="100%" cellspacing=0 cellpadding=0>
    <tr>
        <th style="padding: 15px 15px">No</th>
        <th>Nama</th>
        <th>NIK</th>
        <th>Di bawai Oleh</th>
    </tr>

    @foreach ($data as $key=> $item)
        
    <tr>
        <td>{{$key+1}}</td>
        <td>{{$item->nama}}</td>
        <td>{{$item->nik}}</td>
        <td>{{$item->dibawai == null ? '': $item->dibawai->nama}}</td>
    </tr>
    @endforeach
</table>


</body>
</html>