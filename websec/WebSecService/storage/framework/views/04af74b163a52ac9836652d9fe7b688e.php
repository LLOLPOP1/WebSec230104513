<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="text-center">Welcome to WebSec</h1>
    <div class="container m-3">
        <div class="card shadow-lg text-center p-4">
            <button type="button" class="btn btn-primary" onclick="doSomething()">Press Me</button>
        </div>
    </div>
    <script>    
        function doSomething() {
            alert('Hello From JavaScript');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\github-lol\WebSec230104513\websec\WebSecService\resources\views/welcome.blade.php ENDPATH**/ ?>