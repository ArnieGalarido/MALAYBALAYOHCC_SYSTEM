@extends('layouts.app')
@section('content')

<div class="sticky-top text-white" style="background-color:#12536d">
  <div class="input-group">
    <button id="openNav" class="w3-button w3-large" onclick="w3_open()">
      &#9776;
    </button>
    <div class="col"> @include('includes.notification')</div>
    <div class="col-sm-9">
      <h5 class="my-2 mx-3 p-1">Bed Tracker</h5>
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
        <div class="col-sm-10 mb-3" style="color:#12536d">
          <h2>
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-hospital" viewBox="0 0 16 16">
              <path d="M8.5 5.034v1.1l.953-.55.5.867L9 7l.953.55-.5.866-.953-.55v1.1h-1v-1.1l-.953.55-.5-.866L7 7l-.953-.55.5-.866.953.55v-1.1h1ZM13.25 9a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25h-.5ZM13 11.25a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5Zm.25 1.75a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25h-.5Zm-11-4a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5A.25.25 0 0 0 3 9.75v-.5A.25.25 0 0 0 2.75 9h-.5Zm0 2a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25h-.5ZM2 13.25a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5Z" />
              <path d="M5 1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1a1 1 0 0 1 1 1v4h3a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h3V3a1 1 0 0 1 1-1V1Zm2 14h2v-3H7v3Zm3 0h1V3H5v12h1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3Zm0-14H6v1h4V1Zm2 7v7h3V8h-3Zm-8 7V8H1v7h3Z" />
            </svg>
            {{ $hospital->name ?? '' }}
          </h2>
          <h5>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
              <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
              <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
            </svg>
            {{ $hospital->details['address'] ?? '' }}
            @if($hospital->details['main_contact'] != null)
            - {{ $hospital->details['main_contact'] ?? '' }}
            @endif
          </h5>

          @if($hospital->details['er_contact'] != null )
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
            ER - {{ $hospital->details['er_contact'] ?? '' }}
          </span>
          @endif
          @if($hospital->details['lab_contact'] != null)
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
            Lab - {{ $hospital->details['lab_contact'] ?? '' }}
          </span>
          @endif
          @if($hospital->details['dialysis_contact'] != null )
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
            Dialysis - {{ $hospital->details['dialysis_contact'] ?? '' }}
          </span>
          @endif
          @if($hospital->details['triage_contact'] == 'null')
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
            Triage - {{ $hospital->details['triage_contact'] ?? '' }}
          </span>
          @endif
        </div>

        <hr>
        <div class="d-flex justify-content-between py-2 w-100">
          <ul class="nav nav-pills gap-2 font-weight-bold">
            <li class="nav-item" onclick="toggleNav('nav-rooms')">
              <div id="nav-rooms" class="nav-link text-green text-center text-uppercase active">Rooms</div>
            </li>
            <li class="nav-item" onclick="toggleNav('nav-physicians')">
              <div id="nav-physicians" class="nav-link text-green text-center text-uppercase">Physicians</div>
            </li>
          </ul>

          <button id="btn-add-room" type="button" class="btn text-white" data-bs-toggle="modal" data-bs-target="#showModalNewRoom" style="background-color:#12536d;width:120px">
            Add Room
          </button>
          <button id="btn-add-physician" type="button" class="btn text-white d-none" data-bs-toggle="modal" data-bs-target="#showModalNewPhysician" style="background-color:#12536d;width:120px">
            Add Physician
          </button>
        </div>

        <div id="container-rooms" class="col-12">
          <div class="row">
            <!-- /start foreach rooms -->
            @foreach($rooms as $room)
            <div class="col-lg-4">
              <div class="card mb-4" style="background-color:#12536d">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-9 mb-2">
                      <h5 class="text-white">
                        {{ $room->name }}
                      </h5>
                    </div>
                    <div class="col-sm-3 mb-2 d-flex justify-content-end">
                      <div>
                        <a type="button" href="{{ route('bed-tracker.room.edit',['id'=>$room->id, 'code'=>$hospital->code]) }}" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#showModalEditRoom{{ $room->id }}">
                          Edit
                        </a>
                      </div>

                      <form type="submit" action="{{ route('bed-tracker.room.delete',['id'=>$room->id, 'code'=>$hospital->code]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm " id="">
                          Delete
                        </button>
                      </form>
                    </div>
                  </div>

                  <div class="row rounded-3" style="background-color:#e9f6fb;color:#0f4357;">

                    <div class="col-sm-6 my-2 text-center">
                      <label class="fw-bold">Vacant Beds </label>
                      <h4>{{ $room->details['vacant_beds'] }}</h4>
                    </div>
                    <div class="col-sm-6 my-2 text-center">
                      <label class="fw-bold">Total Beds </label>
                      <h4>{{ $room->details['total_beds'] }}</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            <!-- end foreach rooms -->
          </div>

        </div>

        <div id="container-physicians" class="col-12 d-none">
          <div class="row">
            <!-- /start foreach physicians-->
            @foreach($physicians as $physician)
            <div class="col-lg-4">
              <div class="card mb-4" style="background-color:#12536d">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-9 mb-2">
                      <h5 class="text-white">
                        {{ $physician->name }}
                      </h5>
                    </div>
                    <div class="col-sm-3 mb-2 d-flex justify-content-end">
                      <div>
                        <a type="button" href="{{ route('bed-tracker.physician.edit',['id'=>$physician->id, 'code'=>$hospital->code]) }}" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#showModalEditPhysician{{ $physician->id }}">
                          Edit
                        </a>
                      </div>

                      <form type="submit" action="{{ route('bed-tracker.physician.delete',['id'=>$physician->id, 'code'=>$hospital->code]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm " id="">
                          Delete
                        </button>
                      </form>
                    </div>
                  </div>

                  <div class="row rounded-3" style="background-color:#e9f6fb;color:#0f4357;">
                    <div class="col-sm-6 my-2">
                      <h5 class="fw-bold">Specialty </h5>
                      <h6>{{ $physician->details['specialty'] ?? '' }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            <!-- end foreach physicians-->
          </div>

        </div>

        <!-- NEW Room MODAL -->
        <div class="modal fade" id="showModalNewRoom" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <form action="{{ route('bed-tracker.room.store', ['code' => $hospital->code]) }}" method="post">
              @csrf
              <div class="modal-content">
                <div class="modal-header">
                  <!-- <h5 class="modal-title" id="">Edit Room</h5> -->
                  <h5 class="modal-title" id="">New Room</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                  <div class="row">
                    <div class="form-group required col mb-2">
                      <label for="" class="form-label">Room Name :</label>
                      <input type="text" class="form-control" name="name" placeholder="Please input " required>
                    </div>

                  </div>
                  <div class="row">
                    <div class="form-group required col mb-2">
                      <label for="" class="form-label">Total number of beds :</label>
                      <input type="text" class="form-control" name="total_beds" placeholder="Please input " required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group required col mb-2">
                      <label for="" class="form-label">Vacant number of beds :</label>
                      <input type="text" class="form-control" name="vacant_beds" placeholder="Please input " required>
                    </div>
                  </div>


                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- end of modal -->
        @foreach ($rooms as $room)
        <!-- Edit Room MODAL -->
        <div class="modal fade" id="showModalEditRoom{{ $room->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <form method="POST" action="{{ route('bed-tracker.room.update',['id'=>$room->id, 'code'=>$hospital->code]) }}">
              @method('PUT')
              @csrf
              <div class="modal-content">
                <div class="modal-header">

                  <h5 class="modal-title" id="">Edit Room</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                  <div class="row">
                    <div class="form-group required col mb-2">
                      <label for="" class="form-label">Room Name :</label>
                      <input type="text" class="form-control" name="name" value="{{ $room->name ?? '' }}" placeholder="Please input " required>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col mb-2">
                      <label for="" class="form-label">Total number of beds :</label>
                      <input type="text" class="form-control" name="total_beds" value="{{ $room->details['total_beds'] ?? '' }}" placeholder="Please input " required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group required col mb-2">
                      <label for="" class="form-label">Vacant number of beds :</label>
                      <input type="text" class="form-control" name="vacant_beds" value="{{ $room->details['vacant_beds'] ?? '' }}" placeholder="Please input " required>
                    </div>
                  </div>


                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        @endforeach
        <!-- end of modal -->

        <!-- NEW Physician MODAL -->
        <div class="modal fade" id="showModalNewPhysician" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-md">
            <form action="{{ route('bed-tracker.physician.store', ['code' => $hospital->code]) }}" method="post">
              @csrf
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="">New Physician</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                  <div class="row">
                    <div class="col-12 form-group required mb-2">
                      <label for="" class="form-label">Physician Name :</label>
                      <input type="text" class="form-control" name="name" placeholder="Please input " required>
                    </div>

                    <div class="col-12 form-group required mb-2">
                      <label class="form-label">Specialty : <small>press enter for mupltiple specialty</small></label>
                      <textarea class="form-control" name="specialty" rows="5" placeholder="New line for multiple specialty" required></textarea>
                    </div>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- end of modal -->

        @foreach ($physicians as $physician)
        <!-- Edit Physician MODAL -->
        <div class="modal fade" id="showModalEditPhysician{{ $physician->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-md">
            <form method="POST" action="{{ route('bed-tracker.physician.update',['id'=>$physician->id, 'code'=>$hospital->code]) }}">
              @method('PUT')
              @csrf
              <div class="modal-content">
                <div class="modal-header">

                  <h5 class="modal-title" id="">Edit Physician</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                  <div class="row">
                    <div class="col-12 form-group required mb-2">
                      <label for="" class="form-label">Physician Name :</label>
                      <input type="text" class="form-control" name="name" value="{{ $physician->name ?? '' }}" placeholder="Please input " required>
                    </div>

                    <div class="col-12 form-group required mb-2">
                      <label class="form-label">Specialty :</label>
                      <textarea class="form-control" name="specialty" rows="5" placeholder="Please input " style="white-space: pre-wrap;" required>{{ $physician->details['specialty'] ?? '' }}</textarea>
                    </div>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        @endforeach
        <!-- end of modal -->
      </div>
    </div>
  </div>

  @stop
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const active_nav = "<?= $active_nav ?? 'nav-rooms' ?>";
      toggleNav(active_nav);
    });
    

    const toggleNav = (nav) => {
      let nav_room = document.getElementById("nav-rooms");
      let nav_physician = document.getElementById("nav-physicians");

      let add_room = document.getElementById("btn-add-room");
      let add_physician = document.getElementById("btn-add-physician");
      
      let container_room = document.getElementById("container-rooms");
      let container_physician = document.getElementById("container-physicians");

      if (nav === 'nav-rooms') {
        nav_room.classList.add('active');
        add_room.classList.remove('d-none');
        container_room.classList.remove('d-none');

        nav_physician.classList.remove('active');
        add_physician.classList.add('d-none');
        container_physician.classList.add('d-none');
      } else {
        nav_room.classList.remove('active');
        add_room.classList.add('d-none');
        container_room.classList.add('d-none');

        nav_physician.classList.add('active');
        add_physician.classList.remove('d-none');
        container_physician.classList.remove('d-none');
      }
    }
  </script>