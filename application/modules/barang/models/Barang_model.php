<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    public function getData($id = null)
    {
        $this->db->from('barang');
        if($id)
        {
            $this->db->where('id_barang', $id);
        }
        return $this->db->get();
    }

    public function add($data)
    {
        date_default_timezone_set("Asia/Jakarta");
        $params = array(
            'nama_barang' => htmlspecialchars($data['nama_barang']),
            'harga_beli' => htmlspecialchars($data['harga_beli']),
            'harga_jual' => htmlspecialchars($data['harga_jual']),
            'stock' => htmlspecialchars($data['stock']),
            'photo_barang' => htmlspecialchars($data['photo_barang']),
            'created_at' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('barang', $params);
    }

    public function update($data)
    {
        date_default_timezone_set("Asia/Jakarta");
        $params = array(
            'nama_barang' => htmlspecialchars($data['nama_barang']),
            'harga_beli' => htmlspecialchars($data['harga_beli']),
            'harga_jual' => htmlspecialchars($data['harga_jual']),
            'stock' => htmlspecialchars($data['stock']),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        if($data['photo_barang'] != null){
            $params['photo_barang'] = $data['photo_barang'];
        }
        $this->db->where('id_barang', $data['id']);
        $this->db->update('barang', $params);
    }

    public function del($data)
    {
        $this->db->where('id_barang', $data['id']);
        $this->db->delete('barang');
    }

}

?>