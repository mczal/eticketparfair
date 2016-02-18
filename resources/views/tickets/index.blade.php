@extends('layouts.app')

@section('content')
  <a class="btn btn-primary" href={{url('/tickets/create')}} role="button">Create</a>
  <table class="table">
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
    @if ( count($tickets) > 0 )
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
            <a href={{url('/tickets/'.$ticket->id)}}><i class="fa fa-street-view"></i></a>
            <a href="#"><i class="fa fa-pencil-square-o"></i></a>
            <a href="#"><i class="fa fa-eraser"></i></a>
          </td>
        </tr>
      @endforeach
    @endif
  </table>
@endsection
