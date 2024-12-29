<x-mail::message>
<img src="{{asset("images/mlg-logo.png")}}" alt="" style="width: 150px; height: auto;">

# Part-time Instructor Attendance

The instructors present today are:

@foreach ($users as $user)
- Name: {{ $user->first_name }} {{ $user->last_name }}
@endforeach


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
