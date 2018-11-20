@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Administrator's Page</h1>
        <div class="row">
            <h2>View All Orders</h2>
            <table class="table">
                <tr>
                    <th>order id</th>
                    <th>title</th>
                    <th>item</th>
                    <th>owner</th>
                    <th>taker</th>
                    <th>latitude</th>
                    <th>longitude</th>
                    <th>Completed</th>
                    <th>Confirmed</th>
                    <th>Operations</th>
                </tr>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->title}}</td>
                        <td>{{$order->item}}</td>
                        <td>{{$order->owner}}</td>
                        <td>{{$order->taker}}</td>
                        <td>{{$order->latitude}}</td>
                        <td>{{$order->longitude}}</td>
                        <td>{{$order->completed}}</td>
                        <td>{{$order->confirmed}}</td>
                        <td>
                            <a href="{{route('orders.show', $order->id)}}">View</a>
                            <a href="{{route('orders.edit', $order->id)}}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </table>
            <h2>View All Users</h2>
            <table class="table">
                <tr>
                    <th>user id</th>
                    <th>user name</th>
                    <th>user email</th>
                    <th>provider id</th>
                    <th>user type</th>
                    <th>Operations</th>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->provider_id}}</td>
                        <td>{{$user->type}}</td>
                        <td>
                            <a href="admin/user/{{$user->id}}/orders">View Orders</a>
                        </td>
                    </tr>
                @endforeach
            </table>
    </div>

@endsection