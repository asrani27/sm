@extends('layouts.app')
@push('css')

@endpush
@section('content')
<a href="/superadmin/refresh" class="btn btn-md btn-danger"><i class="fa fa-refresh"></i>&nbsp;Refresh</a><br/><br/>
<div class="row">
  <div class="col-md-8">
  <div class="box">  
      <div class="box-body no-padding ">  
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
      </div>
  </div>
  </div>
  <div class="col-md-4">
  <div class="box">  
      <div class="box-body no-padding ">  
        <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
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
  
  
  </script>

<script>
  window.onload = function () {
  
  var chart = new CanvasJS.Chart("chartContainer", {
    exportEnabled: true,
    animationEnabled: true,
    title:{
      text: "DPT Per Kecamatan"
    },
    subtitles: [{
      text: "Prediksi Data Sahabat Dengan Data DPT"
    }], 
    axisX: {
      title: "Kecamatan"
    },
    axisY: {
      title: "DPT Terdaftar",
      titleFontColor: "#4F81BC",
      lineColor: "#4F81BC",
      labelFontColor: "#4F81BC",
      tickColor: "#4F81BC",
      includeZero: true
    },
    axisY2: {
      title: "Data Sahabat",
      titleFontColor: "#C0504E",
      lineColor: "#C0504E",
      labelFontColor: "#C0504E",
      tickColor: "#C0504E",
      includeZero: true
    },
    toolTip: {
      shared: true
    },
    legend: {
      cursor: "pointer",
      itemclick: toggleDataSeries
    },
    data: [{
      type: "column",
      name: "DPT Terdaftar",
      showInLegend: true,      
      yValueFormatString: "#,##0.# Org",
      dataPoints: [
        { label: "BJM BARAT",  y: 19034.5 },
        { label: "BJM TIMUR", y: 20015 },
        { label: "BJM TENGAH", y: 25342 },
        { label: "BJM UTARA",  y: 20088 },
        { label: "BJM SELATAN",  y: 28234 }
      ]
    },
    {
      type: "column",
      name: "Sahabat",
      axisYType: "secondary",
      showInLegend: true,
      yValueFormatString: "#,##0.# Org",
      dataPoints: [
        { label: "BJM BARAT",  y: 2 },
        { label: "BJM TIMUR", y: 4 },
        { label: "BJM TENGAH", y:  3 },
        { label: "BJM UTARA",  y: 2 },
        { label: "BJM SELATAN",  y: 5 }
      ]
    }]
  });
  chart.render();
  
  function toggleDataSeries(e) {
    if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
      e.dataSeries.visible = false;
    } else {
      e.dataSeries.visible = true;
    }
    e.chart.render();
  }
  

  var chart2 = new CanvasJS.Chart("chartContainer2", {
	exportEnabled: true,
	animationEnabled: true,
	title:{
		text: "DPT Kota Banjarmasin"
	},
	legend:{
		cursor: "pointer",
		itemclick: explodePie
	},
	data: [{
		type: "pie",
		showInLegend: true,
		toolTipContent: "{name}: <strong>{y}%</strong>",
		indexLabel: "{name} - {y}%",
		dataPoints: [
			{ y: 1250, name: "DPT Terdaftar", exploded: true },
			{ y: 50, name: "Sahabat" },
		]
	}]
});
chart2.render();
}

function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.chart2.render();

  }
  </script>
@endpush
