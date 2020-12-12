@extends('emails.layout')


@section('title')
	{{ $title }}
@endsection

@section('content')

<h1>@yield('title')</h1>
<br>
<p>
	Έχουμε λάβει το αίτημά σας για εκτίμηση κόστους μετακόμισης. Θα επικοινωνήσουμε μαζί σας το συντομότερο δυνατόν.<br>
	Ευχαριστούμε!
</p>

@endsection
