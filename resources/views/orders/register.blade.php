@extends('layouts.user')

@section('content')

<p style="text-align:center;"><img src="{{asset("/assets/images/tickets.png")}}" width="250" height="auto"></p>
<div class="row">
	<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1"  style="background: rgba(38,38,38,0.8); padding-top:10px; padding-bottom:20px;">
  <p align="center">Input your personal details below</p>
	<form role="form">
  <div class="form-group">
	<div class="col-sm-12">
	    <label for="nama">Name:</label>
     <input type="text" class="form-control" id="nama">
	 </div>
</div>
<div class="form-group">
  <div class="col-sm-12">
  <label for="email">Email:</label>
  <input type="text" class="form-control" id="email">
</div>
  </div>
  <div class="form-group">
	<div class="col-sm-12">
	    <label for="nama">No. ID (KTP, KTM, SIM):</label>
     <input type="text" class="form-control" id="nama">
	 </div>
</div>

<div class="col-sm-12">
<div class="form-group">
  <label for="tiket">Number of tickets:</label>
  <select class="form-control" id="sel1">
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
	<option>5</option>
  </select>
</div>
<div>
<p align="center"><div class="col-sm-12"><label for="tiket sisa" >Number of tickets remaining: </label><label id="first" for="sisa">499</label></div></p>
<div class="col-sm-12">
<a class="btn btn-lg btn-primary pull-right" href="./confirmation.html" role="button">Submit</a>
</div>
</form>
</div>
</div>
</div>

@endsection
