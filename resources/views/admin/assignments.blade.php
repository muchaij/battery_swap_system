@extends('layouts.admin')

@section('content')

<div class="container home">
    <div class="row d-flex align-items-center">
        <div class='col-sm-6 col-md-8'>
            <h5><i class='fas fa-handshake'></i> Assignments</h5>
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
            <div class='text-right mt-1'>
                <button class='btn btn-primary btn-modal' data-toggle='modal' data-target='#assignmentModal'><i class='fas fa-plus'></i> &nbsp;Add New</button>
            </div>
            <hr>
            <div class="table-responsive">
                <table class='table w-100'>
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Battery</th>
                        <th>Station</th>
                        <th>Status</th>
                        <th>Pickup Level</th>
                        <th>Return Level</th>
                        <th>Date</th>
                        <th class='text-right'>Action</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="assignmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 1px solid rgb(200,200,200);">
                <h5 class="modal-title" id="exampleModalLabel">Add/Edit Assignment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="border-bottom: 1px solid rgb(200,200,200);">
                <form action="{{url('admin/assignments/add')}}" method="POST" class="row">
                    @csrf
                    <div class="col-sm-6 form-group sacco">
                        <input type="hidden" name="id" class="form-control" value="0">
                        <input type="hidden" name="user_id" class="form-control" value="0">
                        <input type="hidden" name="battery_id" class="form-control" value="0">
                        <input type="hidden" name="station_id" class="form-control" value="0">
                        <label>User:</label>
                        <input type="text" name="name" class="form-control" placeholder="Name" autocomplete="off"/>
                        <div class='list-group users'>
                            <span class='list-group-item'><i class="fas fa-spinner fa-spin"></i> Loading...</span>
                        </div>
                    </div>
                    <div class="col-sm-6 form-group sacco">
                        <label>Battery:</label>
                        <input type="text" name="model" class="form-control" placeholder="Model" autocomplete="off"/>
                        <div class='list-group model'>
                            <span class='list-group-item'><i class="fas fa-spinner fa-spin"></i> Loading...</span>
                        </div>
                    </div>

                    <div class="col-sm-6 form-group sacco">
                        <label>Pickup Station</label>
                        <input type="text" name="station" class="form-control" placeholder="Station" autocomplete="off"/>
                        <div class='list-group stations'>
                            <span class='list-group-item'><i class="fas fa-spinner fa-spin"></i> Loading...</span>
                        </div>
                    </div>

                    <div class="col-sm-6 form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value='0'>Assign</option>
                            <option value='1'>Mark Returned</option>
                        </select>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label>Pickup  Level(%)</label>
                        <input type="number" name="p_level" class="form-control" placeholder="Pickup Level" min="1" max="100" value="100"/>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label>Return Level(%)</label>
                        <input type="number" name="r_level" class="form-control" placeholder="Totals" min="1" max="100" value="0"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer pt-2 pb-2">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-submit">Save changes</button>
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
                        url: "{{ url('admin/datatables/assignments') }}",
                        data: function (d) {
                                d.search = $('input[name=search]').val();
                            }
                        },
                columns: [
                    {data: "user", name: "user", orderable: false},
                    {data: "email", name: "email"},
                    {data: "battery", name: "battery"},
                    {data: "station", name: "station"},
                    {data: "status", name: "status"},
                    {data: "pickup_level", name: "pickup_level"},
                    {data: "return_level", name: "return_level"},
                    {data: "created_at", name: "created_at"},
                    {data: "action", name: "action", orderable: false},
                    /*{data: "mydate", name: "date", orderable: false},*/
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
