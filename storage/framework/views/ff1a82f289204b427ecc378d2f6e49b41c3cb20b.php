<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<footer class="footer footer-transparent d-print-none cs-footer">
    <div class="container-fluid">
        <div class="row text-center align-items-center">
            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <p>Copyright &copy; <span id="current-year"></span> <a href="https://www.jmbaxi.com" target="_blank">JMBAXI GROUP</a>. All rights reserved.</p>
            </div>
            <div class="col-lg-auto ms-lg-auto">
                <p>Powered by <a href="http://parasightsolutions.com/" target="_blank">Parasight Solutions</a></p>
            </div>
        </div>
    </div>
</footer>

<!-- END: Footer-->

<!-- BEGIN: Vendor JS-->
<script src="<?php echo e(asset('public/backend-assets/app-assets/vendors/js/vendors.min.js')); ?>"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="<?php echo e(asset('public/backend-assets/app-assets/js/core/app-menu.js')); ?>"></script>
<script src="<?php echo e(asset('public/backend-assets/app-assets/js/core/app.js')); ?>"></script>
<!-- END: Theme JS-->


<script src="<?php echo e(asset('public/backend-assets/assets/js/jquery-3.6.1.min.js')); ?>"></script>

<script src="<?php echo e(asset('public/backend-assets/assets/js/bootstrap.bundle.min.js')); ?>"></script>

<!-- BEGIN: Page JS-->
<script src="<?php echo e(asset('public/backend-assets/app-assets/js/scripts/cards/card-statistics.js')); ?>"></script>
<!-- END: Page JS-->


<script src="<?php echo e(asset('public/frontend-assets/js/tabler.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/frontend-assets/js/demo.min.js')); ?>"></script>
<!-- Tabler Core -->

<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>

