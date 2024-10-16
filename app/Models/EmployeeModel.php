<?php


namespace App\Models;

use CodeIgniter\Model;


class EmployeeModel extends Model
{
    protected $table = 'm_employee';
    protected $primaryKey = 'm_employee_id';
    protected $allowedFields = [
        'nama_karyawan',
        'tanggal_lahir',
        'alamat', 
        'email', 
        'valid_from', 
        'valid_to', 
        'create_by', 
        'update_by'
    ];
}
?>