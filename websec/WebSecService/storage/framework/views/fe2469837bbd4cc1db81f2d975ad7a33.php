

<?php $__env->startSection('content'); ?>
    <h1>Customers</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Credit</th>
                <th>Status</th>
                <?php if($canBlockUsers): ?>
                    <th>Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($customer->id); ?></td>
                    <td><?php echo e($customer->name); ?></td>
                    <td><?php echo e($customer->email); ?></td>
                    <td><?php echo e(number_format($customer->credit, 2)); ?></td>
                    <td><?php echo e($customer->is_blocked ? 'Blocked' : 'Active'); ?></td>
                    <?php if($canBlockUsers): ?>
                        <td>
                            <form action="<?php echo e(route('employees.toggle_block', $customer)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn <?php echo e($customer->is_blocked ? 'btn-success' : 'btn-danger'); ?>">
                                    <?php echo e($customer->is_blocked ? 'Unblock' : 'Block'); ?>

                                </button>
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\github-lol\WebSec230104513\websec\WebSecService\resources\views/employees/customers.blade.php ENDPATH**/ ?>