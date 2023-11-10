

<?php $__env->startSection('content'); ?>


    <?php if($id > 0): ?>
        <accounting-create-edit :id="<?php echo e($id); ?>"></accounting-create-edit>
    <?php else: ?>
        <accounting-create-edit :id=<?php echo e($id); ?>></accounting-create-edit>
    <?php endif; ?>
    
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eshen\Desktop\Github\smart_finance_system\resources\views/administrator/accounting/accounting-create-edit.blade.php ENDPATH**/ ?>