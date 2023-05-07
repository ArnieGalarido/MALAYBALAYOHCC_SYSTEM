
<?php $__env->startSection('content'); ?>

<div class="sticky-top text-white" style="background-color:#12536d">
 <div class="input-group">
    <button id="openNav" class="w3-button w3-large" onclick="w3_open()">
     &#9776;
    </button> 
    <div class="col"> <?php echo $__env->make('includes.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
    <div class="col-sm-9">
      <h5 class="my-2 mx-3 p-1">Bed Tracker</h5> 
    </div>
    <div class="col-sm-2 my-2">👋🏻Hi, <?php echo e(Auth::user()->details['firstname'] ?? ''); ?></div>
  </div>
</div>
<?php echo $__env->make('includes.flash-message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="w3-container">
  <br>
  <div class="row">  
    <div class="col-lg-12">
 
     <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-4">
         <form method="get" action="<?php echo e(route('bed-tracker.index')); ?>">

         <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="search" name="search" value="<?php echo e($search); ?>">
           <div class="input-group-append">
             <button class="btn btn-outline-secondary" type="submit" style="background-color:#12536d">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-search" viewBox="0 0 16 16">
                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
            </div>
          </div>
        </form>
       </div>  
       <div class="col-sm-4">
          <div class="dropdown">
           <button type="button" class="btn dropdown-toggle text-white" data-bs-toggle="dropdown" style="background-color:#12536d">
             Sort by
           </button>
           <ul class="dropdown-menu">
             <li><a class="dropdown-item" href="<?php echo e(route('bed-tracker.index').'?sort=asc&search='.$search); ?>">Hospital name asc</a></li>  
             <li><a class="dropdown-item" href="<?php echo e(route('bed-tracker.index').'?sort=desc&search='.$search); ?>">Hospital name desc</a></li>
            </ul>
         </div>
       </div>
       <div class="col-sm-2">
          <span class="d-flex flex-row-reverse mb-2">
          <a class="btn text-white" id="" href="<?php echo e(route('bed-tracker.add-hospital')); ?>" style="background-color:#12536d">
           Add Hospital
          </a>
         </span>
       </div>
      </div>
      <div  style="color:#12536d">
       <hr>
        <h3>Hospital list</h3>
      </div>
      <div class="card mb-4">
        <div class="card-body"style="background-image: linear-gradient(white,skyblue)">

         <table class="table" style="background-color:white" >
            <thead>
             <tr class="table" style="background-color:#12536d; color:white">
                <th scope="col ">Hospital name</th>
                <th scope="col">Province / City </th>
                <th scope="col">Contact Number</th>
                <th scope="col">Action</th>
             </tr>
            </thead>
          <tbody>
            <?php $__currentLoopData = $hospitals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hospital): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <!-- link to hospital code -->
              <td><a href="<?php echo e(route('bed-tracker.show', ['code'=>$hospital->code])); ?>"><?php echo e($hospital->name); ?></a></td>
              <td><?php echo e($hospital->details['address']); ?></td>
              <td><?php echo e($hospital->details['main_contact']); ?></td> 
              <td class="">
               <div class="input-group input-group-sm ">
                 <a type="button" href="<?php echo e(route('bed-tracker.edit',['code'=>$hospital->code])); ?>" class="btn text-white mx-2 btn-sm" 
                   data-bs-toggle="modal" 
                   data-bs-target="#showModalEditHospital<?php echo e($hospital->code); ?>" 
                   style="background-color:#12536d"
                 >
                   Edit
                 </a>
                 <form action="<?php echo e(route('bed-tracker.delete',['code'=>$hospital->code])); ?>" method="POST">
                   <?php echo csrf_field(); ?>
                   <?php echo method_field('DELETE'); ?>
                    <button class="btn text-white btn-sm" id="" href="" style="background-color:#12536d">
                     Delete
                    </button>
                 </form>
                </div>
              </td> 
 
           </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>

        </table>
        <nav class="d-flex flex-row-reverse">
        <?php echo e($hospitals->withQueryString()->links()); ?>

        </nav>

      </div>
     <?php $__currentLoopData = $hospitals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hospital): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <!-- Edit Hospital MODAL -->
    <div class="modal fade" id="showModalEditHospital<?php echo e($hospital->code); ?>" value="<?php echo e($hospital->code); ?>"data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
       <form method="POST" action="<?php echo e(route('bed-tracker.update',['code'=>$hospital->code])); ?>">
          <?php echo method_field('PUT'); ?>
          <?php echo csrf_field(); ?>
         <div class="modal-content">                                                                                                                                                                                                                                                                                                                                                                                                                                                       
           <div class="modal-header">
             <h5 class="modal-title" id="" style="color:#0f4357;">Edit Hospital Information</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
              <form>
              <div class="row">
                <div class="col-sm-7"></div>  
                <div class="form-group required col-sm-5 mb-4">
                  <label for="" class="form-label">Hospital Address :</label>
                  <select name="address" class="form-select" aria-label="" required>

                    <option selected value=''>Select Province/City</option>
                    <option <?php echo e($hospital->details['address'] == 'Malaybalay City' ? 'selected' : ''); ?>  value="Malaybalay City">Malaybalay City</option>
                    <option <?php echo e($hospital->details['address'] == 'Valencia' ? 'selected' : ''); ?> value="Valencia City">Valencia City</option>
                    <option <?php echo e($hospital->details['address'] == 'Quezon' ? 'selected' : ''); ?> value="Quezon">Quezon</option>
                    <option <?php echo e($hospital->details['address'] == 'Lantapan' ? 'selected' : ''); ?> value="Lantapan">Lantapan</option>
                    <option <?php echo e($hospital->details['address'] == 'Cabanglasan' ? 'selected' : ''); ?> value="Cabanglasan">Cabanglasan</option>
                    <option <?php echo e($hospital->details['address'] == 'Dangcagan' ? 'selected' : ''); ?> value="Dangcagan">Dangcagan</option>
                    <option <?php echo e($hospital->details['address'] == 'Pangantucan' ? 'selected' : ''); ?> value="Pangantucan">Pangantucan</option>
                    <option <?php echo e($hospital->details['address'] == 'Talakag' ? 'selected' : ''); ?> value="Talakag">Talakag</option>
                    <option <?php echo e($hospital->details['address'] == 'Sumilao' ? 'selected' : ''); ?> value="Sumilao">Sumilao</option>
                    <option <?php echo e($hospital->details['address'] == 'Libona' ? 'selected' : ''); ?> value="Libona">Libona</option>
                    <option <?php echo e($hospital->details['address'] == 'Manolo Fortich' ? 'selected' : ''); ?> value="Manolo Fortich">Monolo Fortich</option>
                    <option <?php echo e($hospital->details['address'] == 'Maramag' ? 'selected' : ''); ?> value="Maramag">Maramag</option>
                    <option <?php echo e($hospital->details['address'] == 'San Fernando' ? 'selected' : ''); ?> value="San Fernando">San Fernando</option>
                    <option <?php echo e($hospital->details['address'] == 'Kalilangan' ? 'selected' : ''); ?> value="Kalilangan">Kalilangan</option>
                    <option <?php echo e($hospital->details['address'] == 'Damulog' ? 'selected' : ''); ?> value="Damulog">Damulog</option>
                    <option <?php echo e($hospital->details['address'] == 'Baungon' ? 'selected' : ''); ?> value="Baungon">Baungon</option>
                    <option <?php echo e($hospital->details['address'] == 'Impasug-ong' ? 'selected' : ''); ?> value="Impasug-ong">Impasug-ong</option>
                    <option <?php echo e($hospital->details['address'] == 'Malitbog' ? 'selected' : ''); ?> value="Malitbog">Malitbog</option>
                  </select>
                </div>
              </div>
              <div class="row">
               <div class="form-group required col mb-3">   
                  <label for="referredHosp" class="form-label">Hospital name :</label>
                  <input type="text" class="form-control" name="name" value="<?php echo e($hospital->name); ?>"placeholder="Input hospital name">
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">   
                 <label for="referredHosp" class="form-label">Hospital Main contact :</label>
                  <input type="text" class="form-control" name="main_contact" value="<?php echo e($hospital->details['main_contact']); ?>" placeholder="Input hospital contact number">
                </div>
              </div>
              <h6>Other contact (if any) :</h6>
              <div class="row">
               <div class="col mb-3">   
                 <label for="referredHosp" class="form-label">E.R  :</label>
                  <input type="text" class="form-control" name="er_contact" value="<?php echo e($hospital->details['er_contact']); ?>" placeholder="Enter">
                </div>
                <div class="col mb-3">   
                  <label for="referredHosp" class="form-label">Laboratory :</label>
                  <input type="text" class="form-control" name="lab_contact" value="<?php echo e($hospital->details['lab_contact']); ?>" placeholder="Enter">
                </div>
                <div class="col mb-3">   
                  <label for="referredHosp" class="form-label">Dialysis :</label>
                  <input type="text" class="form-control" name="dialysis_contact" value="<?php echo e($hospital->details['dialysis_contact']); ?>" placeholder="Enter">
                </div>
                <div class="col mb-3">   
                  <label for="referredHosp" class="form-label">Triage :</label>
                  <input type="text" class="form-control" name="triage_contact" value="<?php echo e($hospital->details['triage_contact']); ?>"placeholder="Enter">
                </div>
              </div> 
             </form>            
            </div>
           <div class="modal-footer">
             <button type="submit" class="btn text-white"style="background-color:#12536d">Submit</button>
           </div>
         </div>
        </form>
     </div>
    </div>
    <!--end Modal-->
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
   
   
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ohcc_system\resources\views/bed-tracker/hospital.blade.php ENDPATH**/ ?>