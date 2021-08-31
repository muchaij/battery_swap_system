@extends('layouts.admin')

@section('content')

<div class="container home">
    <div class="row d-flex align-items-center">
        <div class='col-sm-6 col-md-8'>
            <h5><i class='fas fa-battery-three-quarters'></i> Batteries</h5>
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
                <button class='btn btn-primary btn-modal' data-toggle='modal' data-target='#batteryModal'><i class='fas fa-plus'></i> &nbsp;Add New</button>
            </div>
            <hr>
            <div class="table-responsive">
                <table class='table w-100'>
                    <thead>
                        <th>Name</th>
                        <th>Model</th>
                        <th>Totals</th>
                        <th>In Use</th>
                        <th>Date</th>
                        <th class='text-right'>Action</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="batteryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 1px solid rgb(200,200,200);">
                <h5 class="modal-title" id="exampleModalLabel">Add/Edit Batteries</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="border-bottom: 1px solid rgb(200,200,200);">
                <form action="{{url('admin/batteries/add')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="id" class="form-control" value="0">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control" placeholder="Name" autocomplete="off"/>
                    </div>
                    <div class="form-group">
                        <label>Model Name:</label>
                        <input type="text" name="model" class="form-control" placeholder="Model" autocomplete="off"/>
                    </div>
                    <div class="form-group">
                        <label>Total Batteries</label>
                        <input type="number" name="totals" class="form-control" placeholder="Totals" min="0"/>
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
                        url: "{{ url('admin/datatables/batteries') }}",
                        data: function (d) {
                                d.search = $('input[name=search]').val();
                            }
                        },
                columns: [
                    {data: "name", name: "name"},
                    {data: "model", name: "model"},
                    {data: "number", name: "number"},
                    {data: "in_use", name: "in_use"},
                    {data: "created_at", name: "created_at"},
                    {data: "action", name: "action", orderable: false},
                    /*{data: "mydate", name: "date", orderable: false},*/
                ]
            });
            /*var timer = null;
            $('input[name=search]').keyup(function(e){
                clearTimeout(timer);
                timer = setTimeout(function(){
                    table.draw();
                }, 1000);
            });*/
            $('.search-form').submit(function(e){
                e.preventDefault();
                table.draw();
            });
            $('.btn-submit').click(function(){
                $('#batteryModal form').submit();
            });
            $('.btn-modal').click(function(){
                $('#batteryModal input[name=id]').val(0);
                $('#batteryModal input[name=name]').val("");
                $('#batteryModal input[name=model]').val("");
                $('#batteryModal input[name=totals]').val("");
            });

            $(document).on('click', '.btn-edit', function(){
                var row = $(this).closest('tr');
                var id = row.find(".id").text();
                var name = row.find("td:nth-child(1)").text();
                var model = row.find("td:nth-child(2)").text();
                var number = row.find("td:nth-child(3)").text();
                $('#batteryModal input[name=id]').val(id);
                $('#batteryModal input[name=name]').val(name);
                $('#batteryModal input[name=model]').val(model);
                $('#batteryModal input[name=totals]').val(number);

                $('#batteryModal').modal();
            });
    });
</script>

@endpush
