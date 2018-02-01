<div style="width:900px; margin: 0 auto;">
    <div class="header" style="padding:20px 100px 20px 100px; background-color:#0c390e; color: #9d9d9d;">
        <img src="{{ asset('images/Lambang_Kementerian_Lingkungan_Hidup_dan_Kehutanan.png') }}" height="64" style="float: left;">
        <center><font style="font-size:16pt; font-weight: bold;"> E-SATSLN <br> Kementrian Lingkungan Hidup dan Kehutanan </font></center>
    </div>

    <div class="body" style="padding:20px 100px 20px 100px;">
        <br>Yth Bapak/Ibu dari perusahaan {{ $data['company_name'] }},<br><br>

        Berikut ini Tagihan SATS-LN dengan detail sebagai berikut.<br><br>
        <table border="0">
            <tr>
                <td style="padding: 3px;"> Kode SATSLN </td>
                <td style="padding: 3px;"> : </td>
                <td style="padding: 3px;"> {{ $data['trade_permit_code'] }} </td>
            </tr>
            <tr>
                <td style="padding: 3px;"> IHH </td>
                <td style="padding: 3px;"> : </td>
                <td style="padding: 3px;"> Rp @if($data['permit_type'] == '1') {{ number_format($data['pnbp_percentage'] + $data['pnbp_subAmount'],2,',','.') }} @else {{ number_format(0,2,',','.') }} @endif  </td>
            </tr>
            <tr>
                <td style="padding: 3px;"> Blanko </td>
                <td style="padding: 3px;"> : </td>
                <td style="padding: 3px;"> Rp {{ number_format($data['harga_blanko'],2,',','.') }} </td>
            </tr>
            <tr>
                <td style="padding: 3px; font-weight: bold;"> Total Tagihan</td>
                <td style="padding: 3px; font-weight: bold;"> : </td>
                <td style="padding: 3px; font-weight: bold;"> Rp {{ number_format($data['total_pnbp'],2,',','.') }} </td>
            </tr>
        </table> <br>
        Silahkan melakukan pembayaran ditempat atau melalui transfer ke rekening berikut [ ... ], untuk melunasi tagihan tersebut. Silahkan login aplikasi untuk melihat tagihan lebih lanjut.<br><br>

        Hormat kami,<br>
        Administrator E-SATSLN<br>
        Direktorat Konservasi Keanekaragaman Hayati<br>
        Kementrian Lingkungan Hidup dan Kehutanan<br>
        <a href="www.menlh.go.id"> www.menlh.go.id </a><br>
        Email ini dikirimkan secara otomatis oleh sistem, kami tidak melakukan pengecekan email yang dikirimkan ke email ini. Jika ada pertanyaan silahkan menghubungi +6221 8580067-68<br><br>
    </div>

    <div class="footer" style="width:auto; padding:20px 100px 20px 100px; background-color:#0c390e; color:#9d9d9d;">
        <font size="3pt" style="font-weight: bold;">Disclaimer</font><br>
        <font size="1pt">
            Informasi yang disampaikan melalui e-mail ini hanya diperuntukkan bagi pihak penerima sebagaimana dimaksud pada tujuan e-mail ini saja.
            E-mail ini dapat berisi informasi atau hal-hal yang secara hukum bersifat rahasia.
            Segala bentuk kajian, penyampaian kembali, penyebarluasan, penyediaan untuk dapat diakses, dan/atau penggunaan lain atau tindakan sejenis atas informasi ini oleh pihak baik orang maupun badan selain dari pihak
            yang dimaksud pada tujuan e-mail ini adalah dilarang dan dapat diancam sanksi sesuai dengan ketentuan yang berlaku.
            Jika karena suatu kesalahan Anda menerima informasi ini berharap menghubungi Direktorat Konservasi Keanekaragaman Hayati dan segera menghapus e-mail ini beserta setiap salinan dan seluruh lampirannya.
        </font>
    </div>
</div>

