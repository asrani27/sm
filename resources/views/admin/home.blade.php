@extends('layouts.app')
@push('css')

@endpush
@section('content')
<div class="row">
  <div class="col-md-12">
  <div class="box">
    
    <!-- /.box-header -->       
      <div class="box-body no-padding ">  
        <div class="col-md-12 bg-orange-gradient">
          <H1 class="text-center ">SAHABAT MUKHYAR</H1>
          <hr style="border: 1px solid black">
           
          {{-- <h3 class="text-center ">JUMLAH DPT : {{number_format($dpt)}}</h3> --}}
          <h3 class="text-center ">JUMLAH SM : {{number_format($data->count())}}</h3>
          <H2 class="text-center "></H2>

          <table style="font-size: 14px; font-weight:bold;" border="1"  cellpadding="100" cellspacing="100" width="100%">
            <tr>
              <td style="padding: 10px 10px;">NO</td>
              <td style="padding: 10px 10px;">NIK</td>
              <td style="padding: 10px 10px;">NAMA</td>
              <td style="padding: 10px 10px;">JUMLAH YG DI BAWAI</td>
            </tr>
            @foreach ($data as $key=>$item)
            <tr >
              <td style="padding: 10px 10px;">{{$key + 1}}</td>
              <td style="padding: 10px 10px;">{{$item->nik}}</td>
              <td style="padding: 10px 10px;">{{$item->nama}}</td>
              <td style="padding: 10px 10px;">{{$item->dibawai}}</td>
            </tr>
            @endforeach
          </table>
          <br/><br/>
          
          <br/>
        </div>
      </div>
      
  </div>
  </div>
  {{-- <div class="col-md-6">
    <div class="box">
      <div class="box-body no-padding ">  
          <div class="col-md-12 text-center">
            <H1>GRAFIK PERSENTASE</H1>
            <hr style="border: 1px solid black">

            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            <h2>SM : {{number_format($sm)}}</h2>
            <h2>NON SM : {{number_format($dpt - $sm)}}</h2>
          
          </div>
      </div>
    </div>
  </div> --}}
</div>


@endsection
@push('js')

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

<script>

  var c_sm = {!!json_encode($sm)!!}
  var dpt = {!!json_encode($dpt)!!}
  var p_sm = c_sm/dpt * 100;
  var pn_sm = 100 - p_sm;
  console.log(c_sm);
  window.onload = function() {
  
  var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    title: {
      text: "Persentase SM"
    },
    data: [{
      type: "pie",
      startAngle: 240,
      yValueFormatString: "##0.00\"%\"",
      indexLabel: "{label} {y}",
      dataPoints: [
        {y: p_sm, label: "SM"},
        {y: pn_sm, label: "NON SM"},
      ]
    }]
  });
  chart.render();
  
  }
  </script>
@endpush
