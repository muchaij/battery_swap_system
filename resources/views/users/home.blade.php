@extends('layouts.user')

@section('content')

<div class="container home">
    <div class="row d-flex align-items-center">
        <div class='col-sm-6 col-md-8'>
            <h5><i class='fas fa-battery-three-quarters'></i> My Battery Assignments</h5>
        </div>
        <div class='col-sm-4 text-right'>
            <form class='search-form'>
                <div class='input-group'>
                    <input type='text' name='search' class='form-control' placeholder="Search">
                    <div class='input-group-append'>
                        <button class='btn btn-primary'>
                            <i class='fas fa-search'></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <hr>
            <div class="table-responsive">
                <table class='table w-100'>
                    <thead>
                        <th>Battery</th>
                        <th>Station</th>
                        <th>Status</th>
                        <th>Pickup Level</th>
                        <th>Return Level</th>
                        <th>Date</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(document).ready(function(){
        var table = $('.table').DataTable({
                    processing: true,
                    serverSide: true,
                    oLanguage: {sProcessing: "<i class='fas fa-spinner fa-pulse'></i> Processing..."},
                    dom: 'lBrtip',
                    buttons: [
                    ],
                    ajax: //"{{ url('datatables/users') }}",
                        {
                        url: "{{ url('datatables/assignments') }}",
                        data: function (d) {
                                d.search = $('input[name=search]').val();
                            }
                        },
                columns: [
                    {data: "battery", name: "battery"},
                    {data: "station", name: "station"},
                    {data: "status", name: "status"},
                    {data: "pickup_level", name: "pickup_level"},
                    {data: "return_level", name: "return_level"},
                    {data: "created_at", name: "created_at"},
                ]
            });

            var timer = null;
            /*$('input[name=search]').keyup(function(e){
                clearTimeout(timer);
                timer = setTimeout(function(){
                    table.draw();
                }, 1000);
            });*/

            $('.btn-modal').click(function(){
                $('#assignmentModal input[name=id]').val(0);
                $('#assignmentModal input[name=user_id]').val(0);
                $('#assignmentModal input[name=battery_id]').val(0);
                $('#assignmentModal input[name=station_id]').val(0);
                $('#assignmentModal input[name=name]').val("");
                $('#assignmentModal input[name=model]').val("");
                $('#assignmentModal input[name=station]').val("");
                $('#assignmentModal select[name=status]').val(0);
                $('#assignmentModal input[name=r_level]').val(0);
                $('#assignmentModal select[name=p_level]').val(100);
            });
            $(document).on('click', '.btn-edit', function(){
                var row  = $(this).closest("tr");
                var id = row.find(".id").text();
                var user_id = row.find(".user_id").text();
                var battery_id = row.find(".battery_id").text();
                var station_id = row.find(".station_id").text();
                var name = row.find("td:nth-child(1)").text();
                var model = row.find("td:nth-child(3)").text();
                var station = row.find("td:nth-child(4)").text();
                var status = row.find(".status").text();
                var p_level = row.find("td:nth-child(6)").text();
                var r_level = row.find("td:nth-child(7)").text();
                $('#assignmentModal input[name=id]').val(id);
                $('#assignmentModal input[name=user_id]').val(user_id);
                $('#assignmentModal input[name=battery_id]').val(battery_id);
                $('#assignmentModal input[name=station_id]').val(station_id);
                $('#assignmentModal input[name=name]').val(name);
                $('#assignmentModal input[name=model]').val(model);
                $('#assignmentModal input[name=station]').val(station);
                $('#assignmentModal select[name=status]').val(status);
                $('#assignmentModal input[name=r_level]').val(r_level);
                $('#assignmentModal select[name=p_level]').val(p_level);
                $('#assignmentModal').modal();
            });

            $('.search-form').submit(function(e){
                e.preventDefault();
                table.draw();
            });
            $('.btn-submit').click(function(){
                $('#assignmentModal form').submit();
            });

            $('#assignmentModal input[name=name]').keyup(function(){
                clearTimeout(timer);
                $('.sacco .users').show();
                $('.sacco .users').html("<p class='list-group-item'><i class='fas fa-spinner fa-pulse'></i> Loading...</p>");
                timer = setTimeout(function(){
                    var search = $('#assignmentModal input[name=name]').val();
                    searchUsers(search);
                }, 1000);
            });

            function searchUsers(search){
                $.ajax({
                    url: "{{url('admin/users/search?')}}search="+search,
                    type: 'GET',
                }).done(function(data){
                    var users = JSON.parse(data);
                    $.each(users, function(index, item){
                        $('.sacco .users').html("<a href='"+item.id+"' class='list-group-item text-dark'"
                        +">"+item.firstname+" "+item.lastname+" ("+item.email+")</a>");
                    });
                    $('.sacco .users a').click(function(e){
                        e.preventDefault();
                        $('.sacco .users').hide();
                        var id = $(this).attr('href');
                        var name = $(this).text();
                        $('input[name=user_id]').val(id);
                        $('input[name=name]').val(name);
                    })
                }).fail(function(){
                    $('.sacco .users').html("<p class='list-group-item text-danger'>Error Processing request!</p>");
                });
            }


            $('#assignmentModal input[name=model]').keyup(function(){
                clearTimeout(timer);
                $('.sacco .model').show();
                $('.sacco .model').html("<p class='list-group-item'><i class='fas fa-spinner fa-pulse'></i> Loading...</p>");
                timer = setTimeout(function(){
                    var search = $('#assignmentModal input[name=model]').val();
                    searchModel(search);
                }, 1000);
            });

            function searchModel(search){
                $.ajax({
                    url: "{{url('admin/model/search?')}}search="+search,
                    type: 'GET',
                }).done(function(data){
                    var model = JSON.parse(data);
                    $.each(model, function(index, item){
                        $('.sacco .model').html("<a href='"+item.id+"' class='list-group-item text-dark'"
                        +">"+item.name+" ("+item.model+")</a>");
                    });
                    $('.sacco .model a').click(function(e){
                        e.preventDefault();
                        $('.sacco .model').hide();
                        var id = $(this).attr('href');
                        var name = $(this).text();
                        $('input[name=battery_id]').val(id);
                        $('input[name=model]').val(name);
                    })
                }).fail(function(){
                    $('.sacco .model').html("<p class='list-group-item text-danger'>Error Processing request!</p>");
                });
            }
            $('#assignmentModal input[name=station]').keyup(function(){
                clearTimeout(timer);
                $('.sacco .stations').show();
                $('.sacco .stations').html("<p class='list-group-item'><i class='fas fa-spinner fa-pulse'></i> Loading...</p>");
                timer = setTimeout(function(){
                    var search = $('#assignmentModal input[name=station]').val();
                    searchStations(search);
                }, 1000);
            });

            function searchStations(search){
                $.ajax({
                    url: "{{url('admin/stations/search?')}}search="+search,
                    type: 'GET',
                }).done(function(data){
                    var model = JSON.parse(data);
                    $.each(model, function(index, item){
                        $('.sacco .stations').html("<a href='"+item.id+"' class='list-group-item text-dark'"
                        +">"+item.name+" ("+item.location+")</a>");
                    });
                    $('.sacco .stations a').click(function(e){
                        e.preventDefault();
                        $('.sacco .stations').hide();
                        var id = $(this).attr('href');
                        var name = $(this).text();
                        $('input[name=station_id]').val(id);
                        $('input[name=station]').val(name);
                    })
                }).fail(function(){
                    $('.sacco .stations').html("<p class='list-group-item text-danger'>Error Processing request!</p>");
                });
            }
    });
</script>

@endpush
