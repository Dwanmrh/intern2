@extends('layouts.app')

@section('title', 'Nilai Mental Kepribadian (NMK)')
@section('withSidebar', true)

@section('content')
<div class="container mt-4">
  <div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Nilai Mental Kepribadian (NMK)</h5>

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
        <option selected>Pilih Minggu</option>
        @for ($i = 1; $i <= 18; $i++)
          <option value="Minggu {{ $i }}">Minggu {{ $i }}</option>
        @endfor
        <option value="Sosiometri">Sosiometri</option>
      </select>
    </div>
    <div class="col-md-3">
      <select class="form-select">
        <option selected>Pilih Peleton</option>
        <option value="1/A/I">1/A/I</option>
        <option value="1/A/II">1/A/II</option>
        <option value="1/A/III">1/A/III</option>
      </select>
    </div>
    <div class="mb-3 d-flex align-items-center gap-3">
      <button class="btn btn-success w-100">Search</button>
    </div>
  </div>

      <div class="d-flex">
        <input
          class="form-control form-control-sm me-2"
          type="file"
          id="uploadExcel"
          accept=".xlsx, .xls"
        />
        <button class="btn btn-sm btn-primary" onclick="uploadData()">Upload</button>
      </div>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped mb-0">
          <thead class="table-dark">
            <tr>
              <th>Nama</th>
              <th>Nosis</th>
              <th>Peleton</th>
              <th>Kelas</th>
              <th>Nilai Akhir Pengamatan (NAP) Bobot 7</th>
              <th>Nilai Akhir Sosiometri (NAS) Bobot 3</th>
              <th>Nilai Akhir Mental Kepribadian (NAMK)</th>
              <th>Ranking</th>
              <th>Kategori</th>
            </tr>
          </thead>
          <tbody id="nilaiMentalBody">
            <tr>
              <td>IKIM IBRAHIM</td>
              <td>2508020001</td>
              <td>1/A/I</td>
              <td>A-1</td>
              <td>85</td>
              <td>88</td>
              <td>88</td>
              <td>1</td>
              <td>Memuaskan</td>
            </tr>
            <tr>
              <td>RIDWAN HIDAYATULLAH</td>
              <td>2508020002</td>
              <td>1/A/I</td>
              <td>A-1</td>
              <td>80</td>
              <td>82</td>
              <td>80</td>
              <td>2</td>
              <td>Sangat Memuaskan</td>
            </tr>
            <tr>
              <td>RENDY MAULANA</td>
              <td>2508020003</td>
              <td>1/A/I</td>
              <td>A-1</td>
              <td>90</td>
              <td>91</td>
              <td>91</td>
              <td>3</td>
              <td>Cukup Memuaskan</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
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
    const tableBody = document.getElementById("nilaiMentalBody");
    tableBody.innerHTML = "";

    data.slice(1).forEach((row) => {
      if (row.length >= 7) {
        const tr = document.createElement("tr");
        row.slice(0, 7).forEach((cell) => {
          const td = document.createElement("td");
          td.textContent = cell || "-";
          tr.appendChild(td);
        });
        tableBody.appendChild(tr);
      }
    });

    alert("Data berhasil diupload dan ditambahkan ke tabel.");
  }
</script>
@endpush
