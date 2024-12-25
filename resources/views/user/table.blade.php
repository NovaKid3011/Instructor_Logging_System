
@extends('welcome')
@section('user')

<div class="container">
        <p>Please select a letter to view instructors</p>

    <!-- Alphabet Toolbar -->
    <div class="alpha-toolbar">
        <div class="row">
            @foreach (range('A', 'F') as $letter)
            <a href="{{ url('/instructors/letter/' . $letter) }}" class="alpha-link">{{ $letter }}</a>
            @endforeach
        </div>
        <div class="row">
            @foreach (range('G', 'L') as $letter)
            <a href="{{ url('/instructors/letter/' . $letter) }}" class="alpha-link">{{ $letter }}</a>
            @endforeach
        </div>
        <div class="row">
            @foreach (range('M', 'R') as $letter)
            <a href="{{ url('/instructors/letter/' . $letter) }}" class="alpha-link">{{ $letter }}</a>
            @endforeach
        </div>
        <div class="row">
            @foreach (range('S', 'X') as $letter)
            <a href="{{ url('/instructors/letter/' . $letter) }}" class="alpha-link">{{ $letter }}</a>
            @endforeach
        </div>
        <div class="row">
            @foreach (range('Y', 'Z') as $letter)
            <a href="{{ url('/instructors/letter/' . $letter) }}" class="alpha-link">{{ $letter }}</a>
            @endforeach
        </div>
    </div>
</div>

@endsection
