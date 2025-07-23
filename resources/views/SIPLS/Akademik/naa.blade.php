@extends('layouts.app')

@section('title', 'Nilai Akademik (NA)')
@section('withSidebar', true)

@section('content')
<div class="container mt-4">
  <div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Nilai Akademik (NA)</h5>
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
              <th>Nilai Rerata Mapel (NRMP) Bobot 5</th>
              <th>Nilai Gladi Wirottama (NGW) Bobot 1</th>
              <th>Nilai (NKPW) Bobot 1</th>
              <th>Nilai Latnis (NLT) Bobot 3</th>
              <th>Nilai Akhir Akademik (NAA)</th>
              <th>Ranking</th>
              <th>Kategori</th>
            </tr>
          </thead>
          <tbody id="dataSiswaBody">
            <tr>
              <td>IKIM IBRAHIM</td>
              <td>2508020001</td>
              <td>1/A/I</td>
              <td>A-1</td>
              <td>86</td>
              <td>85</td>
              <td>90</td>
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
              <td>86</td>
              <td>78</td>
              <td>82</td>
              <td>80</td>
              <td>80</td>
              <td>1</td>
              <td>Sangat Memuaskan</td>
            </tr>
            <tr>
              <td>RENDY MAULANA</td>
              <td>2508020003</td>
              <td>1/A/I</td>
              <td>A-1</td>
              <td>86</td>
              <td>92</td>
              <td>88</td>
              <td>90</td>
              <td>90</td>
              <td>3</td>
              <td>Kurang Memuaskan</td>
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
    const tableBody = document.getElementById("dataSiswaBody");
    tableBody.innerHTML = "";

    data.slice(1).forEach((row) => {
      if (row.length >= 8) {
        const tr = document.createElement("tr");
        row.slice(0, 8).forEach((cell) => {
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
