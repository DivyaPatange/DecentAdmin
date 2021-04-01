<!DOCTYPE html>
<html lang="en">
<head>
  <title>Decent | Admin | Student Daily Attendance</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body onload="window.print()">

<div class="container">
  <h2 class="text-center">Daily Attendance</h2>
  <p class="text-center"> {{ $date }}</p>            
  <table class="table">
    <thead>
      <tr>
        <th>Student Name</th>
        <th>Regi No</th>
        <th>Roll No.</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
        @foreach($student as $s)
        <tr>
            <td>{{ $s->student_name }}</td>
            <td>{{ $s->regi_no }}</td>
            <td>{{ $s->roll_no }}</td>
            <?php 
                $studAttend = DB::table('attendance_student_lists')->where('student_id', $s->id)->join('student_attendances', 'attendance_student_lists.stud_attendance_id', '=', 'student_attendances.id')
                ->select('student_attendances.attendance_date', 'attendance_student_lists.status')
                ->where('student_attendances.attendance_date', $date)
                ->first();
            ?>
            <td>@if(!empty($studAttend)) {{ $studAttend->status }} @endif</td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>

</body>
</html>
