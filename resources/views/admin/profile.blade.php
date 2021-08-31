@extends('layouts.admin')

@section('content')
<div class="container mt-4 mb-4 home">
    <div class="row">
        <div class="col mb-1">
            <h4><i class='far fa-user'></i> | Your Profile</h4>
        </div>
        <div class='col-sm-12 mt-2'>

            <div class='shadow-sm rounded bg-white p-3 mb-2'>
                <form class='row d-flex align-items-center'>
                    <div class='col-sm-12'>
                        <h5>Update your profile settings</h5>
                        <hr>
                    </div>
                    <div class='col-sm-6 mb-2'>
                        <label>First Name</label>
                        <input type='text' name='firstname' class='form-control' placeholder="First Name" value='{{\Auth::user()->firstname}}' required>
                    </div>
                    <div class='col-sm-6 mb-2'>
                        <label>Last Name</label>
                        <input type='text' name='lastname' class='form-control' placeholder="Last Name" value='{{\Auth::user()->lastname}}' required>
                    </div>
                    <div class='col-sm-6 mb-2'>
                        <label>Email Address</label>
                        <input type='email' name='email' class='form-control' placeholder="Email Address" value='{{\Auth::user()->email}}'  required>
                    </div>
                    <div class='col-sm-6 mb-2'>
                        <label>Current Password</label>
                        <input type='password' name='password' class='form-control' placeholder="Current Password" required>
                    </div>
                    <div class='col-sm-6 mb-2'>
                        <label>New Password</label>
                        <input type='password' name='new_password' class='form-control' placeholder="New Password" required>
                    </div>
                    <div class='col-sm-6 mb-2'>
                        <label>Confirm New Password</label>
                        <input type='password' name='confirm_new_password' class='form-control' placeholder="Confirm new password" required>
                    </div>
                    <div class='col text-right'>
                        <button class='btn btn-primary shadow'><i class='fas fa-trash'></i> Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="countyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 1px solid rgb(200,200,200);">
                <h5 class="modal-title" id="exampleModalLabel">Add County</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="border-bottom: 1px solid rgb(200,200,200);">
                <form action="{{url('admin/county/add')}}" method="POST">
                    @csrf
                    <div class="form-group sacco">
                        <input type="hidden" name="id" class="form-control" value="0">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="County Name" autocomplete="off"/>
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
        $('.btn-submit').click(function(){
            $('#countyModal form').submit();
        });
    });
</script>
@endpush
