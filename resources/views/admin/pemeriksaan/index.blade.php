@extends('layouts.app')
@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Data registrasi</h3>

            <div class="box-tools">
              <a href="/superadmin/pemeriksaan/create" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nomor Pemeriksaan</th>
                <th>Nomor Reg</th>
                <th>Petugas</th>
                <th>Hasil</th>
                <th>Aksi</th>
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                
                <td>{{$data->firstItem() + $key}}</td>
                <td>{{$item->tanggal}}</td>
                <td>{{$item->nomor}}</td>
                <td>{{$item->registrasi == null ? '': $item->registrasi->nomor_reg}}</td>
                <td>{{$item->petugas->nama}}</td>
                <td>{{$item->hasil}}</td>
                <td>
                  <a href="/superadmin/pemeriksaan/cetak/{{$item->id}}" class="btn btn-flat btn-sm btn-primary" target="_blank"><i class="fa fa-file"></i> Cetak</a>
                  <a href="/superadmin/pemeriksaan/edit/{{$item->id}}" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                  <a href="/superadmin/pemeriksaan/delete/{{$item->id}}" class="btn btn-flat btn-sm btn-primary" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i> Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody></table>
          </div>
          <!-- /.box-body -->
        </div>
        {{$data->links()}}
        <!-- /.box -->
      </div>
</div>

@endsection
@push('js')

@endpush
