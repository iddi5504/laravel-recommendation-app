@extends('layouts.app')

@section('dashbord-content')

@include('partials.recommendation-form', [
'method'=> 'PATCH',
'recommendation' => $recommendation ?? null,
'title' => 'Edit Recommendation',
])


@endsection
