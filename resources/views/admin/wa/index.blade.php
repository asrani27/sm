@extends('layouts.app')
@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Data Nomor ({{$data->total()}})</h3>

            <div class="box-tools">
              <a href="/superadmin/wa/create" class="btn btn-flat btn-sm btn-primary"  data-toggle="modal" data-target="#modal-default"><i class="fa fa-whatsapp"></i> Send Message</a>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Text</th>
                <th>Message</th>
                <th>Nomor Tujuan</th>
                
                <th>Aksi</th>
              </tr>
              {{-- @foreach ($data as $key => $item)
              <tr>
                <td>{{$data->firstItem() + $key}}</td>
                <td>{{$item->nomor}}</td>
                <td>
                  <a href="/superadmin/nomor/delete/{{$item->id}}" class="btn btn-flat btn-sm btn-primary" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i> Delete</a>
                </td>
              </tr>
              @endforeach --}}
            </tbody></table>
          </div>
          <!-- /.box-body -->
        </div>
        {{$data->links()}}
        <!-- /.box -->
      </div>
</div>

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Send Message</h4>
      </div>
      <form action="/superadmin/wa/send-message" method="post" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
        <input type="text" class="form-control" placeholder="isi" name="message" required><br/>
        <input type="file" class="form-control" name="file">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
        <button type="submit" class="btn btn-primary">Upload</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection
@push('js')

@endpush
