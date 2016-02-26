@extends('layouts.app')

@section('title', 'Tickets')
@section('header', 'Tickets')
@section('subheader', 'Ticket List')

@section('content')
  <p>
      <a class="btn btn-primary" href={{url('/tickets/create')}} role="button"><i class="fa fa-plus"></i>  Create New</a>
  </p>

  <div class="box box-solid">
      <div class="box-body">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Code</th>
                <th>Order</th>
                <th>Type</th>
                <th>Order Date</th>
                <th>Active Date</th>
                <th>Check-in Date</th>
                <th></th>
              </tr>
            </thead>
            @if ( count($tickets) > 0 )
            <tbody>
              @foreach($tickets as $ticket)
                  <tr>
                    <td>{{$ticket->unique_code}}</td>
                    <td>{!! $ticket->order ? ($ticket->order->no_order.'<br>'.$ticket->order->name) : '' !!}</td>
                    <td>{{$ticket->type->name}}</td>
                    <td>{{$ticket->order_date}}</td>
                    <td>{{$ticket->active_date}}</td>
                    <td>{{$ticket->check_in_date}}</td>
                    <!--view edit delete-->
                    <td>
                      <a href="{{url('/tickets/print/'.$ticket->id)}}" class="btn btn-default btn-primary" target="_blank"><i class="fa fa-print"></i></a>
                      <a href="{{url('/tickets/'.$ticket->id)}}" class="btn btn-default"><i class="fa fa-eye"></i></a>
                      <a href="{{url('/tickets/'.$ticket->id.'/edit')}}" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                      <form action="{{ url('/tickets/'.$ticket->id) }}" method="post" style="display:inline">
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
  {!! $tickets->links() !!}
@endsection
