@extends('admin.master')
@section('title', 'Thống kê tiền thu được')
@section('PageContent')
<div class="row border-bottom bd-lightGray mt-4">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Thống kê tiền thu được theo tháng</h3>
    </div>
    <div class="col-md-8 d-flex flex-justify-center flex-justify-end-md">
        <ul class="breadcrumbs bg-transparent m-0">
            <li class="page-item"><a class="page-link" href="/"><span class="mdi mdi-home"></span></a></li>
            <li class="page-item"><a class="page-link" href="#">Thống kê tiền thu được theo tháng</a></li>
        </ul>
    </div>
</div>
<section class="tables_wrapper">
    <aside class="tables_components">
        <div class="row">
            <div class="col-12">
                <div class="bg-white p-4">
                    <canvas id="chartMonth" data-order="{{$month}}"></canvas>
                </div>
            </div>
        </div>
    </aside>
</section>
<div class="row border-bottom bd-lightGray mt-4 ">
    <div class="col-md-4 text-center text-left-md">
        <h3 class="content_title m-0">Thống kê tiền thu được theo năm</h3>
    </div>
    <div class="col-md-8 d-flex flex-justify-center flex-justify-end-md">
        <ul class="breadcrumbs bg-transparent m-0">
            <li class="page-item"><a class="page-link" href="/"><span class="mdi mdi-home"></span></a></li>
            <li class="page-item"><a class="page-link" href="#">Thống kê tiền thu được theo năm</a></li>
        </ul>
    </div>
</div>
<section class="tables_wrapper ">
    <aside class="tables_components">
        <div class="row flex-justify-center">
            <div class="col-3 ">
                <div class="bg-white p-4">
                    <canvas id="chartYear" width="100" height="100"  data-order="{{$year}}"></canvas>
                </div>
            </div>
        </div>
    </aside>
</section>
@endsection
@section('JsLibraries')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
    var order = $('#chartMonth').data('order');
    var listOfValue = [];
    listOfValue = Object.values(order);
    var ctx = document.getElementById('chartMonth').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels: ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],
            datasets: [{
                label: 'Tiền đã thu (¥)',
                backgroundColor: '#ce352c',
                borderColor: '#ce352c',
                data: listOfValue
            }]
        },
        // Configuration options go here
        options: {
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        return tooltipItem.yLabel.toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                    }
                }
            }
        }
    });
</script>
<script>
    var order = $('#chartYear').data('order');
    var listOfValue = [];
    var year = [];
    order.forEach(function(element){
        year.push(element.getYear);
        listOfValue.push(element.value);
    });
    var ctx1 = document.getElementById('chartYear').getContext('2d');
    var chart1 = new Chart(ctx1, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels: year,
            datasets: [{
                label: 'Tiền thu được (¥)',
                backgroundColor: '#0366d6',
                borderColor: '#0366d6',
                data: listOfValue
            }]
        },
        // Configuration options go here
        options: {
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        return tooltipItem.yLabel.toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                    }
                }
            }
        }
    });
</script>
@endsection
