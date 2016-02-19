<!-- Name -->
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="order-name" class="col-sm-2 control-label">Name</label>

    <div class="col-sm-6">
        <input type="text" name="name" id="order-name" class="form-control" value="{{ isset($order->name) ? $order->name : '' }}">
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<!-- Address -->
<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
    <label for="order-address" class="col-sm-2 control-label">Address</label>

    <div class="col-sm-6">
        <textarea name="name" id="order-address" class="form-control" value="{{ isset($order->address) ? $order->address : '' }}"></textarea>
        @if ($errors->has('address'))
            <span class="help-block">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
        @endif
    </div>
</div>

<!-- Email -->
<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="order-email" class="col-sm-2 control-label">Email</label>

    <div class="col-sm-6">
        <input type="email" name="email" id="order-email" class="form-control" value="{{ isset($order->email) ? $order->email : '' }}">
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>

<!-- ID TYPE -->
<div class="form-group{{ $errors->has('id_type') ? ' has-error' : '' }}">
    <label for="order-id_type" class="col-sm-2 control-label">Type ID</label>

    <div class="col-sm-6">
        <select class="form-control" name="id_type" id="order-id_type">
        <option value="ktp"{{ (isset($order) && $order->id_type == 'ktp') ? ' selected' : '' }}>KTP</option>
            <option value="sim"{{ (isset($order) && $order->id_type == 'sim') ? ' selected' : '' }}>SIM</option>
            <option value="ktm"{{ (isset($order) && $order->id_type == 'ktm') ? ' selected' : '' }}>KTM</option>
            <option value="kartu_pelajar"{{ (isset($order) && $order->id_type == 'kartu_pelajar') ? ' selected' : '' }}>Kartu Pelajar</option>
            <option value="lainnya"{{ (isset($order) && $order->id_type == 'lainnya') ? ' selected' : '' }}>Lainnya</option>
        </select>

        @if ($errors->has('id_type'))
            <span class="help-block">
                <strong>{{ $errors->first('id_type') }}</strong>
            </span>
        @endif
    </div>
</div>

<!-- ID Number -->
<div class="form-group{{ $errors->has('id_no') ? ' has-error' : '' }}">
    <label for="order-id_no" class="col-sm-2 control-label">ID Number</label>

    <div class="col-sm-6">
        <input type="text" name="id_no" id="order-id_no" class="form-control" value="{{ isset($order->id_no) ? $order->id_no : '' }}">
        @if ($errors->has('id_no'))
            <span class="help-block">
                <strong>{{ $errors->first('id_no') }}</strong>
            </span>
        @endif
    </div>
</div>

<!-- Email -->
<div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
    <label for="order-quantity" class="col-sm-2 control-label">Quantity</label>

    <div class="col-sm-2">
        <input type="number" name="quantity" id="order-quantity" class="form-control" value="{{ isset($order->quantity) ? $order->quantity : '' }}">
        @if ($errors->has('quantity'))
            <span class="help-block">
                <strong>{{ $errors->first('quantity') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-sm-2">
        <p class="control-label" style="text-align: left">Max. 3 Tickets</p>
    </div>
</div>
