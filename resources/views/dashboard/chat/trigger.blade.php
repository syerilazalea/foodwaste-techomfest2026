@extends('dashboard.layouts.app')

@section('content')
<main>
    <div class="container">
        <!-- Title Start -->
        <div class="page-title-container">
            <h1 class="mb-0 pb-0 display-4" id="title">Start a Chat</h1>
        </div>
        <!-- Title End -->

        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }} (ID: {{ $user->id }})</td>
                                <td>
                                    <a href="{{ route('dashboard.chat.index', ['start_chat' => $user->id]) }}" class="btn btn-primary btn-sm">Start Chat</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
