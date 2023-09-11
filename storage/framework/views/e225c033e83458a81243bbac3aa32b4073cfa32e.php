

<?php $__env->startSection('content'); ?>

<section class="hero is-fullheight-with-navbar">
  <div class="hero-body">
    <div class="container has-text-centered">
        <p class="title">
            <?php
                $user = Auth::user();
            ?>
          WELCOME  <?php echo e(strtoupper($user->lname)); ?>, <?php echo e(strtoupper($user->fname)); ?>

        </p>
    </div>
  </div>
</section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.faculty-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\etien\OneDrive\Desktop\Github Proj\fastgrade\resources\views/faculty/faculty-dashboard-n.blade.php ENDPATH**/ ?>