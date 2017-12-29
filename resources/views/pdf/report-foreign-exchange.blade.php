<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan SATS-LN</title>
    <style type="text/css">
        * {
            font: 10px arial, calibri;
            margin: 10px;
            padding: 0;
        }

        hr {

        }

        #header {
            border-bottom: #000 solid 2px;
        }

        #header #header-logo {
            float: left;
            text-align: center;
        }

        #header #header-info {
            text-align: center;
        }

        #header #header-info span:nth-child(1) {
            font-size: 14px;
            font-weight: bold;
        }

        #header #header-info span:nth-child(3) {
            font-size: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div id="header">
    <div id="header-logo">
        <img src="{{ asset('images/Lambang_Kementerian_Lingkungan_Hidup_dan_Kehutanan.png') }}" height="70">
    </div>
    <div id="header-info">
        <span>KEMENTERIAN LINGKUNGAN HIDUP DAN KEHUTANAN DIREKTORAT JENDERAL KONSERVASI SUMBER DAYA ALAM DAN EKOSISTEM</span>
        <br>
        <span>DIREKTORAT KONSERVASI KEANEKARAGAMAN HAYATI</span>
        <br>
        <span>Gedung Pusat Kehutanan Manggala Wanabhakti Blok VII Lt. 7<br>Jl. Jend. Gatot Subroto, Jakarta 10270 - Telp. 021 - 5720227 - Fax. 021 - 5720027</span>
    </div>
</div>
<?php
$total = 0;
foreach ($species as $spec) {
    $total = $total + ($spec->total_export*$spec->nominal);
}
?>
<table>
    <tr>
        <th>Tahun&nbsp;&nbsp;&nbsp;</th>
        <td>: &nbsp;&nbsp;&nbsp;</td>
        <td>
            @if(Request::input('year'))
                {{ Request::input('year') }}
            @else
                -
            @endif
        </td>
    </tr>
    <tr>
        <th>Total Devisa Negara &nbsp;&nbsp;&nbsp;</th>
        <td>: &nbsp;&nbsp;&nbsp;</td>
        <td><?=  'Rp. ' . number_format($total, 2, ',', '.') ?></td>
    </tr>
</table>

<hr>

<table border="1" cellspacing="0" width="100%">
    <thead align="center">
    <tr>
        <th width="50px">No.</th>
        <th>Tahun</th>
        <th>Nama Ilmiah Spesies</th>
        <th>Nama Indonesia Spesies</th>
        <th>Nama Umum Spesies</th>
        <th>Total Ekspor</th>
        <th>Harga Patokan</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($species as $spec)
        <tr>
            <td>{{ (($species->currentPage() - 1 ) * $species->perPage() ) + $loop->iteration }}</td>
            <td>{{ $spec->year }}</td>
            <td><i>{{ $spec->species_scientific_name }}</i></td>
            <td>{{ $spec->species_indonesia_name }}</td>
            <td>{{ $spec->species_general_name }}</td>
            <td>{{ $spec->total_export }}</td>
            <td>Rp {{ number_format($spec->nominal,2,',','.') }}</td>
            <td>Rp {{ number_format($spec->total_export*$spec->nominal,2,',','.') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>