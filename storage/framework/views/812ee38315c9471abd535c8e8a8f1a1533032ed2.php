<!doctype html>

<html>
<head>
    <?php echo $__env->make('includes.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
      <?php echo $__env->make('includes.sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
      
      <div id="app" style="margin-left:15%">
          <?php echo $__env->yieldContent('content'); ?>
      </div>
  </div>
</body>

</html><?php /**PATH C:\xampp\htdocs\ohcc_system\resources\views/layouts/app.blade.php ENDPATH**/ ?>