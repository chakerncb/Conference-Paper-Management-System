@extends('chair.layouts.app')

@section('content')
<div class="pt-16"> <!-- Account for fixed navbar -->
    @livewire('chair.settings-manager')
</div>
@endsection