@extends('layouts.app')

@section('content')
  <a class="btn btn-primary" href={{url('/confirmations/create')}} role="button"><i class="fa fa-plus"></i> Create New</a>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Id</th>
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
            <td>{{$confirmation->id}}</td>
            <td>{{$confirmation->order_id}}</td>
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
  {!! $confirmations->render() !!}
@endsection
