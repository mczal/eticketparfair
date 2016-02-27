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
                        <th>No Order</th>
                        <th>Name</th>
                        <th>Tgl Order</th>
                        <th>Status</th>
                        <th>Total</th>
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
                                <td>IDR {{ number_format($order->total_price) }}</td>
                                <td>
                                    <a href="{{ url('/orders/'.$order->id) }}" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                    <form action="{{ url('/orders/'.$order->id.'') }}" method="post" style="display:inline">
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}

                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this item?')"><i class="fa fa-trash-o"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    {!! $orders->appends(['keyword' => $keyword])->links() !!}
@endsection
