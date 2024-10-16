<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.dataTables.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: auto;
            margin-top: 20px;
        }
        .button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 15px;
        }
        .button:disabled {
            background-color: #ccc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data Karyawan</h2>
        <button class="button" onclick="window.location.href='employees/add_employee_page'">Tambah Karyawan</button>
        <table id="employeeTable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Karyawan</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <!-- Load jQuery and DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.3/js/dataTables.buttons.min.js"></script>
    <script>
        $(document).ready(function() {
          
            $('#employeeTable').DataTable({
                ajax: {
                    url: '/employees/list', 
                    dataSrc: '',
                    error: function(xhr, status, error) {
                        console.error('Error fetching employee data:', error); 
                        alert('Failed to load employee data. Please try again later.');
                    }
                },
                columns: [
                    { data: 'm_employee_id' }, 
                    { data: 'nama_karyawan' },
                    { data: 'tanggal_lahir' },
                    { data: 'alamat' },
                    {
                        data: 'm_employee_id',
                        render: function(data, type, row) {
                            return `
                                <button onclick="editEmployee(${data})">Edit</button>
                                <button onclick="deleteEmployee(${data})">Delete</button>
                            `;
                        }
                    }
                ]
            });
        });

        function editEmployee(id) {
            window.location.href = `employees/edit_employee_page/${id}`;
        }

        function deleteEmployee(id) {
            if (confirm('Are you sure you want to delete this employee?')) {
                fetch(`/employees/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        alert('Employee deleted successfully!');
                        $('#employeeTable').DataTable().ajax.reload(); 
                    } else {
                        alert('Failed to delete employee.');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }
    </script>
</body>
</html>
