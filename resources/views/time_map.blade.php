@extends('layouts.app')

@section('content')

@php 

$startTime = strtotime($latestRecord->clas_time); 
$classDuration = $latestRecord->duration_class * 60;
$totalPeriods = $latestRecord->no_of_period;
$breakTime = $latestRecord->duration_break1 * 60; 

$timeSlots = [];

for ($i = 1; $i <= $totalPeriods; $i++) {
    $endTime = $startTime + $classDuration;
    $timeSlots[] = date("h:i A", $startTime) . " - " . date("h:i A", $endTime);
    $startTime = $endTime;

    if ($i == 5) {
        $startTime += $breakTime;
    }
}

@endphp


<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ url()->previous() }}" class="btn btn-danger text-white text-center col-md-1 mt-5">Back</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Day</th>
                @foreach ($timeSlots as $index => $slot)
                <th scope="col">{{  $slot }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($workingDays as $index => $day)
            <tr>
                <th scope="row">{{ $day }}</th>
                
                <td>Math</td>
                <td>Science</td>
                <td>English</td>
                <td>History</td>
                <td>Geography</td>
                <td>Physics</td>
                <td>Sports</td>
                <td>Tamil</td>
            </tr>
            @endforeach
            
        </tbody>
    </table>


</div>




@endsection