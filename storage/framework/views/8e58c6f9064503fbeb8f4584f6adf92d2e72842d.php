
<?php $__env->startSection('content'); ?>

<div class="sticky-top text-white" style="background-color:#12536d">
 <div class="input-group">
    <button id="openNav" class="w3-button w3-large" onclick="w3_open()">
     &#9776;
    </button> 
    <div class="col"> <?php echo $__env->make('includes.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>    <div class="col-sm-9">
      <h5 class="my-2 mx-3 p-1 textt-white">Users Account</h5> 
    </div>
      <div class="col-sm-2 my-2">👋🏻Hi, <?php echo e(Auth::user()->details['firstname'] ?? ''); ?></div>
  </div>
</div>

<div class="w3-container">
  <br>
  <div class="row">  
     <div class="col-lg-2"></div>
     <div class="col-lg-8">
      
      <div class="card mb-4" >
        <div class="card-body">
        <h4 class="text-center" style="color:#12536d">Users Account</h4>
        <hr>
            <form method="POST" action="">
             <div class="row">
                
                 <div class="col-sm-4 mb-4">
                     <label for="" class="form-label">Role :</label>

                     <select name="role" class="form-select" aria-label="" disabled>
                         <option selected value=''>Select</option>
                         <option <?php echo e($user->role == 'user' ? 'selected' : ''); ?> value="user">Hospital User</option>
                         <option  <?php echo e($user->role == 'staff' ? 'selected' : ''); ?> value="staff">OHCC Staff</option>
                         <option <?php echo e($user->role == 'admin' ? 'selected' : ''); ?> value="admin">OHCC Admin</option>
                      </select>
                  </div>
                  <?php if($user->role != 'user' && $user->role !='admin'): ?>
                 <div class="col-sm-8 mb-4">
                     <label for="" class="form-label">Hospital (Hospital users):</label>
                     <input type="text" class="form-control" name="hospital"  value="<?php echo e($user->hospital->name ?? ''); ?>"disabled >
                  </div>
                  <?php endif; ?>
             </div>

              <div class="row">
                 <div class="col-sm-4 mb-3">   
                     <label for="referredHosp" class="form-label">First name :</label>
                     <input type="text" class="form-control" name="firstname"  value="<?php echo e($user->details['firstname'] ?? ''); ?>"disabled >
                  </div>
                  <div class="col-sm-2 mb-3">   
                     <label for="referredHosp" class="form-label">Middle name :</label>
                     <input type="text" class="form-control" name="middlename"  value="<?php echo e($user->details['middlename'] ?? ''); ?>" disabled>
                  </div>
                  <div class="col-sm-4 mb-3">   
                     <label for="referredHosp" class="form-label">Last name :</label>
                     <input type="text" class="form-control" name="lastname" value="<?php echo e($user->details['lastname'] ?? ''); ?>" disabled>
                  </div>
                  <div class="col-sm-2 mb-3">   
                     <label for="referredHosp" class="form-label">Suffix :</label>
                     <input type="text" class="form-control" name="suffix" value="<?php echo e($user->details['suffix'] ?? ''); ?>" disabled>
                  </div>
              </div>
              <div class="row">
                 <div class="col-sm-4 mb-3">   
                     <label for="referredHosp" class="form-label">Birthday :</label>
                     <input type="date" class="form-control" name="birthday" value="<?php echo e($user->details['birthday'] ?? ''); ?>" disabled>
                  </div>
                  <div class="col-sm-2 mb-3">   
                     <label for="referredHosp" class="form-label">Age :</label>
                     <input type="text" class="form-control" name="age" value="<?php echo e($user->age); ?>"disabled>
                  </div>
                  <div class="col-sm-2 mb-3">   
                     <label for="referredHosp" class="form-label">Gender :</label>
                     <input type="text" class="form-control" name="gender" value="<?php echo e($user->details['gender'] ?? ''); ?>"disabled>
                  </div>
                  <div class="col-sm-4 mb-3">
                     <label for="referredHosp" class="form-label">Contact Number :</label>
                     <input type="number" class="form-control" name="contact_number" value="<?php echo e($user->details['contact_number'] ?? ''); ?>" disabled>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-10 mb-3">
                     <label for="" class="form-label">Address :</label>
                     <input type="text" class="form-control" name="address"value="<?php echo e($user->details['address'] ?? ''); ?>" disabled>
                  </div> 
                  <div class="col-sm-2 mb-3">
                     <label for="referredHosp" class="form-label">Zip code :</label>
                     <input type="text" class="form-control" name="zipcode" value="<?php echo e($user->details['zipcode'] ?? ''); ?>" disabled>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-8 mb-3">
                      <label for="" class="form-label">Email :</label>
                      <input type="email" class="form-control" name="email" value="<?php echo e($user->email ?? ''); ?>" disabled>
                   </div> 
                   <div class="col-sm-4 mb-3">
                        <label for="" class="form-label">Password :</label>
                      <input type="password" class="form-control" name="password" placeholder="*****" disabled>
                   </div> 
              </div>
           </form>
        </div>

      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ohcc_system\resources\views/users/user-show.blade.php ENDPATH**/ ?>