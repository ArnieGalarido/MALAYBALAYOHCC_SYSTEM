<?php if(Auth::user()->role != 'user'): ?>
  <Notification :user="<?php echo e(Auth::user()); ?>" />
<?php endif; ?><?php /**PATH C:\xampp\htdocs\ohcc_system\resources\views/includes/notification.blade.php ENDPATH**/ ?>