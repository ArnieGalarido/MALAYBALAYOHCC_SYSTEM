<!doctype html>

<html>
<head>
    @include('includes.head')
    <script>
      function w3_open() {
        document.getElementById("app").style.marginLeft = "15%";
        document.getElementById("mySidebar").style.width = "15%";
        document.getElementById("mySidebar").style.display = "";
        // document.getElementById("openNav").style.display = 'none';
      }
      function w3_close() {
        document.getElementById("app").style.marginLeft = "0%";
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("openNav").style.display = "inline-block";
      }
</script>
</head>

<body class="" >
  <div class="mw-100">
      @include('includes.sidenav') 
      
      <div id="app" style="margin-left:15%">
          @yield('content')
      </div>
  </div>
</body>

</html>