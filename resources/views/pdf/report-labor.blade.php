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
foreach ($users as $user) {
    $total = $total + $user->company->labor_total;
}
?>
<table>
    <tr>
        <th>Tanggal Pendaftaran dari&nbsp;&nbsp;&nbsp;</th>
        <td>: &nbsp;&nbsp;&nbsp;</td>
        <td>
            @if(Request::input('date_from'))
                {{ Carbon\Carbon::createFromFormat('Y-m-d', request()->input('date_from'))->toFormattedDateString() }}
            @else
                -
            @endif
        </td>
    </tr>
    <tr>
        <th>Tanggal Pendaftaran sampai &nbsp;&nbsp;&nbsp;</th>
        <td>: &nbsp;&nbsp;&nbsp;</td>
        <td>
            @if(Request::input('date_until'))
                {{ Carbon\Carbon::createFromFormat('Y-m-d', request()->input('date_until'))->toFormattedDateString() }}
            @else
                -
            @endif
        </td>
    </tr>
    <tr>
        <th>Total Serapan Tenaga Kerja &nbsp;&nbsp;&nbsp;</th>
        <td>: &nbsp;&nbsp;&nbsp;</td>
        <td>{{ $total }} orang</td>
    </tr>
</table>

<hr>

<table border="1" cellspacing="0" width="100%">
    <thead align="center">
    <tr>
        <th width="50px">No.</th>
        <th>Tanggal Pendaftaran</th>
        <th>Nama Perusahaan</th>
        <th>Nama Pemilik Usaha</th>
        <th>Jumlah Serapan Tenaga Kerja</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ (($users->currentPage() - 1 ) * $users->perPage() ) + $loop->iteration }}</td>
            <td>{{ $user->company->created_at->toFormattedDateString() }}</td>
            <td>{{ $user->company->company_name }}</td>
            <td>{{ $user->company->owner_name }}</td>
            <td>{{ $user->company->labor_total }} orang</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>