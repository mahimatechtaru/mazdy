@extends('frontend.layouts.master')

@section('content')
<div class="container py-5 text-center">
      <div class="card-title">
                        <span class="title">{{ __('Hospital Wallets') }}</span>
                        </h4>
                    </div>
    <h2>Welcome, {{ auth('provider')->user()->name }} {{ auth('provider')->user()->last_name }}</h2>
    <h4 class="mt-4 text-muted">Work in progress 🚧</h4>

    <form action="{{ route('providers.logout') }}" method="POST" class="mt-5">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
</div>
@endsection
