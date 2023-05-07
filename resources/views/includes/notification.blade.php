@if(Auth::user()->role != 'user')
  <Notification :user="{{ Auth::user() }}" />
@endif