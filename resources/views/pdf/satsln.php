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
		}

		hr {
			
		}
	</style>
</head>
<body>

<table border="1" cellspacing="0" style="margin: 10px;" width="80%">
	<tr>
		<td height="10">
			<div style="float: left; height: 64px;"><img src="<?= asset('images/CITES_logo_high_resolution.jpg') ?>" height="64"></div>
			<div style="float: right; height: 64px; width: 128px; text-align: center; font-size: 10px">CONVENTION ON INTERNATIONAL TRADE IN ENDANGERED SPECIES OF WILD FAUNA AND FLORA</div>
</td>
		<td style="text-align: center;"><img src="<?= asset('images/logo-garuda_acehdesain_grey.jpg') ?>" height="64"></td>
		<td>KEMENTERIAN LINGKUNGAN HIDUP DAN KEHUTANAN DIREKTORAT JENDERAL KONSERVASI SUMBER DAYA ALAM DAN EKOSISTEM<hr>MINISTRY OF ENVIRONMENT AND FORESTRY DIRECTORATE GENERAL OF ECOSYSTEM AND NATURAL RESOURCES CONSERVATION
</td>
		<td style="text-align: center;"><img src="<?= asset('images/logo-garuda_acehdesain_grey.jpg') ?>" height="64px"></td>
	</tr>

	<tr>
		<td colspan="4">
			<table>
				<tr>
					<td>Alamat<hr><i>Address</i></td>
					<td>:</td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td colspan="4">
			<table>
				<tr>
					<td width="10">I.</td>
					<td>Surat Angkut Tumbuhan dan Satwa Liar<hr><i>Permitt</i></td>
					<td>No. :</td>
					<td width="200">&nbsp;</td>
					<td>
						<table>
							<tr>
								<td>
									<label><input type="checkbox" name="trading_type">Export</label>
								</td>
								<td>
									<label><input type="checkbox" name="trading_type">Import</label>
								</td>
								<td>
									<label><input type="checkbox" name="trading_type">Re-Export</label>
								</td>
								<td>
									<label><input type="checkbox" name="trading_type">Other</label>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td colspan="4">
			<table>
				<tr>
					<td width="10">II.</td>
					<td>Diberikan Kepada (nama, alamat, negara)<hr><i>Permitee (name. address, country)</i></td>
					<td>:</td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td colspan="4">
			<table>
				<tr>
					<td width="10">III.</td>
					<td>Dikirim Kepada (nama, alamat, negara)<hr><i>Permitee (name. address, country)</i></td>
					<td>:</td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td width="50%" colspan="2">
			<table>
				<tr>
					<td width="10">IV.</td>
					<td>Berlaku sampai dengan<hr><i>Valid until</i></td>
					<td>:</td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td>

		<td width="50%" colspan="2">
			<table>
				<tr>
					<td width="10">V.</td>
					<td>Pelabuhan Tujuan<hr><i>Place Port of destination</i></td>
					<td>:</td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td width="50%" colspan="2">
			<table>
				<tr>
					<td width="10">VI.</td>
					<td>Pelabuhan Pemberangkatan<hr><i>Port exportation</i></td>
					<td>:</td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td>

		<td width="50%" colspan="2">
			<table>
				<tr>
					<td width="10">VII.</td>
					<td>Maksud transaksi<hr><i>Purpose of transaction</i></td>
					<td>:</td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td colspan="4">
			<table>
				<tr>
					<td width="10">VIII.</td>
					<td width="570" style="text-align: center;">Pemegang sertifikat ini diberi izin untuk mengekspor/mengimpor satwa dan tumbuhan sebagai berikut<hr><i>The above mentioned permitee is authorized to export/import the wild animals and plants specifiedhere order</i></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td colspan="4">
			<table border="1" cellspacing="0" width="100%" style="border: 0;">
				<tr style="text-align: center;">
					<td>No.</td>
					<td>Nama Jenis<hr>Name of species<br>(Scientific, Name, Indonesia, Common)</td>
					<td>Jumlah<hr>Quantity</td>
					<td>Kelamin dan keterangan lain tentang spesimen<hr>Sex and or other description of specimens</td>
					<td>Appendiks<br>(Sumber)<hr>Appendices<br>(Source)</td>
					<td>Jumlah yang telah dikirim/kuota (Tahun)<hr>Total exported/Quota (Year)</td>
				</tr>

				<?php for ($i = 1; $i < 12; $i++) { ?>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<?php } ?>
			</table>
		</td>
	</tr>

	<tr>
		<td colspan="4">
			<table width="100%">
				<tr>
					<td>IX.</td>
					<td>Syarat khusus<hr><i>Special conditions</i></td>
					<td>:</td>
					<td>Tidak sah apabila ada coretan/koreksi: Untuk satwa hidup, hanya berlaku apabila pengangkutanya sesuai dengan peraturan sesuai dengan peraturan IATA untuk satu kali pengiriman<hr>Not valid for any correction: For live animals this permit is only valid if the transport conditions confrom to the guidelines for transport of live animals, or IATA regulation and valid for one shipment only</td>
				</tr>
				<tr>
					<td colspan="4" height="32">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td colspan="2">
			<table width="100%">
				<tr>
					<td>X.</td>
					<td>Sertifikat ini diterbitkan oleh<hr><i>This permitt is issued by</i><br>Tempat/<i>Place</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal/<i>Date</i></td>
				</tr>
			</table>
		</td>

		<td colspan="2">
			<table>
				<tr>
					<td>ATAS NAMA DIREKTUR JENDERAL KONSERVASI SUMBER DAYA ALAM DAN EKOSISTEM<hr><i>FOR THE DIRECTOR GENERAL OF ECOSYSTEM AND NATURAL RESOURCES CONSERVATION</i></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td colspan="2">
			<table>
				<tr>
					<td>XI. Diisi oleh petugas pemeriksa pengiriman<hr>To be completed by official who inspect the shipment</td>
				</tr>
				<tr>
					<td>
						<table>
							<tr>
								<td colspan="2">Lihat kolom jenis/See column of species</td>
							</tr>
							<tr>
								<td>No.</td>
								<td>Jumlah/Quantity</td>
							</tr>
							<tr>
								<td>1.</td>
							</tr>
							<tr>
								<td>2.</td>
							</tr>
							<tr>
								<td>3.</td>
							</tr>
							<tr>
								<td>4.</td>
							</tr>
							<tr>
								<td>5.</td>
							</tr>
							<tr>
								<td>6.</td>
							</tr>
							<tr>
								<td>7.</td>
							</tr>
							<tr>
								<td>8.</td>
							</tr>
							<tr>
								<td>9.</td>
							</tr>
							<tr>
								<td>10.</td>
							</tr>
							<tr>
								<td>11.</td>
							</tr>
							<tr>
								<td>12.</td>
							</tr>
						</table>
					</td>

					<td>
						<table>
							<tr>
								<td>No. Bukti Pengiriman<hr>Bill of Ladding (Airway bill number)</td>
								<td>:</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>Tanggal<hr>Date</td>
								<td>:</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>Pelabuhan pemberangkatan<hr>Port of exportation</td>
								<td>:</td>
								<td>&nbsp;</td>
							</tr>
						</table>	
					</td>
				</tr>
			</table>
		</td>

		<td colspan="2">
			<table>
				<tr>
					<td colspan="3">XII. Pembaharuan<hr>Renewal</td>
				</tr>
				<tr>
					<td>Berlaku sampai dengan<hr>Valid until</td>
					<td>:</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>Dikirim kepada (nama, alamat, negara)<hr>Consignee (name, address, country)</td>
					<td>:</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>Pelabuhan pemberangkatan<hr>Port of exportation</td>
					<td>:</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>Pelabuhan tujuan<hr>Port of destination</td>
					<td>:</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>Tanggal<hr>Date</td>
					<td>:</td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

</body>
</html>