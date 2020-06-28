<header>
    <nav class="navbar-bg  navbar navbar-inverse header" id="main-navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><p class="logo">Servicedoer</p></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                @auth
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item">
                            @if (auth()->user()->type=='customer')
                                <a href="/orders" class="nav-link">Orders</a>
                            @else
                                <a href="/service-provider/orders" class="nav-link">Orders</a>
                            @endif
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link  dropdown-toggle" data-toggle="dropdown">
                                notifications ({{ $notifications->count() }})
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($notifications as $notification)
                                    <li class="dropdown-item notification">
                                        @if ($notification->data['type'] == 1)
                                            <a href="#" 
                                                class="give-quote-notification" 
                                                project-id="{{ $notification->data['project_id'] }}"
                                                notification-id="{{ $notification->id }}">
                                                {{ $notification->data['message'] }}
                                            </a>
                                        @elseif($notification->data['type'] == 2)
                                            <a href="#" 
                                                class="quote-received-notification"
                                                quote-id="{{ $notification->data['quote_id'] }}"
                                                notification-id="{{ $notification->id }}">
                                                {{ $notification->data['message'] }}
                                            </a>
                                        @elseif($notification->data['type'] == 3)
                                            <a href="/service-provider/orders/{{ $notification->data['order_id'] }}" 
                                                class="order-completed-notification"
                                                order-id="{{ $notification->data['order_id'] }}"
                                                notification-id="{{ $notification->id }}">
                                                {{ $notification->data['message'] }}
                                            </a>
                                        @elseif($notification->data['type'] == 4)
                                            <a href="#" 
                                                class="new-review-notification"
                                                review-id="{{ $notification->data['review_id'] }}"
                                                notification-id="{{ $notification->id }}">
                                                {{ $notification->data['message'] }}
                                            </a>
                                        @elseif($notification->data['type'] == 5)
                                            <a href="/service-provider/orders/{{ $notification->data['order_id'] }}" 
                                                class="order-cancelled-notification"
                                                order-id="{{ $notification->data['order_id'] }}"
                                                notification-id="{{ $notification->id }}">
                                                {{ $notification->data['message'] }}
                                            </a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="dropdown nav-item user-dropdown">
                            <a class="dropdown-toggle nav-link " data-toggle="dropdown" href="#">
                                <img src="{{ auth()->user()->profile_image }}" width=30px" class="">
                                <h4>{{ auth()->user()->name }}</h4>    
                                <i class="fas fa-sort-down"></i>
                            </a>    
                            <ul class="dropdown-menu ">
                                @if (auth()->user()->type == 'service-provider')    
                                    <li><a href="{{ route('service-provider.profile', auth()->user()->id ) }}" class="drop-down">Account</a></li>                                    
                                @endif
                                <li><a href="/logout" class="drop-down">Sign Out</a></li>
                            </ul>
                        </li>
                        <!-- <li class="menu-items"><a href="register.html" class="act-link">Sign Up</a></li>
                        <li class="menu-items"><a href="login.html" class="act-link">Login in</a></li>				 -->
                    </ul>
                @else                    
                    <ul class="nav navbar-nav navbar-right">
                        <li class="menu-items"><a href="/register/service-provider" class="act-link1">Become a Doer</a></li>
                        <li class="menu-items"><a href="/register" class="act-link">Sign Up</a></li>
                        <li class="menu-items"><a href="/login" class="act-link">Login in</a></li>				
                    </ul>
                @endauth

                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header> 

@include('partials.give-quote-modal')
@include('partials.order-quote-modal')


@push('scripts')
<script>
    $('.order-completed-notification').click(function(e){
        e.preventDefault();
        var notificationId = $(this).attr('notification-id')
        url = $(this).attr('href')
        $.ajax({
            method: 'get',
            url : '/api/notifications/markasread/'+notificationId,
            success: function(res){
                console.log(res)
                window.location = url;
            },
        })
    })

    $('.order-cancelled-notification').click(function(e){
        e.preventDefault();
        var notificationId = $(this).attr('notification-id')
        url = $(this).attr('href')
        $.ajax({
            method: 'get',
            url : '/api/notifications/markasread/'+notificationId,
            success: function(res){
                console.log(res)
                window.location = url;
            },
        })
    })

</script>
@endpush


