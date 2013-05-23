<div class="navbar">
    <div class="navbar-inner">
        <a class="brand" href="#">Title</a>
    <ul class="nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
        @if (Session::has('name'))
            <li>
                Bienvenido {{Session::get('name')}}
            </li>
            <li>
                {{ link_to_route('logout',
                     'Logout',
                     array(),
                     array('class' => 'btn btn-danger ')) }}
            <li/>
        @else
            <li>
                {{ link_to_route('login',
                     'Login',
                     array(),
                     array('class' => 'btn btn-success ')) }}
            <li/>
        @endif
    </ul>
    </div>
</div>