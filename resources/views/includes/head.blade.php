<title>OHCC</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link rel="shortcut icon" type="image/x-icon" href="Logo.png" />

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!--         
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> -->



<style>
  body {
    font-family: 'Nunito', sans-serif;
  }
</style>
<style>
  .form-group.required .form-label:before {
    content: "*";
    color: red;
  }

  .total-calls {
    background-color: #12536d;
    height: 65px;
    width: 65px;
    border-radius: 50%;
    display: inline-block;
  }

  .circle {

    height: 65px;
    width: 65px;
    border-radius: 50%;
    display: inline-block;
  }
</style>
<script>
  `use strict`

  function refreshTime() {

    const timeDisplay = document.getElementById("time");
    const dateDisplay = document.getElementById("date");
    const date = new Date();

    const dateString = date.toDateString();
    const timeString = date.toLocaleTimeString();

    const formattedString = dateString;

    if (dateDisplay !== null) {
      dateDisplay.textContent = dateString;
    }

    if (timeDisplay !== null) {
      timeDisplay.textContent = timeString;
    }
  }

  setInterval(refreshTime, 1000);
</script>

@vite('resources/js/app.js')