@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
crossorigin=""/>
<style>
  #map { height: 700px; }
</style>
@endpush
@section('content')
<div class="row text-center">
  <div class="col-lg-4">
    <a href="" class="btn btn-primary btn-block">KECAMATAN</a>
  </div>
  <div class="col-lg-4">
    <a href="" class="btn btn-primary btn-block">KELURAHAN</a>
  </div>
  <div class="col-lg-4">
    <a href="" class="btn btn-primary btn-block">RT</a>
  </div>
</div>
<br/>
<div class="row">
<div id="map"></div>
</div>


@endsection
@push('js')
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
crossorigin=""></script>
<script>
  var map = L.map('map').setView([-3.327460, 114.588515], 14);
  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 24,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

var kec = {!!json_encode($kec)!!}

kec.forEach(element => {
  if(element.lat == null){

  }else{
    var marker = L.marker([element.lat, element.long]).addTo(map);
    marker.bindPopup(element.nama).openPopup();
  }
});

</script>
@endpush
