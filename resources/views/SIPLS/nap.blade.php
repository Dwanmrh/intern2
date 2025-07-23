@extends('layouts.app')

@section('title', 'Nilai Akhir Pendidikan (NAP)')
@section('withSidebar', true)

@section('content')
<div class="container mt-4 main-content">
  <h1 class="text-center mb-3">Nilai Akhir Pendidikan (NAP)</h1>

  <div class="table-responsive">
    <table class="table table-bordered text-center align-middle">
      <thead class="table-light">
        <tr>
          <th colspan="3">Nilai Akhir</th>
          <th rowspan="2">Nilai Akhir Pendidikan (NAP)</th>
          <th rowspan="2">Rank</th>
          <th rowspan="2">Kategori</th>
          <th colspan="3">Nilai Konversi</th>
          <th rowspan="2">Nilai Ranking</th>
          <th rowspan="2">Rank</th>
        </tr>
        <tr>
          <th>Akademik Bobot 4</th>
          <th>Mental Bobot 4</th>
          <th>Kesjas Bobot 2</th>
          <th>Akademik Bobot 4</th>
          <th>Mental Bobot 4</th>
          <th>Kesjas Bobot 2</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>85</td>
          <td>88</td>
          <td>90</td>
          <td>87.6</td>
          <td>1</td>
          <td>Sangat Baik</td>
          <td>4.0</td>
          <td>4.0</td>
          <td>4.0</td>
          <td>95</td>
          <td>1</td>
        </tr>
        <tr>
          <td>82</td>
          <td>85</td>
          <td>88</td>
          <td>85.0</td>
          <td>2</td>
          <td>Baik</td>
          <td>3.8</td>
          <td>3.9</td>
          <td>4.0</td>
          <td>91</td>
          <td>2</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
