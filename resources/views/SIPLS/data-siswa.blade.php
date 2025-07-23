@extends('layouts.app')

@section('title', 'Data Siswa')
@section('withSidebar', true)

@section('content')
<div class="container">
  <h1 class="text-center mb-4">Data Siswa</h1>

  <!-- Tombol Upload -->
  <div class="mb-3 d-flex">
    <input class="form-control me-2" type="file" id="uploadExcel" accept=".xlsx, .xls" />
    <button class="btn btn-primary me-2" onclick="uploadData()">
      <i class="fas fa-upload me-1"></i> Upload
    </button>
  </div>

  <!-- Tabel Data Siswa -->
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="dataSiswaTable" class="table table-bordered table-striped">
          <thead class="table-dark">
            <tr>
              <th>Nama</th>
              <th>Nosis</th>
              <th>Peleton</th>
              <th>Kelas</th>
              <th>Pengiriman</th>
            </tr>
          </thead>
          <tbody id="dataSiswaBody">
            <tr>
              <td>IKIM IBRAHIM</td>
              <td>2508020001</td>
              <td>1/A/I</td>
              <td>A-1</td>
              <td>Polda Jabar</td>
            </tr>
            <tr>
              <td>RIDWAN HIDAYATULLAH</td>
              <td>2508020002</td>
              <td>1/A/I</td>
              <td>A-1</td>
              <td>Polda Kaltim</td>
            </tr>
            <tr>
              <td>RENDY MAULANA</td>
              <td>2508020003</td>
              <td>1/A/I</td>
              <td>A-1</td>
              <td>Polda Jabar</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
  function uploadData() {
    const fileInput = document.getElementById("uploadExcel");
    const file = fileInput.files[0];

    if (!file) {
      alert("Harap pilih file terlebih dahulu.");
      return;
    }

    if (!file.name.endsWith(".xlsx") && !file.name.endsWith(".xls")) {
      alert("Format file tidak valid. Harap unggah file Excel (.xlsx atau .xls).");
      return;
    }

    const reader = new FileReader();
    reader.readAsBinaryString(file);

    reader.onload = function (e) {
      const data = e.target.result;
      const workbook = XLSX.read(data, { type: "binary" });
      const firstSheet = workbook.Sheets[workbook.SheetNames[0]];
      const jsonData = XLSX.utils.sheet_to_json(firstSheet, { header: 1 });

      updateTable(jsonData);
    };

    reader.onerror = function (error) {
      console.error("Gagal membaca file", error);
      alert("Terjadi kesalahan saat membaca file.");
    };
  }

  function updateTable(data) {
    const tableBody = document.getElementById("dataSiswaBody");
    tableBody.innerHTML = "";

    data.slice(1).forEach((row) => {
      if (row.length >= 5) {
        const tr = document.createElement("tr");
        for (let i = 0; i < 5; i++) {
          const td = document.createElement("td");
          td.textContent = row[i] || "-";
          tr.appendChild(td);
        }
        tableBody.appendChild(tr);
      }
    });

    alert("Data berhasil diupload dan ditambahkan ke tabel.");
  }
</script>
@endsection
