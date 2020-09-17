@extends('layouts.master')
{{-- @section('title', 'Dashboard') --}}
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Data Customer</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Data Customer</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      
      <!-- /.card -->

      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          
          <!-- BAR CHART -->
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Bar Chart</h3>

              {{-- <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
              </div> --}}
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="barChart" style="min-height: 250px; height: 250px; width: 100%;"></canvas>
                {{-- <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas> --}}
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- LINE CHART -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Line Chart</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                {{-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> --}}
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="lineChart" style="min-height: 250px; height: 250px; width: 100%;"></canvas>
                {{-- <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas> --}}
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

@endsection
@section('script')

<script>

// Opsi chart
var chartOption = {
  scales: {
    yAxes: [{
      ticks: {
        beginAtZero: true
      }
    }]
  },
  maintainAspectRatio: false
}

// Opsi bar chart
var barChartOption = $.extend(chartOption, {/* kasih option di sini */});

// Opsi line chart
var lineChartOption = $.extend(chartOption, {elements: {line: {tension: 0}}});

// Bar chart (Customer & CG)
$.ajax({
  url: "/dashboard/data-chart-user",
  success: function (data) {
    var labelUser = data[0];
    var dataUserCustomer = data[1];
    // var dataUserCG = data[2];
    var barChart = new Chart(document.getElementById('barChart').getContext('2d'), {
      type: 'bar',
      data: {
        labels: labelUser,
        datasets: [
          // Ini customer
          {
            label: "Customer",
            data: dataUserCustomer,
            backgroundColor: 'rgba(227, 53, 76, 0.2)',
            borderColor: 'rgba(227, 53, 76, 1)',
            borderWidth: 1.5
          }
          // Ini CG
          // {
          //   label: "Customer",
          //   data: dataUserCG,
          //   backgroundColor: 'rgba(101, 110, 187, 0.2)',
          //   borderColor: 'rgba(101, 110, 187, 1)',
          //   borderWidth: 1.5
          // }
        ]
      },
      options: barChartOption
    });
  }
});

// Line chart (Pemesanan & Pemasukan/Pendapatan)
$.ajax({
  url: "/dashboard/data-chart-pemesanan",
  success: function (data) {
    var labelPemesan = data[0];
    var dataPemesan = data[1];
    var dataPendapatan = data[2];
    var lineChart = new Chart(document.getElementById('lineChart').getContext('2d'), {
      type: 'line',
      data: {
        labels: labelPemesan,
        datasets: [
          // Ini jumlah pemesan
          {
            label: "Pemesan",
            data: dataPemesan,
            backgroundColor: 'rgba(227, 53, 76, 0.2)',
            borderColor: 'rgba(227, 53, 76, 1)',
            borderWidth: 1.5
          },
          // Ini jumlah pendapatan
          {
            label: "Pemasukan/pendapatan",
            data: dataPendapatan,
            backgroundColor: 'rgba(101, 110, 187, 0.2)',
            borderColor: 'rgba(101, 110, 187, 1)',
            borderWidth: 1.5
          }
        ]
      },
      options: lineChartOption
    });
  }
});

</script>
@endsection