<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light navbar-border">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2 footer-text">
                    <span class="float-md-left d-block d-md-inline-block ">
                        Copyright &copy; 2018 - <?php echo e(date('Y')); ?>

                        <a class="text-bold-800 grey darken-2" href="<?php echo e(route('admin.dashboard')); ?>" target="_blank">
                            JMBAXI GROUP</a>
                    </span>
                </p>
            </div>

            <div class="col-md-6">
                <p class="text-grey text-end footer-text"><a href="http://www.parasightsolutions.com/">Powered By
                        Parasight Solutions</a></p>
            </div>

        </div>
    </div>

</footer>
<!-- END: Footer-->

<!-- BEGIN: Vendor JS-->
<script src="<?php echo e(asset('public/backend-assets/app-assets/vendors/js/vendors.min.js')); ?>"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="<?php echo e(asset('public/backend-assets/app-assets/vendors/js/charts/apexcharts/apexcharts.min.js')); ?>"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="<?php echo e(asset('public/backend-assets/app-assets/js/core/app-menu.js')); ?>"></script>
<script src="<?php echo e(asset('public/backend-assets/app-assets/js/core/app.js')); ?>"></script>
<!-- END: Theme JS-->


<script src="<?php echo e(asset('public/backend-assets/assets/js/jquery-3.6.1.min.js')); ?>"></script>

<script src="<?php echo e(asset('public/backend-assets/assets/js/bootstrap.bundle.min')); ?>"></script>

<!-- BEGIN: Page JS-->
<script src="<?php echo e(asset('public/backend-assets/app-assets/js/scripts/cards/card-statistics.js')); ?>"></script>
<!-- END: Page JS-->

<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>

<script src="<?php echo e(asset('public/frontend-assets/js/toastr.min.js')); ?>"></script>

<!-- Kapella Theme JS Backend files -->
<script src="<?php echo e(asset('public/backend-assets/js/vendor.bundle.base.js')); ?>"></script>
<script src="<?php echo e(asset('public/backend-assets/js/template.js')); ?>"></script>
<script src="<?php echo e(asset('public/backend-assets/js/Chart.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/backend-assets/js/progressbar.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/backend-assets/js/chartjs-plugin-datalabels.js')); ?>"></script>
<script src="<?php echo e(asset('public/backend-assets/js/justgage.js')); ?>"></script>
<script src="<?php echo e(asset('public/backend-assets/js/raphael-2.1.4.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/backend-assets/js/jquery.cookie.js')); ?>"></script>
<script src="<?php echo e(asset('public/backend-assets/js/dashboard.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js"
    integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="<?php echo e(asset('public/backend-assets/assets/js/bootstrap-tagsinput.js')); ?>"></script>
<script src="<?php echo e(asset('public/frontend-assets/js/jquery.magnific-popup.js')); ?>"></script>
<script src="<?php echo e(asset('public/frontend-assets/js/jquery.magnific-popup.min.js')); ?>"></script>




<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    var values = $('#tags option[selected="true"]').map(function() {
        return $(this).val();
    }).get();
    $('#tags').select2({
        placeholder: "Please select"
    });
</script>


<script>
    $(document).ready(function () {
        // Initialize Select2
        $('#select2all').select2({
            placeholder: 'Select an option',
            allowClear: true
        });

        // Add "Select All" checkbox at the top
        $('#select2all').on('select2:open', function (e) {
            if (!$('.select2-all-checkbox').length) {
                var $selectAllOption = $('<option>', {
                    class: 'select2-all-checkbox',
                    value: 'all',
                    text: 'Select All'
                });

                $(this).prepend($selectAllOption);
                $(this).trigger('change');
            }
        });

        // Handle "Select All" checkbox click
        $('#select2all').on('change', function (e) {
            if ($(this).val() && $(this).val().includes('all')) {
                // Select all options
                $(this).val($(this).find('option').not('[value="all"]').map(function () {
                    return $(this).val();
                })).trigger('change');
            }
        });
    });
</script>

