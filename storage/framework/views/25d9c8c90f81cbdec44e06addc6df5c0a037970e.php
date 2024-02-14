<?php $__env->startSection('title', 'Admin-Dashboard'); ?>
<?php $__env->startSection('content'); ?>

<section class="dashboard">
    <div class="row">
        <div class="col-md-3">
            <div class="dashboard-card">
                <div class=" row align-items-center ">

                    <div class="col-md-8">
                        <h4>TOTAL IDEAS</h4>
                        <span><?php echo e($total_ideas); ?></span>
                    </div>
                    <div class="col-md-4">
                        <!-- <img src="..\public\backend-assets\images\img1.png" class=" img-fluid" /> -->
                        <img src="<?php echo e(asset('public/backend-assets/images/img1.png')); ?>" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-3">
            <div class="dashboard-card">
                <div class=" row align-items-center">
                    <div class="col-md-8">
                        <h4>REVISE REQUEST</h4>
                        <span><?php echo e($revise_request); ?></span>
                    </div>
                    <div class="col-md-4">
                        <img src="<?php echo e(asset('public/backend-assets/images/4.png')); ?>" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="dashboard-card">
                <div class=" row align-items-center">
                    <div class="col-md-8">
                        <h4>UNDER ASSESSMENT</h4>
                        <span><?php echo e($under_assessment); ?></span>
                    </div>
                    <div class="col-md-4">
                        <img src="<?php echo e(asset('public/backend-assets/images/7.png')); ?>" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="dashboard-card">
                <div class=" row align-items-center">
                    <div class="col-md-8">
                        <h4>UNDER APPROVAL</h4>
                        <span><?php echo e($under_approving); ?></span>
                    </div>
                    <div class="col-md-4">
                        <img src="<?php echo e(asset('public/backend-assets/images/3.png')); ?>" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="dashboard-card">
                <div class=" row align-items-center">
                    <div class="col-md-8">
                        <h4>APPROVED IDEAS</h4>
                        <span><?php echo e($approved_ideas); ?></span>
                    </div>
                    <div class="col-md-4">
                        <img src="<?php echo e(asset('public/backend-assets/images/2.png')); ?>" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <div class=" row align-items-center">
                    <div class="col-md-8">
                        <h4>IMPLEMENTATION</h4>
                        <span><?php echo e($implementation); ?></span>
                    </div>
                    <div class="col-md-4">
                        <img src="<?php echo e(asset('public/backend-assets/images/5.png')); ?>" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        

    



    <div class="col-md-3">
        <div class="dashboard-card">
            <div class=" row align-items-center">
                <div class="col-md-8">
                    <h4>IMPLEMENTED IDEAS</h4>
                    <span><?php echo e($implemented); ?></span>
                </div>
                <div class="col-md-4">
                    <img src="<?php echo e(asset('public/backend-assets/images/2.png')); ?>" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card">
            <div class=" row align-items-center">
                <div class="col-md-8">
                    <h4>REJECTED</h4>
                    <span><?php echo e($rejected); ?></span>
                </div>
                <div class="col-md-4">
                    <img src="<?php echo e(asset('public/backend-assets/images/6.png')); ?>" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    </div>

</section>

<!-- <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Area chart</h4>
                  <canvas id="areaChart"></canvas>
                </div>
              </div> -->
<div class="col-lg-12">
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="subheader">Ideas submitted this year </h3>
                    <div id="chart-mentions" class="chart-lg"></div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('public/backend-assets/js/template.js')); ?>"></script>

<script>
    function getNumber() {
        const arr_res = [];
        const obj_res = <?php echo json_encode($response); ?>

        obj_res.map((e) => {
            arr_res.push(e.y);
        })
        var largest = 0;

        for (i = 0; i < arr_res.length; i++) {
            if (arr_res[i] > largest) {
                largest = arr_res[i];
            }
        }
        return largest < 10 ? 10 : largest;
    }




    $(document).ready(function() {
        //console.log((<?php echo json_encode($response); ?>));
        var options = {
            chart: {
                height: 350
                , type: 'bar'
            , }
            , dataLabels: {
                enabled: false
            }
            , series: [{
                name: 'Ideas',
                // data: [],
                data: <?php echo json_encode($response); ?>

            , }]
            , yaxis: {
                max : getNumber
            }
            , title: {
                text: 'Ideas'
            , }
            , noData: {
                text: 'Loading...'
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#chart-mentions")
            , options
        );

        chart.render();


        // url = '<?php echo e(url('ideas/getChartValues')); ?>';        
        // $.getJSON(url, function(response) {
        //     // var jsonData = JSON.parse(response);
        //     // var return_data = jsonData.response;
        //     //console.log(response);
        //     chart.updateSeries([{
        //         name: 'Ideas',
        //         data: response
        //     }])
        // });

    })

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ideaportal/resources/views/backend/admin/dashboard.blade.php ENDPATH**/ ?>