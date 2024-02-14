<?php

use App\Models\backend\AdminUsers;
use App\Models\frontend\Users;
use App\Models\backend\Category;
use App\Models\frontend\IdeaImages;
use App\Models\backend\Company;
?>
@extends('backend.layouts.app')
@section('title', 'Dashboards/Leaderboard')

@section('content')
<div class="container">
    <div class="row">

        <!-- Second Section with Bar and Pie Graphs -->
        <div class="col-md-12 mt-4">
            <div class="row  align-items-center">
                <div class="col-md-6">
                    <main class="">
                        <div class="d-flex align-items-center p-3 my-3  bg-purple rounded shadow-sm">
                            <div class="lh-1">
                                <h3 class=""><b>Top Idea Creators</b></h3>
                            </div>
                        </div>

                        <div class="d-flex ">
                            <div class="my-3 p-3 bg-body rounded shadow-sm m-1">
                                <h4><b>Current Leaders</b></h4>
                                <h6 class="border-bottom pb-2 mb-0">Goals created last 7 days</h6>
                                @foreach($week_data as $row)
                                <div class="d-flex text-body-secondary pt-3">
                                    <div class="mr-1 text-secondary">{{$loop->index+1}}</div>
                                    <p class="pb-3 mb-0 small lh-sm border-bottom">
                                        <strong class="d-block text-gray-dark"
                                            style="font-size:14px;">{{$row->user->name}}</strong>
                                        {{$row->total_ideas}}
                                    </p>
                                </div>
                                @endforeach
                            </div>

                            <div class="my-3 p-3 bg-body rounded shadow-sm m-1">
                                <h4><b>Last Month's Winners</b></h4>
                                <h6 class="border-bottom pb-2 mb-0">Goals created last month</h6>
                                @foreach($month_data as $row)
                                <div class="d-flex text-body-secondary pt-3">
                                    <div class="mr-1 text-secondary">{{$loop->index+1}}</div>
                                    <p class="pb-3 mb-0 small lh-sm border-bottom">
                                        <strong class="d-block text-gray-dark"
                                            style="font-size:14px;">{{$row->user->name}}</strong>
                                        {{$row->total_ideas}}
                                    </p>
                                </div>
                                @endforeach
                            </div>
                            <div class="my-3 p-3 bg-body rounded shadow-sm m-1">
                                <h4><b>All-Time Leaders</b></h4>
                                <h6 class="border-bottom pb-2 mb-0">Goals created all-time</h6>
                                @foreach($all_time_data as $row)
                                <div class="d-flex text-body-secondary pt-3">
                                    <div class="mr-1 text-secondary">{{$loop->index+1}}</div>
                                    <p class="pb-3 mb-0 small lh-sm border-bottom">
                                        <strong class="d-block text-gray-dark"
                                            style="font-size:14px;">{{$row->user->name}}</strong>
                                        {{$row->total_ideas}}
                                    </p>
                                </div>
                                @endforeach

                            </div>
                        </div>



                    </main>
                </div>
                <div class="col-md-4">
                    <h4>Idea Staus</h4>
                    <canvas id="myChart"></canvas>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <div class="row m-1">
                            <h5>{{$participants}} <span class="ml-2"></span> Participants</h5>
                            <h5>{{$top_rated}} <span class="ml-2"></span> Top Rated ⭐</h5>
                            <h5>{{$implemented}} <span class="ml-2"></span> Implemented</h5>
                            <h5>{{$underprocess}} <span class="ml-2"></span> Under Process</h5>
                            <h5>{{$on_hold}} <span class="ml-2"></span> On Hold</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6">

                </div>

                <div class="col-md-4  d-flex justify-content-center" style="height:300px;">
                    <h4>Categroy Wise Ideas</h4>
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>



    </div>
</div>
@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>


<script>
    const barChart = document.getElementById('myChart').getContext('2d');

        new Chart(barChart, {
            type: 'bar',
            data: {
                labels: ['Top Rated', 'On Hold', 'Revised', 'Reviewed'],
                datasets: [{
                    label: 'Idea Count',
                    data: [{{$top_rated}}, {{$on_hold}}, {{$revised}}, {{$reviewed}}],
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true
                    }
                },
                
            },
        });
</script>


<script>
    // Function to generate dynamic colors based on the number of categories
    function generateDynamicColors(numColors) {
        var colors = [];
        for (var i = 0; i < numColors; i++) {
            colors.push(getRandomColor());
        }
        return colors;
    }

    // Function to generate a random color
    function getRandomColor() {

        // var letters = '0123456789ABCDEF'; //for any color
        var letters = '89ABCDEF';  //for lighter color
        var color = '#';
        for (var i = 0; i < 6; i++) {
            // color += letters[Math.floor(Math.random() * 16)]; //for any color
            color += letters[Math.floor(Math.random() * letters.length)];

        }
        return color;
    }

    const pieChart = document.getElementById('myPieChart');

        var CategoryLabel = Object.values(@json($categroy));
        // console.log(CategoryLabel);
        var CategoryCount = @json($couting_array);
        
    new Chart(pieChart, {
        type: 'pie',
        data: {
            labels: CategoryLabel,
            datasets: [{
                label: 'Idea Count',
                data: CategoryCount,
                backgroundColor: generateDynamicColors(CategoryCount.length),
                hoverOffset: 4
            }],
        },
        options: {
            plugins: {
                datalabels: {
                    color: '#000', // Data label text color
                    formatter: (value) => {
                        return value || ''; // Display the count value; if the value is falsy, display an empty string
                    },
                },
            },
            title: {
                display: true,
                text: 'Category Wise Ideas', // Your chart title here
                fontSize: 15,
                fontColor: '#000', // Title text color
            },
        },
        plugins: [ChartDataLabels],
    });

</script>













@endsection