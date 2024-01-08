@extends('layouts.app')
@push('css')

@endpush
@section('content')
<div class="row">
  <div class="col-md-6">
  <div class="box">
    
    <!-- /.box-header -->       
      <div class="box-body no-padding ">  
        <div class="col-md-12 bg-orange-gradient">
          <H1 class="text-center ">SAHABAT MUKHYAR</H1>
          <hr style="border: 1px solid black">
           
          <h3 class="text-center ">JUMLAH DPT</h3>
          <H2 class="text-center ">{{number_format($dpt)}}</H2>

          <table style="font-size: 14px; font-weight:bold;" border="1"  cellpadding="100" cellspacing="100" width="70%">
            <tr>
              <td style="padding: 10px 10px;">KECAMATAN</td>
              <td style="padding: 10px 10px;">JUMLAH DPT</td>
              <td style="padding: 10px 10px;">JUMLAH SM</td>
              <td style="padding: 10px 10px;">PERSENTASE</td>
            </tr>
            @foreach ($kec as $item)
            <tr >
              <td style="padding: 10px 10px;">{{$item->nama}}</td>
              <td class="text-center">{{number_format($item->dpt)}}</td>
              <td class="text-center">0</td>
              <td class="text-center">0 %</td>
            </tr>
            @endforeach
          </table>
          <br/><br/>
          <table style="font-size: 14px; font-weight:bold;" border="1"  cellpadding="100" cellspacing="100" width="70%">
            <tr>
              <td style="padding: 10px 10px;">KELURAHAN</td>
              <td style="padding: 10px 10px;">JUMLAH DPT</td>
              <td style="padding: 10px 10px;">JUMLAH SM</td>
              <td style="padding: 10px 10px;">PERSENTASE</td>
            </tr>
            @foreach ($kel as $item)
            <tr >
              <td style="padding: 5px 5px;">{{$item->nama}}</td>
              <td class="text-center">{{number_format($item->dpt)}}</td>
              <td class="text-center">0</td>
              <td class="text-center">0 %</td>
            </tr>
            @endforeach
          </table>
          <br/>
        </div>
      </div>
      
  </div>
  </div>
  <div class="col-md-6">
    <div class="box">
      <div class="box-body no-padding ">  
          <div class="col-md-12 text-center">
            <H1>GRAFIK PERSENTASE</H1>
            <hr style="border: 1px solid black">
          </div>
      </div>
    </div>
    </div>
</div>


@endsection
@push('js')

@endpush
