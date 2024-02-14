<?php $__env->startSection('title', 'Update External Roles'); ?>

<?php $__env->startSection('content'); ?>
<?php

use App\Models\backend\BackendMenubar;
use App\Models\backend\BackendSubMenubar;
use Spatie\Permission\Models\Permission;


$user_id = Auth()->guard('admin')->user()->id;
//$user_master = UserMaster::where('user_id',$user_id)->first();

//$menu_ids=explode(",",$user_master->menu_master);
//$submenu_ids=explode(",",$user_master->submenu_master);
//$sub_submenu_ids=explode(",",$user_master->sub_sub_master);
//$child_sub_submenu_ids=explode(",",$user_master->child_sub_sub_master);
//$backend_menubar = DB::select("SELECT * FROM backend_menubar_sublink bms, backend_menubar bm where bms.menu_id=bm.menu_id and bm.visibility=1 group by bm.menu_id");
$backend_menubar = BackendMenubar::Where(['visibility'=>1])->orderBy('sort_order')->get();
?>
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-2">
        <h3 class="content-header-title">External User</h3>

        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">External User</li>
                </ol>
            </div>
        </div>
    </div>

</div>
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <?php echo $__env->make('backend.includes.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo Form::model($role, [
                        'method' => 'POST',
                        'url' => ['admin/rolesexternal/update'],
                        'class' => 'form'
                        ]); ?>

                         <div class="form-body">
                            <div class="row">
                                <div class="col-md-12 col-12" style="margin-bottom:20px !important;">
                                    <div class="form-label-group">
                                        <?php echo e(Form::label('role_name', 'Role Name *')); ?>

                                        <?php echo e(Form::hidden('id', $role->id)); ?>

                                        <?php echo e(Form::text('role_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Role Name', 'required' => true])); ?>


                                    </div>
                                </div>

                                <div class="col-md-12 col-12" style="margin-bottom:20px !important;">
                                    <div class="form-group">
                                        <?php echo e(Form::label('role_type', 'Role Type *')); ?>

                                        <?php echo Form::select('role_type',[''=>'Select Role','User'=>'User', 'Assessment Team'=> 'Assessment Team', 'Approving Authority' => 'Approving Authority','Implementation' => 'Implementation','MIS User'] ,
                                        null, ['class' => 'form-control','id'=>'role_type','required' => true]); ?>

                                    </div>
                                </div>

                                
                                

                                 
                                 <div class="col-md-12 col-12 internal-user external_user_cat_data d-none">
                                </div>
                                
                                
                                <div class="col-md-12 col-12 internal-user external_user_st_data d-none">
                                </div>

                                     
                                <div class="col-md-12 col-12 internal-user external_user_men_data d-none">
                                </div>



                                


                                 
                                 <div class="col-md-12 col-12 internal-user external_user_btn_data d-none">
                                </div>

                                




                                <div class="col-12 d-flex justify-content-start">
                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-secondary mr-1 mb-1 text-white">Reset</button>
                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>



       document.addEventListener("DOMContentLoaded", function (event) {
          var type_id = document.getElementById('role_type').selectedOptions[0].value;


            //for menus
            document.querySelector('.external_user_men_data').classList.remove("d-none");
          var html = '';
          if (type_id == 'User') {
              var menu_status_arr = ['dashboard','all ideas', 'ideas_for_approval','rewards'];
            }else{
              var menu_status_arr = ['dashboard','all ideas', 'my_ideas','ideas_for_approval','rewards'];
          }

          var menu_values_string = <?php echo json_encode( $role->menu_values); ?>;
           const menu_values_data = (menu_values_string != null)?menu_values_string.split(','):"";

           // alert('in action');
           console.log(menu_values_data);

          html += `
          <h4 class="card-title">
           <div class="checkbox checkbox-primary">
            <input id="Menu" name="menu_values[]" type="checkbox" value="menu_values" ${(menu_values_data.includes('menu_values'))?'checked':''}>
            <label for="Menu">Menu</label>
           </div>
           </h4>
           <div class="col-md-12 col-12">
                    <div class="col-md-12 col-12 mt-2 menu_permissions">
                       <ul class="list-unstyled mb-0">
              `;

          for (var i = 0; i < menu_status_arr.length; i++) {
             html += `
              <li class="d-inline-block mr-2 mb-1">
                  <fieldset>
                      <div class="checkbox checkbox-primary">
                        <input id="menu_values[${menu_status_arr[i]}]" name="menu_values[${menu_status_arr[i]}]" type="checkbox" value="${menu_status_arr[i]}" ${(menu_values_data.includes(menu_status_arr[i]))?'checked':''}>
                        <label for="menu_values[${menu_status_arr[i]}]">${menu_status_arr[i]}</label></div>
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


          //for buttons
          document.querySelector('.external_user_btn_data').classList.remove("d-none");
          var html = '';
        //   if (type_id == 'User') {
             var button_status_arr = ['Add','Edit','View','Delete','Revisions']
        //   }else{
        //     var button_status_arr = ['Add','View','Revisions']
        //   }

          var button_values_string = <?php echo json_encode( $role->button_values); ?>;
           const button_values_data = (button_values_string != null)?button_values_string.split(','):"";

           // alert('in action');
           console.log(button_values_data);

          html += `
          <h4 class="card-title">
           <div class="checkbox checkbox-primary">
            <input id="Buttons" name="button_values[]" type="checkbox" value="button_values" ${(button_values_data.includes('button_values'))?'checked':''}>
            <label for="Buttons">Buttons</label>
           </div>
           </h4>
           <div class="col-md-12 col-12">
                    <div class="col-md-12 col-12 mt-2 menu_permissions">
                       <ul class="list-unstyled mb-0">
              `;

          for (var i = 0; i < button_status_arr.length; i++) {
             html += `
              <li class="d-inline-block mr-2 mb-1">
                  <fieldset>
                      <div class="checkbox checkbox-primary">
                        <input id="button_values[${button_status_arr[i]}]" name="button_values[${button_status_arr[i]}]" type="checkbox" value="${button_status_arr[i]}" ${(button_values_data.includes(button_status_arr[i]))?'checked':''}>
                        <label for="button_values[${button_status_arr[i]}]">${button_status_arr[i]}</label></div>
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




          //status
          if (type_id != 'User') {

           document.querySelector('.external_user_st_data').classList.remove("d-none");
           var html = '';
           if (type_id == 'Approving Authority') {
              // alert('aa');
              var idea_status_arr = ["under_approving_authority", "reject", "on_hold", "resubmit"];

           } else if (type_id == 'Assessment Team') {

              var idea_status_arr = ["in_assessment", "reject", "on_hold", "resubmit"];
           } else if (type_id == 'Implementation') {
              var idea_status_arr = ["certificate", "implemented"];
           }

           var status_values_string = <?php echo json_encode( $role->status_values); ?>;
           const status_values_data = (status_values_string != null)?status_values_string.split(','):"";

           // alert('in action');
           console.log(status_values_data);


           // <div class="checkbox checkbox-primary"><?php echo e(Form::checkbox("status_values[]", "status_values", null, ["id"=>"Status"])); ?>  <label for="Status">${type_id}</label></div>
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
                                    <input id="status_values[${idea_status_arr[i]}]" name="status_values[${idea_status_arr[i]}]" type="checkbox" value="${idea_status_arr[i]}" ${(status_values_data.includes(idea_status_arr[i]))?'checked':''}>
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
        
        // for categories
        document.querySelector('.external_user_cat_data').classList.remove("d-none");
          var html = '';
          var idea_cat_arr = <?php echo isset($categories) ? json_encode($categories) : '[]'; ?>;


          var category_values_string = <?php echo json_encode( $role->category_values); ?>;
        const category_values_data = (category_values_string != null)?category_values_string.split(','):"";

          html += `
          <h4 class="card-title">
           <div class="checkbox checkbox-primary">
            <input id="category_values" name="category_values[]" type="checkbox" value="category_values" ${(category_values_data.includes('category_values'))?'checked':''}>
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
                      <div class="checkbox checkbox-primary">
                        <input id="category_values[${idea_cat_arr[i]}]" name="category_values[${idea_cat_arr[i]}]" type="checkbox" value="${idea_cat_arr[i]}" ${(category_values_data.includes(idea_cat_arr[i]))?'checked':''}>
                        <label for="category_values[${idea_cat_arr[i]}]">${idea_cat_arr[i]}</label></div>
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
           
        
        } else {

           document.querySelector('.external_user_st_data').classList.add("d-none");
           document.querySelector('.external_user_st_data').innerHTML = "";
           }
          // alert (getValue);
       });

       document.getElementById('role_type').addEventListener('change', function () {
          var type_id = this.value;
          get_dynamic_status(type_id);

       });

    </script>
</section>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/ideaportal/resources/views/backend/rolesexternal/edit.blade.php ENDPATH**/ ?>