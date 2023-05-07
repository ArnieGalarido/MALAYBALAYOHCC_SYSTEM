@extends('layouts.app')
@section('content')

<div class="sticky-top text-white" style="background-color:#12536d">
 <div class="input-group">
    <button id="openNav" class="w3-button w3-large" onclick="w3_open()">
     &#9776;
    </button> 
    <div class="col"> @include('includes.notification')</div>
    <div class="col-sm-9"> 
     <h5 class="my-2 mx-3 p-1">Referral Form</h5> 
    </div>
      <div class="col-sm-2 my-2">👋🏻Hi, {{Auth::user()->details['firstname'] ?? ''}}</div>
  </div>
</div>

<div class="w3-container ">
  <br>
  <div class="card mb-4" style="">
   <div class="card-body" >
      <form class="" method="POST" action="{{ route('referral-form.store') }}">
        @csrf
        @include('includes.flash-message')
       <div class="form-group required row">
          <div class="col-sm-7"></div>
          <div class="col-sm-2 mb-2 mt-2 text-end">
            <label for="datetime" class="form-label">Referral date-time :</label>
          </div>
          <div class="col-sm-3 mb-2">  
           <input type="datetime-local" class="form-control" name="referral_date" required>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-9 mb-2">  
            <label for="refHospital" class="form-label">Referring Hospital :</label>
            <select onchange="referringHospital()" id="referring_hospital" name="referring_hospital" class="form-select" aria-label="">
              <option selected value=''>Select Hospital</option>
              @foreach($hospitals as $hospital)
               <option value="{{ $hospital->code }}">{{ $hospital->name }}</option>
              @endforeach
           </select>
            <!-- <input type="text" class="form-control" name="referring_hospital" placeholder="Please input referring hospital"> -->
          </div>
          <div class="form-group required col-sm-3 mb-2">  
            <label for="contact" class="form-label">Contact No :</label>
            <input type="number" class="form-control" name="contact_no" placeholder="Enter contact number" required>
          </div>
        </div>

        <div class="row">
          <div class=" col-sm-5 mb-2">  
           <label for="referring_physician" class="form-label">Referring Physician(Doctor) :</label>
           <select id="referring_physician"  name="referring_physician" class="form-select" aria-label="">
              <option selected value=''>Select Physician</option>
           </select>
           <!-- <input type="text" class="form-control" name="referring_physician" placeholder="Enter physician name" > -->
          </div>
         <div class="form-group required col-sm-7 mb-2">  
           <label for="referred_hospital" class="form-label">Referred to(Hospital) :</label>
           <select onchange="referredHospital()" id="referred_hospital" name="referred_hospital" class="form-select" aria-label="" required>
              <option selected value='' >Select Hospital</option>
              @foreach($hospitals as $hospital)
               <option value="{{ $hospital->code }}">{{ $hospital->name }}</option>
             @endforeach
           </select>
          </div>
        </div>

        <div class="row">
          <div class="form-group required col-sm-5 mb-2">  
            <label for="patientName" class="form-label">Patient's Name :</label>
            <input type="text" class="form-control" name="patient_name" placeholder="Enter patient's full name" required>
          </div>
          <div class="form-group required col-sm-3 mb-2">  
           <label for="birthday" class="form-label">Birthday :</label>
           <input type="date" class="form-control" name="birthday" required >
          </div>
         <div class="form-group required col-sm-2 mb-2">  
            <label for="sex" class="form-label">Sex :</label>
            <select class="form-select" aria-label="" name="sex" required>
               <option selected value=''>--Select--</option>
               <option value="Female">Female</option>
               <option value="Male">Male</option>
               <option value="Others">Others</option>
    
             </select>
          </div>
          <div class="form-group required col-sm-2 mb-2">  
           <label for="referredHosp" class="form-label">Civil Status :</label>
            <!-- <input type="text" class="form-control" name="civil_status" placeholder="Enter civil status"> -->
            <select class="form-select" aria-label="" name="civil_status" required>
               <option selected value=''>--Select--</option>
               <option value="Single">Single</option>
               <option value="Married">Married</option>
               <option value="Divorce">Divorce</option>
               <option value="Separated">Separated</option>
               <option value="Widowed">Widowed</option>
             </select>
         </div>
        </div>  

        <div class="row">
          <div class="col-sm-4 mb-2">  
            <label for="chiefComplains" class="form-label">Chief Complaints :</label>
            <textarea class="form-control" id="" name="chief_complaints" placeholder="Message" rows="3"></textarea>
          </div>
          <div class="col-sm-4 mb-2">  
            <label for="hbi" class="form-label">HPI :</label>
           <textarea class="form-control" id="" name="hpi" placeholder="Enter HPI" rows="3"></textarea>
          </div>
          <div class="col-sm-4 mb-2">  
            <label for="diagnosis" class="form-label">Diagnosis :</label>
            <textarea class="form-control" id="" name="diagnosis" placeholder="Enter diagnosis" rows="3"></textarea>
         </div>
        </div>
        <hr>

        <div class="row">
          <div class="form-group required col-sm-9 mb-3">  
            <label for="reasfHospital" class="form-label">Reason for Referral :</label>
           <input type="text" class="form-control" name="reason_referral" placeholder="Enter referring hospital" required>
          </div>
         <div class="col-sm-3 mb-3">  
           <label for="preferred_doctor" class="form-label">Preferred Doctor(if any) :</label>
           <select id="preferred_doctor"  name="preferred_doctor" class="form-select" aria-label="">
              <option selected value=''>Select Physician</option>
           </select>
           <!-- <input type="text" class="form-control" name="preferred_doctor" placeholder="Enter"> -->
         </div>
        </div>    

       
        <div class="row">

         <div class="form-group required col-sm-3 mb-3">  
           <div class="input-group input-group-sm ">
              <label for="referredHosp" class="form-label mx-2">Rapid Antigen Test :</label>
             <select class="form-select" aria-label="" name="ra_test" required>
                <option selected value=''>--Select--</option>
                <option value="no">No</option>
                <option value="yes">Yes</option>
             </select>
           </div>
          </div>
          <div class="col-sm-3 mb-2">   
            <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2">(if yes)Results:</label>
             <select class="form-select" aria-label="" name="ra_results">
                <option selected value=''>--Select--</option>
                <option value="positive">Positive</option>
                <option value="negative">Negative</option>
             </select>
           </div>
         </div>
         <div class="col-sm-3 mb-2">   
            <div class="input-group input-group-sm">
             <label for="referredHosp" class="form-label mx-2 px-2">Date taken:</label>
             <input type="date" class="form-control" name="ra_date_taken" placeholder="">
           </div>
         </div>
        </div>

        <div class="row">

         <div class="form-group required col-sm-3 mb-3">  
           <div class="input-group input-group-sm ">
              <label for="referredHosp" class="form-label mx-2">RTPCR Test :</label>
              <select class="form-select" aria-label="" name="rtpcr_test" required>
                <option selected value=''>--Select--</option>
                <option value="no">No</option>
                <option value="yes">Yes</option>
             </select>
           </div>
          </div>
          <div class="col-sm-3 mb-2">   
            <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2">(if yes)Results:</label>
             <select class="form-select" aria-label="" name="rtpcr_results">
                <option selected value=''>--Select--</option>
                <option value="positive">Positive</option>
                <option value="negative">Negative</option>
             </select>
           </div>
         </div>
         <div class="col-sm-3 mb-2">   
            <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2 px-2">Date taken:</label>
             <input type="date" class="form-control" name="rtpcr_date_taken" placeholder="">
           </div>
         </div>
        </div>

        <div class="row">

         <div class="col-sm-3 mb-3">  
           <div class="input-group input-group-sm ">
              <label for="referredHosp" class="form-label mx-2">Vaccinated :</label>
              <select class="form-select" aria-label="" name="vaccinated">
                <option selected value=''>--Select--</option>
                <option value="first_vaccine">1st Dose</option>
                <option value="second_vaccine">2nd Dose</option>
              </select>
           </div>
          </div>
          <div class="col-sm-3 mb-2">   
            <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2">Name of Vaccine :</label>
             <select class="form-select" aria-label="" name="vaccine_name">
               <option selected value=''>--Select--</option>
               <option value="Bharat BioTech"> Bharat BioTech</option>
               <option value="CoronaVac (Sinovac)">CoronaVac (Sinovac)</option>
               <option value="Gamaleya Sputnik V">Gamaleya Sputnik V</option>
               <option value="Johnson and Johnson's Janssen">Johnson and Johnson's Janssen</option>
               <option value="Moderna">Moderna</option>
               <option value="Oxford-AstraZeneca">Oxford-AstraZeneca</option>
               <option value="Pfizer-BioNTech">Pfizer-BioNTech</option>
               <option value="Sinopharm">Sinopharm</option>
             </select>
           </div>
         </div>

        </div>


        <div class="row">

         <div class="col-sm-3 mb-3">  
           <div class="input-group input-group-sm ">
              <label for="referredHosp" class="form-label mx-2">Booster :</label>
              <select class="form-select" aria-label="" name="booster">
                <option selected value=''>--Select--</option>
                <option value="first">1st Dose</option>
                <option value="second">2nd Dose</option>
              </select>
           </div>
          </div>
          <div class="col-sm-3 mb-2">   
            <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2">Name of Vaccine :</label>
             <select class="form-select" aria-label="" name="booster_name">
               <option selected value=''>--Select--</option>
               <option value="Bharat BioTech"> Bharat BioTech</option>
               <option value="CoronaVac (Sinovac)">CoronaVac (Sinovac)</option>
               <option value="Gamaleya Sputnik V">Gamaleya Sputnik V</option>
               <option value="Johnson and Johnson's Janssen">Johnson and Johnson's Janssen</option>
               <option value="Moderna">Moderna</option>
               <option value="Oxford-AstraZeneca">Oxford-AstraZeneca</option>
               <option value="Pfizer-BioNTech">Pfizer-BioNTech</option>
               <option value="Sinopharm">Sinopharm</option>
             </select>           </div>
         </div>
        </div>

 

       <hr>

        <h6>Vital Signs :</h6>

        <div class="row">
          <div class="col-sm-2 mb-3">  
           <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2 my-2">BP :</label>
             <input type="text" class="form-control" name="BP" placeholder="Enter">
             <span class="input-group-text" id="basic-addon2">mmHg</span>
            </div>
          </div>
   
         <div class="col-sm-3 mb-3">       
           <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2 my-2">HR/PR :</label>
             <input type="text" class="form-control" name="HR_PR">
             <span class="input-group-text" id="basic-addon2">beats/min</span>
           </div>
          </div>

          <div class="col-sm-2 mb-3">  
            <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2 my-2">RR :</label>
             <input type="text" class="form-control" name="RR" placeholder="Enter">
             <span class="input-group-text" id="basic-addon2">/min</span>
           </div>
         </div>

          <div class="col-sm-2 mb-3">  
           <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2 my-2">Temp :</label>
             <input type="text" class="form-control" name="temperature" placeholder="Enter">
           </div>
         </div>

        </div> 
         <!-- herer -->
        <div class="row">
          <div class="col-sm-3 mb-3">  
            <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2 my-2">O2sat Room air% :</label>
             <input type="text" class="form-control" name="o2sat_room_air" placeholder="Enter">
            </div>
         </div>
   
         <div class="col-sm-3 mb-3">  
           <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2 my-2">O2sat With Oxygen% :</label>
             <input type="text" class="form-control" class="o2sat_oxygen" placeholder="Enter">
           </div>
         </div>

         <div class="col-sm-2 mb-3">  
            <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2 my-2">If yes :</label>
             <input type="text" class="form-control liter" class="o2sat_oxygen_litter" placeholder="Enter">
             <span class="input-group-text" id="basic-addon2">/liter</span>
            </div>
         </div>
        </div>

        <div class="row">
          <div class="col-sm-3 mb-3">  
           <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2">Intubated :</label>
             <select class="form-select" aria-label="" name="intubated">
                <option selected value=''>--Select--</option>
                <option value="no">No</option>
                <option value="yes">Yes</option>
             </select>
            </div>
          </div>
         <div class="col-sm-2 mb-3"> 
            <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2">GCS :</label>
             <input type="text" class="form-control" name="gcs" placeholder="Enter">
           </div>
         </div>

          <div class="col-sm-4 mb-3">  
           <div class="input-group input-group-sm">
              <span class="input-group-text" id="basic-addon2">E:</span>
              <input type="text" class="form-control pt-2" name="gcs_e">
              <span class="input-group-text" id="basic-addon2">M:</span>
              <input type="text" class="form-control"name="gcs_m">
              <span class="input-group-text" id="basic-addon2">V:</span>
             <input type="text" class="form-control" name="gcs_v">
           </div>
         </div>
        </div>

        <div class="row">
         <div class="col-sm-6 mb-2">  
            <label for="hbi" class="form-label">Pertinent P.E :</label>
            <textarea class="form-control" id="" name="pertinent_pe" placeholder="Input pertinent P.E" rows="3"></textarea>
         </div>
         <div class="col-sm-6 mb-2">  
            <label for="diagnosis" class="form-label">Covid Symptoms :</label>
            <textarea class="form-control" id="" name="covid_symptoms" placeholder="Enter covid symptoms" rows="3"></textarea>
          </div>
        </div>

        <br>
        <h5>For Trauma Case(V/A) :</h5>
        <div class="row">
         <div class="col-sm-5 mb-2">  
            <label for="refPhysician" class="form-label">Place of Incident :</label>
            <input type="text" class="form-control" name="incident_place" placeholder="Input place of incident">
         </div>

         <div class="col-sm-5 mb-2">  
           <label for="refPhysician" class="form-label">Nature of Incident :</label>
           <input type="text" class="form-control" name="incident_nature" placeholder="Input nature of incident">
         </div>
          <div class="col-sm-2 mb-2">  
            <label for="refPhysician" class="form-label">Time of Incident :</label>
           <input type="time" class="form-control" name="incident_time" placeholder="">
         </div>
        </div>

        <div class="row">
          <div class="col-sm-12 mb-2">  
           <label for="refPhysician" class="form-label">Comorbidities :</label>
            <textarea class="form-control" id="" name="comorbidities" placeholder="Input comordities" rows="3"></textarea>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12 mb-2">  
           <label for="refPhysician" class="form-label">Maintenance Meds :</label>
            <textarea class="form-control" id="" name="maintenance_meds" placeholder="Input maintenance meds" rows="3"></textarea>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12 mb-2">  
            <label for="refPhysician" class="form-label">Medication Given :</label>
            <textarea class="form-control" id="" name="medication_given" placeholder="Input medication given" rows="3"></textarea>
         </div>
        </div>

        <div class="row">
         <div class="col-sm-12 mb-2">  
            <label for="refPhysician" class="form-label">Laboratory Results :</label>
            <textarea class="form-control" id="" name="laboratory_results" placeholder="Enter laboratory results" rows="3"></textarea>
         </div>
        </div>

        <br>
        <h5>For OB Case :</h5>

        <div class="row">
         <div class="col-sm-2 mb-2">   
           <label for="referredHosp" class="form-label">Gravida :</label>
            <input type="text" class="form-control" name="gravida" placeholder="Enter">
          </div>
          <div class="col-sm-2 mb-2">   
            <label for="referredHosp" class="form-label">Para :</label>
            <input type="text" class="form-control" name="para" placeholder="Enter">
          </div>

          <div class="col-sm-2 mb-2">   
            <label for="referredHosp" class="form-label">cm Time :</label>
           <input type="time" class="form-control" name="cm_time" placeholder="">
          </div>
        </div>


        <div class="row">
          <div class="col-sm-2 mb-3">   
            <label for="referredHosp" class="form-label">AOG via LMP :</label>
            <input type="text" class="form-control" name="aog_via_lmp" placeholder="Enter">
          </div>
          <div class="col-sm-2 mb-3">   
            <label for="referredHosp" class="form-label">AOG via UTZ :</label>
            <input type="text" class="form-control" name="aog_via_utz" placeholder="Enter">
         </div>

          <div class="col-sm-2 mb-3">   
           <label for="referredHosp" class="form-label">EDC :</label>
            <input type="text" class="form-control" name="edc" placeholder="Enter">
          </div>

          <div class="col-sm-2 mb-3">   
            <label for="referredHosp" class="form-label">LMP :</label>
            <input type="text" class="form-control" name="lmp" placeholder="Enter">
         </div>
        </div>

        <div class="row">

         <div class="col-sm-4 mb-3">  
           <div class="input-group input-group-sm ">
              <label for="referredHosp" class="form-label mx-2">Leaking BOW(Leaking Bag of Water) :</label>
              <select class="form-select" aria-label="" name="leaking_bow">
                <option selected value=''>--Select--</option>
                <option value="no">No</option>
                <option value="yes">Yes</option>
             </select>
           </div>
          </div>
         <div class="col-sm-3 mb-2">   
            <div class="input-group input-group-sm ">
             <label for="referredHosp" class="form-label mx-2">Time started leaking :</label>
             <input type="time" class="form-control" name="time_started_leaking" placeholder="">
           </div>
         </div>
        </div>

        <div class="row">
          <div class="col-sm-3 mb-3">   
            <label for="referredHosp" class="form-label">FHT(Fetal Heart Rate) :</label>
           <input type="text" class="form-control" name="FHT" placeholder="Enter fetal heart rate">
         </div>
          <div class="col-sm-3 mb-3">   
           <label for="referredHosp" class="form-label">Location :</label>
           <input type="text" class="form-control" name="FHT_location" placeholder="Enter location">
          </div>

          <div class="col-sm-3 mb-3">   
           <label for="referredHosp" class="form-label">FH(Fundic Height) :</label>
           <input type="text" class="form-control" name="FH" placeholder="Enter fundic height">
          </div>
        </div>

        <div class="row">
          <div class="col-sm-3 mb-3">   
           <label for="referredHosp" class="form-label">Presentation :</label>
           <select class="form-select" aria-label="" name="presentation">
             <option selected value=''>--Select--</option>
             <option value="cephalic">Cephalic</option>
             <option value="breech">Breech</option>
             <option value="single">Single</option>
             <option value="twin">Twin</option>
            </select>
          </div>
        </div>
        

        <div class="row">
          <div class="col-sm-12 mb-2">  
           <label for="refPhysician" class="form-label">UTZ Results :</label>
            <textarea class="form-control" id="" name="utz_results" placeholder="Input UTZ results" rows="3"></textarea>
         </div>
        </div>  

        <div class="row">
         <div class="col-sm-12 mb-2">  
            <label for="refPhysician" class="form-label">Precaution Needed/Others(if Any) :</label>
            <textarea class="form-control" id="" name="precaution_needed" placeholder="Input precaution needed" rows="3"></textarea>
         </div>
        </div>

        <div class="row mb-2">
          <div class="col-sm-8 mt-2">
            <label for="" class="form-label"> Remarks status of patient :</label>
            <textarea class="form-control" id="" name="remarks" rows="5"> </textarea>
          </div>
          <div class="col-sm-4 mt-2">
            <div class="form-group required">  
             <label for="datetime" class="form-label">Call Received By :</label>
              <input type="text" class="form-control" name="call_received_by" required>
            </div>
            <div class="form-group required">
              <label for="datetime" class="mt-4 form-label">Status of call :</label>
             <select class="form-select" aria-label="" name="call_status" required >
               <option selected value=''>--Select--</option>
               <option value="admitted">Admitted</option>
               <option value="followup">Follow up</option>
               <option value="cancelled">Cancelled</option>
               <option value="expired">Expired</option>
               <option value="pending">Pending</option>
             </select>
           </div> 
         </div>
        </div> 


       <div class="row">
        <div class="col-sm-10"></div>
         <div class="col-sm mb-2"  style="margin-left: 6%">
           <span class=""><br>
             <button type="submit" class="btn btn-primary" id="">
                Submit
             </button>
            </span>
         </div>
        </div>
      </form> 
    </div>
  </div>
