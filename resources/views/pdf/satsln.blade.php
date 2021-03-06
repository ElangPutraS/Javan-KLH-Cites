<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>SATS-LN</title>
    <style type="text/css">
        * {
            font: 10px arial, calibri;
            margin: 0;
            padding: 0;
            color: white;
        }
        hr{
            border: transparent;
        }

        .colored{
            color : black;
            font-size: 8pt;
            padding-top: 0px;
        }

        .header td{
            font-size: 6pt;
        }

        .bottom-page tr td{
            vertical-align: top;
        }
    </style>
</head>
<body>

<table border="0" cellspacing="0" style="margin: 28px 10px 0px 10px;" width="80%">
<!--tr>
		<td height="10">
			<div style="float: left; height: 64px;"><img src="{{ asset('images/CITES_logo_high_resolution.jpg') }}" height="64"></div>
			<div style="float: right; height: 64px; width: 128px; text-align: center; font-size: 10px">CONVENTION ON INTERNATIONAL TRADE IN ENDANGERED SPECIES OF WILD FAUNA AND FLORA</div>
</td>
		<td style="text-align: center;"><img src="{{ asset('images/logo-garuda_acehdesain_grey.jpg') }}" height="64"></td>
		<td>KEMENTERIAN LINGKUNGAN HIDUP DAN KEHUTANAN DIREKTORAT JENDERAL KONSERVASI SUMBER DAYA ALAM DAN EKOSISTEM<hr>MINISTRY OF ENVIRONMENT AND FORESTRY DIRECTORATE GENERAL OF ECOSYSTEM AND NATURAL RESOURCES CONSERVATION
