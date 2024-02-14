<div class="step">
    <img src="<?php echo e(asset('/public/frontend-assets/images/' . $image)); ?>" alt="" style='height:30px !important; width:30px !important'>
    <br>
    <span><?php echo e($label); ?></span>
</div>
<?php if($showArrow): ?>
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-danger mx-2" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
</svg>
<?php endif; ?>
<?php /**PATH /var/www/html/ideaportal/resources/views/frontend/status_step.blade.php ENDPATH**/ ?>