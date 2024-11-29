<?php

function tanggal_indo($tanggal){
	// format bulan
	$bulan = [
		'01'=>'januari',
		'02'=>'februari',
		'03'=> 'maret',
		'04'=> 'april',
		'05'=>'mei',
		'06'=> 'juni',
		'07'=> 'juli',
		'08'=> 'agustus',
		'09'=>'september',
		'10'=>'oktober',
		'11'=>'november',
		'12'=>'desember'];


		// format hari
		$hari = [
			'Sun'=>'minggu',
			'Mon'=>'senin',
			'Tue'=> 'selasa',
			'Wed'=> 'rabu',
			'Thu'=>'kamis',
			'Fri'=> 'jumat',
			'Sat'=> 'sabtu'
		];


		// hari 
		// pecah menggunakan
			$pecah = explode(" ",$tanggal);

			$tanggal = $pecah[0];
			$jam = $pecah[1];

			$nama_hari = date('D',strtotime($tanggal));
			$nama_tanggal = date('d',strtotime($tanggal));
			$nama_bulan = date('m',strtotime($tanggal));
			$nama_tahun = date('Y',strtotime($tanggal));

			$output = $hari[$nama_hari].",".$nama_tanggal." ".$bulan[$nama_bulan]." ".$nama_tahun." ".date('H:i',strtotime($jam));



			return $output;

		}


		?>