</td>
		<td style="text-align: center;"><img src="{{ asset('images/logo-garuda_acehdesain_grey.jpg') }}" height="64px"></td>
	</tr-->

    <tr>
        <td colspan="2" style="text-align: center;">
            CONVENTION ON INTERNATIONAL TRADE IN ENDANGERED SPECIES OF WILD FAUNA AND FLORA
        </td>
        <td colspan="2" style="text-align: center;">
            KEMENTERIAN LINGKUNGAN HIDUP DAN KEHUTANAN DIREKTORAT JENDERAL KONSERVASI SUMBER DAYA ALAM DAN EKOSISTEM
            <hr>
            MINISTRY OF ENVIRONMENT AND FORESTRY DIRECTORATE GENERAL OF ECOSYSTEM AND NATURAL RESOURCES CONSERVATION
            <br>
            <br>
        </td>
    </tr>

    <tr>
        <td colspan="4">
            <table>
                <tr>
                    <td style="font-size: 5pt">Alamat
                        <hr>
                        <i style="font-size: 5pt">Address</i></td>
                    <td>:</td>
                    <td style="font-size: 5pt">Manggala Wanabhakti, Blok-VII Lt. 7 Jl. Gatot Subroto Jakarta 10270 Telp. (62-21) 5720227,
                        5704501-04 Ext. 769, Fax. (62-21) 5720227, 5734818 <br><i style="font-size: 5pt">e-mail: subdittp.ditkkh@gmail.com</i></td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td colspan="4">
            <table>
                <tr>
                    <td width="10">I.</td>
                    <td width="50">Surat Angkut Tumbuhan dan Satwa Liar
                        <hr>
                        <i>Permit</i>
                    </td>
                    <td>No. :</td>
                    <td style="font-weight: bold; font-family: Calibri; font-size: 10pt;" class="colored"
                        width="232"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @if($trade_permit->permit_type == 1 || $trade_permit->is_blanko == 1){{ $trade_permit->trade_permit_code }}  @else @endif </td>
                    <td width="140">
                        <table>
                            <tr>
                                @if($trade_permit->permit_type == 1 || $trade_permit->is_blanko == 1)
                                    <td class="colored" align="left" width="38">
                                        @if($trade_permit->trading_type_id == 2)
                                            x
                                        @endif
                                        <span>Export </span></td>
                                    <td class="colored" align="left" width="38">
                                        @if($trade_permit->trading_type_id == 1)
                                            x
                                        @endif
                                        <span>Import </span>
                                    </td>
                                    <td class="colored" align="left" width="38">
                                        @if($trade_permit->trading_type_id == 4)
                                            x
                                        @endif
                                        <span>Re-export </span>
                                    </td>
                                    <td class="colored" align="left" width="38">
                                        @if($trade_permit->trading_type_id == 3)
                                            x
                                        @endif
                                        <span>Others </span>
                                    </td>
                                @endif
                            </tr>
                        </table>
                    </td>
                <!--td class="colored" >@if($trade_permit->permit_type == 1 || $trade_permit->is_blanko == 1) {{ $trade_permit->tradingType->trading_type_name }} @else @endif</td-->
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td colspan="4">
            <table>
                <tr>
                    <td width="10">II.</td>
                    <td>Diberikan Kepada (nama, alamat, negara)
                        <hr>
                        <i>Permitee (name. address, country)</i></td>
                    <td>:</td>
                    <td style="font-family: Calibri;" class="colored"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @if($trade_permit->permit_type == 1 || $trade_permit->is_blanko == 1){{ $trade_permit->company->company_name . ' - ' . $trade_permit->company->company_address }} @else @endif</td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td colspan="4">
            <table>
                <tr>
                    <td width="10">III.</td>
                    <td>Dikirim Kepada (nama, alamat, negara)
                        <hr>
                        <i>Permitee (name. address, country)</i></td>
                    <td>:</td>
                    <td style="font-family: Calibri;" class="colored"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @if($trade_permit->permit_type == 1 || $trade_permit->is_blanko == 1){{ $trade_permit->consignee . ' , ' . $trade_permit->consignee_address }} @else @endif</td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td width="50%" colspan="2">
            <table>
                <tr>
                    <td width="10">IV.</td>
                    <td>Berlaku sampai dengan
                        <hr>
                        <i>Valid until</i></td>
                    <td>:</td>
                    <td style="font-family: Calibri;" class="colored"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @if($trade_permit->permit_type == 1 || $trade_permit->is_blanko == 1) {{ Carbon\Carbon::parse($trade_permit->valid_until)->format('d F Y') }} @endif</td>
                </tr>
            </table>
        </td>

        <td width="50%" colspan="2">
            <table>
                <tr>
                    <td width="10">V.</td>
                    <td>Pelabuhan Tujuan
                        <hr>
                        <i>Place Port of destination</i></td>
                    <td>:</td>
                    <td style="font-family: Calibri;" class="colored"> @if($trade_permit->permit_type == 1 || $trade_permit->is_blanko == 1) {{ $trade_permit->portDest->port_name }} @else @endif</td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td width="50%" colspan="2">
            <table>
                <tr>
                    <td width="10">VI.</td>
                    <td>Pelabuhan Pemberangkatan
                        <hr>
                        <i>Port exportation</i></td>
                    <td>:</td>
                    <td style="font-family: Calibri;" class="colored"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @if($trade_permit->permit_type == 1 || $trade_permit->is_blanko == 1) {{ $trade_permit->portExpor->port_name }} @else @endif</td>
                </tr>
            </table>
        </td>

        <td width="50%" colspan="2">
            <table>
                <tr>
                    <td width="10">VII.</td>
                    <td>Maksud transaksi
                        <hr>
                        <i>Purpose of transaction</i></td>
                    <td>:</td>
                    <td style="font-family: Calibri;" class="colored"> @if($trade_permit->permit_type == 1 || $trade_permit->is_blanko == 1){{ $trade_permit->purposeType->purpose_type_name }} @else @endif </td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td colspan="4">
            <table>
                <tr>
                    <td width="10" style="font-size: 5pt;">VIII.</td>
                    <td width="570" style="text-align: center; font-size: 5pt;" >Pemegang sertifikat ini diberi izin untuk
                        mengekspor/mengimpor satwa dan tumbuhan sebagai berikut
                        <hr>
                        <i style="font-size: 5pt;">The above mentioned permitee is authorized to export/import the wild animals and plants
                            specified here order</i></td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td colspan="4">
            <table width="100%">
                <tr style="text-align: center;" class="header">
                    <td width="2%">No.</td>
                    <td width="15%">Nama Jenis
                        <hr>
                        Name of species<br>(Scientific, Name, Indonesia, Common)
                    </td>
                    <td width="8%">Jumlah
                        <hr>
                        Quantity
                    </td>
                    <td width="6%">Kelamin dan keterangan lain tentang spesimen
                        <hr>
                        Sex and or other description of specimens
                    </td>
                    <td width="5%">Appendiks<br>(Sumber)
                        <hr>
                        Appendices<br>(Source)
                    </td>
                    <td width="10%">Jumlah yang telah dikirim/kuota (Tahun)
                        <hr>
                        Total exported/Quota (Year)
                    </td>
                </tr>
                @php
                    //dd($trade_permit_detail);
                @endphp

                @if($trade_permit->permit_type == 1 || $trade_permit->permit_type == 2 && $trade_permit->is_blanko == 1)
                    @foreach($trade_permit->tradeSpecies->groupBy('id') as $value)
                        @php
                            $companyQuota = $value[0]->companyQuota->first()->pivot->where([['year', '=', Carbon\Carbon::parse($trade_permit->date_submission)->format('Y')], ['company_id', '=', $trade_permit->company_id], ['species_id', '=', $value[0]->id]])->first();
                        @endphp

                        @if($value[0]->pivot->total_exported > 0)
                            <tr>
                                <td style="font-family: Calibri; font-size: 8pt;" class="colored" align="center">{{ $loop->iteration }}</td>
                                <td style="font-family: Calibri; font-size: 8pt;" class="colored"> &nbsp;&nbsp; {{ $value[0]->species_scientific_name }}</td>
                                <td style="font-family: Calibri; font-size: 8pt;" class="colored" align="center"> &nbsp;&nbsp; {{ $value[0]->pivot->where([['species_id', $value[0]->id], ['trade_permit_id', $trade_permit->id]])->sum('total_exported') }} {{ $value[0]->unit->unit_description }}</td>
                                <td style="font-family: Calibri; font-size: 8pt;" class="colored" align="center">{{ $value[0]->species_description }}</td>
                                <td style="font-family: Calibri; font-size: 8pt;" class="colored" align="center">
                                    @if($value[0]->is_appendix == 1)
                                        @if($value[0]->appendixSource->id == 1)
                                            {{'I'. '(' . $value[0]->source->source_code . ')'}}
                                        @elseif($value[0]->appendixSource->id == 2)
                                            {{'II'. '(' . $value[0]->source->source_code . ')'}}
                                        @else
                                            {{'-'. '(' . $value[0]->source->source_code . ')'}}
                                        @endif
                                    @else
                                        {{ '-' }}
                                    @endif
                                </td>
                                <td style="font-family: Calibri; font-size: 8pt;" class="colored"
                                    align="center">{{ $value[0]->pivot->total_exported . '/' . $companyQuota->quota_amount . ' (' . $value[0]->pivot->year . ')' }}</td>
                            </tr>
                        @endif
                    @endforeach
                        <tr>
                            <td colspan="4" class="colored">----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="colored" align="right" >T O T A L</td>
                            <td class="colored" align="center">{{ $value[0]->pivot->where('trade_permit_id', $trade_permit->id)->sum('total_exported') }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="colored">----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                            </td>
                        </tr>

                @else
                    @for($i=0; $i<6 ; $i++)
                        <tr>
                            <td><br></td>
                        </tr>
                    @endfor
                @endif

                    @for($i=1; $i<(17 - count($trade_permit->tradeSpecies->groupBy('id')) ); $i++)
                        <tr>
                            <td><br></td>
                        </tr>
                    @endfor

            </table>
        </td>
    <tr>
        <td colspan="4">
            <table width="100%">
                <tr>
                    <td>IX.</td>
                    <td>Syarat khusus
                        <hr>
                        <i>Special conditions</i></td>
                    <td>:</td>
                    <td>Tidak sah apabila ada coretan/koreksi: Untuk satwa hidup, hanya berlaku apabila pengangkutanya
                        sesuai dengan peraturan sesuai dengan peraturan IATA untuk satu kali pengiriman
                        <hr>
                        Not valid for any correction: For live animals this permit is only valid if the transport
                        conditions confrom to the guidelines for transport of live animals, or IATA regulation and valid
                        for one shipment only
                    </td>
                </tr>
                <tr>
                    <td style="font-family: Calibri; font-size: 8pt;" colspan="4" height="32" align="center" class="colored">
                        @if($trade_permit->permit_type == 1 || $trade_permit->is_blanko == 1) {{ 'Security Stamp No: '.$trade_permit->stamp }} @else @endif
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td colspan="2" style="border: none;">
            <table width="100%">
                <tr>
                    <td valign="top">X.</td>
                    <td>
                        <u>Sertifikat ini diterbitkan oleh</u>
                        <br>
                        <i>This permitt is issued by</i><br><br><br><br><br><br><br>
                        <table>
                            <tr>
                                <td width="20px"><br></td>
                                <td width="30px"><br></td>
                                <td width="80px" align="left">
                                    @if($trade_permit->permit_type == 1 || $trade_permit->is_blanko == 1)
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <p class="colored">Jakarta</p>
                                    @endif
                                    Tempat/<i>Place</i>
                                </td>
                                <td align="right">
                                    &nbsp;&nbsp;<p class="colored">
                                        @if($trade_permit->permit_type == 1 || $trade_permit->is_blanko == 1 )
                                            {{ Carbon\Carbon::now()->format('d/m/Y') }}
                                        @endif
                                    </p>Tanggal/<i>Date</i>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>

        <td colspan="2" style="border: none">
            <table width="85%" style="float: right;">
                <tr>
                    <td align="center">
                        ATAS NAMA DIREKTUR JENDERAL KONSERVASI SUMBER DAYA ALAM DAN EKOSISTEM
                        <hr>
                        <i>FOR THE DIRECTOR GENERAL OF ECOSYSTEM AND NATURAL RESOURCES CONSERVATION</i>
                        <br><br><br><br><br><br>
                        <font class="colored">
                            @if ( $trade_permit->permit_type == 1 || $trade_permit->is_blanko == 1 )
                                {{ strtoupper(auth()->user()->name) }}
                            @endif
                        </font>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td height="10px"></td>
    </tr>
    <tr>
        <td width="50%" colspan="2">
            <table class="text-centered">
                <tr>
                    <td width="10" style="font-size: 6pt;">IX.</td>
                    <td style="font-size: 6pt;">Diisi oleh petugas pemeriksa pengiriman
                        <hr>
                        <i style="font-size: 6pt;">To be completed by official who inspect the shipment</i></td>
                </tr>
            </table>
        </td>

        <td width="50%" colspan="2">
            <table>
                <tr>
                    <td colspan="3" style="font-size: 6pt;">XII. Pembaharuan
                        <hr>
                        Renewal
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <table>
                <tr>
                    <td>
                        <table cellspacing="0">
                            <thead align="center">
                            <tr>
                                <th colspan="2">Lihat kolom jenis/See column of species</th>
                            </tr>
                            <tr>
                                <th>No.</th>
                                <th>Jumlah/Quantity</th>
                            </tr>
                            </thead>

                            <tbody>
                            @for($i = 1; $i <= 12; $i++)
                                <tr>
                                    <td align="center">{{ $i }}</td>
                                    <td align="center"></td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </td>

                    <td>
                        <table width="100%">
                            <tr>
                                <td>No. Bukti Pengiriman
                                    <hr>
                                    Bill of Ladding (Airway bill number)
                                </td>
                                <td>:</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Tanggal
                                    <hr>
                                    Date
                                </td>
                                <td>:</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Pelabuhan pemberangkatan
                                    <hr>
                                    Port of exportation
                                </td>
                                <td>:</td>
                                <td></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td></td>

                    <td>
                        <table cellspacing="10">
                            <tr>
                                <td>
                                    <center>Cap
                                        <hr>
                                        official stamp
                                    </center>
                                </td>
                                <td></td>
                                <td>
                                    <center>Tanda Tangan
                                        <hr>
                                        Signature
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
            </table>
        </td>

        <td colspan="2">
            <table style="font-size: 10px" width="100%" class="bottom-page">
                <tr>
                    <td width="45%"><br>Berlaku sampai dengan
                        <hr>
                        Valid until<br><br>
                    </td>
                    <td width="5%"><br>:</td>
                    <td width="35%" style="font-family: Calibri; font-size: 8pt;" class="colored"> <br>@if($trade_permit->permit_type == 2 && $trade_permit->is_blanko == 0) {{ Carbon\Carbon::parse($trade_permit->valid_until)->format('d F Y') }}
                         @endif</td>
                    <td width="15%"></td>
                </tr>
                <tr>
                    <td>Dikirim kepada (nama, alamat, negara)
                        <hr>
                        Consignee (name, address, country)<br><br><br><br><br>
                    </td>
                    <td>:</td>
                    <td style="font-family: Calibri; font-size: 8pt;" class="colored" >@if($trade_permit->permit_type == 2 && $trade_permit->is_blanko == 0) {{ $trade_permit->consignee. ' , ' . $trade_permit->consignee_address }} @else @endif
                        </td>
                    <td width="20%"></td>
                </tr>
                <tr>
                    <td>Pelabuhan pemberangkatan
                        <hr>
                        Port of exportation<br><br><br>
                    </td>
                    <td>:</td>
                    <td style="font-family: Calibri; font-size: 8pt;" class="colored">@if($trade_permit->permit_type == 2 && $trade_permit->is_blanko == 0) {{ $trade_permit->portExpor->port_name }} @else @endif
                        </td>
                    <td width="20%"></td>
                </tr>
                <tr>
                    <td>Pelabuhan tujuan
                        <hr>
                        Port of destination<br><br>
                    </td>
                    <td>:</td>
                    <td style="font-family: Calibri; font-size: 8pt;" class="colored">@if($trade_permit->permit_type == 2 && $trade_permit->is_blanko == 0) {{ $trade_permit->portDest->port_name }} @else @endif
                        </td>
                    <td width="20%"></td>
                </tr>
                <tr>
                    <td>Tanggal
                        <hr>
                        Date
                    </td>
                    <td>:</td>
                    <td style="font-family: Calibri; font-size: 8pt;" class="colored">@if($trade_permit->permit_type == 2 && $trade_permit->is_blanko == 0) {{ Carbon\Carbon::parse($trade_permit->valid_start)->format('d F Y') }} @else @endif
                        </td>
                    <td width="20%"></td>
                </tr>
                <tr>
                    <td></td>

                    <td colspan="3">
                        <table cellspacing="25">
                            <tr>
                                <td>
                                    <center>Cap
                                        <hr>
                                        Official stamp
                                    </center>
                                </td>
                                <td>
                                    <center>Tanda Tangan
                                        <hr>
                                        Signature
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
            </table>
        </td>
    </tr>


</table>

</body>
</html>