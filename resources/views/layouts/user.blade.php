<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>User-Luggage Tracking App</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    
    <link href="{{asset('fontawesome/css/all.css')}}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my_styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chat.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span class='text-white'><i class='fas fa-user-shield'></i> User</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mx-auto">
                        @guest
 
                        @else
                            
                        @endguest
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="btn btn-primary mr-3" href="{{ route('login') }}"><i class='fas fa-sign-in-alt'></i> {{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-danger" href="{{ route('register') }}"><i class='fas fa-pen-fancy'></i> {{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('home') }}">
                                    <span class='d-none d-md-block'>
                                        <i class='fas fa-home'></i> {{ __('Dashboard') }}
                                    </span>
                                    <span class='d-block d-md-none'>
                                        <i class='fas fa-home'></i>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('send_package') }}">
                                    <span class='d-none d-sm-block'>
                                        <i class='fas fa-globe'></i> {{ __('Send Package') }}
                                    </span>
                                    <span class='d-block d-sm-none'>
                                        <i class='fas fa-globe'></i>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Hi, {{\Auth::user()->firstname}}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('profile') }}">
                                        Profile
                                    </a>
                                    <a class="dropdown-item border-top" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class='mt-4'>
            @yield('content')
        </main>
    </div>
    
    <button class='btn btn-primary btn-float shadow-lg'>
        <table>
            <tr>
                <td>
                    <i class='fas fa-comments'></i>
                </td>
            </tr>
        </table>
    </button>

    <!-- chat Window -->
    <div class='mychat shadow-lg border'>
        <div class='p-3 border-bottom myheader'>
            <div class='text-center'>
                <h5>Current Drivers</h5>
            </div>
        </div>
        <div class="w-100 messages">
            <p class='text-muted text-center p-4'>
                <i class='fas fa-spinner fa-pulse'></i> Loading...
            </p>
            <!--<div class='chat-body-receive'>
                Hi mkuu? mambo?<br>
                <span class='small'><strong>12-03-2020 3.00 PM</strong> from <strong>John Muchai</strong></span>
            </div>-->
        </div>
        <div class="p-2 border-top">
            <form class='message-form' method='POST' action='{{url("messages/send")}}'>
                @csrf
                <input type='hidden' name='package_id' value='0'>
                <input type='hidden' name='last_id' value='0'>
                <input type='hidden' name='offset' value='0'>
                <input type='hidden' name='rec_id' value='0'>
                <input type='hidden' name='sender_id' value='{{\Auth::user()->id}}'>
                <div class='input-group'>
                    <input class='form-control' name='message' placeholder="Enter Message Here" autocomplete="off" autofocus>
                    <div class='input-group-append'>
                        <button class='btn btn-primary'>
                            <i class='far fa-paper-plane'></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- end of chat -->


    @if (\Session::has('success'))
        <div class="notifications bg-success shadow">
            <p class='text-white text-center'><i class='fas fa-check-circle'></i> {!! \Session::get('success') !!}</p>
        </div>
    @endif
    @if (\Session::has('error'))
        <div class="notifications bg-danger shadow">
            <p class='text-white text-center'><i class='fas fa-exclamation-circle'></i> {!! \Session::get('error') !!}</p>
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="notifications bg-danger shadow">
            <ul class='text-white'>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    
    <script src='https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js'></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFrY5fH-gBUGMk6zfFnmk7aHZp-Dzzdzo&libraries=places&region=KE"></script>

    @stack('js')
    <script>
        $(document).ready(function(){
            setTimeout(function(){
                $('.notifications').fadeOut(1000);
            }, 3000);
            
            var show = false;
            var timer = null;

            $('.btn-float').click(function(){
                show?show=false:show=true;
                if(show){
                    $('.myheader').html("<div class='text-center'><h5>Current Drivers</h5></div>");
                    getUsers();
                    $('input[name=last_id]').val(0);
                    $('.mychat').show();
                }else{
                    clearInterval(timer);
                    $('.mychat').hide();
                }
            });
            var user_id = '{{\Auth::user()->id}}';
            function getUsers(){
                $('.messages').html('');
                $.ajax({
                    url: '{{url("get/users")}}',
                    type: 'GET',
                }).done(function(data){
                    var data = JSON.parse(data);
                    $.each(data, function(index, value){
                        $('.messages').append('<div class="row p-2 border-bottom d-flex align-items-center" data-id="'+value.user.sender_id+'">'+
                            '<div class="col-2"><div class="user-avatar-sm">'+value.user.firstname.substring(0,1)+value.user.lastname.substring(0,1)+'</div></div>'+
                            '<div class="col-8"><strong class="name">'+value.user.firstname+' '+value.user.lastname+'</strong><br>'+
                            ''+(value.message != null?(value.message.message.length > 20?value.message.message.substring(0,20)+'...':value.message.message):'')+
                            '</div><div class="col-2 text-right">'+
                            (value.unread > 0?'<span class="badge badge-primary">'+value.unread+'</span>':'')+'</div>'+
                            '</div>');
                    });
                });
            }
            
            $(document).on('click', '.messages .d-flex', function(){
                var rec_id = $(this).attr('data-id');
                var name = $(this).find('.name').text();
                var names = name.split(' ');

                $('.message-form input[name=rec_id]').val(rec_id);
                $('.mychat .myheader').html('<div class="row d-flex align-items-center">'+
                '<div class="col-3"><div class="user-avatar mr-2 ml-2">'+names[0].substring(0,1)+names[1].substring(0,1)
                +'</div></div><div class="col-9"><span>'+
                name+'</span></div></div>');
                $('.mychat .messages').html('<p class="text-center p-2 text-muted"><i class="fas fa-spinner fa-pulse"></i> Loading...</p>');
                getMessages();
            });
            
            function getMessages(){
                clearInterval(timer);
                var user_id = $('.message-form input[name=rec_id]').val();
                var sender_id = '{{\Auth::user()->id}}';
                var last_id = $('input[name=last_id]').val();
                var name = $('.myheader span').text();
                $.ajax({
                    url: '{{url("messages/get")}}?user_id='+user_id+'&last_id='+last_id,
                    type: 'GET',
                }).done(function(data){
                    //alert(data);
                    $('.messages .text-muted').remove();
                    if(data.success){
                        $.each(data.success, function(index, value){
                            $('input[name=last_id]').val(value.id);
                            $('.messages').append(
                            "<div class='"+(sender_id == value.sender_id?'chat-body-receive':'chat-body-send')+"'>"
                            +value.message+"<br>"+
                            "<span class='small'><strong>"+value.created_at+"</strong> from <strong>"
                            +(sender_id == value.sender_id?'YOU':name)+"</strong></span>"
                            +"</div>");
                        });
                        
                        if(data.success.length > 0){
                            $(".messages").animate({
                                scrollTop: 10000
                            }, 1000);
                        }
                    }
                    timer = setInterval(function(){
                        getMessages();
                    }, 3000);
                });
            }

            $('.message-form').submit(function(e){
                clearInterval(timer);
                e.preventDefault();
                var btn = $(this).find('.btn');
                btn.attr('disabled', 'disabled');
                btn.html('<i class="fas fa-spinner fa-pulse"></i>');
                
                var formData = $(this).serialize();
                $.ajax({
                    url: '{{url("messages/send")}}',
                    type: 'POST',
                    data: formData,
                }).done(function(data){
                    $('input[name=message]').val('');
                    btn.html('<i class="fas fa-paper-plane"></i>');
                    btn.removeAttr('disabled');
                    timer = setInterval(function(){
                        getMessages();
                    }, 3000);
                });
            });
        });
    </script>
</body>
</html>
