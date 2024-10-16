<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Tambah Karyawan</h1>
        <form action="<?= site_url('employees')?>" method="POST">
        <div class="row">
            <div class="form-group col-6">
                <label for="nama_karyawan">Nama Karyawan*</label>
                <input type="text" class="form-control" name="nama_karyawan" required>
            </div>

            <div class="form-group col-6">
                <label for="tanggal_lahir">Tanggal Lahir*</label>
                <input type="date" class="form-control" name="tanggal_lahir" required>
            </div>
        </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" name="alamat" required></textarea>
            </div>

            <h2>Keluarga:</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Hubungan Keluarga</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                    </tr>
                </thead>
                <tbody id="familyTableBody">
                    <tr>
                        <td><button type="button" class="btn btn-success add-family">+</button></td>
                        <td>
                            <select class="form-control" name="hubungan_keluarga[]">
                                <option value="">--select--</option>
                                <option value="Ayah">Ayah</option>
                                <option value="Ibu">Ibu</option>
                                <option value="Anak">Anak</option>
                                <option value="Saudara">Saudara</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="nama_keluarga[]"></td>
                        <td><input type="date" class="form-control" name="tanggal_lahir_keluarga[]"></td>
                    </tr>
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.querySelector('.add-family').addEventListener('click', function() {
            const tableBody = document.getElementById('familyTableBody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><button type="button" class="btn btn-danger remove-family">-</button></td>
                <td>
                    <select class="form-control" name="hubungan_keluarga[]">
                        <option value="">--select--</option>
                        <option value="Ayah">Ayah</option>
                        <option value="Ibu">Ibu</option>
                        <option value="Anak">Anak</option>
                        <option value="Saudara">Saudara</option>
                    </select>
                </td>
                <td><input type="text" class="form-control" name="nama_keluarga[]"></td>
                <td><input type="date" class="form-control" name="tanggal_lahir_keluarga[]"></td>
            `;
            tableBody.appendChild(newRow);
        });

        document.getElementById('familyTableBody').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-family')) {
                e.target.closest('tr').remove();
            }
        });
    </script>
</body>
</html>