</div>
@stop

<script>
  var hospitals = <?= $hospitals ?>;

  function referringHospital() {
    const referring_hospital = document.getElementById("referring_hospital").value;
    let physicians = hospitals.find(h => h.code === referring_hospital).physicians;

    let select = document.getElementById("referring_physician");
    removeOptions(select);

    let newOption = new Option('Select Physician','');
    newOption.disabled = true;
    select.add(newOption,undefined);
    select.value = '';

    addOptions(select, physicians);
  }

  function referredHospital() {
    const referred_hospital = document.getElementById("referred_hospital").value;
    let physicians = hospitals.find(h => h.code === referred_hospital).physicians;

    let select = document.getElementById("preferred_doctor");
    removeOptions(select);

    let newOption = new Option('Select Physician','');
    select.add(newOption,undefined);
    select.value = '';

    addOptions(select, physicians);
  }

  function removeOptions(selectBox) {
    while (selectBox.options.length > 0) {
      selectBox.remove(0);
    }
  }

  function addOptions(selectBox, physicians) {
    for (const physician of physicians) {
      let tmpOption = new Option(physician.name + (physician.details.specialty !== '' ? ' ('+ physician.details.specialty +')': ''), physician.name);
      selectBox.add(tmpOption,undefined);
    }
  }
</script>