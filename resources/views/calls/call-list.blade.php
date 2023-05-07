@extends('layouts.app')
@section('content')
<div class="sticky-top text-white" style="background-color:#12536d">
 <div class="input-group">
    <button id="openNav" class="w3-button w3-large" onclick="w3_open()">
     &#9776;
    </button> 
    <div class="col"> @include('includes.notification')</div>    <div class="col-sm-9">
     <h5 class="my-2 mx-3 p-1">Calls</h5> 
    </div>
    <div class="col-sm-2 my-2">👋🏻Hi, {{Auth::user()->details['firstname'] ?? ''}}</div>
  </div>
</div>
@include('includes.flash-message')
<div class="w3-container">
  <br>
  <div class="row">  
    <div class="col-lg-12">
             
        <div class="row">
          <div class="col-lg-1"></div>
          <div class="col-lg-2">
              <div class="card mb-4"style="background-color:#e9f6fb">
                   <div class="card-body  text-center">
                      <div class="row">
                         <div class="col">
                             <span class="circle" style="background-color:#008000">
                                <h3 class="text-center mx-3 my-3 text-white">{{ $counted['admitted'] }}</h3>
                             </span>
                         </div>  
                         <div class="col"  style="color:#0f4357;">
                           <h5 class="my-2">Admitted</h5>
                         </div>
                     </div>
                 </div>
             </div>    
         </div>

         <div class="col-lg-2">
              <div class="card mb-4" style="background-color:#e9f6fb">
                   <div class="card-body  text-center">
                      <div class="row">
                         <div class="col">
                             <span class="circle" style="background-color:#5c5c8a">
                                <h3 class="text-center mx-3 my-3 text-white">{{ $counted['followup'] }}</h3>
                             </span>
                         </div>  
                         <div class="col" style="color:#0f4357;">
                           <h5 class="my-2">Follow up</h5>
                         </div>
                     </div>
                 </div>
             </div>    
         </div>

         <div class="col-lg-2">
              <div class="card mb-4" style="background-color:#e9f6fb">
                   <div class="card-body  text-center">
                      <div class="row">
                         <div class="col">
                             <span class="circle" style="background-color:red">
                                <h3 class="text-center mx-3 my-3 text-white">{{ $counted['cancelled'] }}</h3>
                             </span>
                         </div>  
                         <div class="col"style="color:#0f4357;">
                           <h5 class="my-2">Cancelled</h5>
                         </div>
                     </div>
                 </div>
             </div>    
         </div>

         <div class="col-lg-2">
              <div class="card mb-4" style="background-color:#e9f6fb">
                   <div class="card-body text-center">
                      <div class="row">
                         <div class="col">
                             <span class="circle" style="background-color:black">
                                <h3 class="text-center mx-3 my-3 text-white">{{ $counted['expires'] }}</h3>
                             </span>
                         </div>  
                         <div class="col"style="color:#0f4357;">
                           <h5 class="my-2">Expires</h5>
                         </div>
                     </div>
                 </div>
             </div>    
         </div>
         <div class="col-lg-2">
              <div class="card mb-4" style="background-color:#e9f6fb">
                   <div class="card-body text-center">
               
                      <span class="circle" style="background-color:blue">
                        <h3 class="text-center mx-3 my-3 text-white">{{ $counted['pending'] }}</h3>
                       </span>
                      
                        <div class="col"style="color:#0f4357;">
                         <h5 class="my-2">Pending</h5>
                        </div>
                     
                 </div>
             </div>    
         </div>
         

        </div>



     <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-4">
        <form method="get" action="{{ route('calls.index') }}">
         <div class="input-group mb-3">
           <!-- ma search ang date ug type -->
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
           <button type="button" class="btn dropdown-toggle text-white" data-bs-toggle="dropdown" style="background-color:#12536d">
             Sort by
           </button>
           <ul class="dropdown-menu">
             <li><a class="dropdown-item" href="{{ route('calls.index').'?sort=asc&search='.$search }}">Date asc</a></li>  
             <li><a class="dropdown-item" href="{{ route('calls.index').'?sort=desc&search='.$search }}">Date desc</a></li>
            </ul>
         </div>
       </div>
       <div class="col-sm-2">
          <span class="d-flex flex-row-reverse mb-2">
          <a type="button" class="btn text-white" data-bs-toggle="modal" data-bs-target="#showModalNewCall" style="background-color:#12536d">
            Add Call
         </a>
         </span>
       </div>

      </div>
      <div  style="color:#12536d">
      <hr>
        <h3>Call list</h3>
      </div>
      <div class="card mb-4">
        <div class="card-body"style="background-image: linear-gradient(white,skyblue)">

         <table class="table" style="background-color:white">
            <thead>
             <tr class=""style="background-color:#12536d; color:white">
                <th scope="col">#</th>
                <th scope="col ">Date-time called</th>
                <th scope="col">Type</th>
                <th scope="col">Action</th>
             </tr>
            </thead>
          <tbody>
             @foreach($calls as $key => $call)
              <tr>
                <td scope="row">{{ $key + 1 }}</td>   
                <td class="">{{ $call->called_at }}</td>
                <td class="">{{ $call->type }}</td>
                <td class="">
                 <div class="input-group input-group-sm ">
                   <a type="button" href="{{ route('calls.edit',['id'=>$call->id]) }}" class="btn text-white mx-2 btn-sm" 
                     data-bs-toggle="modal" 
                     data-bs-target="#showModalEditCall{{ $call->id }}" 
                     style="background-color:#12536d"
                    >
                    Edit
                   </a>
               
                   <form action="{{ route('calls.delete',['id'=>$call->id]) }}" method="POST">
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
        {{ $calls->withQueryString()->links() }}

        </nav>

      </div>


      <!-- ADD CALL MODAL -->
     <div class="modal fade" id="showModalNewCall" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
       <div class="modal-dialog">
       <form class="" method="POST" action="/calls">
        @csrf
         <div class="modal-content">                                                                                                                                                                                                                                                                                                                                                                                                                                                       
           <div class="modal-header">
             <h5 class="modal-title" id="" style="color:#0f4357;">New Call</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
              <form>
                <div class="row">
                 <div class="form-group required col mb-2">  
                   <label for="" class="form-label">Date-time :</label>
                   <input type="datetime-local" class="form-control" name="called_at" required>
                 </div>

                </div>
                <div class="row">
                 <div class="form-group required col mb-2">  
                    <label for="" class="form-label">Status of call :</label>
                     <select name="type" class="form-select" aria-label="" required>
                          <option selected value=''>Select</option>
                          <option value="admitted">Admitted</option>
                          <option value="followup">Follow up</option>
                          <option value="cancelled">Cancelled</option>
                          <option value="expires">Expired</option>
                          <option value="pending">Pending</option>
                          
                      </select>
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


      @foreach ($calls as $call)
      <!-- Edit CALL MODAL -->
     <div class="modal fade" id="showModalEditCall{{ $call->id }}" value="{{ $call->id }}"data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
       <div class="modal-dialog">
       <form method="POST" action="{{ route('calls.update',['id'=>$call->id]) }}">
          @method('PUT')
          @csrf
         <div class="modal-content">                                                                                                                                                                                                                                                                                                                                                                                                                                                       
           <div class="modal-header">
             <h5 class="modal-title" id="" style="color:#0f4357;">Edit Call</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
              <form>
                <div class="row">
                 <div class="form-group required col mb-2">  
                   <label for="" class="form-label">Date-time :</label>
                   <input type="datetime-local" class="form-control" name="called_at" value="{{ $call->called_at }}" required>
                 </div>

                </div>
                <div class="row">
                 <div class="form-group required col mb-2">  
                    <label for="" class="form-label">Status of call :</label>
                     <select name="type" class="form-select" aria-label="" required>
                          <!-- <option selected>Select</option> -->
                          <option {{ $call->type == 'admitted' ? 'selected' : '' }} value="admitted" >Admitted</option>
                          <option {{ $call->type == 'followup' ? 'selected' : '' }} value="followup">Follow up</option>
                          <option {{ $call->type == 'cancelled' ? 'selected' : '' }} value="cancelled">Cancelled</option>
                          <option {{ $call->type == 'expires' ? 'selected' : '' }} value="expires">Expired</option>
                          <option {{ $call->type == 'pending' ? 'selected' : '' }} value="pending">Pending</option>

                      </select>
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
      @endforeach
    </div>
   
  </div>
</div>
@stop