@extends('layouts.app')

@section('title', 'Nilai Mapel')
@section('withSidebar', true)

@section('content')
<div class="container mt-4">
  <h1 class="text-center mb-4">Nilai Mapel (NMP)</h1>

  <!-- Filter Dropdown -->
  <div class="mb-4 row g-2">
    <div class="col-md-3">
      <select class="form-select">
        <option selected>Pilih Tahun</option>
        <option value="2024">2025</option>
        <option value="2025">2026</option>
        <option value="2026">2027</option>
        <option value="2027">2028</option>
      </select>
    </div>
    <div class="col-md-3">
      <select class="form-select">
        <option selected>Pilih Prodiklat</option>
        <option value="SIP 54-1">SIP 54-1</option>
        <option value="SIP 54-2">SIP 54-2</option>
        <option value="PAG">PAG</option>
      </select>
    </div>
    <div class="col-md-3">
      <select class="form-select">
        <option selected>Pilih Mapel</option>
        @for ($i = 1; $i <= 45; $i++)
          <option value="Mapel {{ $i }}">Mapel {{ $i }}</option>
        @endfor
      </select>
    </div>
    <div class="col-md-3">
      <select class="form-select">
        <option selected>Pilih Kelas</option>
        @for ($i = 'A-1'; $i <= 'A-5'; $i++)
          <option value="Kelas {{ $i }}">Kelas {{ $i }}</option>
        @endfor
      </select>
    </div>
    <div class="mb-3 d-flex align-items-center gap-3">
      <button class="btn btn-success w-100">Search</button>
    </div>
  </div>

  <!-- Upload Section -->
  <div class="mb-3 d-flex align-items-center gap-3">
    <input class="form-control" type="file" id="uploadExcel" accept=".xlsx, .xls" />
    <button class="btn btn-primary" onclick="uploadData()">Upload</button>
  </div>

  <!-- Tabel Nilai -->
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
              <th>Nilai Ujian Tertulis (NUT)</th>
              <th>Nilai Penugasan (NPU)</th>
              <th>Nilai Keaktifan (NKA)</th>
              <th>Nilai Ujian Praktek (NUP)</th>
              <th>Nilai</th>
              <th>Nilai Mapel (NMP)</th>
            </tr>
          </thead>
          <tbody id="dataSiswaBody">
            <tr>
              <td>IKIM IBRAHIM</td>
              <td>2508020001</td>
              <td>1/A/I</td>
              <td>A-1</td>
              <td>85</td>
              <td>90</td>
              <td>88</td>
              <td>88</td>
              <td>88</td>
              <td>88</td>
            </tr>
            <tr>
              <td>RIDWAN HIDAYATULLAH</td>
              <td>2508020002</td>
              <td>1/A/I</td>
              <td>A-1</td>
              <td>78</td>
              <td>82</td>
              <td>80</td>
              <td>80</td>
              <td>80</td>
              <td>80</td>
            </tr>
            <tr>
              <td>RENDY MAULANA</td>
              <td>2508020003</td>
              <td>1/A/I</td>
              <td>A-1</td>
              <td>92</td>
              <td>88</td>
              <td>88</td>
              <td>88</td>
              <td>90</td>
              <td>90</td>
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
