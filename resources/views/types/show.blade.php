@extends('layouts.app')

@section('title', 'Create Type')
@section('header', 'Show Type')

@section('content')
    <p>
        <a href="{{ url('/types' ) }}" class="btn btn-primary"><i class="fa fa-bars"></i> View List</a>
    </p>
    <div class="box box-solid">
        <div class="box-header">
            <h3 class="box-title">General</h3>
        </div>
        <div class="box-body text-left">
            <!-- Type Name -->
            <div class="row">
                <div class="form-group">
                    <label for="type-name" class="col-sm-1 control-label">Name</label>

                    <div class="col-sm-6">
                        {{ $type->name }}
                    </div>
                </div>
            </div>

            <!-- Type Price -->
            <div class="row">
                <div class="form-group">
                    <label for="type-price" class="col-sm-1 control-label">Price</label>

                    <div class="col-sm-3">
                        {{ number_format($type->price) }}
                    </div>
                </div>
            </div>

            <!-- Type Status -->
            <div class="row">
                <div class="form-group">
                    <label for="type-active" class="col-sm-1 control-label">Active</label>
                    <div class="col-sm-3">
                        {{ $type->active == 0 ? 'Not Active' : 'Active' }}
                    </div>
                </div>
            </div>

            <!-- Count Ticket -->
            <div class="row">
                <div class="form-group">
                    <label for="type-active" class="col-sm-1 control-label">Count TIcket</label>
                    <div class="col-sm-3">
                        {{$count}}
                    </div>
                </div>
            </div>

            <!-- Control -->
            <div class="row">
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-1">
                        <a href="{{ url('/types/' . $type->id . '/edit') }}" class="btn btn-default"><i class="fa fa-pencil"></i> Edit</a>
                        <form action="{{ url('/types/' . $type->id) }}" method="post" style="display: inline">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}

                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this item?')"><i class="fa fa-trash-o"></i> Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.box-body -->
    </div>
@endsection
