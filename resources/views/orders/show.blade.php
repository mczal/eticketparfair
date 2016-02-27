@extends('layouts.app')

@section('title', 'Order Detail #' . $order->no_order)
@section('header', 'Order Detail')
@section('subheader', '#' . $order->no_order)

@section('content')
    <p>
        <a href="{{ url('/orders/create' ) }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create New</a>
        <a href="{{ url('/orders' ) }}" class="btn btn-success"><i class="fa fa-bars"></i> View List</a>
    </p>
    <div class="box box-solid">
        <div class="box-header">
            <h3 class="box-title">General</h3>
        </div>
        <div class="box-body text-left">
            <div class="container">
                <!-- Type ID -->
                <div class="row">
                    <div class="form-group">
                        <label for="order-id_type" class="col-sm-2 control-label">Type ID</label>

                        <div class="col-sm-6">
                            {{ App\Order::getIdTypeList($order->id_type) }}
                        </div>
                    </div>
                </div>

                <!-- ID Number -->
                <div class="row">
                    <div class="form-group">
                        <label for="order-id_no" class="col-sm-2 control-label">ID Number</label>

                        <div class="col-sm-6">
                            {{ $order->id_no }}
                        </div>
                    </div>
                </div>

                <!-- TICKET TYPE -->
                <div class="row">
                    <div class="form-group">
                        <label for="order-type_id" class="col-sm-2 control-label">Ticket Type</label>

                        <div class="col-sm-6">
                            {{ $order->type != null ? $order->type->name : '' }}
                        </div>
                    </div>
                </div>

                <!-- Quantity -->
                <div class="row">
                    <div class="form-group">
                        <label for="order-quantity" class="col-sm-2 control-label">Quantity</label>

                        <div class="col-sm-6">
                            {{ $order->quantity }} PCS
                        </div>
                    </div>
                </div>

                <!-- Total -->
                <div class="row">
                    <div class="form-group">
                        <label for="order-total" class="col-sm-2 control-label">Total</label>

                        <div class="col-sm-6">
                            {{ number_format($order->total_price) }}
                        </div>
                    </div>
                </div>

                <!-- Name -->
                <div class="row">
                    <div class="form-group">
                        <label for="order-name" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-6">
                            {{ $order->name }}
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div class="row">
                    <div class="form-group">
                        <label for="order-address" class="col-sm-2 control-label">Address</label>

                        <div class="col-sm-6">
                            {{ $order->address }}
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="row">
                    <div class="form-group">
                        <label for="order-email" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-6">
                            {{ $order->email }}
                        </div>
                    </div>
                </div>

                <!-- Handphone -->
                <div class="row">
                    <div class="form-group">
                        <label for="order-handphone" class="col-sm-2 control-label">Handphone</label>

                        <div class="col-sm-6">
                            {{ $order->handphone }}
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="row">
                    <div class="form-group">
                        <label for="order-status" class="col-sm-2 control-label">Status</label>

                        <div class="col-sm-6">
                            {{ App\Order::getStatusList($order->status) }}
                        </div>
                    </div>
                </div>

                <!-- Control -->
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-2">
                            <form action="{{ url('/orders/' . $order->id) }}" method="post" style="display: inline">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}

                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this item?')"><i class="fa fa-trash-o"></i> Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($order->status == App\Order::STATUS_PAID)
    <div class="box box-solid">
        <div class="box-header">
            <h3 class="box-title">Tickets</h3>
        </div>
        <div class="box-body text-left">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th width="200px">Code</th>
                                    <th width="300px">Signature</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{--*/ $i = 1 /*--}}
                                @foreach($order->tickets as $ticket)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $ticket->unique_code }}</td>
                                        <td>{{ strtoupper($ticket->generateBarcode()) }}</td>
                                        <td>
                                            <a href="{{ url('/tickets/print/' . $ticket->id) }}" target="_blank"><span class="fa fa-print"></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
