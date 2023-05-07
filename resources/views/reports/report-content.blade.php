
<div  style="color:#12536d">
    
      </div>
    

      <div class="">
      
         <div class="card mb-4">
         <div class="card-body" style="background-image: linear-gradient(skyblue,white)" >
         <h4> Call  </h4>

            <table class="table" style="background-color:white">
               <thead>
               <tr class="" style="background-color:#12536d; color:white">
                  <th scope="col">Total Calls</th>
                  <th scope="col ">Admitted</th>
                  <th scope="col">Follow up</th>
                  <th scope="col">Cancelled</th>
                  <th scope="col">Expires</th>
                  <th scope="col">Pending</th>
               </tr>
               </thead>
            <tbody>
               <tr style="font-size:16px">
               <td class="">{{ $calls['total'] }}</td>   
               <td class="">{{ $calls['admitted'] }}</td>
               <td class="">{{ $calls['followup'] }}</td>
               <td class="">{{ $calls['cancelled'] }}</td>
               <td class="">{{ $calls['expires'] }}</td>
               <td class="">{{ $calls['pending'] }}</td>
            </tr>

            </tbody>

         </table>

         </div>
      </div>

      <div class="">
         <div class="card mb-4 ">
         <div class="card-body" style="background-image: linear-gradient(white,skyblue)" >
            <h4>Trauma/Surgery Cases -  {{ $trauma_case['total'] }} </h4>
            <table class="table"  style="background-color:white">
               <thead>
               <tr class="" style="background-color:#12536d; color:white">
                  <th scope="col"></th>
                  <th scope="col ">RAT(+)</th>
                  <th scope="col">RAT(-)</th>
                  <th scope="col">RTPCR(+)</th>
                  <th scope="col">RTPCR(-)</th>
               </tr>
               </thead>
            <tbody style="font-size:16px">
               <tr>
               <td scope="row" class="fw-bold">Unvaccinated</td>   
               <td class="">{{ $trauma_case['unvaccinated']['rat_+'] }}</td>
               <td class="">{{ $trauma_case['unvaccinated']['rat_-'] }}</td>
               <td class="">{{ $trauma_case['unvaccinated']['ratpcr_+'] }}</td>
               <td class="">{{ $trauma_case['unvaccinated']['ratpcr_-'] }}</td>
            </tr>
            <tr>
               <td scope="row" class="fw-bold">1st Dose</td>   
               <td class="">{{ $trauma_case['first_dose']['rat_+'] }}</td>
               <td class="">{{ $trauma_case['first_dose']['rat_-'] }}</td>
               <td class="">{{ $trauma_case['first_dose']['ratpcr_+'] }}</td>
               <td class="">{{ $trauma_case['first_dose']['ratpcr_-'] }}</td>
            </tr>
            <tr>
               <td scope="row"class="fw-bold">2nd Dose</td>   
               <td class="">{{ $trauma_case['second_dose']['rat_+'] }}</td>
               <td class="">{{ $trauma_case['second_dose']['rat_-'] }}</td>
               <td class="">{{ $trauma_case['second_dose']['ratpcr_+'] }}</td>
               <td class="">{{ $trauma_case['second_dose']['ratpcr_-'] }}</td>
            </tr>
            </tbody>

         </table>
         
         </div>
      </div>

      
      <div class="">
         <div class="card mb-4 ">
         <div class="card-body"  style="background-image: linear-gradient(skyblue,white)" >
            <h4>Medical Cases - {{ $medical_case['total'] }}</h4>
            <table class="table"  style="background-color:white" >
               <thead>
               <tr class=""style="background-color:#12536d; color:white">
                  <th scope="col"></th>
                  <th scope="col ">RAT(+)</th>
                  <th scope="col">RAT(-)</th>
                  <th scope="col">RTPCR(+)</th>
                  <th scope="col">RTPCR(-)</th>
               </tr>
               </thead>
            <tbody style="font-size:16px">
            <tr>
               <td scope="row"class="fw-bold">Unvaccinated</td>   
               <td class="">{{ $medical_case['unvaccinated']['rat_+'] }}</td>
               <td class="">{{ $medical_case['unvaccinated']['rat_-'] }}</td>
               <td class="">{{ $medical_case['unvaccinated']['ratpcr_+'] }}</td>
               <td class="">{{ $medical_case['unvaccinated']['ratpcr_-'] }}</td>
            </tr>
            <tr>
               <td scope="row"class="fw-bold">1st Dose</td>   
               <td class="">{{ $medical_case['first_dose']['rat_+'] }}</td>
               <td class="">{{ $medical_case['first_dose']['rat_-'] }}</td>
               <td class="">{{ $medical_case['first_dose']['ratpcr_+'] }}</td>
               <td class="">{{ $medical_case['first_dose']['ratpcr_-'] }}</td>
            </tr>
            <tr>
               <td scope="row"class="fw-bold">2nd Dose</td>   
               <td class="">{{ $medical_case['second_dose']['rat_+'] }}</td>
               <td class="">{{ $medical_case['second_dose']['rat_-'] }}</td>
               <td class="">{{ $medical_case['second_dose']['ratpcr_+'] }}</td>
               <td class="">{{ $medical_case['second_dose']['ratpcr_-'] }}</td>
            </tr>
            </tbody>

         </table>
         
         </div>
      </div>

      <div class="">
         <div class="card mb-4 ">
         <div class="card-body"  style="background-image: linear-gradient(white,skyblue)" >
            <h4>OB-Gyne Cases - {{ $ob_case['total'] }}</h4>
            <table class="table" style="background-color:white">
               <thead>
               <tr class="" style="background-color:#12536d; color:white">
                  <th scope="col"></th>
                  <th scope="col ">RAT(+)</th>
                  <th scope="col">RAT(-)</th>
                  <th scope="col">RTPCR(+)</th>
                  <th scope="col">RTPCR(-)</th>
               </tr>
               </thead>
            <tbody style="font-size:16px">
            <tr>
               <td scope="row" class="fw-bold">Unvaccinated</td>   
               <td class="">{{ $ob_case['unvaccinated']['rat_+'] }}</td>
               <td class="">{{ $ob_case['unvaccinated']['rat_-'] }}</td>
               <td class="">{{ $ob_case['unvaccinated']['ratpcr_+'] }}</td>
               <td class="">{{ $ob_case['unvaccinated']['ratpcr_-'] }}</td>
            </tr>
            <tr>
               <td scope="row"class="fw-bold">1st Dose</td>   
               <td class="">{{ $ob_case['first_dose']['rat_+'] }}</td>
               <td class="">{{ $ob_case['first_dose']['rat_-'] }}</td>
               <td class="">{{ $ob_case['first_dose']['ratpcr_+'] }}</td>
               <td class="">{{ $ob_case['first_dose']['ratpcr_-'] }}</td>
            </tr>
            <tr>
               <td scope="row"class="fw-bold">2nd Dose</td>   
               <td class="">{{ $ob_case['second_dose']['rat_+'] }}</td>
               <td class="">{{ $ob_case['second_dose']['rat_-'] }}</td>
               <td class="">{{ $ob_case['second_dose']['ratpcr_+'] }}</td>
               <td class="">{{ $ob_case['second_dose']['ratpcr_-'] }}</td>
            </tr>
            </tbody>

         </table>
         
         </div>
      </div>
     

      <div class="">
         <div class="card mb-4 ">
         <div class="card-body" style="background-image: linear-gradient(skyblue,white)">
            <h4>Pedia Cases - {{ $pedia_case['total'] }}</h4>
            <table class="table" style="background-color:white">
               <thead>
               <tr class="" style="background-color:#12536d; color:white">
                  <th scope="col"></th>
                  <th scope="col ">RAT(+)</th>
                  <th scope="col">RAT(-)</th>
                  <th scope="col">RTPCR(+)</th>
                  <th scope="col">RTPCR(-)</th>
               </tr>
               </thead>
            <tbody style="font-size:16px">
            <tr>
               <td scope="row"class="fw-bold">Unvaccinated</td>   
               <td class="">{{ $pedia_case['unvaccinated']['rat_+'] }}</td>
               <td class="">{{ $pedia_case['unvaccinated']['rat_-'] }}</td>
               <td class="">{{ $pedia_case['unvaccinated']['ratpcr_+'] }}</td>
               <td class="">{{ $pedia_case['unvaccinated']['ratpcr_-'] }}</td>
            </tr>
            <tr>
               <td scope="row"class="fw-bold">1st Dose</td>   
               <td class="">{{ $pedia_case['first_dose']['rat_+'] }}</td>
               <td class="">{{ $pedia_case['first_dose']['rat_-'] }}</td>
               <td class="">{{ $pedia_case['first_dose']['ratpcr_+'] }}</td>
               <td class="">{{ $pedia_case['first_dose']['ratpcr_-'] }}</td>
            </tr>
            <tr>
               <td scope="row"class="fw-bold">2nd Dose</td>   
               <td class="">{{ $pedia_case['second_dose']['rat_+'] }}</td>
               <td class="">{{ $pedia_case['second_dose']['rat_-'] }}</td>
               <td class="">{{ $pedia_case['second_dose']['ratpcr_+'] }}</td>
               <td class="">{{ $pedia_case['second_dose']['ratpcr_-'] }}</td>
            </tr>
            </tbody>

         </table>
         
         </div>
      </div>