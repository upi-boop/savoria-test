<?php


namespace App\Models;

use CodeIgniter\Model;


class FamilyModel extends Model
{
    protected $table = 'm_family';
    protected $primaryKey = 'family_id';
    protected $allowedFields = ['m_employee_id', 'hubungan_keluarga', 'nama_anggota_keluarga', 'tanggal_lahir_anggota_keluarga'];
}


?>