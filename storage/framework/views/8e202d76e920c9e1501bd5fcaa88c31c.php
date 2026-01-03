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
    <?php endif; ?>
    <style>
        :root {
            --theme-primary: #4e73df;
            --theme-accent: #1cc88a;
            --theme-gradient: linear-gradient(135deg, #4e73df 0%, #1cc88a 100%);
        }

        <?php if(app()->getLocale() == 'ar'): ?>
        body * {
            font-family: 'Cairo', sans-serif !important;
        }
        <?php endif; ?>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1d1701 0%, #2d2515 50%, #1d1701 100%);
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            padding: 2.5rem;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-container img {
            width: 200px;
            height: auto;
            display: block;
            margin: 0 auto 1rem;
        }

        .login-title {
            color: #fff;
            font-size: 1.75rem;
            font-weight: 600;
            margin: 0;
        }

        .login-form {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            color: #fff;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            color: #333;
            font-size: 15px;
            font-weight: 500;
            transition: all 0.2s ease;
            outline: none;
        }

        .form-control::placeholder {
            color: #999;
        }

        .form-control:focus {
            background: #fff;
            border-color: var(--theme-primary);
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.2);
        }

        .btn-login {
            width: 100%;
            padding: 0.875rem 1.5rem;
            background: var(--theme-gradient);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 0.5rem;
            box-shadow: 0 4px 12px rgba(78, 115, 223, 0.4);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(78, 115, 223, 0.5);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            background: rgba(231, 74, 59, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(231, 74, 59, 0.3);
            border-radius: 10px;
            color: #fff;
            padding: 1rem;
            margin-bottom: 1.25rem;
            font-size: 14px;
        }

        .alert ul {
            margin: 0.5rem 0 0 0;
            padding-left: 1.25rem;
        }

        .alert li {
            margin-bottom: 0.25rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-card {
                padding: 2rem 1.5rem;
            }

            .logo-container img {
                width: 160px;
            }

            .login-title {
                font-size: 1.5rem;
            }
        }

        /* RTL Support */
        [dir="rtl"] .form-control {
            text-align: right;
        }

        [dir="rtl"] .logo-container {
            direction: ltr;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo-container">
                <img src="<?php echo e(asset(config('app.logo'))); ?>" alt="Logo">
                <h1 class="login-title"><?php echo e(__('Admin Login')); ?></h1>
            </div>

            <?php if($errors->any()): ?>
                <div class="alert">
                    <strong><?php echo e(__('Whoops!')); ?></strong> <?php echo e(__('There were some problems with your input.')); ?>

                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('login')); ?>" method="post" class="login-form">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="email"><?php echo e(__('Email')); ?></label>
                    <input 
                        id="email" 
                        type="email" 
                        class="form-control"
                        name="email" 
                        value="<?php echo e(old('email')); ?>" 
                        required 
                        autocomplete="email"
                        autofocus 
                        placeholder="<?php echo e(__('Enter your email')); ?>">
                </div>
                <div class="form-group">
                    <label for="password"><?php echo e(__('Password')); ?></label>
                    <input 
                        id="password" 
                        type="password" 
                        class="form-control"
                        name="password" 
                        placeholder="<?php echo e(__('Enter your password')); ?>" 
                        required>
                </div>
                <button type="submit" class="btn-login">
                    <?php echo e(__('Login')); ?>

                </button>
            </form>
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