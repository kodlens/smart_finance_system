

<?php $__env->startSection('content'); ?>
    <?php if(auth()->guard()->check()): ?>
        <accounting-index :prop-user="<?php echo e(Auth::user()); ?>"></accounting-index>
    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\etien\OneDrive\Desktop\Github Proj\smart_finance_system\resources\views/administrator/accounting/accounting-index.blade.php ENDPATH**/ ?>