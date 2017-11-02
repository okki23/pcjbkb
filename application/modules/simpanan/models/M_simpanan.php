<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_simpanan extends MY_Model {

	public function get_new($arrdata){
		$setting = new StdClass();

				foreach ($arrdata as $key => $column_order) {
						$setting->$column_order = '';
				}

				return $setting;
	}

	public function get_all_sum_trans(){
		return $this->db->query("select a.id,a.id_anggota,b.nama_asli,a.tanggal_bayar,a.status,sum(a.jumlah_bayar) as summary from t_simpanan a 
        left join m_anggota b on b.id = a.id_anggota
        GROUP BY a.id_anggota");
	}

	public function save_data($data,$tablename){
	 
		return  $this->db->query("insert into t_simpanan (id,id_anggota,tanggal_bayar,jumlah_bayar,status) values (null,'".$data['id_anggota']."','".$data['tanggal_bayar']."','".$data['jumlah_bayar']."','".$data['status']."') ");
	}

	public function save_data_update($data,$tablename){
		return  $this->db->query("update t_simpanan set tanggal_bayar = '".$data['tanggal_bayar']."',jumlah_bayar = '".$data['jumlah_bayar']."',status = '".$data['status']."'  where id = '".$data['id']."' and id_anggota = '".$data['id_anggota']."' ");
		 
	}

}
