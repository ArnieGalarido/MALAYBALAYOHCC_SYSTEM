@extends('layouts.app')
@section('content')

<div class="sticky-top text-white" style="background-color:#12536d">
 <div class="input-group">
    <button id="openNav" class="w3-button w3-large" onclick="w3_open()">
     &#9776;
    </button> 
    <div class="col"> @include('includes.notification')</div>    <div class="col-sm-9">
    <h5 class="my-2 mx-3 p-1">Users</h5> 
    </div>
      <div class="col-sm-2 my-2">👋🏻Hi, {{Auth::user()->details['firstname'] ?? ''}}</div>
  </div>
</div>

<div class="w3-container">
  <br>
  <div class="row">  
    <div class="col-lg-12">
    @include('includes.flash-message')
     <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-4">
          <!-- ma search email,role,name,contact,hospital,hospital contact -->
          
          <form method="get" action="{{ route('users.index') }}">
          <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="search" aria-label="" name="search" value="{{$search}}">
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
           <button type="button" class="btn dropdown-toggle text-white" data-bs-toggle="dropdown"style="background-color:#12536d">
             Sort by
           </button>
           <ul class="dropdown-menu">
             <li><a class="dropdown-item" href="{{ route('users.index').'?sort=asc&search='.$search }}">Name asc</a></li>
             <li><a class="dropdown-item" href="{{ route('users.index').'?sort=desc&search='.$search }}">Name desc</a></li>
            </ul>
         </div>
       </div>
       <div class="col-sm-2">
          <span class="d-flex flex-row-reverse mb-2">
          <a class="btn text-white" id="" href="{{ route('users.register') }}"style="background-color:#12536d">
           Register User
          </a>
         </span>
       </div>
      </div>

      <div  style="color:#12536d">
      <hr>
        <h3>User list</h3>
      </div>
    
      <div class="card mb-4">
        <div class="card-body" style="background-image: linear-gradient(white,skyblue)" >

         <table class="table" style="background-color:white">
            <thead>
             <tr class="" style="background-color:#12536d; color:white">
                <th scope="col ">Email</th>
                <th scope="col ">Role</th>
                <th scope="col ">Name</th>
                <th scope="col ">Contact Number</th>
                <th scope="col ">Action</th>
             </tr>
            </thead>
          <tbody>
            @foreach($users as $user)
            <tr>
              <td>
                <a  href="{{ route('users.show',['code'=>$user->code]) }}"
                >
                {{$user->email}}
                </a>
              </td>
              <td>{{$user->role}}</td>
              <td>{{$user->name}}</td> 
              <td>{{ $user->details['contact_number'] ?? '-' }}</td>
              <td>
               <div class="input-group input-group-sm ">
                  <!-- <button class="btn text-white btn-sm mx-2 " id="" href="" style="background-color:#12536d">
                    Edit
                  </button> -->

                  <form action="{{ route('users.delete',['code'=>$user->code]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn text-white btn-sm" id="" style="background-color:#12536d">
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
        {{ $users->withQueryString()->links() }}
        </nav>

      </div>
    </div>

   
  </div>
</div>
@stop