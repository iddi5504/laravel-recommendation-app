@extends('layouts.app')

@section('dashbord-content')

@include('partials.recommendation-form', [
'method'=> 'POST',
'title' => 'Create Recommendation',
])


<script>
    let fileImage = ''

    function handleImage(event) {
        console.log(event)
    }

</script>
@endsection
