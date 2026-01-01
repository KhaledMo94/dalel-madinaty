<script src="<?php echo e(asset('backend/js/sb-admin-2.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/js/sidebar-modern.js')); ?>"></script>
<script src="<?php echo e(asset('backend/js/custom.js')); ?>"></script>

<?php if($errors->any()): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1800,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: 'error',
                title: '<?php echo e($error); ?>'
            });
        </script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<?php if(session()->get('error')): ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1800,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: 'error',
            title: '<?php echo e(session()->get('error')); ?>'
        });
    </script>
<?php endif; ?>

<?php if(session()->get('success')): ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1800,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "<?php echo e(session()->get('success')); ?>"
        });
    </script>
<?php endif; ?>

<?php if(app()->getLocale() == 'ar'): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            $('.select2').select2({
                dir: "rtl",
                width: "100%",
            });
        });
    </script>
<?php else: ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            $('.select2').select2({
                width: "100%"
            });
        });
    </script>
<?php endif; ?>
<?php /**PATH /home/khaled/projects/dalel-madinaty/resources/views/components/dashboard/scripts-footer.blade.php ENDPATH**/ ?>