

<?php $__env->startSection('content'); ?>

<section class="section">

    <div class="columns is-centered">
        <div class="column is-6">
            <div class="box">
                <faculty-student-list 
                    prop-schedule-id="<?php echo e($scheduleId); ?>"
                    prop-faculty-id="<?php echo e($facultyId); ?>"
                    prop-academic-year-id="<?php echo e($acadYearId); ?>"></faculty-student-list>
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.faculty-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eshen\Desktop\Github\fastgrade\resources\views/faculty/faculty-student-list.blade.php ENDPATH**/ ?>