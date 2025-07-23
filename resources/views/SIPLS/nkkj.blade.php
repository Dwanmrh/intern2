@extends('layouts.app')

@section('title', 'Nilai Akhir Kesehatan dan Kesamaptaan Jasmani (NAKKJ)')
@section('withSidebar', true)

@section('content')
<div class="container mt-4">
  <h3 class="text-center mb-1">Nilai Akhir Kesehatan dan</h3>
  <h3 class="text-center mb-4">Kesamaptaan Jasmani (NAKKJ)</h3>

  <div class="mb-3 d-flex">
    <input
      class="form-control form-control-sm me-2"
      type="file"
      id="uploadExcel"
      accept=".xlsx, .xls"
    />
    <button class="btn btn-sm btn-primary" onclick="uploadData()">Upload</button>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>Nama</th>
          <th>Nosis</th>
          <th>Peleton</th>
          <th>Kelas</th>
          <th>NK1</th>
          <th>NK2</th>
          <th>NAK (Bobot 4)</th>
          <th>NKJ1</th>
          <th>NKJ2</th>
          <th>NAKJ (Bobot 6)</th>
          <th>NAKKJ</th>
          <th>Ranking</th>
          <th>Kategori</th>
        </tr>
      </thead>
      <tbody id="nilaiBody">
        <tr>
          <td>IKIM IBRAHIM</td>
          <td>2508020001</td>
          <td>1/A/I</td>
          <td>A-1</td>
          <td>66.667</td>
          <td>100</td>
          <td>88</td>
          <td>88</td>
          <td>88</td>
          <td>88</td>
          <td>88</td>
          <td>2</td>
          <td>Memuaskan</td>
        </tr>
        <tr>
          <td>RIDWAN HIDAYATULLAH</td>
          <td>2508020002</td>
          <td>1/A/I</td>
          <td>A-1</td>
          <td>100</td>
          <td>66.678</td>
          <td>100</td>
          <td>80</td>
          <td>80</td>
          <td>80</td>
          <td>80</td>
          <td>1</td>
          <td>Memuaskan</td>
        </tr>
        <tr>
          <td>RENDY MAULANA</td>
          <td>2508020003</td>
          <td>1/A/I</td>
          <td>A-1</td>
          <td>0</td>
          <td>0</td>
          <td>0</td>
          <td>90</td>
          <td>90</td>
          <td>90</td>
          <td>90</td>
          <td>3</td>
          <td>Memuaskan</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection

@push('scripts')
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
      const sheet = workbook.Sheets[workbook.SheetNames[0]];
      const jsonData = XLSX.utils.sheet_to_json(sheet, { header: 1 });

      updateTable(jsonData);
    };

    reader.onerror = function (err) {
      alert("Gagal membaca file.");
      console.error(err);
    };
  }

  function updateTable(data) {
    const tbody = document.getElementById("nilaiBody");
    tbody.innerHTML = "";

    data.slice(1).forEach((row) => {
      const tr = document.createElement("tr");
      row.slice(0, 12).forEach((cell) => {
        const td = document.createElement("td");
        td.textContent = cell ?? "-";
        tr.appendChild(td);
      });
      tbody.appendChild(tr);
    });

    alert("Data berhasil dimuat.");
  }
</script>
@endpush
