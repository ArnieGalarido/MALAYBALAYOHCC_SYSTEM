@extends('layouts.app')
@section('content')

<div class="sticky-top text-white" style="background-color:#12536d">
 <div class="input-group">
    <button id="openNav" class="w3-button w3-large" onclick="w3_open()">
     &#9776;
    </button> 
    <div class="col"> @include('includes.notification')</div>    <div class="col-sm-9">
    <h5 class="my-2 mx-3 p-1">Profile</h5> 
    </div>
      <div class="col-sm-2 my-2">👋🏻Hi, {{Auth::user()->details['firstname'] ?? ''}}</div>
  </div>
</div>

<div class="w3-container">
  <br>
  <div class="row">  
    <div class="col-lg-3">
     <div class="card mb-4 text-white" style="background-color:#12536d">
        <div class="card-body text-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="150px" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
          </svg>
          <!-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
          class="rounded-circle img-fluid" style="width: 150px;"> -->
          <h5 class="my-3">{{ $user->name }}</h5>
          @if($user->role == 'user')
           <p class=" mb-1" name="admin">Hospital User</p>   
          @elseif($user->role == 'staff')
          <p class=" mb-1" name="admin">OHCC Staff</p>   
          @elseif($user->role == 'admin')
          <p class=" mb-1" name="admin">OHCC Admin</p>   
          @endif
        </div>
      </div>    
    </div>

    <div class="col-lg-9">
      @include('includes.flash-message')
      <span class="d-flex flex-row-reverse mb-2">
        <a type="button" class="btn text-white" data-bs-toggle="modal" data-bs-target="#showEditModal"style="background-color:#12536d">
          Edit
         </a>
      </span>
     
      <div class="card mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col">
             <p class="mb-0">First name :</p>
            </div>
            <div class="col">
              <p class="text-muted mb-0">{{ $user->details['firstname'] ?? 'N/A' }}</p>
            </div>
            <div class="col">
             <p class="mb-0">Middle name :</p>
            </div>
            <div class="col">
              <p class="text-muted mb-0">{{ $user->details['middlename'] ?? 'N/A' }}</p>
            </div>
            <div class="col">
             <p class="mb-0">Last name :</p>
           </div>
           <div class="col">
             <p class="text-muted mb-0">{{ $user->details['lastname'] ?? 'N/A' }}</p>
           </div>
           <div class="col">
             <p class="mb-0">Suffix :</p>
           </div>
           <div class="col">
             <p class="text-muted mb-0">{{ $user->details['suffix'] ?? 'N/A' }}</p>
           </div>
         </div>
          <hr>

         <div class="row">
            <div class="col-sm-2">
             <p class="mb-0">Email :</p>
            </div>
            <div class="col-sm-4">
             <p class="text-muted mb-0">{{ $user->email }}</p>
            </div>
            <div class="col-sm-2">
              <p class="mb-0">Password :</p>
            </div>
            <div class="col-sm-4">
              <p class="text-muted mb-0">******</p>
            </div>
         </div>
          <hr>

          <div class="row">
            <div class="col-sm">
              <p class="mb-0">Mobile :</p>
            </div>
            <div class="col-sm">
              <p class="text-muted mb-0">{{ $user->details['contact_number'] ?? 'N/A' }}</p>
           </div>
           <div class="col-sm">
              <p class="mb-0">Birthday :</p>
            </div>
            <div class="col-sm">
              <p class="text-muted mb-0">{{ $user->details['birthday'] ?? 'N/A' }}</p>
           </div>
           <div class="col-sm">
              <p class="mb-0">Age :</p>
            </div>
            <div class="col-sm">
              <p class="text-muted mb-0">{{ $user->details['age'] ?? 'N/A' }}</p>
           </div>
           <div class="col-sm">
              <p class="mb-0">Gender :</p>
            </div>
            <div class="col-sm">
              <p class="text-muted mb-0">{{ $user->details['gender'] ?? 'N/A' }}</p>
           </div>
          </div>
          <hr>

          <div class="row">
            <div class="col-sm">
              <p class="mb-0">Address :</p>
            </div>
           <div class="col-sm-8">
             <p class="text-muted mb-0">{{ $user->details['address'] ?? 'N/A' }}</p>
            </div>
            <div class="col-sm">
              <p class="mb-0">Zip code:</p>
            </div>
           <div class="col-sm">
             <p class="text-muted mb-0">{{ $user->details['zipcode'] ?? 'N/A' }}</p>
            </div>
         </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="showEditModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
       <form method="POST" action="{{ route('update_profile') }}">
          @method('PUT')
          @csrf
         <div class="modal-content">                                                                                                                                                                                                                                                                                                                                                                                                                                                       
           <div class="modal-header">
             <h5 class="modal-title" style="color:#12536d" id="">Edit Profile</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
          
            <div class="modal-body">
              <div class="row mb-2">
               <div class="col-sm-2">
                  <p class="mb-0">First name :</p>
               </div>
               <div class="col-sm-4">
                  <input type="text" class="form-control" name="firstname" value="{{ $user->details['firstname'] ?? '' }}">
               </div>
               <div class="col-sm">
                  <p class="mb-0">Middle name :</p>
               </div>
               <div class="col-sm-4">
                  <input type="text" class="form-control" name="middlename" value="{{ $user->details['middlename'] ?? '' }}">
               </div>
            
             </div>
         
             <div class="row mb-2">
               <div class="col-sm-2">
                 <p class="mb-0">Last name :</p>
                </div>
               <div class="col-sm-4">
                  <input type="text" class="form-control" name="lastname" value="{{ $user->details['lastname'] ?? '' }}">
                </div>
                <div class="col-sm-2">
                  <p class="mb-0">Suffix :</p>
               </div>
               <div class="col-sm-4">
                  <input type="text" class="form-control" name="suffix" value="{{ $user->details['suffix'] ?? '' }}">
               </div>
             </div>
             <div class="row mb-2">
               <div class="col-sm-2">
                  <p class="mb-0">Email :</p>
               </div>
               <div class="col-sm-4">
                  <input type="text" class="form-control"  name="email" value="{{ $user->email }}">
                </div>
                <div class="col-sm-2">
                  <p class="mb-0">Old Password :</p>
                </div>
                <div class="col-sm-4">
                 <input type="password" placeholder="*******" class="form-control"  name="old_password">
               </div>
             </div>
             <div class="row mb-2">
               <div class="col-sm-2">
                  <p class="mb-0">Mobile :</p>
               </div>
               <div class="col-sm-4">
                  <input type="number" class="form-control" name="contact_number" value="{{ $user->details['contact_number'] ?? '' }}" >
               </div>
               <div class="col-sm-2">
                  <p class="mb-0">New Password :</p>
                </div>
                <div class="col-sm-4">
                 <input type="password" placeholder="*******" class="form-control"  name="password">
               </div>
             </div>
            
             <div class="row mb-2">
               <div class="col-sm-2">
                  <p class="mb-0">Birthday :</p>
               </div>
               <div class="col-sm-4">
                  <input type="date" class="form-control" name="birthday" value="{{ $user->details['birthday'] ?? '' }}">
               </div>
               <div class="col-sm">
                  <p class="mb-0">Age: {{ $user->details['age'] }}</p>
                </div>
               <div class="col-sm">
                  <p class="mb-0">Gender:</p>
                </div>
                <div class="col-sm-2">
                 <input type="text" class="form-control" name="gender" value="{{ $user->details['gender'] ?? '' }}" >
               </div>
             </div>

           
       
             <div class="row">
               <div class="col-sm-2">
                  <p class="mb-0">Address :</p>
               </div>
               <div class="col-sm-7">
                  <input type="text" class="form-control"  name="address" value="{{ $user->details['address'] ?? '' }}">
                </div>
                <div class="col-sm">
                  <p class="mb-0">Zip code :</p>
               </div>
               <div class="col-sm">
                  <input type="text" class="form-control"  name="zipcode" value="{{ $user->details['zipcode'] ?? '' }}">
                </div>
             </div>


            </div>
           <div class="modal-footer">
             <button type="submit" class="btn text-white" style="background-color:#12536d">Submit</button>
           </div>
        
          </div>
       </form>
     </div>
    </div>
   <!--end Modal-->
  </div>
</div>
@stop