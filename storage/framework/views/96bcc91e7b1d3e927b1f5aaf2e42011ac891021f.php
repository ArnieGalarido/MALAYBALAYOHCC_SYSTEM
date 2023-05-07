
<?php $__env->startSection('content'); ?>
<?php use Carbon\Carbon; ?>
 <div class="sticky-top text-white" style="background-color:#12536d">
    <div class="input-group">
     <button id="openNav" class="w3-button w3-large" onclick="w3_open()">
      &#9776;
     </button>
     <div class="col"> <?php echo $__env->make('includes.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
     <div class="col-sm-9">
       <h5 class="my-2 mx-3 p-1">Reports</h5>
    </div>
      <div class="col-sm-2 my-2">👋🏻Hi, <?php echo e(Auth::user()->details['firstname'] ?? ''); ?></div>
     <!-- <span class="" style="height:43px;">
        <div class="input-group my-3 ms-8">
           <h5 class=""> <span class=""id="date"> </span> </h5>
           <h5 class=""> <span class=""id="time"> </span> </h5>
        </div>
     </span> -->
    </div>
</div> 

<div class="w3-container">
  <br>
  <div class="row">  
    <div class="col-lg-12 ">
       <div class="row">
          <div class="col-lg-4">
              <div class="card mb-4" style="background-color:#e9f6fb">
                   <div class="card-body">
                      <div class="row">
                         <div class="col-sm-3 ">
                             <span class="total-calls">
                                <h4 class="text-center mx-3 my-3 text-white"><?php echo e($total['calls']); ?></h4>
                             </span>
                         </div>  
                         <div class="col my-3" style="color:#0f4357;">
                           <h5 class="text-center">Total Calls Received</h5>
                         </div>
                     </div>
                 </div>
             </div>    
          </div>

        
          <div class="col-lg-4">
              <div class="card mb-4  "style="background-color:#e9f6fb">
                   <div class="card-body">
                      <div class="row">
                         <div class="col-sm-3">
                             <span class="total-calls" style="background-color:#12536d">
                                <h4 class="text-center mx-3 my-3 text-white"><?php echo e($total['patient']); ?></h4>
                             </span>
                         </div>  
                         <div class="col my-2" style="color:#0f4357;">
                           <h5 class="text-center">Total Patient </h5>
                           <h6 class="text-center">(Referred To Hospitals)</h6>
                         </div>
                     </div>
                 </div>
             </div>    
         </div>

         <div class="col-lg-4">
              <div class="card mb-4" style="background-color:#e9f6fb">
                   <div class="card-body">
                      <div class="row">
                         <div class="col-sm-3">
                             <span class="total-calls" style="background-color:#12536d">
                                <h4 class="text-center mx-3 my-3 text-white"><?php echo e($total['referral']); ?></h4>
                             </span>
                         </div>  
                         <div class="col my-2" style="color:#0f4357;">
                           <h5 class="text-center">Total Calls and Referrals</h5>
                           <h6 class="text-center">(Hospital to Hospital Referrals)</h6>
                        </div>
                     </div>
                 </div>
             </div>    
         </div>

         

        </div>

       
     <div class="row justify-content-md-center">
         <div class="col-4">
         <form method="get" action="<?php echo e(route('reports.index')); ?>">
          <div class="input-group mb-3">
              <input type="month" class="form-control" placeholder="search" aria-label="" name="date" value="<?php echo e($date ?? null); ?>">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" style="background-color:#12536d;color:white">
                    Generate
                </button>
              </div>
            </div>
          </form>
            
         </div>

         <div class="col-sm-2">
          <span class="d-flex flex-row-reverse mb-2">
          <a class="btn text-white" id="" href="<?php echo e(route('reports.download')); ?>" style="background-color:#12536d">
           Download
          </a>
         </span>
       </div>
      </div>
      <hr>
      <h3 style="color:#12536d">Report list</h3>
      <?php echo $__env->make('reports.report-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ohcc_system\resources\views/reports/report-list.blade.php ENDPATH**/ ?>