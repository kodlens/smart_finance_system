

<?php $__env->startSection('content'); ?>
    <faculty-load prop-user='<?php echo json_encode($user, 15, 512) ?>'
        prop-acad-years='<?php echo json_encode($acadYears, 15, 512) ?>'></faculty-load>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eshen\Desktop\Github\fastgrade\resources\views/administrator/faculty/faculty-load.blade.php ENDPATH**/ ?>