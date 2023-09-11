

<?php $__env->startSection('content'); ?>

<section class="section">

    <div class="columns is-centered">
        <div class="column is-8">
            <div class="box">

               
                <?php if(isset($data)): ?>
                    <schedule-create-update
                        prop-acad-years='<?php echo json_encode($acadYears, 15, 512) ?>'
                        prop-rooms='<?php echo json_encode($rooms, 15, 512) ?>'
                        prop-programs='<?php echo json_encode($programs, 15, 512) ?>'
                        prop-data='<?php echo json_encode($data, 15, 512) ?>'></schedule-create-update>
                <?php else: ?>
                    <schedule-create-update
                        prop-acad-years='<?php echo json_encode($acadYears, 15, 512) ?>'
                        prop-rooms='<?php echo json_encode($rooms, 15, 512) ?>'
                        prop-programs='<?php echo json_encode($programs, 15, 512) ?>'></schedule-create-update>
                <?php endif; ?>
               
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eshen\Desktop\Github\fastgrade\resources\views/administrator/schedule/schedule-create-update.blade.php ENDPATH**/ ?>