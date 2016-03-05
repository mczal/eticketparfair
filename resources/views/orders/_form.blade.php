<!-- TICKET TYPE -->
<div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
    <label for="order-type_id" class="col-sm-2 control-label">Ticket Type</label>

    <div class="col-sm-6">
        <select class="form-control" name="type_id" id="order-type_id">
            @foreach($types as $type)
                <option value="{{ $type->id }}"{{ (isset($order) && $order->type_id == $type->id) || old('type_id') == $type->id ? ' selected' : '' }}>{{ $type->name }}</option>
            @endforeach
        </select>

        @if ($errors->has('type_id'))
            <span class="help-block">
                <strong>{{ $errors->first('type_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<!-- Name -->
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="order-name" class="col-sm-2 control-label">Name</label>

    <div class="col-sm-6">
        <input type="text" name="name" id="order-name" class="form-control" value="{{ isset($order->name) ? $order->name : old('name') }}">
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<!-- Email -->
<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="order-email" class="col-sm-2 control-label">Email</label>

    <div class="col-sm-6">
        <input type="email" name="email" id="order-email" class="form-control" value="{{ isset($order->email) ? $order->email : old('email') }}">
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>

<!-- ID Number -->
<div class="form-group{{ $errors->has('id_no') ? ' has-error' : '' }}">
    <label for="order-id_no" class="col-sm-2 control-label">ID Number</label>

    <div class="col-sm-6">
        <input type="text" name="id_no" id="order-id_no" class="form-control" value="{{ isset($order->id_no) ? $order->id_no : old('id_no') }}">
        @if ($errors->has('id_no'))
            <span class="help-block">
                <strong>{{ $errors->first('id_no') }}</strong>
            </span>
        @endif
    </div>
</div>

<!-- Quantity -->
<div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
    <label for="order-quantity" class="col-sm-2 control-label">Quantity</label>

    <div class="col-sm-2">
        <input type="number" name="quantity" id="order-quantity" class="form-control" value="{{ isset($order->quantity) ? $order->quantity : old('quantity') }}">
        @if ($errors->has('quantity'))
            <span class="help-block">
                <strong>{{ $errors->first('quantity') }}</strong>
            </span>
        @endif
    </div>
</div>
