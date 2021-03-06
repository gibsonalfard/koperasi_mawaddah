<div class="main-dash">
	<?php
	$query = $mysqli->query("SELECT b.id_barang,p.id_pengajuan,p.pengaju,p.tgl_pengajuan,a.nama,b.nama brg,
							k.kategori_barang,b.perkiraan_harga,a.alamat,j.nama_pekerjaan,
							a.gaji_perbulan,p.jml_angsur,p.peruntukan,b.spesifikasi,b.gambar FROM tbl_pengajuan p 
							INNER JOIN tbl_anggota a ON(a.nik = p.pengaju)
							INNER JOIN tbl_barang b ON(b.id_barang = p.barang)
							INNER JOIN tbl_kategori_barang k ON(b.kategori = k.id_kategori)
							INNER JOIN tbl_pekerjaan j ON(j.id_pekerjaan = a.pekerjaan)
							WHERE p.id_pengajuan = $_GET[p]");

	if($record = $query->fetch_array()){
		$tgl = date("d F Y", strtotime($record['tgl_pengajuan']));
		$perkiraan = number_format($record['perkiraan_harga'],0,",",".");
		$gaji = number_format($record['gaji_perbulan'],0,",",".");
		echo"
		<!--- MAIN CONTENT HERE -->
		<div class='main-content'>
			<div class='main-title'>
				<h2>Konfirmasi Barang</h2>
			</div>
			<div class='content-small green'><h3 class='content-title'><img src='../img/clipboard.svg' class='menu-icon' style='width:20px;'>Form Konfirmasi Barang</h3>
			<div class='content'>
					<form action='../proses/konfirmasi' method='post' enctype='multipart/form-data' >
						<label class='label-form'>ID Pengajuan</label>
							<br/>
								<input type='hidden' id='id' name='id' value='$record[id_pengajuan]'>
								<input type='text' id='t_id' name='t_id' value='$record[id_pengajuan]' disabled class='form-dash'>
							<br/>
						<label class='label-form'>NIK Pengaju</label>
							<br/>
								<input type='text' id='t_nik' name='t_nik' value='$record[pengaju]' disabled class='form-dash'>
							<br/>
						<label class='label-form'>Nama Pengaju</label>
							<br/>
								<input type='text' id='t_nama' name='t_nama' value='$record[nama]' disabled class='form-dash'>
							<br/>
						<label class='label-form'>Nama Barang</label>
							<br/>
								<input type='text' id='t_barang' name='t_barang' value='$record[brg]' disabled class='form-dash'>
							<br/>
						<label class='label-form'>Perkiraan Harga Barang</label>
							<div class='group'>
								<span class='group-tul'>Rp</span>
								<input type='text' class='form-dash' name='t_perkiraan' id='t_perkiraan' value='$perkiraan' disabled>
							</div>
							<br/>
						<label class='label-form'>Harga Asli Barang<label class='red-color'> *</label></label>
							<div class='group'>
								<span class='group-tul'>Rp</span>
								<input type='text' class='form-dash' name='realPrice' id='realPrice' placeholder='Harga Asli' maxlength='20' onkeypress='return isNumber(event)' onchange='hargaSetelahTambahan(this)'required>
							</div>
							<br/>
						<label class='label-form' style='float:right'><small><label class='red-color'>*</label>) Wajib diisi</small></label><br/>

						<input type='hidden' id='angsuran' name='angsuran' value='$record[jml_angsur]'>
						<input type='submit' value='Konfirmasi Barang' class='dash-button-blue' style='margin-top:10px;'/>
					</form>

				</div>
			</div>
			<div class='content-semi-big grey'>
				<h3 class='content-title'><img src='../img/edit.svg' class='menu-icon' style='width:20px;'>Info Barang (ID = $record[id_barang])</h3>
				<div class='content content-aju'>
					<div class='konf-det bg-img'>
						<img src='../img/barang/$record[gambar]' class='aju-img'/>
					</div>
					<div class='konf-det'>
						<table>
							<tr><td>NIK</td><td>:</td><td>$record[pengaju]</td></tr>
							<tr><td>Tanggal Pengajuan</td><td>:</td><td>$tgl</td></tr>
							<tr><td>Nama Pengaju</td><td>:</td><td>$record[nama]</td></tr>
							<tr><td>Alamat</td><td>:</td><td>$record[alamat]</td></tr>
							<tr><td>Pekerjaan</td><td>:</td><td>$record[nama_pekerjaan]</td></tr>
							<tr class='batas'><td>Gaji/bulan</td><td>:</td><td>Rp$gaji</td></tr>
							<tr><td>Nama Barang</td><td>:</td><td>$record[brg]</td></tr>
							<tr><td>Kategori</td><td>:</td><td>$record[kategori_barang]</td></tr>
							<tr><td>Harga</td><td>:</td><td id='tambahan'>Rp$perkiraan</td></tr>
							<tr><td>Banyak Angsuran</td><td>:</td><td>$record[jml_angsur] kali</td></tr>
						</table>
					</div>
					<div class='konf-det-2'>
						Spesifikasi Barang :
						<p>$record[spesifikasi]</p>
					</div>
					<div class='konf-det-2'>
						Peruntukan Barang :
						<p>$record[peruntukan]</p>
					</div>
					<div class='clear'></div>
				</div>
			</div>
			<div class='clear'></div>
		</div>
		<!--- END HERE -->";
	}
	?>
	<div class="clear"></div>
</div>