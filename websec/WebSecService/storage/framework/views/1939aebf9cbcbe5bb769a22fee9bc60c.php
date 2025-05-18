
<?php $__env->startSection('title', 'Add New Employee'); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-center">
    <div class="row m-4 col-sm-8 col-md-6 col-lg-4">
        <h2 class="text-center mb-4">Add New Employee</h2>
        <form action="<?php echo e(route('store_employee')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <strong>Error!</strong> Please fix the following issues:
                    <ul class="mb-0 mt-2">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="form-group mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" placeholder="Enter employee name" name="name" value="<?php echo e(old('name')); ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" placeholder="Enter employee email" name="email" value="<?php echo e(old('email')); ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" placeholder="Enter password" name="password" required>
            </div>

            <div class="form-group mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password:</label>
                <input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" required>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary w-100">Create Employee</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\github-lol\WebSec230104513\websec\WebSecService\resources\views/users/create_employee.blade.php ENDPATH**/ ?>