@extends('layouts.admin')

@section('content')

<div class="container home">
    <div class="row">
        <div class='col-sm-12'>
            <h5><i class='fas fa-th-list'></i> Dashboard</h5>
        </div>
        <div class="col-sm-4 p-2">
            <div class='card border h-100'>
                <div class='card-body'>
                    <h5>Batteries</h5>
                    <span style='font-size: 2em;'>{{number_format($batteries,0)}}</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4 p-2">
            <div class='card border h-100'>
                <div class='card-body'>
                    <h5>Batteries In Use</h5>
                    <span style='font-size: 2em;'>{{number_format($batteries_in_use,0)}}</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4 p-2">
            <div class='card border h-100'>
                <div class='card-body'>
                    <h5>Drivers</h5>
                    <span style='font-size: 2em;'>{{number_format($drivers,0)}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-12">

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
                    dom: 'lrtip',
                    ajax: //"{{ url('datatables/users') }}",
                        {
                        url: "{{ url('admin/datatables/packages') }}",
                        data: function (d) {
                                d.search = $('input[name=search]').val();
                            }
                        },
                columns: [
                    {data: "id", name: "id", orderable: false},
                    {data: "customer", name: "customer", orderable: false},
                    {data: "driver", name: "driver", orderable: false},
                    {data: "name", name: "name", orderable: false},
                    {data: "route", name: "route", orderable: false},
                    {data: "status", name: "status", orderable: false},
                    {data: "amount", name: "amount", orderable: false},
                    {data: "transid", name: "transid", orderable: false},
                    {data: "paid", name: "paid", orderable: false},
                    {data: "distance", name: "distance", orderable: false},
                    {data: "created_at", name: "created_at", orderable: false},
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
