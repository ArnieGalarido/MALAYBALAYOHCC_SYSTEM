
<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<?php if($message = Session::get('success')): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong><?php echo e($message); ?></strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?> 
    
<?php if($message = Session::get('error')): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong><?php echo e($message); ?></strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>
     
<?php if($message = Session::get('warning')): ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong><?php echo e($message); ?></strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>
     
<?php if($message = Session::get('info')): ?>
<div class="alert alert-info alert-dismissible fade show" role="alert">
  <strong><?php echo e($message); ?></strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>
    
<?php if($errors->any()): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Please check the form below for errors</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\ohcc_system\resources\views/includes/flash-message.blade.php ENDPATH**/ ?>