@extends('layouts.user')

@section('content')
<div class='frontpage'>
    <div class = "container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12" style="background: rgba(76,76,76,0.9); padding-bottom:20px;">
                <p style="text-align:center;"><img src="{{ asset('/assets/images/unnamed.png') }}" width="150" height="150"></p>
                <hr style="width:80%">
                <h3 align="center">PARAHYANGAN FAIR</h3>
                <p align="center">is the biggest music and art event of Catholic University of Parahyangan.
                We are here to bring you one of a kind experience by presenting out selected collaborations, indie music performances, and our hand-picked nation-wide vendors.
                Get ready to have the time of your life.</p>
                <p align="center">And let's rebuild
                the ultimate interactive experience!</p>
                <hr style="width:80%">
                <a class="btn btn-primary btn-block" id="second" href="{{ url('/buy') }}" role="button">GET YOUR TICKET!</a>
            </div>
        </div>
    </div>
</div>
@endsection
