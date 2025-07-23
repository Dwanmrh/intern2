@extends('layouts.app')

@section('title', 'Nilai Integritas Mental & Akhlak Terpuji (NIMAT)')
@section('withSidebar', true)

@section('content')
<div class="container mt-4">
  <div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Nilai Integritas Mental & Akhlak Terpuji (NIMAT)</h5>
      <div class="d-flex">
        <input class="form-control form-control-sm me-2" type="file" id="uploadExcel" accept=".xlsx, .xls" />
        <button class="btn btn-sm btn-primary" onclick="uploadData()">Upload</button>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped mb-0">
          <thead class="table-dark">
            <tr>
              <th>Nosis</th>
              <th>Nama</th>
              <th>Peleton</th>
              <th>N1</th>
              <th>N2</th>
              <th>N3</th>
              <th>Rata-rata</th>
            </tr>
          </thead>
          <tbody id="nilaiBody"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
@include('partials.excel-script')
@endpush
