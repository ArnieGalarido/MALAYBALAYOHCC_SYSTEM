<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>One Hospital</title>
    <!-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

</head>
<body>
    <div class="container-fluid">
    <h3 style="">Report list</h3>
    <div class="">
      
      <div class="card mb-4">
      <div class="card-body">
         <table class="table"  style="background-color:white">
            <thead>
            <tr class="" style="background-color:#12536d; color:white">
               <th scope="col">Total Calls Received</th>
               <th scope="col ">Total Patient <br> (Referred to hospitals)</th>
               <th scope="col">Total Calls and Referrals <br> (Hospital to Hospital Referrals)</th>
            </tr>
            </thead>
         <tbody>
            <tr style="font-size:16px">
            <td class="">{{ $total['calls'] }}</td>   
            <td class="">{{ $total['patient'] }}</td>
            <td class="">{{ $total['referral'] }}</td>
          </tr>

         </tbody>

      </table>

      </div>
   </div>

        @include('reports.report-content')
    </div>
</body>
</html>