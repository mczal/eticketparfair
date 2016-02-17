@extends('layouts.app')

@section('title', 'Types')
@section('header', 'Types')
@section('subheader', 'Type List')

@section('content')
    <p>
        <a href="{{ url('/types/create' ) }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create new</a>
    </p>
    <div class="box box-solid">
        <div class="box-body">
            <table class="table table-stripped table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Active</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            {{ $types }}
        </div><!-- /.box-body -->
    </div>
@endsection
