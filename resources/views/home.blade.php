@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <?php $user = Auth::user(); ?>
                    @if($user)
                    <p>You are logged in! You are user #{{ $user->id }}. Here's your info:</p>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Attribute</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>NetID</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td>Display Name</td>
                                <td>{{ $user->display_name }}</td>
                            </tr>
                            <tr>
                                <td>First Name</td>
                                <td>{{ $user->firstname }}</td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td>{{ $user->lastname }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>PEA</td>
                                <td>{{ $user->pea or 'none' }}</td>
                            </tr>
                            <tr>
                                <td>Department</td>
                                <td>{{ $user->department or 'none' }}</td>
                            </tr>
                            <tr>
                                <td>Title</td>
                                <td>{{ $user->title or 'none' }}</td>
                            </tr>
                            <tr>
                                <td>College</td>
                                <td>{{ $user->college or 'none' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
