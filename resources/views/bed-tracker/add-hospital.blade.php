@extends('layouts.app')
@section('content')

<div class="sticky-top text-white" style="background-color:#12536d">
 <div class="input-group">
    <button id="openNav" class="w3-button w3-large" onclick="w3_open()">
     &#9776;
    </button> 
    <div class="col"> @include('includes.notification')</div>
    <div class="col-sm-9">
     <h5 class="my-2 mx-3 p-1">Add Hospital</h5> 
   </div>
      <div class="col-sm-2 my-2">👋🏻Hi, {{Auth::user()->details['firstname'] ?? ''}}</div>
  </div>
</div>

<div class="w3-container">
  <br>
  <div class="row">  
     <div class="col-lg-2"></div>
     <div class="col-lg-8">
      
      <div class="card mb-4" >
        <div class="card-body">
        <h4 class="text-center" style="color:#12536d">Add Hosptial Account</h4>
        @include('includes.flash-message')
        <hr>
            <form method="POST" action="{{ route('bed-tracker.store') }}">
               @csrf
               <div class="row">
                  <div class="col-sm-7"></div>  
                 <div class="form-group required col-sm-5 mb-4">
                     <label for="" class="form-label">Hospital Address :</label>

                     <select name="address" class="form-select" aria-label="" required>
                         <option selected value=''>Select Province/City</option>
                         <option value="Malaybalay City">Malaybalay City</option>
                         <option value="Valencia City">Valencia City</option>
                         <option value="Quezon">Quezon</option>
                         <option value="Lantapan">Lantapan</option>
                         <option value="Cabanglasan">Cabanglasan</option>
                         <option value="Dangcagan">Dangcagan</option>
                         <option value="Pangantucan">Pangantucan</option>
                         <option value="Talakag">Talakag</option>
                         <option value="Sumilao">Sumilao</option>
                         <option value="Libona">Libona</option>
                         <option value="Manolo Fortich">Monolo Fortich</option>
                         <option value="Maramag">Maramag</option>
                         <option value="San Fernando">San Fernando</option>
                         <option value="Kalilangan">Kalilangan</option>
                         <option value="Damulog">Damulog</option>
                         <option value="Baungon">Baungon</option>
                         <option value="Impasug-ong">Impasug-ong</option>
                         <option value="Malitbog">Malitbog</option>
                      </select>
                  </div>
              </div>
              <div class="row">
                 <div class="form-group required col mb-3">   
                     <label for="referredHosp" class="form-label">Hospital name :</label>
                     <input type="text" class="form-control" name="name" placeholder="Input hospital name" required>
                  </div>

              </div>
              <div class="row">
                 <div class="col mb-3">   
                     <label for="referredHosp" class="form-label">Hospital Main contact :</label>
                     <input type="text" class="form-control" name="main_contact" placeholder="Input hospital contact number">
                  </div>
              </div>
              <h6>Other contact (if any) :</h6>
              <div class="row">
                  <div class="col mb-3">   
                     <label for="referredHosp" class="form-label">E.R  :</label>
                     <input type="text" class="form-control" name="er_contact" placeholder="Enter">
                  </div>
                  <div class="col mb-3">   
                     <label for="referredHosp" class="form-label">Laboratory :</label>
                     <input type="text" class="form-control" name="lab_contact" placeholder="Enter">
                  </div>
                  <div class="col mb-3">   
                     <label for="referredHosp" class="form-label">Dialysis :</label>
                     <input type="text" class="form-control" name="dialysis_contact" placeholder="Enter">
                  </div>
                  <div class="col mb-3">   
                     <label for="referredHosp" class="form-label">Triage :</label>
                     <input type="text" class="form-control" name="triage_contact" placeholder="Enter">
                  </div>
              </div>
           
      
              <hr>
              
              <div class="row">
                  <div class="col-sm-8"></div>
                  <div class="col-sm text-end "> 
                     <a href="{{ route('bed-tracker.index') }}">
                        <button type="button" class="btn btn-danger" id="">
                           Cancel
                        </button>
                     </a>
                  </div>
                  <div class="col-sm text-end"> 
                      <button type="submit" class="btn text-white" id=""  style="background-color:#12536d">
                        Submit
                      </button>
                  </div>
              </div>

           </form>
        </div>

      </div>
    </div>
  </div>
</div>
@stop