<script>
    WebFont.load({
        google: {
            "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
        },
        active: function() {
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
                height: 260,

            });
        }
        if ($("#editor2").length != 0) {
            CKEDITOR.replace('editor2', {
                height: 260,

            });
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.getElementById('navbar_top').classList.add('fixed-top');
                // add padding top to show content behind navbar
                navbar_height = document.querySelector('.navbar').offsetHeight;
                document.body.style.paddingTop = navbar_height + 'px';
            } else {
                document.getElementById('navbar_top').classList.remove('fixed-top');
                // remove padding top from body
                document.body.style.paddingTop = '0';
            }
        });
    });

    $(window).scroll(function() {
        if (window.matchMedia('(min-width: 992px)').matches) {
            var header = $('.horizontal-menu');
            if ($(window).scrollTop() >= 70) {
                $(header).addClass('fixed-on-scroll');
            } else {
                $(header).removeClass('fixed-on-scroll');
            }
        }
    });

    var num = 70; //number of pixels before modifying styles

    $(window).bind('scroll', function() {
        if ($(window).scrollTop() > num) {
            $('.menu').addClass('fixed');
        } else {
            $('.menu').removeClass('fixed');
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#centralized_decentralized_type').hide();
        //  alert($('#tags').val());
        var tags_selected = $('#tags :selected').text();
        var substring = "Approving Authority";
        var substring1 = "Implementation";
        var data = "<?php echo e(isset($roles_external) ? json_encode($roles_external, JSON_HEX_TAG) : ''); ?>";

        //  alert($('#tags :selected').text());
        //  if (Object.values(data).indexOf('Approving Authority') > -1 ) {
        if (tags_selected.includes(substring) || tags_selected.includes(substring1)) {
            $('#centralized_decentralized_type').show();
            $("#centralized_decentralized_type_select").prop('required', true);
        } else {
            $('#centralized_decentralized_type').hide();
            $("#centralized_decentralized_type_select").prop('required', false);
        }

        // if (tags_selected.includes(substring1)) {
        //     $('#centralized_decentralized_type').show();
        //     $("#centralized_decentralized_type_select").prop('required', true);
        // } else {
        //     $('#centralized_decentralized_type').hide();
        //     $("#centralized_decentralized_type_select").prop('required', false);
        // }
        $('#tags').change(function() {
            var tags_selected = $('#tags :selected').text();
            // alert(tags_selected);
            if (tags_selected.includes(substring) || tags_selected.includes(substring1)) {
                //  alert('lll');
                $('#centralized_decentralized_type').show();
                $("#centralized_decentralized_type_select").prop('required', true);
            } else {
                //   alert('****');
                $('#centralized_decentralized_type').hide();
                $("#centralized_decentralized_type_select").prop('required', false);
            }

            //    if (tags_selected.includes(substring1)) {
            //        alert('aaa');
            //        $('#centralized_decentralized_type').show();
            //        $("#centralized_decentralized_type_select").prop('required', true);
            //    } else {
            //        alert('bbb')
            //        $('#centralized_decentralized_type').hide();
            //        $("#centralized_decentralized_type_select").prop('required', false);
            //    }
        });
    });
</script>
<script>
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
        // newWin.close();
    }
</script>
<script>
    $('.test-popup-link').magnificPopup({
        type: 'image'
    });
</script>



