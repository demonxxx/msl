@extends('templates.admin')
@section('content')
@include('partials.flash')
<link href="{{ asset("theme/css/plugins/jsTree/style.css") }}" rel="stylesheet">
<script src="{{ asset("theme/js/plugins/jsTree/jstree.js") }}"></script>

<div id="container">
    @foreach($cities as $city)
    <ul>
        <li>
            {{$city->name}}<span style="margin-left: 5px; color: blue;">Edit</span>&nbsp;<span style="margin-left: 5px; color: blue;">Delete</span>
            <ul>
                @foreach($city->districts as $district)
                <li>{{$district->name}}<span style="margin-left: 5px; color: blue;">Edit</span>&nbsp;<span style="margin-left: 5px; color: blue;">Delete</span>
                    @endforeach
                    <ul>
                        @foreach($district->wards as $ward)
                        <li>{{$ward->name}}<span style="margin-left: 5px; color: blue;">Edit</span>&nbsp;<span style="margin-left: 5px; color: blue;">Delete</span></li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
    @endforeach
</div>
<script>
$(function () {
    $('#container').jstree();
});
</script>
@endsection