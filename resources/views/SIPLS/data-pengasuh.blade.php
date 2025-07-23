@extends('layouts.app')

@section('title', 'Data Pengasuh')
@section('withSidebar', true)

@section('content')
<div class="container mt-4 main-content">
  <h1 class="text-center mb-3">Data Pengasuh</h1>

  <!-- Tombol Upload -->
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

  <!-- Tabel Data Pengasuh -->
  <div class="table-responsive">
    <table class="table table-bordered table-striped text-center align-middle">
      <thead class="table-light">
        <tr>
          <th>Images</th>
          <th>No</th>
          <th>Nama</th>
          <th>Pangkat</th>
          <th>NRP</th>
          <th>Jabatan</th>
          <th>Penugasan</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><img src="{{ asset('assets/images/pengasuh.png') }}" alt="Pengasuh" width="50" /></td>
          <td>1</td>
          <td>IBRAHIM</td>
          <td>KOMPOL</td>
          <td>202503030001</td>
          <td>PAUR MINSIS</td>
          <td>JABAR</td>
        </tr>
        <tr>
          <td><img src="{{ asset('assets/images/pengasuh.png') }}" alt="Pengasuh" width="50" /></td>
          <td>2</td>
          <td>MUHAMMAD</td>
          <td>IPTU</td>
          <td>202503030002</td>
          <td>TIM IT</td>
          <td>JABAR</td>
        </tr>
        <tr>
          <td><img src="{{ asset('assets/images/pengasuh.png') }}" alt="Pengasuh" width="50" /></td>
          <td>3</td>
          <td>BAKTI</td>
          <td>IPDA</td>
          <td>202503030001</td>
          <td>TIM IT</td>
          <td>JABAR</td>
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
