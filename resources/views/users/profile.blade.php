@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 mb-1">
            <h4><i class='far fa-user'></i> Profile</h4>
            <hr>
        </div>

        <form class='row' action='{{url("profile/change")}}' method='POST'>
            @csrf
            <div class='col-sm-6 mb-2'>
                <label>First Name:</label>
                <input type='text' name='firstname' class='form-control' placeholder="First Name" value='{{\Auth::user()->firstname}}' required>
            </div>
            <div class='col-sm-6 mb-2'>
                <label>Last Name:</label>
                <input type='text' name='lastname' class='form-control' placeholder="First Name" value='{{\Auth::user()->lastname}}' required>
            </div>
            <div class='col-sm-6 mb-2'>
                <label>Email Address:</label>
                <input type='email' name='email' class='form-control' placeholder="Email Address" value='{{\Auth::user()->email}}' readonly>
            </div>
            <div class='col-sm-6 mb-2'>
                <label>Current Password:</label>
                <input type='password' name='password' class='form-control' placeholder="Current Password" required>
            </div>
            <div class='col-sm-6 mb-2'>
                <label>New Password:</label>
                <input type='password' name='new_password' class='form-control' placeholder="New Password">
            </div>
            <div class='col-sm-6 mb-2'>
                <label>Confirm New Password:</label>
                <input type='password' name='confirm_password' class='form-control' placeholder="Confirm New Password">
            </div>
            <div class='col-sm-12 text-right'>
                <button class='btn btn-primary'>
                    <span>Update profile</span> <i class='fas fa-arrow-right pl-2'></i>
                </button>
            </div>
        </form>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pay Via MPESA STK PUSH</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary pay_button">Proceed</button>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
<script>
    $(document).ready(function(){
        $('.pay_button').click(function(){
            $(this).attr('disabled', 'disabled');
            $(this).html('<i class="fas fa-spinner fa-pulse"></i> Waiting...');
            var formData = $('#paymentModal form').serialize();
            $.ajax({
                url: "{{url('api/stk/push')}}",
                type: 'POST',
                data: formData,
            }).done(function(){
                $('.pay_button').removeAttr('disabled');
                $('.pay_button').html('Proceed');
                alert('Once Paid refresh to see changes');
            }).fail(function(){
                alert('Oops! Something went wrong!');
            });
        });
    });
</script>
@endpush
