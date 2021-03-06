<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Detail SATS-LN</title>
    <style type="text/css">
        * {
            font: 10px arial, calibri;
            margin: 0;
            padding: 0;
        }

        hr {
            margin: 10px 0;
        }

        .clearfix {
            clear: both;
        }

        #header {
            padding: 20px 50px;
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

        #content {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 10px;
            padding: 0 50px;
        }

        #content span:nth-child(1) {
            font-size: 10px;
            font-weight: bold;
        }

        #content #content-info {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        #content #content-footer {
            margin: 10px 0;
            text-align: left;
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

<div id="content">
    <div id="content-info">
        <span>SURAT	PERINTAH PEMBAYARAN PUNGUTAN PERDAGANGAN TUMBUHAN/SATWA LIAR</span>
        <br>
        <br>
        <span>Nomor: {{ $tradePermit->id }}</span>
        <br>
        <span>Periode Tanggal: {{ date('d F Y', strtotime($tradePermit->valid_start)) }}
            s/d {{ date('d F Y', strtotime($tradePermit->valid_until)) }}</span>
    </div>

    <div id="content-detail">
        <table>
            <tr>
                <td>Kode</td>
                <td>:</td>
                <td>{{ $tradePermit->trade_permit_code }}</td>
            </tr>

            <tr>
                <td>Nama Perusahaan</td>
                <td>:</td>
                <td>{{ $tradePermit->company->company_name }}</td>
            </tr>
            <tr>
                <td>Nomor SK/Tanggal</td>
                <td>:</td>
                <td>__________/{{ date('l, d F Y', strtotime($tradePermit->valid_start)) }}</td>
            </tr>
            <tr>
                <td>Nomor Seri</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td>Pelabuhan Tujuan</td>
                <td>:</td>
                <td>{{ $tradePermit->portDest->port_name }}</td>
            </tr>
        </table>

        <hr>

        <table border="1" cellspacing="0" width="100%">
            <thead align="center">
            <tr>
                <td>No.</td>
                <td>Nama Jenis</td>
                <td>Kuantiti</td>
                <td>Persentase (%)</td>
                <td>Nilai Persentase (Rp)</td>
                <td>Tarif (Rp)</td>
                <td>Jumlah Bayar (Rp)</td>
            </tr>
            </thead>

            <tbody>
            @foreach ($tradePermit->tradePermit->tradeSpecies as $value)
                @if($value->pivot->total_exported > 0)
                    @php
                        //$tradePermit->valid_renewal == $value->pivot->valid_renewal
                        $tradePermit2 = \App\TradePermit::where('id', '=', $value->pivot->trade_permit_id)->first();
                    @endphp
                    <tr>
                        <td align="center">{{ $loop->iteration }}</td>
                        <td>{{ $value->species_scientific_name }}</td>
                        <td align="center">{{ $value->pivot->total_exported }}</td>
                        <td align="center">
                            @if($tradePermit->permit_type == 1)
                                {{ $tradePermit2->pnbp->percentage_value }}
                                @elseif($tradePermit->permit_type == 2)
                            0
                            @endif
                        </td>
                        <td align="center">
                            @if($tradePermit->permit_type == 1)
                                {{ number_format($value->pivot->total_exported * ($value->nominal * ($tradePermit2->pnbp->percentage_value / 100)), 0, ',', '.') }}
                                @elseif($tradePermit->permit_type == 2)
                                0
                            @endif
                        </td>
                        <td align="right">
                            @if($tradePermit->permit_type == 1)
                                {{ number_format($value->nominal * $value->pivot->total_exported) }}
                                @elseif($tradePermit->permit_type == 2)
                            0
                                @endif
                        </td>
                        <td align="right">
                            @if($tradePermit->permit_type == 1)
                                {{ number_format(($value->nominal * $value->pivot->total_exported) + ($value->pivot->total_exported * ($value->nominal * ($tradePermit2->pnbp->percentage_value / 100)))) }}
                                @elseif($tradePermit->permit_type == 2)
                                0
                                @endif
                        </td>
                    </tr>
                    @php
                        $total[] = $value->nominal;
                        if ($tradePermit->permit_type == 1) {
                            $subtotal[] = ($value->nominal * $value->pivot->total_exported) + ($value->pivot->total_exported * ($value->nominal * ($tradePermit2->pnbp->percentage_value / 100)));
                        } elseif ($tradePermit->permit_type == 2) {
                            $subtotal[] = 0;
                        }
                        $total_exported[] = $value->pivot->total_exported;
                        $no = $loop->iteration + 1;
                    @endphp
                @endif
            @endforeach
            <tr>
                <td align="center"> {{ $no }} </td>
                <td colspan="4"> biaya blanko SATS-LN</td>
                <td align="right">{{ number_format($generalValueBlangko->value) }}</td>
                <td align="right">{{ number_format($generalValueBlangko->value) }}</td>
            </tr>
            @php
                $subtotal[] = $generalValueBlangko->value;
            @endphp
            <tr>
                <td colspan="6" align="center">JUMLAH</td>
                <td align="right">{{ number_format(array_sum($subtotal)) }}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <div id="content-footer">
        <p>Terbilang (dengan huruf):
            ...................................................................................................................................................................................................................................................</p>
        <br>
        <p>An. Direktur Jenderal PHKA<br><br>Pejabat Penagih<br><br><br><br>..........................<br>NIP</p>
        <br><br><br><br>
        <ul id="tembusan">
            Tembusan:
        </ul>
        <!--ul id="tembusan">
            Tembusan:
            <li>Direktur Jenderal</li>
            <li>Sekretaris Jenderal Kementerian Perhutanan</li>
            <li>Kepala UPT yang bersangkutan
        </ul>
        <br><br><br><br>
        <table border="0" width="100%">
            <tr>
                <td>Salinan sesuai dengan aslinya</td>
                <td>MENTERI KEHUTANAN</td>
            </tr>
            <tr>
                <td>KEPALA BIRO HUKUM DAN ORGANISASI</td>
                <td>REPUBLIK INDONESIA</td>
            </tr>
            <tr>
                <td height="50">TTD</td>
                <td>TTD</td>
            </tr>
            <tr>
                <td>KRISNA RYA</td>
                <td>SITI NURBAYA</td>
            </tr>
        </table-->
    </div>
</div>
</body>
</html>