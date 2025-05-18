<nav class="navbar navbar-expand-sm bg-light">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="./">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./even">Even Numbers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./prime">Prime Numbers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./multable">Multiplication Table</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('products_list')); ?>">Products</a>
            </li>
            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->hasRole('Customer')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('purchases.index')); ?>">My Purchases</a>
                </li>
                <?php endif; ?>
                <?php if(auth()->user()->hasRole('Employee')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('employees.customers')); ?>">Manage Customers</a>
                </li>
                <?php endif; ?>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show_users')): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('users')); ?>">Users</a>
            </li>
            <?php endif; ?>
        </ul>
        <ul class="navbar-nav">
            <?php if(auth()->guard()->check()): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('profile')); ?>"><?php echo e(auth()->user()->name); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('do_logout')); ?>">Logout</a>
            </li>
            <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('login')); ?>">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('register')); ?>">Register</a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<?php /**PATH D:\github-lol\WebSec230104513\websec\WebSecService\resources\views/layouts/menu.blade.php ENDPATH**/ ?>