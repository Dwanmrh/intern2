@extends('layouts.app')

@section('title', 'Nilai Ranking (NR)')
@section('withSidebar', true)

@section('content')
<div class="container mt-4 main-content">
  <h1 class="text-center mb-3">Nilai Ranking (NR)</h1>
  <p>Rumus Konversi: <strong>(Nilai Riil Individu - Nilai Terendah Resimen) / (Nilai Tertinggi - Terendah) × 100</strong></p>
  <p>Contoh: <code>(75 - 65) / 15 × 100</code></p>

  <!-- Upload File Excel -->
  <div class="mb-3 d-flex">
    <input
      class="form-control me-2"
      type="file"
      id="uploadExcel"
      accept=".xlsx, .xls"
    />
    <button class="btn btn-primary me-2" onclick="uploadData()">
      Upload
    </button>
  </div>

  <!-- Tabel Ranking -->
  <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
      <thead class="table-light">
        <tr>
          <th>Nama</th>
          <th>Nosis</th>
          <th>Peleton</th>
          <th>Kelas</th>
          <th>NK Akademik (Bobot 4)</th>
          <th>NK Mental Kepribadian (Bobot 4)</th>
          <th>NK Kesjas (Bobot 2)</th>
          <th>Nilai Ranking (NR)</th>
          <th>Ranking</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>IKIM IBRAHIM</td>
          <td>2508020001</td>
          <td>1/A/I</td>
          <td>A-1</td>
          <td>66.667</td>
          <td>100</td>
          <td>88</td>
          <td>88</td>
          <td>2</td>
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
          <td>1</td>
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
          <td>3</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection

@section('scripts')
<script>
  function uploadData() {
    const fileInput = document.getElementById("uploadExcel");
    const file = fileInput.files[0];

    if (file) {
      if (file.name.endsWith(".xlsx") || file.name.endsWith(".xls")) {
        console.log("File yang diupload:", file.name);
        alert("File berhasil diupload: " + file.name);
      } else {
        alert("Format file tidak valid. Harap unggah file Excel (.xlsx atau .xls).");
      }
    } else {
      alert("Harap pilih file terlebih dahulu.");
    }
  }
</script>
@endsection
