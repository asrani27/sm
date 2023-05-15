@extends('layouts.app')
@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Laporan</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <a href="/laporan/petugas" class='btn btn-primary btn-flat' target="_blank"><i class="fa fa-file-o"></i>  Laporan Petugas</a>
            <a href="/laporan/registrasi" class='btn btn-primary btn-flat' target="_blank"><i class="fa fa-file-o"></i>  Laporan Registrasi</a>
            <a href="/laporan/pemeriksaan" class='btn btn-primary btn-flat' target="_blank"><i class="fa fa-file-o"></i>  Laporan Pemeriksaan</a>

            <br/>
            <br/>
            <br/>
            <h1>Laporan Rekapitulasi</h1>
            <form method="get" action="/laporan/rekapitulasi">
              @csrf
              <select name="bulan" class="form-control">
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
              </select>

              <select name="tahun" class="form-control">
                <option value="2023">2023</option>
                <option value="2024">2024</option>
              </select>
              <button type="submit" class='btn btn-primary btn-flat' target="_blank">Cetak</button>
            </form>
          </div>
          <!-- /.box-body -->
        </div>
        
        <!-- /.box -->
      </div>
</div>

@endsection
@push('js')

@endpush
