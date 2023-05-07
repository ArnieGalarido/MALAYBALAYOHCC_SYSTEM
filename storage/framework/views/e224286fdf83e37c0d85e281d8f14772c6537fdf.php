
<?php $__env->startSection('content'); ?>

<div class="sticky-top text-white" style="background-color:#12536d">
 <div class="input-group">
    <button id="openNav" class="w3-button w3-large" onclick="w3_open()">
     &#9776;
    </button> 
    <div class="col"> <?php echo $__env->make('includes.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
    <div class="col-sm-9">
     <h5 class="my-2 mx-3 p-1">Patients Referral</h5> 
    </div>
    <div class="col-sm-2 my-2">👋🏻Hi, <?php echo e(Auth::user()->details['firstname'] ?? ''); ?></div>
  </div>
</div>

<div class="w3-container ">
  <br>
  <div class="card mb-4" style="">
   <div class="card-body" >
      <form class="" method="" action="">
  
       <div class="row">
          <div class="col-sm-7"></div>
          <div class="col-sm-2 mb-2 mt-2 text-end">
            <label for="datetime" class="form-label">Referral date-time :</label>
          </div>
          <div class="col-sm-3 mb-2">  
           <input type="datetime-local" class="form-control" name="referral_date" value="<?php echo e($referral->details['referral_date'] ?? ''); ?>" disabled>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-9 mb-2">  
            <label for="refHospital" class="form-label">Referring Hospital :</label>
            <input type="text" class="form-control" name="referring_hospital" value="<?php echo e($referral->referring_hospital->name ?? ''); ?>"disabled>
          </div>
          <div class="col-sm-3 mb-2">  
            <label for="contact" class="form-label">Contact No :</label>
            <input type="number" class="form-control" name="contact_no" value="<?php echo e($referral->details['contact_no'] ?? ''); ?>" disabled>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-5 mb-2">  
           <label for="refPhysician" class="form-label">Referring Physician(Doctor) :</label>
           <input type="text" class="form-control" name="referring_physician" value="<?php echo e($referral->details['referring_physician'] ?? ''); ?>" disabled>
          </div>
         <div class="col-sm-7 mb-2">  
           <label for="referredHosp" class="form-label">Referred to(Hospital) :</label>
            <input type="text" class="form-control" name="referred_hospital" value="<?php echo e($referral->referred_hospital->name ?? ''); ?>" disabled>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-7 mb-2">  
            <label for="patientName" class="form-label">Patient's Name :</label>
            <input type="text" class="form-control" name="patient_name" value="<?php echo e($referral->patient->name ?? ''); ?>" disabled>
          </div>
          <div class="col-sm-1 mb-2">  
           <label for="age" class="form-label">Age :</label>
           <input type="number" class="form-control" name="age" value="<?php echo e($referral->patient->age); ?>" disabled >
          </div>
         <div class="col-sm-1 mb-2">  
            <label for="sex" class="form-label">Sex :</label>
           <input type="text" class="form-control" name="sex" value="<?php echo e($referral->patient->details['sex'] ?? ''); ?>" disabled >
          </div>
          <div class="col-sm-3 mb-2">  
           <label for="referredHosp" class="form-label">Civil Status :</label>
            <input type="text" class="form-control" name="civil_status" value="<?php echo e($referral->patient->details['civil_status'] ?? ''); ?>"  disabled>
         </div>
        </div>  

        <div class="row">
          <div class="col-sm-4 mb-2">  
            <label for="chiefComplains" class="form-label">Chief Complaints :</label>
            <textarea class="form-control" id="" name="chief_complaints"  rows="3" disabled> <?php echo e($referral->details['chief_complaints'] ?? ''); ?></textarea>
          </div>
          <div class="col-sm-4 mb-2">  
            <label for="hbi" class="form-label">HPI :</label>
           <textarea class="form-control" id="" name="hpi" rows="3" disabled> <?php echo e($referral->patient->details['hpi'] ?? ''); ?></textarea>
          </div>
          <div class="col-sm-4 mb-2">  
            <label for="diagnosis" class="form-label">Diagnosis :</label>
            <textarea class="form-control" id="" name="diagnosis" rows="3" disabled><?php echo e($referral->patient->details['diagnosis'] ?? ''); ?></textarea>
         </div>
        </div>
        <hr>

        <div class="row">
          <div class="col-sm-9 mb-3">  
            <label for="reasfHospital" class="form-label">Reason for Referral :</label>
           <input type="text" class="form-control" name="reason_referral"  value="<?php echo e($referral->details['reason_referral'] ?? ''); ?>" disabled>
          </div>
         <div class="col-sm-3 mb-3">  
           <label for="contact" class="form-label">Preferred Doctor(if any) :</label>
           <input type="text" class="form-control" name="preferred_doctor" value="<?php echo e($referral->details['preferred_doctor'] ?? ''); ?>" disabled>
         </div>
        </div>    

       
        <div class="row">

         <div class="col-sm-3 mb-3">  
           <div class="input-group input-group-sm ">
              <label for="referredHosp" class="form-label mx-2">Rapid Antigen Test :</label>
              <select class="form-select" aria-label="" name="ra_test" disabled>
                <option selected value=''>----</option>
                <option <?php echo e($referral->patient->details['ra_test'] == 'no' ? 'selected' : ''); ?> value="no">No</option>
                <option <?php echo e($referral->patient->details['ra_test'] == 'yes' ? 'selected' : ''); ?> value="yes">Yes</option>
             </select>
           </div>
          </div>
          <div class="col-sm-3 mb-2">   
            <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2">(if yes)Results:</label>
             <select class="form-select" aria-label="" name="ra_results" disabled>
                <option selected value=''>----</option>
                <option <?php echo e($referral->patient->details['ra_results'] == 'Positive' ? 'selected' : ''); ?> value="Positive">Positive</option>
                <option <?php echo e($referral->patient->details['ra_results'] == 'Negative' ? 'selected' : ''); ?> value="Negative">Negative</option>
             </select>
            </div>
         </div>
         <div class="col-sm-3 mb-2">   
            <div class="input-group input-group-sm">
             <label for="referredHosp" class="form-label mx-2 px-2">Date taken:</label>
             <input type="date" class="form-control" name="ra_date_taken"  value="<?php echo e($referral->patient->details['ra_date_taken'] ?? ''); ?>" disabled>
           </div>
         </div>
        </div>

        <div class="row">

         <div class="col-sm-3 mb-3">  
           <div class="input-group input-group-sm ">
              <label for="referredHosp" class="form-label mx-2">RTPCR Test :</label>
              <select class="form-select" aria-label="" name="rtpcr_test" disabled>
                <option selected value=''>----</option>
                <option <?php echo e($referral->patient->details['rtpcr_test'] == 'no' ? 'selected' : ''); ?> value="no">No</option>
                <option <?php echo e($referral->patient->details['rtpcr_test'] == 'yes' ? 'selected' : ''); ?> value="yes">Yes</option>
             </select>
           </div>
          </div>
          <div class="col-sm-3 mb-2">   
            <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2">(if yes)Results:</label>
             <select class="form-select" aria-label="" name="rtpcr_results" disabled>
                <option selected value=''>----</option>
                <option <?php echo e($referral->patient->details['rtpcr_results'] == 'Positive' ? 'selected' : ''); ?> value="Positive">Positive</option>
                <option <?php echo e($referral->patient->details['rtpcr_results'] == 'Negative' ? 'selected' : ''); ?> value="Negative">Negative</option>
             </select>
           </div>
         </div>
         <div class="col-sm-3 mb-2">   
            <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2 px-2">Date taken:</label>
             <input type="date" class="form-control" name="rtpcr_date_taken"  value="<?php echo e($referral->patient->details['rtpcr_date_taken'] ?? ''); ?>" disabled>
           </div>
         </div>
        </div>

        <div class="row">

         <div class="col-sm-3 mb-3">  
           <div class="input-group input-group-sm ">
              <label for="referredHosp" class="form-label mx-2">Vaccinated :</label>
              <select class="form-select" aria-label="" name="vaccinated" disabled>
                <option selected value=''>----</option>
                <option <?php echo e($referral->patient->details['vaccinated'] == 'first_vaccine' ? 'selected' : ''); ?> value="first">1st Dose</option>
                <option <?php echo e($referral->patient->details['vaccinated'] == 'second_vaccine' ? 'selected' : ''); ?> value="second">2nd Dose</option>
             </select>
           </div>
          </div>
          <div class="col-sm-3 mb-2">   
            <div class="input-group input-group-sm">
             <label for="referredHosp" class="form-label mx-2">Name of Vaccine :</label>
             <input type="text" class="form-control" name="vaccine_name" value="<?php echo e($referral->patient->details['vaccine_name'] ?? ''); ?>" disabled>
           </div>
         </div>

        </div>


        <div class="row">

         <div class="col-sm-3 mb-3">  
           <div class="input-group input-group-sm ">
              <label for="referredHosp" class="form-label mx-2">Booster :</label>
              <select class="form-select" aria-label="" name="booster" disabled>
                <option selected value=''>----</option>
                <option <?php echo e($referral->patient->details['booster'] == 'first' ? 'selected' : ''); ?> value="first">1st Dose</option>
                <option <?php echo e($referral->patient->details['booster'] == 'second' ? 'selected' : ''); ?> value="second">2nd Dose</option>
             </select>
           </div>
          </div>
          <div class="col-sm-3 mb-2">   
            <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2">Name of Vaccine :</label>
             <input type="text" class="form-control" name="booster_name" value="<?php echo e($referral->patient->details['booster_name'] ?? ''); ?>" disabled>
           </div>
         </div>
        </div>

 

       <hr>

        <h6>Vital Signs :</h6>

        <div class="row">
          <div class="col-sm-2 mb-3">  
           <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2 my-2">BP :</label>
             <input type="text" class="form-control" name="BP"  value="<?php echo e($referral->patient->details['BP'] ?? ''); ?>" disabled>
             <span class="input-group-text" id="basic-addon2">mmHg</span>
            </div>
          </div>
   
         <div class="col-sm-3 mb-3">       
           <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2 my-2">HR/PR :</label>
             <input type="text" class="form-control" name="HR_PR"  value="<?php echo e($referral->patient->details['HR_PR'] ?? ''); ?>" disabled>
             <span class="input-group-text" id="basic-addon2">beats/min</span>
           </div>
          </div>

          <div class="col-sm-2 mb-3">  
            <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2 my-2">RR :</label>
             <input type="text" class="form-control" name="RR"  value="<?php echo e($referral->patient->details['RR'] ?? ''); ?>"disabled>
             <span class="input-group-text" id="basic-addon2">/min</span>
           </div>
         </div>

          <div class="col-sm-2 mb-3">  
           <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2 my-2">Temp :</label>
             <input type="text" class="form-control" name="temperature"  value="<?php echo e($referral->patient->details['temperature'] ?? ''); ?>"disabled>
           </div>
         </div>

        </div> 
         <!-- herer -->
        <div class="row">
          <div class="col-sm-3 mb-3">  
            <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2 my-2">O2sat Room air% :</label>
             <input type="text" class="form-control" name="o2sat_room_air" value="<?php echo e($referral->patient->details['o2sat_room_air'] ?? ''); ?>"disabled>
            </div>
         </div>
   
         <div class="col-sm-3 mb-3">  
           <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2 my-2">O2sat With Oxygen% :</label>
             <input type="text" class="form-control" class="o2sat_oxygen" value="<?php echo e($referral->patient->details['o2sat_oxygen'] ?? ''); ?>"disabled>
           </div>
         </div>

         <div class="col-sm-2 mb-3">  
            <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2 my-2">If yes :</label>
             <input type="text" class="form-control liter" class="o2sat_oxygen_litter" value="<?php echo e($referral->patient->details['o2sat_oxygen_litter'] ?? ''); ?>" disabled>
             <span class="input-group-text" id="basic-addon2">/liter</span>
            </div>
         </div>
        </div>

        <div class="row">
          <div class="col-sm-3 mb-3">  
           <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2">Intubated :</label>
             <select class="form-select" aria-label="" name="intubated" disabled>
                <option selected value=''>----</option>
                <option <?php echo e($referral->patient->details['intubated'] == 'no' ? 'selected' : ''); ?> value="no">No</option>
                <option <?php echo e($referral->patient->details['intubated'] == 'yes' ? 'selected' : ''); ?> value="yes">Yes</option>
             </select>
            </div>
          </div>
         <div class="col-sm-2 mb-3"> 
            <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2">GCS :</label>
             <input type="text" class="form-control" name="gcs" value="<?php echo e($referral->patient->details['gcs'] ?? ''); ?>"disabled>
           </div>
         </div>

          <div class="col-sm-4 mb-3">  
           <div class="input-group input-group-sm">
              <span class="input-group-text" id="basic-addon2">E:</span>
              <input type="text" class="form-control pt-2" name="gcs_e" value="<?php echo e($referral->patient->details['gcs_e'] ?? ''); ?>" disabled>
              <span class="input-group-text" id="basic-addon2">M:</span>
              <input type="text" class="form-control"name="gcs_m" value="<?php echo e($referral->patient->details['gcs_m'] ?? ''); ?>" disabled>
              <span class="input-group-text" id="basic-addon2">V:</span>
             <input type="text" class="form-control" name="gcs_v" value="<?php echo e($referral->patient->details['gcs_v'] ?? ''); ?>" disabled>
           </div>
         </div>
        </div>

        <div class="row">
         <div class="col-sm-6 mb-2">  
            <label for="hbi" class="form-label">Pertinent P.E :</label>
            <textarea class="form-control" id="" name="pertinent_pe" disabled><?php echo e($referral->patient->details['pertinent_pe'] ?? ''); ?></textarea>
         </div>
         <div class="col-sm-6 mb-2">  
            <label for="diagnosis" class="form-label">Covid Symptoms :</label>
            <textarea class="form-control" id="" name="covid_symptoms" disabled><?php echo e($referral->patient->details['covid_symptoms'] ?? ''); ?></textarea>
          </div>
        </div>
        <?php if($referral->patient->case != 'pedia' && $referral->patient->case != 'medical'): ?>
        <br>
        <?php if($referral->patient->case != 'ob'): ?>
        <h5>For Trauma Case(V/A) :</h5>
        <div class="row">
         <div class="col-sm-5 mb-2">  
            <label for="refPhysician" class="form-label">Place of Incident :</label>
            <input type="text" class="form-control" name="incident_place"  value="<?php echo e($referral->patient->details['incident_place'] ?? ''); ?>" disabled>
         </div>

         <div class="col-sm-5 mb-2">  
           <label for="refPhysician" class="form-label">Nature of Incident :</label>
           <input type="text" class="form-control" name="incident_nature" value="<?php echo e($referral->patient->details['incident_nature'] ?? ''); ?>" disabled>
         </div>
          <div class="col-sm-2 mb-2">  
            <label for="refPhysician" class="form-label">Time of Incident :</label>
           <input type="time" class="form-control" name="incident_time" value="<?php echo e($referral->patient->details['incident_time'] ?? ''); ?>" disabled>
         </div>
        </div>

        <div class="row">
          <div class="col-sm-12 mb-2">  
           <label for="refPhysician" class="form-label">Comorbidities :</label>
            <textarea class="form-control" id="" name="comorbidities"  rows="3" disabled><?php echo e($referral->patient->details['comorbidities'] ?? ''); ?></textarea>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12 mb-2">  
           <label for="refPhysician" class="form-label">Maintenance Meds :</label>
            <textarea class="form-control" id="" name="maintenance_meds"  rows="3" disabled><?php echo e($referral->patient->details['maintenance_meds'] ?? ''); ?></textarea>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12 mb-2">  
            <label for="refPhysician" class="form-label">Medication Given :</label>
            <textarea class="form-control" id="" name="medication_given" rows="3" disabled><?php echo e($referral->patient->details['maintenance_meds'] ?? ''); ?> </textarea>
         </div>
        </div>

        <div class="row">
         <div class="col-sm-12 mb-2">  
            <label for="refPhysician" class="form-label">Laboratory Results :</label>
            <textarea class="form-control" id="" name="laboratory_results"rows="3" disabled><?php echo e($referral->patient->details['laboratory_results'] ?? ''); ?></textarea>
         </div>
        </div>


        <?php endif; ?>
        <br>
        <?php if($referral->patient->case != 'trauma'): ?>

        <h5>For OB Case :</h5>

        <div class="row">
         <div class="col-sm-2 mb-2">   
           <label for="referredHosp" class="form-label">Gravida :</label>
            <input type="text" class="form-control" name="gravida" value="<?php echo e($referral->patient->details['gravida'] ?? ''); ?>"disabled>
          </div>
          <div class="col-sm-2 mb-2">   
            <label for="referredHosp" class="form-label">Para :</label>
            <input type="text" class="form-control" name="para" value="<?php echo e($referral->patient->details['para'] ?? ''); ?>"  disabled>
          </div>

          <div class="col-sm-2 mb-2">   
            <label for="referredHosp" class="form-label">cm Time :</label>
           <input type="time" class="form-control" name="cm_time" value="<?php echo e($referral->patient->details['cm_time'] ?? ''); ?>" disabled>
          </div>
        </div>


        <div class="row">
          <div class="col-sm-2 mb-3">   
            <label for="referredHosp" class="form-label">AOG via LMP :</label>
            <input type="text" class="form-control" name="aog_via_lmp" value="<?php echo e($referral->patient->details['aog_via_lmp'] ?? ''); ?>" disabled>
          </div>
          <div class="col-sm-2 mb-3">   
            <label for="referredHosp" class="form-label">AOG via UTZ :</label>
            <input type="text" class="form-control" name="aog_via_utz" value="<?php echo e($referral->patient->details['aog_via_utz'] ?? ''); ?>" disabled>
         </div>

          <div class="col-sm-2 mb-3">   
           <label for="referredHosp" class="form-label">EDC :</label>
            <input type="text" class="form-control" name="edc" value="<?php echo e($referral->patient->details['edc'] ?? ''); ?>" disabled>
          </div>

          <div class="col-sm-2 mb-3">   
            <label for="referredHosp" class="form-label">LMP :</label>
            <input type="text" class="form-control" name="lmp" value="<?php echo e($referral->patient->details['lmp'] ?? ''); ?>"disabled>
         </div>
        </div>

        <div class="row">

         <div class="col-sm-4 mb-3">  
           <div class="input-group input-group-sm ">
              <label for="referredHosp" class="form-label mx-2">Leaking BOW(Leaking Bag of Water) :</label>
              <select class="form-select" aria-label="" name="leaking_bow" disabled>
                <option selected value=''>----</option>
                <option <?php echo e($referral->patient->details['leaking_bow'] == 'no' ? 'selected' : ''); ?> value="no">No</option>
                <option <?php echo e($referral->patient->details['leaking_bow'] == 'yes' ? 'selected' : ''); ?> value="yes">Yes</option>
             </select>
           </div>
          </div>
         <div class="col-sm-3 mb-2">   
            <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2">Time started leaking :</label>
             <input type="time" class="form-control" name="time_started_leaking" value="<?php echo e($referral->patient->details['time_started_leaking'] ?? ''); ?>" disabled>
           </div>
         </div>
        </div>

        <div class="row">
          <div class="col-sm-3 mb-3">   
            <label for="referredHosp" class="form-label">FHT(Fetal Heart Rate) :</label>
           <input type="text" class="form-control" name="FHT" value="<?php echo e($referral->patient->details['FHT'] ?? ''); ?>" disabled>
         </div>
          <div class="col-sm-3 mb-3">   
           <label for="referredHosp" class="form-label">Location :</label>
           <input type="text" class="form-control" name="FHT_location" value="<?php echo e($referral->patient->details['FHT_location'] ?? ''); ?>" disabled>
          </div>

          <div class="col-sm-3 mb-3">   
           <label for="referredHosp" class="form-label">FH(Fundic Height) :</label>
           <input type="text" class="form-control" name="FH" value="<?php echo e($referral->patient->details['FH'] ?? ''); ?>" disabled>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-3 mb-3">   
           <label for="referredHosp" class="form-label">Presentation :</label>
           <select class="form-select" aria-label="" name="presentation" disabled>
             <option selected value=''>----</option>
             <option <?php echo e($referral->patient->details['presentation'] == 'cephalic' ? 'selected' : ''); ?>  value="cephalic">Cephalic</option>
             <option <?php echo e($referral->patient->details['presentation'] == 'breech' ? 'selected' : ''); ?>   value="breech">Breech</option>
             <option <?php echo e($referral->patient->details['presentation'] == 'single' ? 'selected' : ''); ?>   value="single">Single</option>
             <option <?php echo e($referral->patient->details['presentation'] == 'twin' ? 'selected' : ''); ?>  value="twin">Twin</option>
            </select>
          </div>
        </div>
        

        <div class="row">
          <div class="col-sm-12 mb-2">  
           <label for="refPhysician" class="form-label">UTZ Results :</label>
            <textarea class="form-control" id="" name="utz_results" rows="3" disabled><?php echo e($referral->patient->details['utz_results'] ?? ''); ?></textarea>
         </div>
        </div>  

        <div class="row">
         <div class="col-sm-12 mb-2">  
            <label for="refPhysician" class="form-label">Precaution Needed/Others(if Any) :</label>
            <textarea class="form-control" id="" name="precaution_needed" rows="3" disabled><?php echo e($referral->patient->details['precaution_needed'] ?? ''); ?></textarea>
         </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>


       <div class="row">
          <div class="col-sm-8 mt-2">
            <label for="" class="form-label"> Remarks status of patient :</label>
            <textarea class="form-control" id="" name="remarks" rows="5" disabled> <?php echo e($referral->details['remarks'] ?? ''); ?></textarea>
          </div>
          <div class="col-sm-4 mt-2">
            <div class="">
              <label for="datetime" class="form-label">Call Received By :</label>
              <input type="text" class="form-control" name="call_received_by" value="<?php echo e($referral->details['call_received_by'] ?? ''); ?>" disabled>

            </div>
            <div class="">
             <label for="datetime" class="mt-4 form-label">Status of call :</label>
             <select class="form-select" aria-label="" name="call_status" disabled>
               <option selected value=''>----</option>
               <option <?php echo e($referral->patient->status == 'admitted' ? 'selected' : ''); ?> value="admitted">Admitted</option>
               <option <?php echo e($referral->patient->status == 'followup' ? 'selected' : ''); ?>  value="followup">Follow up</option>
               <option <?php echo e($referral->patient->status == 'cancelled' ? 'selected' : ''); ?>  value="cancelled">Cancelled</option>
               <option <?php echo e($referral->patient->status == 'expired' ? 'selected' : ''); ?> value="expired">Expired</option>
              </select>
            </div>
          </div>
         
        </div>
      </form> 
    </div>
  </div>
</div>

    

 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ohcc_system\resources\views/referrals/show-referral.blade.php ENDPATH**/ ?>