<?php $__env->startSection('title', 'Prime Numbers'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3>Prime Numbers</h3>
            </div>
            <div class="card-body text-center">
                <?php $__currentLoopData = range(1, 100); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(isPrime($i)): ?>
                        <span class="badge bg-primary m-1 p-2"><?php echo e($i); ?></span>
                    <?php else: ?>
                        <span class="badge bg-secondary m-1 p-2"><?php echo e($i); ?></span>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\github-lol\WebSec230104513\websec\WebSecService\resources\views/prime.blade.php ENDPATH**/ ?>