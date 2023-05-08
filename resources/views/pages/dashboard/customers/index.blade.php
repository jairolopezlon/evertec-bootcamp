@extends('layouts.dashboard')


@section('title', 'Dashboard Customer List')
@section('option-content')
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Is Enabled</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->is_enabled ? 'Enabled' : 'Disabled' }}</td>
                    <td>
                        <form method="POST" action="{{ route('users.toggle-enable', $customer->id) }}">
                            @csrf
                            <button type="submit">{{ $customer->is_enabled ? 'Disable' : 'Enable' }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