<script>
    $(document).ready(function() {
        $('.test-popup-link').magnificPopup({
            type: 'image'
            // other options
        });

        function append_clear_button() {
            $('#notifications_lists').append(`<div class="col-sm-12 px-2 text-right clear_notification_btn_div text-end">
                <a href="<?php echo e(url('/')); ?>/admin/notifications/show" class="btn btn-primary btn-sm btn_show_notif" style='float-right;' data="<?php echo e(Auth::user()->admin_user_id); ?>">Show All</a>
                <span class="btn btn-info btn-sm  btn_clear_notif" style='float-right;' data="<?php echo e(Auth::user()->admin_user_id); ?>">Clear</span>
        </div>`);
        }

        function getNotifications() {
            append_clear_button();
            $.ajax({
                type: 'GET',
                url: '<?php echo e(url('admin/ideas/ajax_get_notifications')); ?>',
                success: function(data) {
                    // console.log(data);
                    var jsonData = JSON.parse(data);
                    var return_data = jsonData.response;
                    // console.log(return_data);
                    notification_read_ids = jsonData.notification_read_ids;
                    //console.log(return_data);
                    var count_unread = Object.keys(notification_read_ids[0]).length;
                    if (count_unread > 0) {
                        $('#count_unread').empty();
                        $('#count_unread').append(`${count_unread}`);
                        $('#count_unread').show();
                    } else {
                        $('#count_unread').hide();
                    }
                    //$('#no_notifications').empty();
                    //$('#no_notifications').hide();

                    if (jsonData.response.length > 0) {
                        $('#no_notifications').empty();
                        $('#notifications_lists').empty();
                        append_clear_button();
                        for (var i = 0; i < jsonData.response.length; i++) {
                            if (return_data[i].status == 'success') {
                                var badge = '';
                                if (return_data[i].notification_read == '0') {
                                    badge =
                                        `<span style="height:7px;width:7px;border-radius:100px;background:red;margin-left:10px;"></span>`;
                                    // console.log('hello');
                                } else {
                                    var badge = '';
                                }
                                var idea_id = return_data[i].idea_id;
                                var url_update_notification =
                                    '<?php echo e(url('admin/ideas/ajax_update_notification/:notification_id')); ?>/' +
                                    idea_id;
                                url_update_notification = url_update_notification.replace(
                                    ':notification_id', return_data[i].notification_id);
                                url_update_notification = url_update_notification.replace(
                                    ':notification_for', return_data[i].notification_for);
                                $('#notifications_lists').append(
                                    `<a class="text-decoration-none" href="${url_update_notification}" style="cursor:pointer;">
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
                        }
                    } else {
                        // console.log('no notifications');
                        $('#notifications_lists').empty();
                        $('#no_notifications').empty();
                        append_clear_button();
                        $('#no_notifications').append(
                            '<h3 style="padding:10px;">No notifications yet</h3>');
                        $('#no_notifications').show();
                    }
                }
            });
        }

        getNotifications();
        setInterval(getNotifications, 5000);

    });
</script>


<script>
    function get_dynamic_categories(type_id) {
        if (type_id != 'User') {
            document.querySelector('.external_user_cat_data').classList.remove("d-none");
            var html = '';
            var idea_cat_arr = <?php echo isset($categories) ? json_encode($categories) : '[]'; ?>;
            html += `
          <h4 class="card-title">
           <div class="checkbox checkbox-primary">
            <input id="category_values" name="category_values[]" type="checkbox" value="category_values">
            <label for="category_values">Categories</label>
           </div>
           </h4>
           <div class="col-md-12 col-12">
                    <div class="col-md-12 col-12 mt-2 menu_permissions">
                       <ul class="list-unstyled mb-0">
              `;

        for (var i = 0; i < idea_cat_arr.length; i++) {
            html += `
              <li class="d-inline-block mr-2 mb-1">
                  <fieldset>
                      <div class="checkbox checkbox-primary"><input id="category_values[${idea_cat_arr[i]}]" name="category_values[${idea_cat_arr[i]}]" type="checkbox" value="${idea_cat_arr[i]}"> <label for="button_values[${idea_cat_arr[i]}]">${idea_cat_arr[i]}</label></div>
                  </fieldset>
              </li>
              `;
        }
        html += `
                    </ul>
                 </div>
              </div>
              `;
        // console.log(html);
        document.querySelector('.external_user_cat_data').innerHTML = html;
        } 
    }
</script>


<script>
    function get_dynamic_status(type_id) {
        if (type_id != 'User') {

            document.querySelector('.external_user_st_data').classList.remove("d-none");
            var html = '';
            if (type_id == 'Approving Authority') {
                var idea_status_arr = ["under_approving_authority", "reject", "on_hold", "resubmit"];
            } else if (type_id == 'Assessment Team') {
                var idea_status_arr = ["in_assessment", "reject", "on_hold", "resubmit"];
            } else if (type_id == 'Implementation') {
                var idea_status_arr = ["certificate", "implemented"];
            }

            html += `
                 <h4 class="card-title">
                     ${type_id}
                 </h4>
                 <div class="col-md-12 col-12">
                    <div class="col-md-12 col-12 mt-2 menu_permissions">
                       <ul class="list-unstyled mb-0">
                 `;

            for (var i = 0; i < idea_status_arr.length; i++) {
                html += `
                 <li class="d-inline-block mr-2 mb-1">
                     <fieldset>
                         <div class="checkbox checkbox-primary">
                            <input id="status_values[${idea_status_arr[i]}]" name="status_values[${i}]" type="checkbox" value="${idea_status_arr[i]}">
                            <label for="status_values[${idea_status_arr[i]}]">${idea_status_arr[i]}</label></div>
                     </fieldset>
                 </li>
                 `;
            }
            html += `
                       </ul>
                    </div>
                 </div>
                 `;
            // console.log(html);
            document.querySelector('.external_user_st_data').innerHTML = html;
        } else {
            document.querySelector('.external_user_st_data').classList.add("d-none");
            document.querySelector('.external_user_st_data').innerHTML = "";
        }
    }
</script>


<script>
    function get_dynamic_buttons(type_id) {


        document.querySelector('.external_user_btn_data').classList.remove("d-none");
        var html = '';
        //   if (type_id == 'User') {
        var idea_status_arr = ['Add', 'Edit', 'View', 'Delete', 'Revisions']
        //   }else{
        //     var idea_status_arr = ['Add','View','Revisions']
        //   }


        html += `
          <h4 class="card-title">
           <div class="checkbox checkbox-primary">
            <input id="button_values" name="button_values[]" type="checkbox" value="button_values">
            <label for="button_values">Buttons</label>
           </div>
           </h4>
           <div class="col-md-12 col-12">
                    <div class="col-md-12 col-12 mt-2 menu_permissions">
                       <ul class="list-unstyled mb-0">
              `;

        for (var i = 0; i < idea_status_arr.length; i++) {
            html += `
              <li class="d-inline-block mr-2 mb-1">
                  <fieldset>
                      <div class="checkbox checkbox-primary"><input id="button_values[${idea_status_arr[i]}]" name="button_values[${idea_status_arr[i]}]" type="checkbox" value="${idea_status_arr[i]}"> <label for="button_values[${idea_status_arr[i]}]">${idea_status_arr[i]}</label></div>
                  </fieldset>
              </li>
              `;
        }
        html += `
                    </ul>
                 </div>
              </div>
              `;
        // console.log(html);
        document.querySelector('.external_user_btn_data').innerHTML = html;

    }
</script>

<script>
    function get_dynamic_menus(type_id) {


        document.querySelector('.external_user_men_data').classList.remove("d-none");
        var html = '';
         if (type_id == 'User') {
             var idea_status_arr = ['dashboard', 'all ideas', 'ideas_for_approval', 'rewards'];
         } else {
            var idea_status_arr = ['dashboard','all ideas', 'my_ideas', 'ideas_for_approval', 'rewards'];
        }


        html += `
          <h4 class="card-title">
           <div class="checkbox checkbox-primary">
            <input id="menu_values" name="menu_values[]" type="checkbox" value="menu_values">
            <label for="menu_values">Menu</label>
           </div>
           </h4>
           <div class="col-md-12 col-12">
                    <div class="col-md-12 col-12 mt-2 menu_permissions">
                       <ul class="list-unstyled mb-0">
              `;

        for (var i = 0; i < idea_status_arr.length; i++) {
            html += `
              <li class="d-inline-block mr-2 mb-1">
                  <fieldset>
                      <div class="checkbox checkbox-primary"><input id="menu_values[${idea_status_arr[i]}]" name="menu_values[${idea_status_arr[i]}]" type="checkbox" value="${idea_status_arr[i]}"> <label for="menu_values[${idea_status_arr[i]}]">${idea_status_arr[i]}</label></div>
                  </fieldset>
              </li>
              `;
        }
        html += `
                    </ul>
                 </div>
              </div>
              `;
        // console.log(html);
        document.querySelector('.external_user_men_data').innerHTML = html;

    }

    $('#NavBar').on('click', '.btn_clear_notif', function(e) {
        e.stopPropagation();
        let user_data_id = $(this).attr('data');
        let user_role = "<?php echo e(isset($roles_external->role_name) ? $roles_external->role_name : ''); ?>";


        let data = {
            '_token': "<?php echo e(@csrf_token()); ?>",
            'id': user_data_id
        };
        if (confirm('do you want to clear all notification?')) {
            $.ajax({
                type: 'post',
                url: '<?php echo e(url('admin/ideas/ajax_clear_notification')); ?>',
                data: data,
                datatype: 'application/json',
                success: function(resp) {
                    if (resp == 1) {
                        location.reload()
                        e.stopPropagatio = false;
                    }
                }
            });
        } //end of if condition
    });
</script>






<script>
    // Set the time (in milliseconds) after which the automatic redirect should occur
    const logoutTime = 15 * 60 * 1000; // 15 minutes in milliseconds

    // Start the timer when the user logs in or interacts with the site
    let timer = setTimeout(() => {
        // Redirect the user to the logout page after the specified time
        window.location.href =
        "<?php echo e(url('/')); ?>/admin/logout/timeout"; // Change 'logout.html' to the actual logout page URL
    }, logoutTime);

    // Reset the timer whenever the user interacts with the site
    function resetTimer() {
        clearTimeout(timer);
        timer = setTimeout(() => {
            window.location.href =
            "<?php echo e(url('/')); ?>/admin/logout/timeout"; // Change 'logout.html' to the actual logout page URL
        }, logoutTime);
    }

    // Attach event listeners to relevant elements (e.g., buttons, links) to reset the timer
    document.addEventListener('click', resetTimer);
    document.addEventListener('mousemove', resetTimer);
    document.addEventListener('keypress', resetTimer);
    document.addEventListener('change', resetTimer);

    window.addEventListener('beforeunload', function (event) {
        console.log('found');
        // Make an API request to trigger logout
        fetch("<?php echo e(url('/')); ?>/admin/logout/timeout", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>", // Replace with your actual CSRF token
            },
        });
    });

</script><?php /**PATH C:\wamp64\www\ideaportal\resources\views/backend/includes/footer.blade.php ENDPATH**/ ?>