<?php
namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\FamilyModel;
use CodeIgniter\RESTful\ResourceController;

class EmployeeController extends ResourceController
{


    protected $format    = 'json';
    protected $employeeModel;
    protected $familyModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
        $this->familyModel = new FamilyModel();
    }

    public function index()
    {
        return view('index');
    }

    public function listEmployee()
    {
        $employees = $this->employeeModel->findAll();

        if (!$employees) {
            return $this->failNotFound('Employee not found');
        }
        return $this->respond($employees);
    }


    public function create()
    {
        return view('employee_view');
    }

    public function store()
    {
        
        // Simpan data karyawan
        $employeeData = [
            'nama_karyawan' => $this->request->getVar('nama_karyawan'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'alamat' => $this->request->getVar('alamat'),
            'valid_from' => date('Y-m-d'), // Set valid_from to current date
        ];

        // Insert employee data and get the employee ID
        $employeeId = $this->employeeModel->insert($employeeData);
        
        // Simpan data anggota keluarga
        $hubunganKeluarga = $this->request->getVar('hubungan_keluarga');
        $namaKeluarga = $this->request->getVar('nama_keluarga');
        $tanggalLahirKeluarga = $this->request->getVar('tanggal_lahir_keluarga');

        for ($i = 0; $i < count($hubunganKeluarga); $i++) {
            if (!empty($hubunganKeluarga[$i]) && !empty($namaKeluarga[$i])) {
                $familyData = [
                    'm_employee_id' => $employeeId,
                    'hubungan_keluarga' => $hubunganKeluarga[$i],
                    'nama_anggota_keluarga' => $namaKeluarga[$i],
                    'tanggal_lahir_anggota_keluarga' => $tanggalLahirKeluarga[$i],
                ];
                $this->familyModel->insert($familyData);
            }
        }

        return redirect()->to('/employees');
    }

    public function edit($id = null)
    {
        $employee = $this->employeeModel->find($id);
        $family_members = $this->familyModel->where('m_employee_id', $id)->findAll();

        if (!$employee) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data karyawan tidak ditemukan');
        }

        return view('edit_employee_view', ['employee' => $employee, 'family_members' => $family_members]);
    }

    public function update($id = null)
    {
        // Update data karyawan
        $employeeData = [
            'nama_karyawan' => $this->request->getVar('nama_karyawan'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'alamat' => $this->request->getVar('alamat'),
            'update_by' => 1, // Ganti dengan ID pengguna yang sebenarnya
            'update_date' => date('Y-m-d H:i:s')
        ];

        $this->employeeModel->update($id, $employeeData);

        // Hapus anggota keluarga yang sudah ada (untuk update)
        $this->familyModel->where('m_employee_id', $id)->delete();

        // Simpan data anggota keluarga yang baru
        $hubunganKeluarga = $this->request->getVar('hubungan_keluarga');
        $namaKeluarga = $this->request->getVar('nama_keluarga');
        $tanggalLahirKeluarga = $this->request->getVar('tanggal_lahir_keluarga');

        for ($i = 0; $i < count($hubunganKeluarga); $i++) {
            if (!empty($hubunganKeluarga[$i]) && !empty($namaKeluarga[$i])) {
                $familyData = [
                    'm_employee_id' => $id,
                    'hubungan_keluarga' => $hubunganKeluarga[$i],
                    'nama_anggota_keluarga' => $namaKeluarga[$i],
                    'tanggal_lahir_anggota_keluarga' => $tanggalLahirKeluarga[$i],
                ];
                $this->familyModel->insert($familyData);
            }
        }

        return redirect()->to('/employees');
    }



    public function delete($id = null)
    {
         $this->familyModel->where('m_employee_id', $id)->delete();

         $this->employeeModel->delete($id);
 
         return $this->response->setJSON(['status' => 'Employee deleted successfully']);
    }

}