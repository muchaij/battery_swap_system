@extends('layouts.user')

@section('content')
<div class="container home">
    <div class="row">
        <div class='col-sm-6 col-md-8'>
            <h5><i class='fas fa-th-list'></i> Packages</h5>
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
                <table class='table'>
                    <thead>
                        <th>Order No.</th>
                        <th>Name</th>
                        <th>Vehicle</th>
                        <th>Status</th>
                        <th>Distance (Est.)</th>
                        <th>amount</th>
                        <th>MPESA Code</th>
                        <th>Date</th>
                        <th class='text-right'>Action</th>
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
                        url: "{{ url('datatables/packages') }}",
                        data: function (d) {
                                d.search = $('input[name=search]').val();
                            }
                        },
                columns: [
                    {data: "id", name: "id", orderable: false},
                    {data: "name", name: "name", orderable: false},
                    {data: "vehicle", name: "vehicle", orderable: false},
                    {data: "status", name: "status", orderable: false},
                    {data: "distance", name: "distance", orderable: false},
                    {data: "amount", name: "amount", orderable: false},
                    {data: "transid", name: "transid", orderable: false},
                    {data: "created_at", name: "created_at", orderable: false},
                    {data: "action", name: "action", orderable: false},
                    /*{data: "mydate", name: "date", orderable: false},*/
                ]
            });
            $('.search-form').submit(function(e){
                e.preventDefault();
                table.draw();
            });
    });
</script>
    
@endpush