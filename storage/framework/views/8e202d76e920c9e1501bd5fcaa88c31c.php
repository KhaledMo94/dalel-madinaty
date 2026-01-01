<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" <?php if(app()->getLocale() === 'ar'): ?> dir="rtl" <?php endif; ?>>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="<?php echo e(asset(config('app.logo'))); ?>">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <title><?php echo e(__('Admin Login')); ?> - <?php echo e(config('app.name')); ?></title>
    <?php if (isset($component)) { $__componentOriginal4d51d44039a122bc98aca5675b302dd2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4d51d44039a122bc98aca5675b302dd2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.styles','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.styles'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4d51d44039a122bc98aca5675b302dd2)): ?>
<?php $attributes = $__attributesOriginal4d51d44039a122bc98aca5675b302dd2; ?>
<?php unset($__attributesOriginal4d51d44039a122bc98aca5675b302dd2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4d51d44039a122bc98aca5675b302dd2)): ?>
<?php $component = $__componentOriginal4d51d44039a122bc98aca5675b302dd2; ?>
<?php unset($__componentOriginal4d51d44039a122bc98aca5675b302dd2); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalff081aa4dfcbf242a65d0b6a13be2894 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff081aa4dfcbf242a65d0b6a13be2894 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.scripts-header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.scripts-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalff081aa4dfcbf242a65d0b6a13be2894)): ?>
<?php $attributes = $__attributesOriginalff081aa4dfcbf242a65d0b6a13be2894; ?>
<?php unset($__attributesOriginalff081aa4dfcbf242a65d0b6a13be2894); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalff081aa4dfcbf242a65d0b6a13be2894)): ?>
<?php $component = $__componentOriginalff081aa4dfcbf242a65d0b6a13be2894; ?>
<?php unset($__componentOriginalff081aa4dfcbf242a65d0b6a13be2894); ?>
<?php endif; ?>
    <?php if(app()->getLocale() == 'ar'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('backend/css/rtl.css')); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:slnt,wght@-11..11,200..1000&display=swap" rel="stylesheet">
        <style>
            body * {
                font-family: 'Cairo', sans-serif !important;
            }
        </style>
    <?php endif; ?>
</head>

<body style="background-color: rgb(81, 69, 33)">
    <div class="container v-center">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-5 col-md-5">
                <div class="my-5 border-0 shadow-lg card o-hidden">
                    <div class="p-0 card-body">
                        <div class="row">
                            <div class="col-lg-12" style="background-color: # f9f6ed">
                                <div class="p-5">

                                    <div class="text-center">
                                        <img src="<?php echo e(asset(config('app.logo'))); ?>" alt="Logo" class="mb-4"
                                            style="width: 300px; border-radius: 10px;">
                                        <h1 class="mb-4 text-gray-900 h4"><?php echo e(__('Admin Login')); ?></h1>
                                    </div>

                                    <form action="<?php echo e(route('login')); ?>" class="user" method="post">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group">
                                            <input id="email" type="email" class="form-control form-control-user"
                                                name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email"
                                                autofocus placeholder="<?php echo e(__('Email')); ?>">
                                        </div>
                                        <div class="form-group">
                                            <input id="password" type="password" class="form-control form-control-user"
                                                name="password" placeholder="<?php echo e(__('Password')); ?>" required>
                                        </div>
                                        <button type="submit"
                                            class="text-white btn btn-user btn-block"  style="background-color: rgb(189, 163, 86) ; font-family: 'Cairo', sans-serif; font-size:20px"><?php echo e(__('Login')); ?>

                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginal2cfac71dd3686bd5095be6d06dc36ded = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2cfac71dd3686bd5095be6d06dc36ded = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.scripts-footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.scripts-footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2cfac71dd3686bd5095be6d06dc36ded)): ?>
<?php $attributes = $__attributesOriginal2cfac71dd3686bd5095be6d06dc36ded; ?>
<?php unset($__attributesOriginal2cfac71dd3686bd5095be6d06dc36ded); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2cfac71dd3686bd5095be6d06dc36ded)): ?>
<?php $component = $__componentOriginal2cfac71dd3686bd5095be6d06dc36ded; ?>
<?php unset($__componentOriginal2cfac71dd3686bd5095be6d06dc36ded); ?>
<?php endif; ?>
</body>

</html>
<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/auth/login.blade.php ENDPATH**/ ?>