<script src="<?php echo e(asset('public/frontend-assets/js/jquery.magnific-popup.js')); ?>"></script>
<script src="<?php echo e(asset('public/frontend-assets/js/jquery.magnific-popup.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/frontend-assets/js/toastr.min.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="<?php echo e(asset('public/frontend-assets/static/js/app.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    WebFont.load({
        google: {
            "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
        }
        , active: function() {
            sessionStorage.fonts = true;
        }
    });

    $(document).ready(function() {
        if ($("#editor").length != 0) {
            CKEDITOR.replace('editor', {
                height: 260,

            });
        }
        if ($("#editor1").length != 0) {
            CKEDITOR.replace('editor1', {
                height: 260
            , });
        }
        if ($("#editor2").length != 0) {
            CKEDITOR.replace('editor2', {
                height: 260,

            });
        }
    });


    $(document).ready(function() {
        $('#reason_resubmit').hide();
        $('#reason_reject').hide();
        $('#reason_sla').hide();
        $('#reason_sla').prop('required', false);
        update_idea_status_dropdown();
        $('#idea_status').change(function() {
            update_idea_status_dropdown();
        });
    });

    function update_idea_status_dropdown(){
        var sla_status = $('#deadline_status').val();
        $('#reason_sla').hide();
            $('#reason_sla').prop('required', false);
            if(sla_status == 1){
                $('#reason_sla').show();
                $('#reason_sla').prop('required', true);
            }
            if ($('#idea_status').find(":selected").val() == 'resubmit') {
                $('#reason_resubmit').show();
                $("#reason_resubmit").prop('required', true);
            } else if ($('#idea_status').find(":selected").val() == 'reject') {
                $('#reason_reject').show();
                $("#reason_reject").prop('required', true);

            }
            else if ($('#idea_status').find(":selected").val() == 'in_assessment'){
            }
            if ($('#idea_status').find(":selected").val() != 'resubmit') {
                $('#reason_resubmit').hide();
                $("#reason_resubmit").prop('required', false);
            }
            if ($('#idea_status').find(":selected").val() != 'reject') {
                $('#reason_reject').hide();
                $("#reason_reject").prop('required', false);
            }
    }

    // $(document).ready(function() {
    function printFunc() {
        var divToPrint = document.getElementById('DivIdToPrint');
        var htmlToPrint = `
            <style type="text/css">
                .content_container {
                top: 64% !important;
            }
            .user_name {
                font-size:2.2em !important;
                margin-bottom:130px !important;
            }
            * { margin:0px !important;padding:0px   !important;}
            .date {
                font-size:1.6em !important;
            }
            </style>`;
        htmlToPrint += divToPrint.outerHTML;
        newWin = window.open("");

        newWin.document.write(htmlToPrint);
        newWin.print();
    }

    // document.ready
    $(document).ready(function() {
        $('.test-popup-link').magnificPopup({
            type: 'image'
        });

        function getNotifications() {

            $.ajax({
                type: 'GET'
                , url: '<?php echo e(url('ideas/ajax_get_notifications')); ?>'
                , success: function(data) {
                    var jsonData = JSON.parse(data);
                    var return_data = jsonData.response;
                    notification_read_ids = jsonData.notification_read_ids;
                    var count_unread = Object.keys(notification_read_ids[0]).length;
                    if (count_unread > 0) {
                        $('#count_unread').empty();
                        $('#count_unread').append(`${count_unread}`);
                        $('#count_unread').show();
                    } else {
                        $('#count_unread').hide();
                    }
                    if(jsonData.response.length <= 0){
                        $('.btn_clear_notif').addClass('d-none');
                    }

                    if (jsonData.response.length > 0) {
                        $('.btn_clear_notif').removeClass('d-none');
                        $('#no_notifications').empty();
                        $('#notifications_lists').empty();
                        for (var i = 0; i < jsonData.response.length; i++) {
                            var badge = '';
                            if (return_data[i].notification_read == '0') {
                                badge = `<span style="margin:0px 6px 5px 6px" class="badge bg-red"></span>`;
                            } else {
                                var badge = '';
                            }
                            var url_update_notification = '<?php echo e(url("ideas/ajax_update_notification/:notification_id/:idea_id")); ?>';
                            url_update_notification = url_update_notification.replace(':notification_id', return_data[i].notification_id);
                            url_update_notification = url_update_notification.replace(':idea_id', return_data[i].idea_id);
                            $('#notifications_lists').append(
                                `<a class="text-decoration-none" href="${url_update_notification}" style="cursor:pointer">
                                    <li class="list-group-item">
                                        <div class="d-flex align-items-center justify-content-between" id="notification_title">
                                            <p style="font-size:1em;margin-bottom:5px">${return_data[i].notification_title}</p>
                                        ${badge}
                                        </div>
                                        <div id="notification_body">
                                            <p style="font-size:1em;margin-bottom:8px">${return_data[i].notification_description}</p>
                                        </div>
                                    </li>
                                </a>`
                            );
                        }
                    } else {
                        $('#notifications_lists').empty();
                        $('#no_notifications').empty();
                        $('#no_notifications').append('<h3 style="padding:10px;">No notifications yet</h3>');
                        $('#no_notifications').show();
                    }
                }
            });
        }
        getNotifications();
        setInterval(getNotifications, 5000);
    });

    $('#role_global').change(function() {

    var role = $('#role_global :selected').val();

    window.location = "<?php echo e(url('/users/updaterole')); ?>/" + role;

    });

    $('#reset_file').click(function(){
        $('#selected-images').hide();
    });

       $('.navbar-nav').on('click','.btn_clear_notif', function(e){
        e.stopPropagation();
       let user_data_id = $(this).attr('data');
       let user_role = "<?php echo e((isset($roles_external->role_type)?$roles_external->role_type:'')); ?>";


       let data = {'_token':"<?php echo e(@csrf_token()); ?>", 'id': user_data_id,'user_role':user_role };
       if(confirm('do you want to clear all notification?')){
        $.ajax({
            type: 'post'
            , url: '<?php echo e(url('ideas/ajax_clear_notification')); ?>'
            , data: data
            ,datatype:'application/json'
            , success: function(resp) {
               if(resp == 1){
                e.stopPropagatio = false;
               }
            }
        });
       }
    });

    // Set the time (in milliseconds) after which the automatic redirect should occur
    const logoutTime =  15 * 60 * 1000; // 15 minutes in milliseconds

    // Start the timer when the user logs in or interacts with the site
    let timer = setTimeout(() => {
        // Redirect the user to the logout page after the specified time
        window.location.href =
        "<?php echo e(url('/')); ?>/user/logout/timeout"; // Change 'logout.html' to the actual logout page URL
    }, logoutTime);

    // Reset the timer whenever the user interacts with the site
    function resetTimer() {
        clearTimeout(timer);
        timer = setTimeout(() => {
            window.location.href =
            "<?php echo e(url('/')); ?>/user/logout/timeout"; // Change 'logout.html' to the actual logout page URL
        }, logoutTime);
    }

    // Attach event listeners to relevant elements (e.g., buttons, links) to reset the timer
    document.addEventListener('click', resetTimer);
    document.addEventListener('mousemove', resetTimer);
    document.addEventListener('keypress', resetTimer);
    document.addEventListener('change', resetTimer);
</script>
<?php /**PATH C:\wamp64\www\ideaportal\resources\views/frontend/includes/footer.blade.php ENDPATH**/ ?>