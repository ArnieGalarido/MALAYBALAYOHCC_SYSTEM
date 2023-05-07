@extends('layouts.app')
@section('content')

<div class="sticky-top text-white" style="background-color:#12536d">
 <div class="input-group">
    <button id="openNav" class="w3-button w3-large" onclick="w3_open()">
     &#9776;
    </button> 
    <div class="col"> @include('includes.notification')</div>
    <div class="col-sm-9">
    <h5 class="my-2 mx-3 p-1">Referrals</h5> 
    </div>
      <div class="col-sm-2 my-2">👋🏻Hi, {{Auth::user()->details['firstname'] ?? ''}}</div>
  </div>
</div>

<div class="w3-container">
  <br>
  <div class="row">  
    <div class="col-lg-12">
 
     <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-4">
        <form method="get" action="{{ route('referral-form.index') }}">

         <div class="input-group mb-3">
            <input type="text" class="form-control" name="search" placeholder="search" aria-label="" value="{{$search}}">
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
           <button type="button" class="btn dropdown-toggle text-white text-capitalize" data-bs-toggle="dropdown" style="background-color:#12536d">
             {{ $status ?? "All Status" }}
           </button>
           <ul class="dropdown-menu">
             <li><a class="dropdown-item" href="{{ route('referral-form.index').'?status&search='.$search }}">All Status</a></li>
             <li><a class="dropdown-item" href="{{ route('referral-form.index').'?status=admitted&search='.$search }}">Admitted</a></li>
             <li><a class="dropdown-item" href="{{ route('referral-form.index').'?status=followup&search='.$search }}">Followup</a></li>
             <li><a class="dropdown-item" href="{{ route('referral-form.index').'?status=cancelled&search='.$search }}">Cancelled</a></li>
             <li><a class="dropdown-item" href="{{ route('referral-form.index').'?status=expired&search='.$search }}">Expired</a></li>
             <li><a class="dropdown-item" href="{{ route('referral-form.index').'?status=pending&search='.$search }}">Pending</a></li>

            </ul>
         </div>
       </div>
       <div class="col-sm-2">
          <span class="d-flex flex-row-reverse mb-2">
          <a class="btn text-white" id="" href="{{ route('referral-form.create') }}" style="background-color:#12536d">
            Fill Referral Form
          </a>
         </span>
       </div>
      </div>

      <div  style="color:#12536d">
       <hr>
        <h3>Referral list</h3>
      </div>

      <div class="card mb-4">
        <div class="card-body" style="background-image: linear-gradient(white,skyblue)">

         <table class="table"  style="background-color:white">
            <thead>
             <tr class=""style="background-color:#12536d; color:white">
 
                <th scope="col ">Date-time</th>
                <th scope="col">Patient's Name</th>
                <th scope="col">Reffering hospital</th>
                <th scope="col">Reffered hospital</th>
                <th scope="col">Status</th>
                <!-- <th scope="col">Contact Number</th> -->
                <th scope="col">Action</th>
             </tr>
            </thead>
          <tbody>
           @foreach($referrals as $referral)
            <tr>
              <td>{{ $referral->details['referral_date'] ?? '-' }}</td>
              <td><a href="{{ route('referral-form.show',['code'=>$referral->code]) }}">{{ $referral->patient['name'] ?? '-' }}</a></td>
              <td>{{ $referral->referring_hospital->name ?? '-' }}</td>
              <td>{{ $referral->referred_hospital->name ?? '-' }}</td>
              <td>{{ $referral->details['call_status'] ?? '-' }}</td>
              <!-- <td>{{ $referral->details['contact_no'] ?? '-' }}</td> -->
              <td>
               <div class="input-group input-group-sm ">
                  <a type="button" class="btn text-white mx-2 btn-sm"
                   style="background-color:#12536d"
                   href="{{ route('referral-form.edit',['code'=>$referral->code]) }}"
                   >
                    Edit
                  </a>
                  <form action="{{ route('referral-form.delete',['code'=>$referral->code]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                   <button class="btn text-white btn-sm" id="" href="" style="background-color:#12536d">
                     Delete
                   </button>
                  </form>   
                </div>
            </td> 
           </tr>
              @endforeach

          </tbody>

        </table>
   
        <nav class="d-flex flex-row-reverse">
        {{ $referrals->withQueryString()->links() }}
        </nav>
      </div>
    </div>

   
  </div>
</div>
@stop