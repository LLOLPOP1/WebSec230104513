<?php $__env->startSection('title', 'Product Store'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mt-4 mb-3 align-items-center">
    <div class="col-md-10">
        <h2 class="fw-bold">🛒 Product Store</h2>
    </div>
    <div class="col-md-2 text-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_products')): ?>
        <a href="<?php echo e(route('products_edit')); ?>" class="btn btn-success w-100">➕ Add Product</a>
        <?php endif; ?>
    </div>
</div>

<form class="mb-4">
    <div class="row g-2">
        <div class="col-md-2">
            <input name="keywords" type="text" class="form-control" placeholder="🔍 Search" value="<?php echo e(request()->keywords); ?>">
        </div>
        <div class="col-md-2">
            <input name="min_price" type="number" class="form-control" placeholder="Min Price" value="<?php echo e(request()->min_price); ?>">
        </div>
        <div class="col-md-2">
            <input name="max_price" type="number" class="form-control" placeholder="Max Price" value="<?php echo e(request()->max_price); ?>">
        </div>
        <div class="col-md-2">
            <select name="order_by" class="form-select">
                <option value="" disabled <?php echo e(request()->order_by=="" ? 'selected' : ''); ?>>Order By</option>
                <option value="name" <?php echo e(request()->order_by=="name" ? 'selected' : ''); ?>>Name</option>
                <option value="price" <?php echo e(request()->order_by=="price" ? 'selected' : ''); ?>>Price</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="order_direction" class="form-select">
                <option value="" disabled <?php echo e(request()->order_direction=="" ? 'selected' : ''); ?>>Direction</option>
                <option value="ASC" <?php echo e(request()->order_direction=="ASC" ? 'selected' : ''); ?>>ASC</option>
                <option value="DESC" <?php echo e(request()->order_direction=="DESC" ? 'selected' : ''); ?>>DESC</option>
            </select>
        </div>
        <div class="col-md-1 d-grid">
            <button type="submit" class="btn btn-primary">Apply</button>
        </div>
        <div class="col-md-1 d-grid">
            <a href="<?php echo e(route('products_list')); ?>" class="btn btn-outline-danger">Reset</a>
        </div>
    </div>
</form>

<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="card mb-4 shadow-sm">
    <div class="card-header bg-light">
        <h4 class="mb-0"><?php echo e($product->name); ?></h4>
    </div>
    <div class="card-body row">
        <div class="col-md-4 text-center">
            <img src="<?php echo e(asset("images/$product->photo")); ?>" class="img-fluid rounded" alt="<?php echo e($product->name); ?>">
        </div>
        <div class="col-md-8">
            <table class="table table-bordered mb-3">
                <tr><th>Name</th><td><?php echo e($product->name); ?></td></tr>
                <tr><th>Model</th><td><?php echo e($product->model); ?></td></tr>
                <tr><th>Code</th><td><?php echo e($product->code); ?></td></tr>
                <tr><th>Price</th><td>$<?php echo e(number_format($product->price, 2)); ?></td></tr>
                <tr><th>Stock</th><td><?php echo e($product->stock); ?></td></tr>
                <tr><th>Description</th><td><?php echo e($product->description); ?></td></tr>
            </table>
            <div class="d-flex gap-2">
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->hasRole('Customer')): ?>
                    <form action="<?php echo e(route('purchases.store')); ?>" method="POST" class="flex-grow-1">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                        <button type="submit" class="btn btn-primary w-100" <?php echo e($product->stock < 1 ? 'disabled' : ''); ?>>
                            🛍 Buy
                        </button>
                    </form>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_products')): ?>
                <a href="<?php echo e(route('products_edit', $product->id)); ?>" class="btn btn-success flex-grow-1">✏️ Edit</a>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_products')): ?>
                <a href="<?php echo e(route('products_delete', $product->id)); ?>" class="btn btn-danger flex-grow-1">🗑 Delete</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\github-lol\WebSec230104513\websec\WebSecService\resources\views/products/list.blade.php ENDPATH**/ ?>