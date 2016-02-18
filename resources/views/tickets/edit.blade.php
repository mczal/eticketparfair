@extends('layouts.app')

@section('content')
<p>
    <a href="{{ url('/tickets') }}" class="btn btn-primary"><i class="fa fa-bars"></i> View List</a>
</p>
<div class="box box-solid">
    <div class="box-header">
        <h3 class="box-title">General</h3>
    </div>
    <div class="box-body text-left">
        <form class="form-horizontal" action="{{ url('/tickets/' . $ticket->id) }}" method="post">
            {!! csrf_field() !!}
            {!! method_field('PATCH') !!}

            <!-- Ticket unique code -->
            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                <label for="ticket-code" class="col-sm-1 control-label">Unique Code</label>
                <div class="col-sm-6">
                    <input type="text" name="code" id="ticket-code" class="form-control" value="{{ isset($ticket->unique_code) ? $ticket->unique_code : '' }}">
                    @if ($errors->has('code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('code') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- Type order id -->
            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                <label for="type-price" class="col-sm-1 control-label">Price</label>

                <div class="col-sm-3">
                    <input type="text" name="price" id="type-price" class="form-control" value="{{ isset($type->price) ? $type->price : 0 }} ">
                    @if ($errors->has('price'))
                        <span class="help-block">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- Type Status -->
            <div class="form-group">
                <label for="type-active" class="col-sm-1 control-label">Active</label>
                <div class="col-sm-3">
                    <select class="form-control" name="active">
                        <option value="0"{{ (isset($type->active) && $type->active == 0) ? ' selected' : '' }}>Not Active</option>
                        <option value="1"{{ (isset($type->active) && $type->active == 1) ? ' selected' : '' }}>Active</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 col-sm-offset-1">
                    <button type="submit" name="button" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div><!-- /.box-body -->
</div>
@endsection
