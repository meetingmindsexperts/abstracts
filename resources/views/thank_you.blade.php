@extends('layouts.main')

@section('content')

<div class="text-center">
    <h2>Thank You!</h2>
    <p><i>Email: </i><b>{{ $email }}</b></p>
    <p><i>Paper Number:</i> <b>{{ $paper_number }}</b></p>
    
    <p>Your file has been successfully uploaded. We will review the recording and in case of any adjustments required, you will be notified accordingly.
    </p>
    <p>For any further assistance, please contact us at <a href="mailto:eighc@meetingmindsexperts.com">eighc@meetingmindsexperts.com</a></p>
    
</div>

@endsection