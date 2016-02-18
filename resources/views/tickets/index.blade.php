@extends('layouts.app')

@section('content')
  <a class="btn btn-primary" href={{url('/tickets/create')}} role="button"><i class="fa fa-plus"></i>  Create New</a>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>id</th>
        <th>unique_code</th>
        <th>order_id</th>
        <th>type_id</th>
        <th>order_date</th>
        <th>active_date</th>
        <th>check_in_date</th>
        <th>operation</th>
      </tr>
    </thead>
    @if ( count($tickets) > 0 )
    <tbody>
      @foreach($tickets as $ticket)
          <tr>
            <td>{{$ticket->id}}</td>
            <td>{{$ticket->unique_code}}</td>
            <td>{{$ticket->order_id}}</td>
            <td>{{$ticket->type_id}}</td>
            <td>{{$ticket->order_date}}</td>
            <td>{{$ticket->active_date}}</td>
            <td>{{$ticket->check_in_date}}</td>
            <!--view edit delete-->
            <td>
              <a href="{{url('/tickets/'.$ticket->id)}}" class="btn btn-default"><i class="fa fa-eye"></i></a>
              <a href="{{url('/tickets/'.$ticket->id.'/edit')}}" class="btn btn-default"><i class="fa fa-pencil"></i></a>
              <form action="{{ url('/tickets/'.$ticket->id.'') }}" method="post" style="display:inline">
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
@endsection
