

<?php $__env->startSection('content'); ?>

<section class="section">

    <div class="columns is-centered">
        <div class="column is-10">
            <div class="box">
                <faculty-faculty-load
                    prop-acad-years='<?php echo json_encode($acadYears, 15, 512) ?>'></faculty-faculty-load>
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.faculty-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\etien\OneDrive\Desktop\Github Proj\fastgrade\resources\views/faculty/faculty-faculty-load.blade.php ENDPATH**/ ?>