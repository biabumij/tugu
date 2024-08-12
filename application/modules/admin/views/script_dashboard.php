<?php
function tgl_indo($date_minggu_1_awal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $date_minggu_1_awal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

$date_now = date('Y-m-d');
$date_juni24_awal = date('2024-06-01');
$date_juni24_akhir = date('2024-06-30');
$date_juli24_awal = date('2024-07-01');
$date_juli24_akhir = date('2024-07-31');
$date_agustus24_awal = date('2024-08-01');
$date_agustus24_akhir = date('2024-08-31');
$date_september24_awal = date('2024-09-01');
$date_september24_akhir = date('2024-09-30');
$date_oktober24_awal = date('2024-10-01');
$date_oktober24_akhir = date('2024-10-31');
$date_november24_awal = date('2024-11-01');
$date_november24_akhir = date('2024-11-30');
$date_desember24_awal = date('2024-12-01');
$date_desember24_akhir = date('2024-12-31');
$date_akumulasi_awal = date('2024-01-01');
$date_akumulasi_akhir = date('2024-12-31');

//REALISASI PRODUKSI
//JUNI24
$rak_juni24 = $this->db->select('(r.vol_produk_a + r.vol_produk_b + r.vol_produk_c + r.vol_produk_d + r.vol_produk_e + r.vol_produk_f) as total_produksi')
->from('rak r')
->where("r.tanggal_rencana_kerja between '$date_juni24_awal' and '$date_juni24_akhir'")
->get()->row_array();
$rencana_produksi_juni24 = $rak_juni24['total_produksi'];

$penjualan_juni24 = $this->db->select('p.nama, pp.client_id, SUM(pp.display_price) as price, SUM(pp.display_volume) as volume, pp.convert_measure as measure')
->from('pmm_productions pp')
->join('penerima p', 'pp.client_id = p.id','left')
->join('pmm_sales_po ppo', 'pp.salesPo_id = ppo.id','left')
->where("pp.date_production between '$date_juni24_awal' and '$date_juni24_akhir'")
->where("pp.status = 'PUBLISH'")
->where("ppo.status in ('OPEN','CLOSED')")
->group_by("pp.client_id")
->get()->result_array();
$total_volume_penjualan_juni24 = 0;
foreach ($penjualan_juni24 as $x){
    $total_volume_penjualan_juni24 += $x['volume'];
}
$realisasi_produksi_juni24 = $total_volume_penjualan_juni24;

//JULI24
$rak_juli24 = $this->db->select('(r.vol_produk_a + r.vol_produk_b + r.vol_produk_c + r.vol_produk_d + r.vol_produk_e + r.vol_produk_f) as total_produksi')
->from('rak r')
->where("r.tanggal_rencana_kerja between '$date_juli24_awal' and '$date_juli24_akhir'")
->get()->row_array();
$rencana_produksi_juli24 = $rak_juli24['total_produksi'];

$penjualan_juli24 = $this->db->select('p.nama, pp.client_id, SUM(pp.display_price) as price, SUM(pp.display_volume) as volume, pp.convert_measure as measure')
->from('pmm_productions pp')
->join('penerima p', 'pp.client_id = p.id','left')
->join('pmm_sales_po ppo', 'pp.salesPo_id = ppo.id','left')
->where("pp.date_production between '$date_juli24_awal' and '$date_juli24_akhir'")
->where("pp.status = 'PUBLISH'")
->where("ppo.status in ('OPEN','CLOSED')")
->group_by("pp.client_id")
->get()->result_array();
$total_volume_penjualan_juli24 = 0;
foreach ($penjualan_juli24 as $x){
    $total_volume_penjualan_juli24 += $x['volume'];
}
$realisasi_produksi_juli24 = $total_volume_penjualan_juli24;

//AGUSTUS24
$rak_agustus24 = $this->db->select('(r.vol_produk_a + r.vol_produk_b + r.vol_produk_c + r.vol_produk_d + r.vol_produk_e + r.vol_produk_f) as total_produksi')
->from('rak r')
->where("r.tanggal_rencana_kerja between '$date_agustus24_awal' and '$date_agustus24_akhir'")
->get()->row_array();
$rencana_produksi_agustus24 = $rak_agustus24['total_produksi'];

$penjualan_agustus24 = $this->db->select('p.nama, pp.client_id, SUM(pp.display_price) as price, SUM(pp.display_volume) as volume, pp.convert_measure as measure')
->from('pmm_productions pp')
->join('penerima p', 'pp.client_id = p.id','left')
->join('pmm_sales_po ppo', 'pp.salesPo_id = ppo.id','left')
->where("pp.date_production between '$date_agustus24_awal' and '$date_agustus24_akhir'")
->where("pp.status = 'PUBLISH'")
->where("ppo.status in ('OPEN','CLOSED')")
->group_by("pp.client_id")
->get()->result_array();
$total_volume_penjualan_agustus24 = 0;
foreach ($penjualan_agustus24 as $x){
    $total_volume_penjualan_agustus24 += $x['volume'];
}
$realisasi_produksi_agustus24 = $total_volume_penjualan_agustus24;

//SEPTEMBER24
$rak_september24 = $this->db->select('(r.vol_produk_a + r.vol_produk_b + r.vol_produk_c + r.vol_produk_d + r.vol_produk_e + r.vol_produk_f) as total_produksi')
->from('rak r')
->where("r.tanggal_rencana_kerja between '$date_september24_awal' and '$date_september24_akhir'")
->get()->row_array();
$rencana_produksi_september24 = $rak_september24['total_produksi'];

$penjualan_september24 = $this->db->select('p.nama, pp.client_id, SUM(pp.display_price) as price, SUM(pp.display_volume) as volume, pp.convert_measure as measure')
->from('pmm_productions pp')
->join('penerima p', 'pp.client_id = p.id','left')
->join('pmm_sales_po ppo', 'pp.salesPo_id = ppo.id','left')
->where("pp.date_production between '$date_september24_awal' and '$date_september24_akhir'")
->where("pp.status = 'PUBLISH'")
->where("ppo.status in ('OPEN','CLOSED')")
->group_by("pp.client_id")
->get()->result_array();
$total_volume_penjualan_september24 = 0;
foreach ($penjualan_september24 as $x){
    $total_volume_penjualan_september24 += $x['volume'];
}
$realisasi_produksi_september24 = $total_volume_penjualan_september24;

//OKTOBER24
$rak_oktober24 = $this->db->select('(r.vol_produk_a + r.vol_produk_b + r.vol_produk_c + r.vol_produk_d + r.vol_produk_e + r.vol_produk_f) as total_produksi')
->from('rak r')
->where("r.tanggal_rencana_kerja between '$date_oktober24_awal' and '$date_oktober24_akhir'")
->get()->row_array();
$rencana_produksi_oktober24 = $rak_oktober24['total_produksi'];

$penjualan_oktober24 = $this->db->select('p.nama, pp.client_id, SUM(pp.display_price) as price, SUM(pp.display_volume) as volume, pp.convert_measure as measure')
->from('pmm_productions pp')
->join('penerima p', 'pp.client_id = p.id','left')
->join('pmm_sales_po ppo', 'pp.salesPo_id = ppo.id','left')
->where("pp.date_production between '$date_oktober24_awal' and '$date_oktober24_akhir'")
->where("pp.status = 'PUBLISH'")
->where("ppo.status in ('OPEN','CLOSED')")
->group_by("pp.client_id")
->get()->result_array();
$total_volume_penjualan_oktober24 = 0;
foreach ($penjualan_oktober24 as $x){
    $total_volume_penjualan_oktober24 += $x['volume'];
}
$realisasi_produksi_oktober24 = $total_volume_penjualan_oktober24;

//NOVEMBER24
$rak_november24 = $this->db->select('(r.vol_produk_a + r.vol_produk_b + r.vol_produk_c + r.vol_produk_d + r.vol_produk_e + r.vol_produk_f) as total_produksi')
->from('rak r')
->where("r.tanggal_rencana_kerja between '$date_november24_awal' and '$date_november24_akhir'")
->get()->row_array();
$rencana_produksi_november24 = $rak_november24['total_produksi'];

$penjualan_november24 = $this->db->select('p.nama, pp.client_id, SUM(pp.display_price) as price, SUM(pp.display_volume) as volume, pp.convert_measure as measure')
->from('pmm_productions pp')
->join('penerima p', 'pp.client_id = p.id','left')
->join('pmm_sales_po ppo', 'pp.salesPo_id = ppo.id','left')
->where("pp.date_production between '$date_november24_awal' and '$date_november24_akhir'")
->where("pp.status = 'PUBLISH'")
->where("ppo.status in ('OPEN','CLOSED')")
->group_by("pp.client_id")
->get()->result_array();
$total_volume_penjualan_november24 = 0;
foreach ($penjualan_november24 as $x){
    $total_volume_penjualan_november24 += $x['volume'];
}
$realisasi_produksi_november24 = $total_volume_penjualan_november24;

//DESEMBER24
$rak_desember24 = $this->db->select('(r.vol_produk_a + r.vol_produk_b + r.vol_produk_c + r.vol_produk_d + r.vol_produk_e + r.vol_produk_f) as total_produksi')
->from('rak r')
->where("r.tanggal_rencana_kerja between '$date_desember24_awal' and '$date_desember24_akhir'")
->get()->row_array();
$rencana_produksi_desember24 = $rak_desember24['total_produksi'];

$penjualan_desember24 = $this->db->select('p.nama, pp.client_id, SUM(pp.display_price) as price, SUM(pp.display_volume) as volume, pp.convert_measure as measure')
->from('pmm_productions pp')
->join('penerima p', 'pp.client_id = p.id','left')
->join('pmm_sales_po ppo', 'pp.salesPo_id = ppo.id','left')
->where("pp.date_production between '$date_desember24_awal' and '$date_desember24_akhir'")
->where("pp.status = 'PUBLISH'")
->where("ppo.status in ('OPEN','CLOSED')")
->group_by("pp.client_id")
->get()->result_array();
$total_volume_penjualan_desember24 = 0;
foreach ($penjualan_desember24 as $x){
    $total_volume_penjualan_desember24 += $x['volume'];
}
$realisasi_produksi_desember24 = $total_volume_penjualan_desember24;

//LABA RUGI
//JUNI24
$rak_juni24 = $this->db->select('*')
->from('rak')
->where("(tanggal_rencana_kerja between '$date_juni24_awal' and '$date_juni24_akhir')")
->get()->row_array();
$nilai_produk_a_juni24 = $rak_juni24['vol_produk_a'] * $rak_juni24['price_a'];
$nilai_produk_b_juni24 = $rak_juni24['vol_produk_b'] * $rak_juni24['price_b'];
$nilai_produk_c_juni24 = $rak_juni24['vol_produk_c'] * $rak_juni24['price_c'];
$nilai_produk_d_juni24 = $rak_juni24['vol_produk_d'] * $rak_juni24['price_d'];
$nilai_produk_e_juni24 = $rak_juni24['vol_produk_e'] * $rak_juni24['price_e'];
$nilai_produk_f_juni24 = $rak_juni24['vol_produk_f'] * $rak_juni24['price_f'];
$nilai_rak_penjualan_juni24 = $nilai_produk_a_juni24 + $nilai_produk_b_juni24 + $nilai_produk_c_juni24 + $nilai_produk_d_juni24 + $nilai_produk_e_juni24 + $nilai_produk_f_juni24;

$komposisi_125 = $this->db->select('(r.vol_produk_a * pk.presentase_a) as komposisi_semen_125, (vol_produk_a * pk.presentase_b) as komposisi_pasir_125, (vol_produk_a * pk.presentase_c) as komposisi_batu1020_125, (vol_produk_a * pk.presentase_d) as komposisi_batu2030_125')
->from('rak r')
->join('pmm_agregat pk', 'r.komposisi_125 = pk.id','left')
->where("(r.tanggal_rencana_kerja between '$date_juni24_awal' and '$date_juni24_akhir')")
->get()->result_array();

$total_volume_semen_125 = 0;
$total_volume_pasir_125 = 0;
$total_volume_batu1020_125 = 0;
$total_volume_batu2030_125 = 0;

foreach ($komposisi_125 as $x){
	$total_volume_semen_125 = $x['komposisi_semen_125'];
	$total_volume_pasir_125 = $x['komposisi_pasir_125'];
	$total_volume_batu1020_125 = $x['komposisi_batu1020_125'];
	$total_volume_batu2030_125 = $x['komposisi_batu2030_125'];
}

$komposisi_175 = $this->db->select('(r.vol_produk_a * pk.presentase_a) as komposisi_semen_175, (vol_produk_a * pk.presentase_b) as komposisi_pasir_175, (vol_produk_a * pk.presentase_c) as komposisi_batu1020_175, (vol_produk_a * pk.presentase_d) as komposisi_batu2030_175')
->from('rak r')
->join('pmm_agregat pk', 'r.komposisi_175 = pk.id','left')
->where("(r.tanggal_rencana_kerja between '$date_juni24_awal' and '$date_juni24_akhir')")
->get()->result_array();

$total_volume_semen_175 = 0;
$total_volume_pasir_175 = 0;
$total_volume_batu1020_175 = 0;
$total_volume_batu2030_175 = 0;

foreach ($komposisi_175 as $x){
	$total_volume_semen_175 = $x['komposisi_semen_175'];
	$total_volume_pasir_175 = $x['komposisi_pasir_175'];
	$total_volume_batu1020_175 = $x['komposisi_batu1020_175'];
	$total_volume_batu2030_175 = $x['komposisi_batu2030_175'];
}

$komposisi_225 = $this->db->select('(r.vol_produk_b * pk.presentase_a) as komposisi_semen_225, (vol_produk_b * pk.presentase_b) as komposisi_pasir_225, (vol_produk_b * pk.presentase_c) as komposisi_batu1020_225, (vol_produk_b * pk.presentase_d) as komposisi_batu2030_225')
->from('rak r')
->join('pmm_agregat pk', 'r.komposisi_225 = pk.id','left')
->where("(r.tanggal_rencana_kerja between '$date_juni24_awal' and '$date_juni24_akhir')")
->get()->result_array();

$total_volume_semen_225 = 0;
$total_volume_pasir_225 = 0;
$total_volume_batu1020_225 = 0;
$total_volume_batu2030_225 = 0;

foreach ($komposisi_225 as $x){
	$total_volume_semen_225 = $x['komposisi_semen_225'];
	$total_volume_pasir_225 = $x['komposisi_pasir_225'];
	$total_volume_batu1020_225 = $x['komposisi_batu1020_225'];
	$total_volume_batu2030_225 = $x['komposisi_batu2030_225'];
}

$komposisi_250 = $this->db->select('(r.vol_produk_c * pk.presentase_a) as komposisi_semen_250, (vol_produk_c * pk.presentase_b) as komposisi_pasir_250, (vol_produk_c * pk.presentase_c) as komposisi_batu1020_250, (vol_produk_c * pk.presentase_d) as komposisi_batu2030_250')
->from('rak r')
->join('pmm_agregat pk', 'r.komposisi_250 = pk.id','left')
->where("(r.tanggal_rencana_kerja between '$date_juni24_awal' and '$date_juni24_akhir')")
->get()->result_array();

$total_volume_semen_250 = 0;
$total_volume_pasir_250 = 0;
$total_volume_batu1020_250 = 0;
$total_volume_batu2030_250 = 0;

foreach ($komposisi_250 as $x){
	$total_volume_semen_250 = $x['komposisi_semen_250'];
	$total_volume_pasir_250 = $x['komposisi_pasir_250'];
	$total_volume_batu1020_250 = $x['komposisi_batu1020_250'];
	$total_volume_batu2030_250 = $x['komposisi_batu2030_250'];
}

$komposisi_300 = $this->db->select('(r.vol_produk_e * pk.presentase_a) as komposisi_semen_300, (vol_produk_e * pk.presentase_b) as komposisi_pasir_300, (vol_produk_e * pk.presentase_c) as komposisi_batu1020_300, (vol_produk_e * pk.presentase_d) as komposisi_batu2030_300')
->from('rak r')
->join('pmm_agregat pk', 'r.komposisi_300 = pk.id','left')
->where("(r.tanggal_rencana_kerja between '$date_juni24_awal' and '$date_juni24_akhir')")
->get()->result_array();

$total_volume_semen_300 = 0;
$total_volume_pasir_300 = 0;
$total_volume_batu1020_300 = 0;
$total_volume_batu2030_300 = 0;

foreach ($komposisi_300 as $x){
	$total_volume_semen_300 = $x['komposisi_semen_300'];
	$total_volume_pasir_300 = $x['komposisi_pasir_300'];
	$total_volume_batu1020_300 = $x['komposisi_batu1020_300'];
	$total_volume_batu2030_300 = $x['komposisi_batu2030_300'];
}

$komposisi_350 = $this->db->select('(r.vol_produk_f * pk.presentase_a) as komposisi_semen_350, (vol_produk_f * pk.presentase_b) as komposisi_pasir_350, (vol_produk_f * pk.presentase_c) as komposisi_batu1020_350, (vol_produk_f * pk.presentase_d) as komposisi_batu2030_350')
->from('rak r')
->join('pmm_agregat pk', 'r.komposisi_350 = pk.id','left')
->where("(r.tanggal_rencana_kerja between '$date_juni24_awal' and '$date_juni24_akhir')")
->get()->result_array();

$total_volume_semen_350 = 0;
$total_volume_pasir_350 = 0;
$total_volume_batu1020_350 = 0;
$total_volume_batu2030_350 = 0;

foreach ($komposisi_350 as $x){
	$total_volume_semen_350 = $x['komposisi_semen_350'];
	$total_volume_pasir_350 = $x['komposisi_pasir_350'];
	$total_volume_batu1020_350 = $x['komposisi_batu1020_350'];
	$total_volume_batu2030_350 = $x['komposisi_batu2030_350'];
}

$total_volume_semen = $total_volume_semen_125 + $total_volume_semen_175 + $total_volume_semen_225 + $total_volume_semen_250 + $total_volume_semen_300 + $total_volume_semen_350;
$total_volume_pasir = $total_volume_pasir_125 + $total_volume_pasir_175 + $total_volume_pasir_225 + $total_volume_pasir_250 + $total_volume_pasir_300 + $total_volume_pasir_350;
$total_volume_batu1020 = $total_volume_batu1020_125 + $total_volume_batu1020_175 + $total_volume_batu1020_225 + $total_volume_batu1020_250 + $total_volume_batu1020_300 + $total_volume_batu1020_350;
$total_volume_batu2030 = $total_volume_batu2030_125 + $total_volume_batu2030_175 + $total_volume_batu2030_225 + $total_volume_batu2030_250 + $total_volume_batu2030_300 + $total_volume_batu2030_350;

$total_volume_solar = $rak_juni24['vol_bbm_solar'];
$total_rak_bahan_juni24 = ($total_volume_semen * $rak_juni24['harga_semen']) + ($total_volume_pasir * $rak_juni24['harga_pasir']) + ($total_volume_batu1020 * $rak_juni24['harga_batu1020']) + ($total_volume_batu2030 * $rak_juni24['harga_batu2030']) + ($total_volume_solar * $rak_juni24['harga_solar']);

$rak_alat = $this->db->select('r.*, (r.vol_produk_a + r.vol_produk_b + r.vol_produk_c + r.vol_produk_d + r.vol_produk_f) as total_produksi')
->from('rak r')
->where("(r.tanggal_rencana_kerja between '$date_juni24_awal' and '$date_juni24_akhir')")
->get()->row_array();

$rak_alat_tm = $rak_alat['penawaran_id_tm'];
$rak_alat_exc = $rak_alat['penawaran_id_exc'];
$rak_alat_tr = $rak_alat['penawaran_id_tr'];

$produk_tm = $this->db->select('p.nama_produk, ppd.price, ppd.qty, pm.measure_name')
->from('pmm_penawaran_pembelian ppp')
->join('pmm_penawaran_pembelian_detail ppd', 'ppp.id = ppd.penawaran_pembelian_id','left')
->join('produk p', 'ppd.material_id = p.id','left')
->join('pmm_measures pm', 'ppd.measure = pm.id','left')
->where("ppp.id = '$rak_alat_tm'")
->group_by('ppd.id')
->order_by('p.nama_produk','asc')
->get()->result_array();

$total_price_tm = 0;
foreach ($produk_tm as $x){
	$total_price_tm += $x['qty'] * $x['price'];
}

$produk_tm_2 = $this->db->select('p.nama_produk, ppd.price, ppd.qty, pm.measure_name')
->from('pmm_penawaran_pembelian ppp')
->join('pmm_penawaran_pembelian_detail ppd', 'ppp.id = ppd.penawaran_pembelian_id','left')
->join('produk p', 'ppd.material_id = p.id','left')
->join('pmm_measures pm', 'ppd.measure = pm.id','left')
->where("ppp.id = '$rak_alat_tm'")
->group_by('ppd.id')
->order_by('p.nama_produk','asc')
->get()->result_array();

$total_price_tm = 0;
foreach ($produk_tm as $x){
	$total_price_tm += $rak_alat['vol_tm'] * $x['price'];
}

$produk_exc = $this->db->select('p.nama_produk, ppd.price, ppd.qty, pm.measure_name, ps.nama')
->from('pmm_penawaran_pembelian ppp')
->join('pmm_penawaran_pembelian_detail ppd', 'ppp.id = ppd.penawaran_pembelian_id','left')
->join('produk p', 'ppd.material_id = p.id','left')
->join('pmm_measures pm', 'ppd.measure = pm.id','left')
->join('penerima ps', 'ppp.supplier_id = ps.id','left')
->where("ppp.id = '$rak_alat_exc'")
->group_by('ppd.id')
->order_by('p.nama_produk','asc')
->get()->result_array();

$total_price_exc = 0;
foreach ($produk_exc as $x){
	$total_price_exc += $rak_alat['vol_exc'] * $x['price'];
}

$produk_tr = $this->db->select('p.nama_produk, ppd.price, ppd.qty, pm.measure_name, ps.nama')
->from('pmm_penawaran_pembelian ppp')
->join('pmm_penawaran_pembelian_detail ppd', 'ppp.id = ppd.penawaran_pembelian_id','left')
->join('produk p', 'ppd.material_id = p.id','left')
->join('pmm_measures pm', 'ppd.measure = pm.id','left')
->join('penerima ps', 'ppp.supplier_id = ps.id','left')
->where("ppp.id = '$rak_alat_tr'")
->group_by('ppd.id')
->order_by('p.nama_produk','asc')
->get()->result_array();

$total_price_tr = 0;
foreach ($produk_tr as $x){
	$total_price_tr += $rak_alat['vol_tr'] * $x['price'];
}
$total_rak_alat_juni24 =  $total_price_tm + $total_price_exc + $total_price_tr;
$total_rak_bahan_alat_juni24 = $total_rak_bahan_juni24 + $total_rak_alat_juni24 + $rak_alat['overhead'];
$total_rak_juni24 = ($total_rak_bahan_alat_juni24!=0)?($nilai_rak_penjualan_juni24 - $total_rak_bahan_alat_juni24) * 100:0;
$total_presentase_rak_juni24 = $total_rak_juni24 / $nilai_rak_penjualan_juni24;
$persentase_rak_juni24 = round($total_presentase_rak_juni24,2);

$penjualan_juni24 = $this->db->select('p.nama, pp.client_id, SUM(pp.display_price) as price, SUM(pp.display_volume) as volume, pp.convert_measure as measure')
->from('pmm_productions pp')
->join('penerima p', 'pp.client_id = p.id','left')
->join('pmm_sales_po ppo', 'pp.salesPo_id = ppo.id','left')
->where("pp.date_production between '$date_juni24_awal' and '$date_juni24_akhir'")
->where("pp.status = 'PUBLISH'")
->where("ppo.status in ('OPEN','CLOSED')")
->group_by("pp.client_id")
->get()->result_array();
$total_penjualan_juni24 = 0;
foreach ($penjualan_juni24 as $x){
    $total_penjualan_juni24 += $x['price'];
}

$date1 = $date_juni24_awal;
$date2 = $date_juni24_akhir;
$bahan_juni_24 = $this->pmm_model->getBahan($date1,$date2);
$alat_juni_24 = $this->pmm_model->getAlat($date1,$date2);
$overhead_juni24 = $this->pmm_model->getOverheadLabaRugi($date1,$date2);
$diskonto_juni24 = $this->db->select('sum(pdb.jumlah) as total')
->from('pmm_biaya pb ')
->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
->join('pmm_coa c','pdb.akun = c.id','left')
->where("pdb.akun = 110")
->where("pb.status = 'PAID'")
->where("(pb.tanggal_transaksi between '$date_juni24_awal' and '$date_juni24_akhir')")
->get()->row_array();
$diskonto_juni24 = $diskonto_juni24['total'];
$laba_rugi_juni24 = $total_penjualan_juni24 - ($bahan_juni_24 + $alat_juni_24 + $overhead_juni24 + $diskonto_juni24);
$total_laba_rugi_juni24 = ($total_penjualan_juni24!=0)?($laba_rugi_juni24 / $total_penjualan_juni24) * 100:0;
$persentase_laba_rugi_juni24 = round($total_laba_rugi_juni24,2);

//JULI24
$rak_juli24 = $this->db->select('*')
->from('rak')
->where("(tanggal_rencana_kerja between '$date_juli24_awal' and '$date_juli24_akhir')")
->get()->row_array();
$nilai_produk_a_juli24 = $rak_juli24['vol_produk_a'] * $rak_juli24['price_a'];
$nilai_produk_b_juli24 = $rak_juli24['vol_produk_b'] * $rak_juli24['price_b'];
$nilai_produk_c_juli24 = $rak_juli24['vol_produk_c'] * $rak_juli24['price_c'];
$nilai_produk_d_juli24 = $rak_juli24['vol_produk_d'] * $rak_juli24['price_d'];
$nilai_produk_e_juli24 = $rak_juli24['vol_produk_e'] * $rak_juli24['price_e'];
$nilai_produk_f_juli24 = $rak_juli24['vol_produk_f'] * $rak_juli24['price_f'];
$nilai_rak_penjualan_juli24 = $nilai_produk_a_juli24 + $nilai_produk_b_juli24 + $nilai_produk_c_juli24 + $nilai_produk_d_juli24 + $nilai_produk_e_juli24 + $nilai_produk_f_juli24;

$komposisi_125 = $this->db->select('(r.vol_produk_a * pk.presentase_a) as komposisi_semen_125, (vol_produk_a * pk.presentase_b) as komposisi_pasir_125, (vol_produk_a * pk.presentase_c) as komposisi_batu1020_125, (vol_produk_a * pk.presentase_d) as komposisi_batu2030_125')
->from('rak r')
->join('pmm_agregat pk', 'r.komposisi_125 = pk.id','left')
->where("(r.tanggal_rencana_kerja between '$date_juli24_awal' and '$date_juli24_akhir')")
->get()->result_array();

$total_volume_semen_125 = 0;
$total_volume_pasir_125 = 0;
$total_volume_batu1020_125 = 0;
$total_volume_batu2030_125 = 0;

foreach ($komposisi_125 as $x){
	$total_volume_semen_125 = $x['komposisi_semen_125'];
	$total_volume_pasir_125 = $x['komposisi_pasir_125'];
	$total_volume_batu1020_125 = $x['komposisi_batu1020_125'];
	$total_volume_batu2030_125 = $x['komposisi_batu2030_125'];
}

$komposisi_175 = $this->db->select('(r.vol_produk_a * pk.presentase_a) as komposisi_semen_175, (vol_produk_a * pk.presentase_b) as komposisi_pasir_175, (vol_produk_a * pk.presentase_c) as komposisi_batu1020_175, (vol_produk_a * pk.presentase_d) as komposisi_batu2030_175')
->from('rak r')
->join('pmm_agregat pk', 'r.komposisi_175 = pk.id','left')
->where("(r.tanggal_rencana_kerja between '$date_juli24_awal' and '$date_juli24_akhir')")
->get()->result_array();

$total_volume_semen_175 = 0;
$total_volume_pasir_175 = 0;
$total_volume_batu1020_175 = 0;
$total_volume_batu2030_175 = 0;

foreach ($komposisi_175 as $x){
	$total_volume_semen_175 = $x['komposisi_semen_175'];
	$total_volume_pasir_175 = $x['komposisi_pasir_175'];
	$total_volume_batu1020_175 = $x['komposisi_batu1020_175'];
	$total_volume_batu2030_175 = $x['komposisi_batu2030_175'];
}

$komposisi_225 = $this->db->select('(r.vol_produk_b * pk.presentase_a) as komposisi_semen_225, (vol_produk_b * pk.presentase_b) as komposisi_pasir_225, (vol_produk_b * pk.presentase_c) as komposisi_batu1020_225, (vol_produk_b * pk.presentase_d) as komposisi_batu2030_225')
->from('rak r')
->join('pmm_agregat pk', 'r.komposisi_225 = pk.id','left')
->where("(r.tanggal_rencana_kerja between '$date_juli24_awal' and '$date_juli24_akhir')")
->get()->result_array();

$total_volume_semen_225 = 0;
$total_volume_pasir_225 = 0;
$total_volume_batu1020_225 = 0;
$total_volume_batu2030_225 = 0;

foreach ($komposisi_225 as $x){
	$total_volume_semen_225 = $x['komposisi_semen_225'];
	$total_volume_pasir_225 = $x['komposisi_pasir_225'];
	$total_volume_batu1020_225 = $x['komposisi_batu1020_225'];
	$total_volume_batu2030_225 = $x['komposisi_batu2030_225'];
}

$komposisi_250 = $this->db->select('(r.vol_produk_c * pk.presentase_a) as komposisi_semen_250, (vol_produk_c * pk.presentase_b) as komposisi_pasir_250, (vol_produk_c * pk.presentase_c) as komposisi_batu1020_250, (vol_produk_c * pk.presentase_d) as komposisi_batu2030_250')
->from('rak r')
->join('pmm_agregat pk', 'r.komposisi_250 = pk.id','left')
->where("(r.tanggal_rencana_kerja between '$date_juli24_awal' and '$date_juli24_akhir')")
->get()->result_array();

$total_volume_semen_250 = 0;
$total_volume_pasir_250 = 0;
$total_volume_batu1020_250 = 0;
$total_volume_batu2030_250 = 0;

foreach ($komposisi_250 as $x){
	$total_volume_semen_250 = $x['komposisi_semen_250'];
	$total_volume_pasir_250 = $x['komposisi_pasir_250'];
	$total_volume_batu1020_250 = $x['komposisi_batu1020_250'];
	$total_volume_batu2030_250 = $x['komposisi_batu2030_250'];
}

$komposisi_300 = $this->db->select('(r.vol_produk_e * pk.presentase_a) as komposisi_semen_300, (vol_produk_e * pk.presentase_b) as komposisi_pasir_300, (vol_produk_e * pk.presentase_c) as komposisi_batu1020_300, (vol_produk_e * pk.presentase_d) as komposisi_batu2030_300')
->from('rak r')
->join('pmm_agregat pk', 'r.komposisi_300 = pk.id','left')
->where("(r.tanggal_rencana_kerja between '$date_juli24_awal' and '$date_juli24_akhir')")
->get()->result_array();

$total_volume_semen_300 = 0;
$total_volume_pasir_300 = 0;
$total_volume_batu1020_300 = 0;
$total_volume_batu2030_300 = 0;

foreach ($komposisi_300 as $x){
	$total_volume_semen_300 = $x['komposisi_semen_300'];
	$total_volume_pasir_300 = $x['komposisi_pasir_300'];
	$total_volume_batu1020_300 = $x['komposisi_batu1020_300'];
	$total_volume_batu2030_300 = $x['komposisi_batu2030_300'];
}

$komposisi_350 = $this->db->select('(r.vol_produk_f * pk.presentase_a) as komposisi_semen_350, (vol_produk_f * pk.presentase_b) as komposisi_pasir_350, (vol_produk_f * pk.presentase_c) as komposisi_batu1020_350, (vol_produk_f * pk.presentase_d) as komposisi_batu2030_350')
->from('rak r')
->join('pmm_agregat pk', 'r.komposisi_350 = pk.id','left')
->where("(r.tanggal_rencana_kerja between '$date_juli24_awal' and '$date_juli24_akhir')")
->get()->result_array();

$total_volume_semen_350 = 0;
$total_volume_pasir_350 = 0;
$total_volume_batu1020_350 = 0;
$total_volume_batu2030_350 = 0;

foreach ($komposisi_350 as $x){
	$total_volume_semen_350 = $x['komposisi_semen_350'];
	$total_volume_pasir_350 = $x['komposisi_pasir_350'];
	$total_volume_batu1020_350 = $x['komposisi_batu1020_350'];
	$total_volume_batu2030_350 = $x['komposisi_batu2030_350'];
}

$total_volume_semen = $total_volume_semen_125 + $total_volume_semen_175 + $total_volume_semen_225 + $total_volume_semen_250 + $total_volume_semen_300 + $total_volume_semen_350;
$total_volume_pasir = $total_volume_pasir_125 + $total_volume_pasir_175 + $total_volume_pasir_225 + $total_volume_pasir_250 + $total_volume_pasir_300 + $total_volume_pasir_350;
$total_volume_batu1020 = $total_volume_batu1020_125 + $total_volume_batu1020_175 + $total_volume_batu1020_225 + $total_volume_batu1020_250 + $total_volume_batu1020_300 + $total_volume_batu1020_350;
$total_volume_batu2030 = $total_volume_batu2030_125 + $total_volume_batu2030_175 + $total_volume_batu2030_225 + $total_volume_batu2030_250 + $total_volume_batu2030_300 + $total_volume_batu2030_350;

$total_volume_solar = $rak_juli24['vol_bbm_solar'];
$total_rak_bahan_juli24 = ($total_volume_semen * $rak_juli24['harga_semen']) + ($total_volume_pasir * $rak_juli24['harga_pasir']) + ($total_volume_batu1020 * $rak_juli24['harga_batu1020']) + ($total_volume_batu2030 * $rak_juli24['harga_batu2030']) + ($total_volume_solar * $rak_juli24['harga_solar']);

$rak_alat = $this->db->select('r.*, (r.vol_produk_a + r.vol_produk_b + r.vol_produk_c + r.vol_produk_d + r.vol_produk_f) as total_produksi')
->from('rak r')
->where("(r.tanggal_rencana_kerja between '$date_juli24_awal' and '$date_juli24_akhir')")
->get()->row_array();

$rak_alat_tm = $rak_alat['penawaran_id_tm'];
$rak_alat_exc = $rak_alat['penawaran_id_exc'];
$rak_alat_tr = $rak_alat['penawaran_id_tr'];

$produk_tm = $this->db->select('p.nama_produk, ppd.price, ppd.qty, pm.measure_name')
->from('pmm_penawaran_pembelian ppp')
->join('pmm_penawaran_pembelian_detail ppd', 'ppp.id = ppd.penawaran_pembelian_id','left')
->join('produk p', 'ppd.material_id = p.id','left')
->join('pmm_measures pm', 'ppd.measure = pm.id','left')
->where("ppp.id = '$rak_alat_tm'")
->group_by('ppd.id')
->order_by('p.nama_produk','asc')
->get()->result_array();

$total_price_tm = 0;
foreach ($produk_tm as $x){
	$total_price_tm += $x['qty'] * $x['price'];
}

$produk_tm_2 = $this->db->select('p.nama_produk, ppd.price, ppd.qty, pm.measure_name')
->from('pmm_penawaran_pembelian ppp')
->join('pmm_penawaran_pembelian_detail ppd', 'ppp.id = ppd.penawaran_pembelian_id','left')
->join('produk p', 'ppd.material_id = p.id','left')
->join('pmm_measures pm', 'ppd.measure = pm.id','left')
->where("ppp.id = '$rak_alat_tm'")
->group_by('ppd.id')
->order_by('p.nama_produk','asc')
->get()->result_array();

$total_price_tm = 0;
foreach ($produk_tm as $x){
	$total_price_tm += $rak_alat['vol_tm'] * $x['price'];
}

$produk_exc = $this->db->select('p.nama_produk, ppd.price, ppd.qty, pm.measure_name, ps.nama')
->from('pmm_penawaran_pembelian ppp')
->join('pmm_penawaran_pembelian_detail ppd', 'ppp.id = ppd.penawaran_pembelian_id','left')
->join('produk p', 'ppd.material_id = p.id','left')
->join('pmm_measures pm', 'ppd.measure = pm.id','left')
->join('penerima ps', 'ppp.supplier_id = ps.id','left')
->where("ppp.id = '$rak_alat_exc'")
->group_by('ppd.id')
->order_by('p.nama_produk','asc')
->get()->result_array();

$total_price_exc = 0;
foreach ($produk_exc as $x){
	$total_price_exc += $rak_alat['vol_exc'] * $x['price'];
}

$produk_tr = $this->db->select('p.nama_produk, ppd.price, ppd.qty, pm.measure_name, ps.nama')
->from('pmm_penawaran_pembelian ppp')
->join('pmm_penawaran_pembelian_detail ppd', 'ppp.id = ppd.penawaran_pembelian_id','left')
->join('produk p', 'ppd.material_id = p.id','left')
->join('pmm_measures pm', 'ppd.measure = pm.id','left')
->join('penerima ps', 'ppp.supplier_id = ps.id','left')
->where("ppp.id = '$rak_alat_tr'")
->group_by('ppd.id')
->order_by('p.nama_produk','asc')
->get()->result_array();

$total_price_tr = 0;
foreach ($produk_tr as $x){
	$total_price_tr += $rak_alat['vol_tr'] * $x['price'];
}
$total_rak_alat_juli24 =  $total_price_tm + $total_price_exc + $total_price_tr;
$total_rak_bahan_alat_juli24 = $total_rak_bahan_juli24 + $total_rak_alat_juli24 + $rak_alat['overhead'];
$total_rak_juli24 = ($total_rak_bahan_alat_juli24!=0)?($nilai_rak_penjualan_juli24 - $total_rak_bahan_alat_juli24) * 100:0;
$total_presentase_rak_juli24 = $total_rak_juli24 / $nilai_rak_penjualan_juli24;
$persentase_rak_juli24 = round($total_presentase_rak_juli24,2);

$penjualan_juli24 = $this->db->select('p.nama, pp.client_id, SUM(pp.display_price) as price, SUM(pp.display_volume) as volume, pp.convert_measure as measure')
->from('pmm_productions pp')
->join('penerima p', 'pp.client_id = p.id','left')
->join('pmm_sales_po ppo', 'pp.salesPo_id = ppo.id','left')
->where("pp.date_production between '$date_juli24_awal' and '$date_juli24_akhir'")
->where("pp.status = 'PUBLISH'")
->where("ppo.status in ('OPEN','CLOSED')")
->group_by("pp.client_id")
->get()->result_array();
$total_penjualan_juli24 = 0;
foreach ($penjualan_juli24 as $x){
    $total_penjualan_juli24 += $x['price'];
}

$date1 = $date_juli24_awal;
$date2 = $date_juli24_akhir;
$bahan_juni_24 = $this->pmm_model->getBahan($date1,$date2);
$alat_juni_24 = $this->pmm_model->getAlat($date1,$date2);
$overhead_juli24 = $this->pmm_model->getOverheadLabaRugi($date1,$date2);
$diskonto_juli24 = $this->db->select('sum(pdb.jumlah) as total')
->from('pmm_biaya pb ')
->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
->join('pmm_coa c','pdb.akun = c.id','left')
->where("pdb.akun = 110")
->where("pb.status = 'PAID'")
->where("(pb.tanggal_transaksi between '$date_juli24_awal' and '$date_juli24_akhir')")
->get()->row_array();
$diskonto_juli24 = $diskonto_juli24['total'];
$laba_rugi_juli24 = $total_penjualan_juli24 - ($bahan_juni_24 + $alat_juni_24 + $overhead_juli24 + $diskonto_juli24);
$total_laba_rugi_juli24 = ($total_penjualan_juli24!=0)?($laba_rugi_juli24 / $total_penjualan_juli24) * 100:0;
$persentase_laba_rugi_juli24 = round($total_laba_rugi_juli24,2);

//AGUSTUS24
$rak_agustus24 = $this->db->select('*')
->from('rak')
->where("(tanggal_rencana_kerja between '$date_agustus24_awal' and '$date_agustus24_akhir')")
->get()->row_array();
$nilai_produk_a_agustus24 = $rak_agustus24['vol_produk_a'] * $rak_agustus24['price_a'];
$nilai_produk_b_agustus24 = $rak_agustus24['vol_produk_b'] * $rak_agustus24['price_b'];
$nilai_produk_c_agustus24 = $rak_agustus24['vol_produk_c'] * $rak_agustus24['price_c'];
$nilai_produk_d_agustus24 = $rak_agustus24['vol_produk_d'] * $rak_agustus24['price_d'];
$nilai_produk_e_agustus24 = $rak_agustus24['vol_produk_e'] * $rak_agustus24['price_e'];
$nilai_produk_f_agustus24 = $rak_agustus24['vol_produk_f'] * $rak_agustus24['price_f'];
$nilai_rak_penjualan_agustus24 = $nilai_produk_a_agustus24 + $nilai_produk_b_agustus24 + $nilai_produk_c_agustus24 + $nilai_produk_d_agustus24 + $nilai_produk_e_agustus24 + $nilai_produk_f_agustus24;

$komposisi_125 = $this->db->select('(r.vol_produk_a * pk.presentase_a) as komposisi_semen_125, (vol_produk_a * pk.presentase_b) as komposisi_pasir_125, (vol_produk_a * pk.presentase_c) as komposisi_batu1020_125, (vol_produk_a * pk.presentase_d) as komposisi_batu2030_125')
->from('rak r')
->join('pmm_agregat pk', 'r.komposisi_125 = pk.id','left')
->where("(r.tanggal_rencana_kerja between '$date_agustus24_awal' and '$date_agustus24_akhir')")
->get()->result_array();

$total_volume_semen_125 = 0;
$total_volume_pasir_125 = 0;
$total_volume_batu1020_125 = 0;
$total_volume_batu2030_125 = 0;

foreach ($komposisi_125 as $x){
	$total_volume_semen_125 = $x['komposisi_semen_125'];
	$total_volume_pasir_125 = $x['komposisi_pasir_125'];
	$total_volume_batu1020_125 = $x['komposisi_batu1020_125'];
	$total_volume_batu2030_125 = $x['komposisi_batu2030_125'];
}

$komposisi_175 = $this->db->select('(r.vol_produk_a * pk.presentase_a) as komposisi_semen_175, (vol_produk_a * pk.presentase_b) as komposisi_pasir_175, (vol_produk_a * pk.presentase_c) as komposisi_batu1020_175, (vol_produk_a * pk.presentase_d) as komposisi_batu2030_175')
->from('rak r')
->join('pmm_agregat pk', 'r.komposisi_175 = pk.id','left')
->where("(r.tanggal_rencana_kerja between '$date_agustus24_awal' and '$date_agustus24_akhir')")
->get()->result_array();

$total_volume_semen_175 = 0;
$total_volume_pasir_175 = 0;
$total_volume_batu1020_175 = 0;
$total_volume_batu2030_175 = 0;

foreach ($komposisi_175 as $x){
	$total_volume_semen_175 = $x['komposisi_semen_175'];
	$total_volume_pasir_175 = $x['komposisi_pasir_175'];
	$total_volume_batu1020_175 = $x['komposisi_batu1020_175'];
	$total_volume_batu2030_175 = $x['komposisi_batu2030_175'];
}

$komposisi_225 = $this->db->select('(r.vol_produk_b * pk.presentase_a) as komposisi_semen_225, (vol_produk_b * pk.presentase_b) as komposisi_pasir_225, (vol_produk_b * pk.presentase_c) as komposisi_batu1020_225, (vol_produk_b * pk.presentase_d) as komposisi_batu2030_225')
->from('rak r')
->join('pmm_agregat pk', 'r.komposisi_225 = pk.id','left')
->where("(r.tanggal_rencana_kerja between '$date_agustus24_awal' and '$date_agustus24_akhir')")
->get()->result_array();

$total_volume_semen_225 = 0;
$total_volume_pasir_225 = 0;
$total_volume_batu1020_225 = 0;
$total_volume_batu2030_225 = 0;

foreach ($komposisi_225 as $x){
	$total_volume_semen_225 = $x['komposisi_semen_225'];
	$total_volume_pasir_225 = $x['komposisi_pasir_225'];
	$total_volume_batu1020_225 = $x['komposisi_batu1020_225'];
	$total_volume_batu2030_225 = $x['komposisi_batu2030_225'];
}

$komposisi_250 = $this->db->select('(r.vol_produk_c * pk.presentase_a) as komposisi_semen_250, (vol_produk_c * pk.presentase_b) as komposisi_pasir_250, (vol_produk_c * pk.presentase_c) as komposisi_batu1020_250, (vol_produk_c * pk.presentase_d) as komposisi_batu2030_250')
->from('rak r')
->join('pmm_agregat pk', 'r.komposisi_250 = pk.id','left')
->where("(r.tanggal_rencana_kerja between '$date_agustus24_awal' and '$date_agustus24_akhir')")
->get()->result_array();

$total_volume_semen_250 = 0;
$total_volume_pasir_250 = 0;
$total_volume_batu1020_250 = 0;
$total_volume_batu2030_250 = 0;

foreach ($komposisi_250 as $x){
	$total_volume_semen_250 = $x['komposisi_semen_250'];
	$total_volume_pasir_250 = $x['komposisi_pasir_250'];
	$total_volume_batu1020_250 = $x['komposisi_batu1020_250'];
	$total_volume_batu2030_250 = $x['komposisi_batu2030_250'];
}

$komposisi_300 = $this->db->select('(r.vol_produk_e * pk.presentase_a) as komposisi_semen_300, (vol_produk_e * pk.presentase_b) as komposisi_pasir_300, (vol_produk_e * pk.presentase_c) as komposisi_batu1020_300, (vol_produk_e * pk.presentase_d) as komposisi_batu2030_300')
->from('rak r')
->join('pmm_agregat pk', 'r.komposisi_300 = pk.id','left')
->where("(r.tanggal_rencana_kerja between '$date_agustus24_awal' and '$date_agustus24_akhir')")
->get()->result_array();

$total_volume_semen_300 = 0;
$total_volume_pasir_300 = 0;
$total_volume_batu1020_300 = 0;
$total_volume_batu2030_300 = 0;

foreach ($komposisi_300 as $x){
	$total_volume_semen_300 = $x['komposisi_semen_300'];
	$total_volume_pasir_300 = $x['komposisi_pasir_300'];
	$total_volume_batu1020_300 = $x['komposisi_batu1020_300'];
	$total_volume_batu2030_300 = $x['komposisi_batu2030_300'];
}

$komposisi_350 = $this->db->select('(r.vol_produk_f * pk.presentase_a) as komposisi_semen_350, (vol_produk_f * pk.presentase_b) as komposisi_pasir_350, (vol_produk_f * pk.presentase_c) as komposisi_batu1020_350, (vol_produk_f * pk.presentase_d) as komposisi_batu2030_350')
->from('rak r')
->join('pmm_agregat pk', 'r.komposisi_350 = pk.id','left')
->where("(r.tanggal_rencana_kerja between '$date_agustus24_awal' and '$date_agustus24_akhir')")
->get()->result_array();

$total_volume_semen_350 = 0;
$total_volume_pasir_350 = 0;
$total_volume_batu1020_350 = 0;
$total_volume_batu2030_350 = 0;

foreach ($komposisi_350 as $x){
	$total_volume_semen_350 = $x['komposisi_semen_350'];
	$total_volume_pasir_350 = $x['komposisi_pasir_350'];
	$total_volume_batu1020_350 = $x['komposisi_batu1020_350'];
	$total_volume_batu2030_350 = $x['komposisi_batu2030_350'];
}

$total_volume_semen = $total_volume_semen_125 + $total_volume_semen_175 + $total_volume_semen_225 + $total_volume_semen_250 + $total_volume_semen_300 + $total_volume_semen_350;
$total_volume_pasir = $total_volume_pasir_125 + $total_volume_pasir_175 + $total_volume_pasir_225 + $total_volume_pasir_250 + $total_volume_pasir_300 + $total_volume_pasir_350;
$total_volume_batu1020 = $total_volume_batu1020_125 + $total_volume_batu1020_175 + $total_volume_batu1020_225 + $total_volume_batu1020_250 + $total_volume_batu1020_300 + $total_volume_batu1020_350;
$total_volume_batu2030 = $total_volume_batu2030_125 + $total_volume_batu2030_175 + $total_volume_batu2030_225 + $total_volume_batu2030_250 + $total_volume_batu2030_300 + $total_volume_batu2030_350;

$total_volume_solar = $rak_agustus24['vol_bbm_solar'];
$total_rak_bahan_agustus24 = ($total_volume_semen * $rak_agustus24['harga_semen']) + ($total_volume_pasir * $rak_agustus24['harga_pasir']) + ($total_volume_batu1020 * $rak_agustus24['harga_batu1020']) + ($total_volume_batu2030 * $rak_agustus24['harga_batu2030']) + ($total_volume_solar * $rak_agustus24['harga_solar']);

$rak_alat = $this->db->select('r.*, (r.vol_produk_a + r.vol_produk_b + r.vol_produk_c + r.vol_produk_d + r.vol_produk_f) as total_produksi')
->from('rak r')
->where("(r.tanggal_rencana_kerja between '$date_agustus24_awal' and '$date_agustus24_akhir')")
->get()->row_array();

$rak_alat_tm = $rak_alat['penawaran_id_tm'];
$rak_alat_exc = $rak_alat['penawaran_id_exc'];
$rak_alat_tr = $rak_alat['penawaran_id_tr'];

$produk_tm = $this->db->select('p.nama_produk, ppd.price, ppd.qty, pm.measure_name')
->from('pmm_penawaran_pembelian ppp')
->join('pmm_penawaran_pembelian_detail ppd', 'ppp.id = ppd.penawaran_pembelian_id','left')
->join('produk p', 'ppd.material_id = p.id','left')
->join('pmm_measures pm', 'ppd.measure = pm.id','left')
->where("ppp.id = '$rak_alat_tm'")
->group_by('ppd.id')
->order_by('p.nama_produk','asc')
->get()->result_array();

$total_price_tm = 0;
foreach ($produk_tm as $x){
	$total_price_tm += $x['qty'] * $x['price'];
}

$produk_tm_2 = $this->db->select('p.nama_produk, ppd.price, ppd.qty, pm.measure_name')
->from('pmm_penawaran_pembelian ppp')
->join('pmm_penawaran_pembelian_detail ppd', 'ppp.id = ppd.penawaran_pembelian_id','left')
->join('produk p', 'ppd.material_id = p.id','left')
->join('pmm_measures pm', 'ppd.measure = pm.id','left')
->where("ppp.id = '$rak_alat_tm'")
->group_by('ppd.id')
->order_by('p.nama_produk','asc')
->get()->result_array();

$total_price_tm = 0;
foreach ($produk_tm as $x){
	$total_price_tm += $rak_alat['vol_tm'] * $x['price'];
}

$produk_exc = $this->db->select('p.nama_produk, ppd.price, ppd.qty, pm.measure_name, ps.nama')
->from('pmm_penawaran_pembelian ppp')
->join('pmm_penawaran_pembelian_detail ppd', 'ppp.id = ppd.penawaran_pembelian_id','left')
->join('produk p', 'ppd.material_id = p.id','left')
->join('pmm_measures pm', 'ppd.measure = pm.id','left')
->join('penerima ps', 'ppp.supplier_id = ps.id','left')
->where("ppp.id = '$rak_alat_exc'")
->group_by('ppd.id')
->order_by('p.nama_produk','asc')
->get()->result_array();

$total_price_exc = 0;
foreach ($produk_exc as $x){
	$total_price_exc += $rak_alat['vol_exc'] * $x['price'];
}

$produk_tr = $this->db->select('p.nama_produk, ppd.price, ppd.qty, pm.measure_name, ps.nama')
->from('pmm_penawaran_pembelian ppp')
->join('pmm_penawaran_pembelian_detail ppd', 'ppp.id = ppd.penawaran_pembelian_id','left')
->join('produk p', 'ppd.material_id = p.id','left')
->join('pmm_measures pm', 'ppd.measure = pm.id','left')
->join('penerima ps', 'ppp.supplier_id = ps.id','left')
->where("ppp.id = '$rak_alat_tr'")
->group_by('ppd.id')
->order_by('p.nama_produk','asc')
->get()->result_array();

$total_price_tr = 0;
foreach ($produk_tr as $x){
	$total_price_tr += $rak_alat['vol_tr'] * $x['price'];
}
$total_rak_alat_agustus24 =  $total_price_tm + $total_price_exc + $total_price_tr;
$total_rak_bahan_alat_agustus24 = $total_rak_bahan_agustus24 + $total_rak_alat_agustus24 + $rak_alat['overhead'];
$total_rak_agustus24 = ($total_rak_bahan_alat_agustus24!=0)?($nilai_rak_penjualan_agustus24 - $total_rak_bahan_alat_agustus24) * 100:0;
$total_presentase_rak_agustus24 = $total_rak_agustus24 / $nilai_rak_penjualan_agustus24;
$persentase_rak_agustus24 = round($total_presentase_rak_agustus24,2);

$penjualan_agustus24 = $this->db->select('p.nama, pp.client_id, SUM(pp.display_price) as price, SUM(pp.display_volume) as volume, pp.convert_measure as measure')
->from('pmm_productions pp')
->join('penerima p', 'pp.client_id = p.id','left')
->join('pmm_sales_po ppo', 'pp.salesPo_id = ppo.id','left')
->where("pp.date_production between '$date_agustus24_awal' and '$date_agustus24_akhir'")
->where("pp.status = 'PUBLISH'")
->where("ppo.status in ('OPEN','CLOSED')")
->group_by("pp.client_id")
->get()->result_array();
$total_penjualan_agustus24 = 0;
foreach ($penjualan_agustus24 as $x){
    $total_penjualan_agustus24 += $x['price'];
}

$date1 = $date_agustus24_awal;
$date2 = $date_agustus24_akhir;
$bahan_juni_24 = $this->pmm_model->getBahan($date1,$date2);
$alat_juni_24 = $this->pmm_model->getAlat($date1,$date2);
$overhead_agustus24 = $this->pmm_model->getOverheadLabaRugi($date1,$date2);
$diskonto_agustus24 = $this->db->select('sum(pdb.jumlah) as total')
->from('pmm_biaya pb ')
->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
->join('pmm_coa c','pdb.akun = c.id','left')
->where("pdb.akun = 110")
->where("pb.status = 'PAID'")
->where("(pb.tanggal_transaksi between '$date_agustus24_awal' and '$date_agustus24_akhir')")
->get()->row_array();
$diskonto_agustus24 = $diskonto_agustus24['total'];
$laba_rugi_agustus24 = $total_penjualan_agustus24 - ($bahan_juni_24 + $alat_juni_24 + $overhead_agustus24 + $diskonto_agustus24);
$total_laba_rugi_agustus24 = ($total_penjualan_agustus24!=0)?($laba_rugi_agustus24 / $total_penjualan_agustus24) * 100:0;
$persentase_laba_rugi_agustus24 = round($total_laba_rugi_agustus24,2);

//SEPTEMBER24
$penjualan_september24 = $this->db->select('p.nama, pp.client_id, SUM(pp.display_price) as price, SUM(pp.display_volume) as volume, pp.convert_measure as measure')
->from('pmm_productions pp')
->join('penerima p', 'pp.client_id = p.id','left')
->join('pmm_sales_po ppo', 'pp.salesPo_id = ppo.id','left')
->where("pp.date_production between '$date_september24_awal' and '$date_september24_akhir'")
->where("pp.status = 'PUBLISH'")
->where("ppo.status in ('OPEN','CLOSED')")
->group_by("pp.client_id")
->get()->result_array();
$total_penjualan_september24 = 0;
foreach ($penjualan_september24 as $x){
    $total_penjualan_september24 += $x['price'];
}

$date1 = $date_september24_awal;
$date2 = $date_september24_akhir;
$bahan_juni_24 = $this->pmm_model->getBahan($date1,$date2);
$alat_juni_24 = $this->pmm_model->getAlat($date1,$date2);
$overhead_september24 = $this->pmm_model->getOverheadLabaRugi($date1,$date2);
$diskonto_september24 = $this->db->select('sum(pdb.jumlah) as total')
->from('pmm_biaya pb ')
->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
->join('pmm_coa c','pdb.akun = c.id','left')
->where("pdb.akun = 110")
->where("pb.status = 'PAID'")
->where("(pb.tanggal_transaksi between '$date_september24_awal' and '$date_september24_akhir')")
->get()->row_array();
$diskonto_september24 = $diskonto_september24['total'];
$laba_rugi_september24 = $total_penjualan_september24 - ($bahan_juni_24 + $alat_juni_24 + $overhead_september24 + $diskonto_september24);
$total_laba_rugi_september24 = ($total_penjualan_september24!=0)?($laba_rugi_september24 / $total_penjualan_september24) * 100:0;
$persentase_laba_rugi_september24 = round($total_laba_rugi_september24,2);

//OKTOBER24
$penjualan_oktober24 = $this->db->select('p.nama, pp.client_id, SUM(pp.display_price) as price, SUM(pp.display_volume) as volume, pp.convert_measure as measure')
->from('pmm_productions pp')
->join('penerima p', 'pp.client_id = p.id','left')
->join('pmm_sales_po ppo', 'pp.salesPo_id = ppo.id','left')
->where("pp.date_production between '$date_oktober24_awal' and '$date_oktober24_akhir'")
->where("pp.status = 'PUBLISH'")
->where("ppo.status in ('OPEN','CLOSED')")
->group_by("pp.client_id")
->get()->result_array();
$total_penjualan_oktober24 = 0;
foreach ($penjualan_oktober24 as $x){
    $total_penjualan_oktober24 += $x['price'];
}

$date1 = $date_oktober24_awal;
$date2 = $date_oktober24_akhir;
$bahan_juni_24 = $this->pmm_model->getBahan($date1,$date2);
$alat_juni_24 = $this->pmm_model->getAlat($date1,$date2);
$overhead_oktober24 = $this->pmm_model->getOverheadLabaRugi($date1,$date2);
$diskonto_oktober24 = $this->db->select('sum(pdb.jumlah) as total')
->from('pmm_biaya pb ')
->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
->join('pmm_coa c','pdb.akun = c.id','left')
->where("pdb.akun = 110")
->where("pb.status = 'PAID'")
->where("(pb.tanggal_transaksi between '$date_oktober24_awal' and '$date_oktober24_akhir')")
->get()->row_array();
$diskonto_oktober24 = $diskonto_oktober24['total'];
$laba_rugi_oktober24 = $total_penjualan_oktober24 - ($bahan_juni_24 + $alat_juni_24 + $overhead_oktober24 + $diskonto_oktober24);
$total_laba_rugi_oktober24 = ($total_penjualan_oktober24!=0)?($laba_rugi_oktober24 / $total_penjualan_oktober24) * 100:0;
$persentase_laba_rugi_oktober24 = round($total_laba_rugi_oktober24,2);

//NOVEMBER24
$penjualan_november24 = $this->db->select('p.nama, pp.client_id, SUM(pp.display_price) as price, SUM(pp.display_volume) as volume, pp.convert_measure as measure')
->from('pmm_productions pp')
->join('penerima p', 'pp.client_id = p.id','left')
->join('pmm_sales_po ppo', 'pp.salesPo_id = ppo.id','left')
->where("pp.date_production between '$date_november24_awal' and '$date_november24_akhir'")
->where("pp.status = 'PUBLISH'")
->where("ppo.status in ('OPEN','CLOSED')")
->group_by("pp.client_id")
->get()->result_array();
$total_penjualan_november24 = 0;
foreach ($penjualan_november24 as $x){
    $total_penjualan_november24 += $x['price'];
}

$date1 = $date_november24_awal;
$date2 = $date_november24_akhir;
$bahan_juni_24 = $this->pmm_model->getBahan($date1,$date2);
$alat_juni_24 = $this->pmm_model->getAlat($date1,$date2);
$overhead_november24 = $this->pmm_model->getOverheadLabaRugi($date1,$date2);
$diskonto_november24 = $this->db->select('sum(pdb.jumlah) as total')
->from('pmm_biaya pb ')
->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
->join('pmm_coa c','pdb.akun = c.id','left')
->where("pdb.akun = 110")
->where("pb.status = 'PAID'")
->where("(pb.tanggal_transaksi between '$date_november24_awal' and '$date_november24_akhir')")
->get()->row_array();
$diskonto_november24 = $diskonto_november24['total'];
$laba_rugi_november24 = $total_penjualan_november24 - ($bahan_juni_24 + $alat_juni_24 + $overhead_november24 + $diskonto_november24);
$total_laba_rugi_november24 = ($total_penjualan_november24!=0)?($laba_rugi_november24 / $total_penjualan_november24) * 100:0;
$persentase_laba_rugi_november24 = round($total_laba_rugi_november24,2);

//DESEMBER24
$penjualan_desember24 = $this->db->select('p.nama, pp.client_id, SUM(pp.display_price) as price, SUM(pp.display_volume) as volume, pp.convert_measure as measure')
->from('pmm_productions pp')
->join('penerima p', 'pp.client_id = p.id','left')
->join('pmm_sales_po ppo', 'pp.salesPo_id = ppo.id','left')
->where("pp.date_production between '$date_desember24_awal' and '$date_desember24_akhir'")
->where("pp.status = 'PUBLISH'")
->where("ppo.status in ('OPEN','CLOSED')")
->group_by("pp.client_id")
->get()->result_array();
$total_penjualan_desember24 = 0;
foreach ($penjualan_desember24 as $x){
    $total_penjualan_desember24 += $x['price'];
}

$date1 = $date_desember24_awal;
$date2 = $date_desember24_akhir;
$bahan_juni_24 = $this->pmm_model->getBahan($date1,$date2);
$alat_juni_24 = $this->pmm_model->getAlat($date1,$date2);
$overhead_desember24 = $this->pmm_model->getOverheadLabaRugi($date1,$date2);
$diskonto_desember24 = $this->db->select('sum(pdb.jumlah) as total')
->from('pmm_biaya pb ')
->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
->join('pmm_coa c','pdb.akun = c.id','left')
->where("pdb.akun = 110")
->where("pb.status = 'PAID'")
->where("(pb.tanggal_transaksi between '$date_desember24_awal' and '$date_desember24_akhir')")
->get()->row_array();
$diskonto_desember24 = $diskonto_desember24['total'];
$laba_rugi_desember24 = $total_penjualan_desember24 - ($bahan_juni_24 + $alat_juni_24 + $overhead_desember24 + $diskonto_desember24);
$total_laba_rugi_desember24 = ($total_penjualan_desember24!=0)?($laba_rugi_desember24 / $total_penjualan_desember24) * 100:0;
$persentase_laba_rugi_desember24 = round($total_laba_rugi_desember24,2);

//REALISASI PER MINGGU
$rencana_kerja_now = $this->db->select('r.*, (r.vol_produk_a + r.vol_produk_b + r.vol_produk_c + r.vol_produk_d + r.vol_produk_e + r.vol_produk_f) as total_produksi')
->from('rak r')
->where("r.tanggal_rencana_kerja <= '$date_now'")
->order_by('r.id','desc')->limit(1)
->get()->row_array();

$date_01_month = date('Y-m-01', strtotime($date_now));

$date_dashboard_1 = $this->db->select('d.*')
->from('date_dashboard d')
->where("d.date >= '$date_01_month'")
->order_by('d.id','asc')->limit(1)
->get()->row_array();

$date_dashboard_2 = $this->db->select('d.*')
->from('date_dashboard d')
->where("d.date >= '$date_01_month'")
->order_by('d.id','asc')->limit(1,1)
->get()->row_array();

$date_dashboard_3 = $this->db->select('d.*')
->from('date_dashboard d')
->where("d.date >= '$date_01_month'")
->order_by('d.id','asc')->limit(1,2)
->get()->row_array();

$date_dashboard_4 = $this->db->select('d.*')
->from('date_dashboard d')
->where("d.date >= '$date_01_month'")
->order_by('d.id','asc')->limit(1,3)
->get()->row_array();

$rencana_kerja_perminggu = $rencana_kerja_now['total_produksi'] / 4;
$rencana_kerja_perminggu_fix = round($rencana_kerja_perminggu,2);

$date_minggu_1_awal = date('Y-m-01', strtotime($date_now));
$date_minggu_1_akhir = date('Y-m-d', strtotime($date_dashboard_1['date']));

$penjualan_minggu_1 = $this->db->select('SUM(pp.display_price) as total, SUM(pp.display_volume) as volume')
->from('pmm_productions pp')
->join('pmm_sales_po ppo', 'pp.salesPo_id = ppo.id','left')
->where("pp.date_production between '$date_minggu_1_awal' and '$date_minggu_1_akhir'")
->where("pp.status = 'PUBLISH'")
->where("ppo.status in ('OPEN','CLOSED')")
->group_by("pp.client_id")
->get()->row_array();

$penjualan_minggu_1 = $penjualan_minggu_1['volume'];
$penjualan_minggu_1_fix = round($penjualan_minggu_1,2);

$date_minggu_2_awal = date('Y-m-d', strtotime('+1 days', strtotime($date_minggu_1_akhir)));
$date_minggu_2_akhir = date('Y-m-d', strtotime($date_dashboard_2['date']));

$penjualan_minggu_2 = $this->db->select('SUM(pp.display_price) as total, SUM(pp.display_volume) as volume')
->from('pmm_productions pp')
->join('pmm_sales_po ppo', 'pp.salesPo_id = ppo.id','left')
->where("pp.date_production between '$date_minggu_2_awal' and '$date_minggu_2_akhir'")
->where("pp.status = 'PUBLISH'")
->where("ppo.status in ('OPEN','CLOSED')")
->group_by("pp.client_id")
->get()->row_array();

$penjualan_minggu_2 = $penjualan_minggu_2['volume'];
$penjualan_minggu_2_fix = round($penjualan_minggu_2,2);

$date_minggu_3_awal = date('Y-m-d', strtotime('+1 days', strtotime($date_minggu_2_akhir)));
$date_minggu_3_akhir = date('Y-m-d', strtotime($date_dashboard_3['date']));

$penjualan_minggu_3 = $this->db->select('SUM(pp.display_price) as total, SUM(pp.display_volume) as volume')
->from('pmm_productions pp')
->join('pmm_sales_po ppo', 'pp.salesPo_id = ppo.id','left')
->where("pp.date_production between '$date_minggu_3_awal' and '$date_minggu_3_akhir'")
->where("pp.status = 'PUBLISH'")
->where("ppo.status in ('OPEN','CLOSED')")
->group_by("pp.client_id")
->get()->row_array();

$penjualan_minggu_3 = $penjualan_minggu_3['volume'];
$penjualan_minggu_3_fix = round($penjualan_minggu_3,2);

$date_minggu_4_awal = date('Y-m-d', strtotime('+1 days', strtotime($date_minggu_3_akhir)));
$date_minggu_4_akhir = date('Y-m-d', strtotime($date_dashboard_4['date']));

$penjualan_minggu_4 = $this->db->select('SUM(pp.display_price) as total, SUM(pp.display_volume) as volume')
->from('pmm_productions pp')
->join('pmm_sales_po ppo', 'pp.salesPo_id = ppo.id','left')
->where("pp.date_production between '$date_minggu_4_awal' and '$date_minggu_4_akhir'")
->where("pp.status = 'PUBLISH'")
->where("ppo.status in ('OPEN','CLOSED')")
->group_by("pp.client_id")
->get()->row_array();

$penjualan_minggu_4 = $penjualan_minggu_4['volume'];
$penjualan_minggu_4_fix = round($penjualan_minggu_4,2);
?>
    