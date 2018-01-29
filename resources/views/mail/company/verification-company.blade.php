@component('mail::message')
<div class="header">
    <img src="{{ asset('images/Lambang_Kementerian_Lingkungan_Hidup_dan_Kehutanan.png') }}" height="64" style="float: left;">
    <center><font style="font-size:16pt; font-weight: bold;"> E-SATSLN <br> Kementrian Lingkungan Hidup dan Kehutanan </font></center>
</div>

<div class="body">
    <br>
    Yth Bapak/Ibu dari perusahaan {{ $company['company_name'] }},<br><br>

    @if($company['company_status'] == 1)
        Pendaftaran akun Perusahaan Anda telah <font color="#228b22" style="font-weight: bold;">DITERIMA</font>.
        Akun Anda telah aktif, silahkan login sesuai email dan password saat registrasi. Terima kasih telah melakukan registrasi. <br><br>
    @else
        Pendaftaran akun Perusahaan Anda telah <font color="red" style="font-weight: bold;">DITOLAK</font>.
        Dengan alasan <b>{{ $company['reject_reason'] }}</b>. Silahkan melakukan registrasi ulang.<br><br>
    @endif

    Hormat kami,<br>
    Administrator E-SATSLN<br>
    Direktorat Konservasi Keanekaragaman Hayati<br>
    Kementrian Lingkungan Hidup dan Kehutanan<br>
    <a href="www.menlh.go.id"> www.menlh.go.id </a><br>
    Email ini dikirimkan secara otomatis oleh sistem, kami tidak melakukan pengecekan email yang dikirimkan ke email ini. Jika ada pertanyaan silahkan menghubungi +6221 8580067-68<br><br>
</div>

<div class="footer">
    <br><font size="3pt" style="font-weight: bold;">Disclaimer</font><br>
    <font size="1pt">
        Informasi yang disampaikan melalui email ini hanya diperuntukkan bagi pihak penerima sebagaimana dimaksud pada tujuan e-mail ini saja.
        E-mail ini dapat berisi informasi atau hal-hal yang secara hukum bersifat rahasia.
        Segala bentuk kajian, penyampaian kembali, penyebarluasan, penyediaan untuk dapat diakses, dan/atau penggunaan lain atau tindakan sejenis atas informasi ini oleh pihak baik orang maupun badan selain dari pihak
        yang dimaksud pada tujuan e-mail ini adalah dilarang dan dapat diancam sanksi sesuai dengan ketentuan yang berlaku.
        Jika karena suatu kesalahan Anda menesima informasi ini berharap menghubungi Direktorat Konservasi Keanekaragaman Hayati dan segera menghapus e-mail ini beserta setiap salinan dan seluruh lampirannya.
    </font>
</div>
@endcomponent
