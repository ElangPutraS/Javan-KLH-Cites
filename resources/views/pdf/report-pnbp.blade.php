<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan PNBP</title>
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

@php $total = 0; @endphp
@foreach($payments as $pnbp)
@php $total = $total + $pnbp->total_payment; @endphp
@endforeach
<table>
    <tr>
        <th>Bulan</th>
        <td>:</td>
        <td>
            @if($month !== null)
            @switch($month)
            @case(1)
            {{ 'Januari' }}
            @break
            @case(2)
            {{ 'Februari' }}
            @break
            @case(3)
            {{ 'Maret' }}
            @break
            @case(4)
            {{ 'April' }}
            @break
            @case(5)
            {{ 'Mei' }}
            @break
            @case(6)
            {{ 'Juni' }}
            @break
            @case(7)
            {{ 'Juli' }}
            @break
            @case(8)
            {{ 'Agustus' }}
            @break
            @case(9)
            {{ 'September' }}
            @break
            @case(10)
            {{ 'Oktober' }}
            @break
            @case(11)
            {{ 'November' }}
            @break
            @case(12)
            {{ 'Desember' }}
            @break
            @default
            {{ 'Semua bulan' }}
            @break
            @endswitch
            @else
            {{ 'Semua Bulan' }}
            @endif
        </td>
    </tr>
    <tr>
        <th>Tahun</th>
        <td>:</td>
        <td>
            @if($year !== null)
            @if($year == 'all')
            {{ 'Semua Tahun' }}
            @else
            {{ $year }}
            @endif
            @else
            {{ 'Semua Tahun' }}
            @endif
        </td>
    </tr>
    <tr>
        <th>Total Pemasukan</th>
        <td>:</td>
        <td>{{ 'Rp. ' . number_format($total, 2, ',', '.') }}</td>
    </tr>
</table>

<table border="1" cellspacing="0" width="100%">
    <thead align="center">
    <tr>
        <th>No.</th>
        <th>Tanggal Pembayaran</th>
        <th>Kode Permohonan</th>
        <th>No. PNBP</th>
        <th>Perusahaan</th>
        <th width="150px">Masa Berlaku</th>
        <th>IHH</th>
        <th>EA-EB</th>
        <th>Jumlah</th>
    </tr>
    </thead>
    <tbody>
    @foreach($payments as $key => $pnbp)
        <tr>
            <td align="center">{{ (($payments->currentPage() - 1 ) * $payments->perPage() ) + $loop->iteration }}</td>
            <td align="center">{{ Carbon\Carbon::parse($pnbp->created_at)->format('d-m-Y') }}</td>
            <td align="center">{{ $pnbp->pnbp->tradePermit->trade_permit_code }}</td>
            <td align="center">{{ $pnbp->pnbp->pnbp_code }}</td>
            <td align="center">{{ $pnbp->pnbp->tradePermit->company->company_name }}</td>
            <td align="center">
                @foreach($trade_permits as $trade_permit)
                @if($pnbp->total_payment > 100000)
                @if($trade_permit->trade_permit_id == $pnbp->pnbp->trade_permit_id && $trade_permit->trade_permit_status_id == '8' && $trade_permit->permit_type == '1')
                {{ Carbon\Carbon::parse($trade_permit->valid_start)->format('d-m-Y') . ' sd. ' . Carbon\Carbon::parse($trade_permit->valid_until)->format('d-m-Y') }}
                @endif
                @else
                @if ($trade_permit->trade_permit_id == $pnbp->pnbp->trade_permit_id && $trade_permit->trade_permit_status_id == '8' && $trade_permit->permit_type == '2')
                {{ Carbon\Carbon::parse($trade_permit->valid_start)->format('d-m-Y') . ' sd. ' . Carbon\Carbon::parse($trade_permit->valid_until)->format('d-m-Y') }}
                @endif
                @endif
                @endforeach
            </td>
            <td align="right">
                @if($pnbp->total_payment > 100000)
                {{ 'Rp. ' . number_format($pnbp->total_payment - 100000, 2, ',', '.') }}
                @else
                {{ 'Rp. 0,00' }}
                @endif
            </td align="right">
            <td align="right"> Rp. {{ number_format(100000,2,',','.') }}</td>
            <td align="right"> Rp. {{ number_format($pnbp->total_payment,2,',','.') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>