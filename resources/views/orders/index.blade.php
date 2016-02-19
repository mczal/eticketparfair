@extends('layouts.app')

@section('title', 'Orders');
@section('header', 'Orders');
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
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection
