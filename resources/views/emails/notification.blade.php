<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
</head>
<body>
    Dear, {{ $mailData['name'] }},
    
    <p>
        <h2> {{ $mailData['subject'] }} </h2>
    <p>

    
    <p>{!! nl2br(e($mailData['message'] )) !!}</p>

    <br>
    <h3>Meeting Information</h3>
    <p>
        <strong>Title: </strong> {{ $mailData['meeting_title'] }} 
    <p>
    
    <p>
        <strong>Date: </strong> {{ $mailData['meeting_date'] }} 
    <p>

    <p>
        <strong>Time: </strong> {{ $mailData['meeting_time'] }} 
    <p>

    <p>
        <strong>Venue: </strong> {{ $mailData['meeting_venue'] }} 
    <p>

    <br/>
    <p>
       <a href='https://www.e-senate.unaab.edu.ng/'>Online FUNAAB e-Senate</a>
    <p>
</body>
</html>