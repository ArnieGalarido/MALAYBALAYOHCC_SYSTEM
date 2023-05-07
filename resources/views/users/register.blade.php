@extends('layouts.app')
@section('content')

<style>
   .form-group.required .form-label:before {
  content:"*";
  color:red;
}
</style>

<div class="sticky-top text-white" style="background-color:#12536d">
 <div class="input-group">
    <button id="openNav" class="w3-button w3-large" onclick="w3_open()">
     &#9776;
    </button> 
    <div class="col"> @include('includes.notification')</div>
     <div class="col-sm-9">
      <h5 class="my-2 mx-3 p-1 textt-white">Register User</h5> 
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
        <h4 class="text-center" style="color:#12536d">Register Account</h4>
        <hr>
            <form method="POST" action="{{ route('users.store') }}">
               @csrf               
               @include('includes.flash-message')
             <div class="row">
                  <div class="col-sm-8"></div>  
                 <div class="form-group required  col-sm-4 mb-4">
                     <label for="" class="form-label">Role :</label>

                     <select name="role" class="form-select" aria-label="" required>
                         <option selected value=''>Select</option>
                         <option value="user">Hospital User</option>
                         <option value="staff">OHCC Staff</option>
                         <option value="admin">OHCC Admin</option>
                      </select>
                  </div>
                  <div class="col-sm-6"></div>  
                 <div class=" col-sm-6 mb-4">
                     <label for="" class="form-label">Hospital (Hospital users):</label>

                     <select name="hospital" class="form-select" aria-label="">
                         <option selected value=''>Select Hospital</option>
                         @foreach($hospitals as $hospital)
                           <option value="{{ $hospital->code }}">{{ $hospital->name }}</option>
                         @endforeach
                      </select>
                  </div>
              </div>
              <div class="row">
                 <div class="form-group required col-sm-4 mb-3">   
                     <label for="referredHosp" class="form-label">First name :</label>
                     <input type="text" class="form-control" name="firstname" placeholder="Enter first name" required>
                  </div>
                  <div class="form-group required col-sm-3 mb-3">   
                     <label for="referredHosp" class="form-label">Middle name :</label>
                     <input type="text" class="form-control" name="middlename" placeholder="Enter middle name" required>
                  </div>
                  <div class="form-group required  col-sm-3 mb-3">   
                     <label for="referredHosp" class="form-label">Last name :</label>
                     <input type="text" class="form-control" name="lastname" placeholder="Enter last name" required>
                  </div>
                  <div class="col-sm-2 mb-3">   
                     <label for="referredHosp" class="form-label">Suffix :</label>
                     <input type="text" class="form-control" name="suffix" placeholder="" >
                  </div>
              </div>
              <div class="row">
                 <div class="form-group required  col-sm-4 mb-3">   
                     <label for="referredHosp" class="form-label">Birthday :</label>
                     <input type="date" class="form-control" name="birthday" placeholder="" required>
                  </div>
                  <!-- <div class="form-group required  col-sm-4 mb-3">   
                     <label for="referredHosp" class="form-label">Age:</label>
                     <input type="number" class="form-control" name="age" id="age" placeholder="" disabled>
                  </div> -->
                 
                  <div class="form-group required  col-sm-2 mb-3">   
                     <label for="referredHosp" class="form-label">Gender :</label>
                     <select name="gender" class="form-select" aria-label="" required>
                         <option selected>Select</option>
                         <option value="female">Female</option>
                         <option value="male">Male</option>
                         
                      </select>
                  </div>
                  <div class="form-group required  col-sm-4 mb-3">
                     <label for="referredHosp" class="form-label">Contact Number :</label>
                     <input type="number" class="form-control" name="contact_number" placeholder="Enter number" required>
                  </div>
              </div>
              <div class="row">
                  <div class="form-group required  col-sm-10 mb-3">
                     <label for="" class="form-label">Address :</label>
                     <input type="text" class="form-control" name="address" placeholder="Street, Barangay, City, Province" required>
                  </div> 
                  <div class="form-group required  col-sm-2 mb-3">
                     <label for="referredHosp" class="form-label">Zip code :</label>
                     <input type="text" class="form-control" name="zipcode" placeholder="Enter" required>
                  </div>
              </div>
              <div class="row">
                  <div class="form-group required col-sm-8 mb-3">
                      <label for="" class="form-label">Email :</label>
                      <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                   </div> 
                   <div class="form-group required  col-sm-4 mb-3">
                        <label for="" class="form-label">Password :</label>
                      <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                   </div> 
              </div>
              <hr>
              
              <div class="row">
                  <div class="col-sm-8"></div>
                  <div class="col-sm text-end "> 
                     <a href="{{ route('users.index') }}">
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