

<?php $__env->startSection('content'); ?>
   
<div class="section">

  
    <div class="columns is-centered">
        <div class="column is-6">
            <div class="has-text-weight-bold is-size-4">ACCOUNTING</div>
            <div class="columns">
                <div class="column">
                
                    <div class="box">
                        <div class="has-text-weight-bold is-size-5 mb-2">FUND SOURCES</div>

                        <?php $__currentLoopData = $fundSources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fund): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="box-card-container">
                            <div class="has-text-weight-bold box-card-title">
                                <?php echo e($fund->fund_source); ?>

                            </div>
                            <div class="box-card-value">
                                <?php echo e($fund->total_amount); ?>

                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                    
                <div class="column">
                    
                    <div class="box">
                        <div class="has-text-weight-bold is-size-5 mb-2">CURRENT FINANCIAL YEAR</div>
                        <?php $__currentLoopData = $cfy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="box-card-container">
                            <div class="has-text-weight-bold box-card-title">
                                <?php echo e($item->allotment_class); ?>

                            </div>
                            <div class="box-card-value">
                                <?php echo e($item->amount); ?>

                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BUDGETING -->
    <!-- BUDGETING -->
    <div class="columns is-centered">
        <div class="column is-6">
            <div class="has-text-weight-bold is-size-4">BUDGETING</div>
            <div class="columns">
                <div class="column">
                
                    <div class="box">
                        <div class="has-text-weight-bold is-size-5 mb-2">FUND SOURCES</div>

                        <?php $__currentLoopData = $budgetingFundSources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fund): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="box-card-container">
                            <div class="has-text-weight-bold box-card-title">
                                <?php echo e($fund->fund_source); ?>

                            </div>
                            <div class="box-card-value">
                                <?php echo e($fund->total_amount); ?>

                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                    
                <div class="column">
                    
                    <div class="box">
                        <div class="has-text-weight-bold is-size-5 mb-2">CURRENT FINANCIAL YEAR</div>
                        <?php $__currentLoopData = $budgetingCurrentFY; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="box-card-container">
                            <div class="has-text-weight-bold box-card-title">
                                <?php echo e($item->allotment_class); ?>

                            </div>
                            <div class="box-card-value">
                                <?php echo e($item->amount); ?>

                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- PROCUREMENT -->
    <div class="columns is-centered">
        <div class="column is-6">
            <div class="has-text-weight-bold is-size-4">PROCUREMENT</div>
            <div class="columns">
                <div class="column">
                
                    <div class="box">
                        <div class="has-text-weight-bold is-size-5 mb-2">FUND SOURCES</div>

                        <?php $__currentLoopData = $procurementFundSources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fund): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="box-card-container">
                            <div class="has-text-weight-bold box-card-title">
                                <?php echo e($fund->fund_source); ?>

                            </div>
                            <div class="box-card-value">
                                <?php echo e($fund->total_amount); ?>

                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                    
                <div class="column">
                    
                    <div class="box">
                        <div class="has-text-weight-bold is-size-5 mb-2">CURRENT FINANCIAL YEAR</div>
                        <?php $__currentLoopData = $procurementCurrentFY; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="box-card-container">
                            <div class="has-text-weight-bold box-card-title">
                                <?php echo e($item->allotment_class); ?>

                            </div>
                            <div class="box-card-value">
                                <?php echo e($item->amount); ?>

                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



    
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\etien\OneDrive\Desktop\Github Proj\smart_finance_system\resources\views/administrator/dashboard.blade.php ENDPATH**/ ?>