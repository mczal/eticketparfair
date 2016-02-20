@extends('layouts.app')

@section('title', 'Orders')
@section('header', 'Orders')
@section('subheader', 'Orders List')

@section('content')
    <p>
        <a href="{{ url('/orders/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create new</a>
    </p>
    <div class="box box-solid">
        <div class="box-body">
            @include('commons.success')
            <p>
                <form action="{{ url('/orders') }}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" value="{{ $keyword }}" id="keyword" placeholder="Enter no order to search ....">
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-flat" type="submit"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </p>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>no_order</th>
                        <th>name</th>
                        <th>tgl_order</th>
                        <th>status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($orders) == 0)
                        <tr>
                            <td colspan="5" align="center">No data found ...</td>
                        </tr>
                    @else
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->no_order }}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ date('d M Y H:i:s', strtotime($order->created_at)) }}</td>
                                <td>{{ App\Order::getStatusList($order->status) }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
