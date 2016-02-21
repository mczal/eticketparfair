@extends('layouts.app')

@section('content')

  <a class="btn btn-primary" href={{url('/confirmations/create')}} role="button"><i class="fa fa-plus"></i> Create New</a>
  <div class="box box-solid">
  <div class="box-body">
    <p>
        <form action="{{ url('/confirmations') }}" method="get">
            <div class="input-group">
              <select class="form-control" name="status">
                <option value="-1">Semua</option>
                <option value="0">Belum divalidasi</option>
                <option value="1">Sudah tervalidasi</option>
              </select>
                <span class="input-group-btn">
                    <button class="btn btn-info btn-flat" type="submit"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
    </p>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Validate</th>
        <th>order_id</th>
        <th>no_rekening</th>
        <th>nama_bank</th>
        <th>total_transfer</th>
        <th>created_at</th>
        <th>updated_at</th>
        <th>operation</th>
      </tr>
    </thead>
    @if( count($confirmations) > 0)
      <tbody>
        @foreach($confirmations as $confirmation)
          <tr>
            <td>
              @if ($confirmation->status == 0)
                <form style="display:inline" action="{{url('/confirmations/validate')}}" method="post">
                  {!! csrf_field() !!}
                  <input readOnly type="hidden" type="number" name="id" value="{{ $confirmation->id }}">
                  <button type="submit" class="btn btn-success" onclick="return confirm('All tickets registered will be active !')">Validate</button>
                </form>
              @else
              <button class="btn btn-default" disabled>Valid</button>
              @endif
            </td>
            <td>{{$confirmation->order['name']}}</td>
            <td>{{$confirmation->no_rekening}}</td>
            <td>{{$confirmation->nama_bank}}</td>
            <td>{{number_format($confirmation->total_transfer)}}</td>
            <td>{{$confirmation->created_at}}</td>
            <td>{{$confirmation->updated_at}}</td>
            <td>
              <a href="{{url('/confirmations/'.$confirmation->id)}}" class="btn btn-default"><i class="fa fa-eye"></i></a>
              <a href="{{url('/confirmations/'.$confirmation->id.'/edit')}}" class="btn btn-default"><i class="fa fa-pencil"></i></a>
              <form style="display:inline" action="{{url('/confirmations/'.$confirmation->id)}}" method="post">
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}

                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this item?')"><i class="fa fa-trash-o"></i></button>

              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>
</div>
  {!! $confirmations->render() !!}
@endsection
