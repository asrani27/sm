@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
crossorigin=""/>
<style>
  #map { height: 500px; }
</style>
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <a href="/superadmin/wa" class="btn btn-flat btn-primary"><i class="fa fa-backward"></i> Kembali</a> <br /><br />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Edit Data</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" method="post" action="/superadmin/wa/edit/{{$data->id}}">
                @csrf
                <div class="box-body">
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            Format Whatsapp :<br/>
                            :th = emoji
                            \n = spasi<br/>
                            ~teks~ = coret<br/>
                            *teks* = tebal<br/>
                            _teks_ = miring
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Caption</label>
                        <div class="col-sm-10">
                            <textarea name="isi" rows="7" class="form-control">{{$data->isi}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kirim Ke</label>
                        <div class="col-sm-10">
                            <select name="kirim_ke" class="form-control">
                                <option value="">-pilih-</option>
                                <option value="MASYARAKAT" {{$data->kirim_ke == "MASYARAKAT" ? 'selected':''}}>MASYARAKAT</option>
                                <option value="ASN" {{$data->kirim_ke == "ASN" ? 'selected':''}}>ASN</option>
                                <option value="NON ASN" {{$data->kirim_ke == "NON ASN" ? 'selected':''}}>NON ASN</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Update Data</button>
                </div>
                <!-- /.box-footer -->
            </form>
            
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection
@push('js')
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
crossorigin=""></script>
<script>
//   var map = L.map('map').setView([-3.327460, 114.588515], 14);
//   L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
//     maxZoom: 24,
//     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
// }).addTo(map);

var latlng = {!!json_encode($latlong)!!}
    
    var map = L.map('map').setView(latlng, 14);
    googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    }).addTo(map);
  
    L.marker([latlng.lat,latlng.lng]).addTo(map);  

    var theMarker = {};
    
    map.on('click', function(e) {
        
        document.getElementById("lat").value = e.latlng.lat;
        document.getElementById("long").value = e.latlng.lng;
        
        if (theMarker != undefined) {
            map.removeLayer(theMarker);
        };
        
        theMarker = L.marker([e.latlng.lat,e.latlng.lng]).addTo(map);  
    });
</script>
@endpush