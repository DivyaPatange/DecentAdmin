<header id="header">
    <div class="container d-flex">
        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="active"><a href="{{ url('/') }}">Home</a></li>
                <li class="drop-down"><a href="#">About Us</a>
                    <ul>
                    <li><a href="{{ url('/secretary-desk') }}">Secretary Desk</a></li>
                    <!--  <li class="drop-down"><a href="#">Drop Down 2</a>
                        <ul>
                        <li><a href="#">Deep Drop Down 1</a></li>
                        <li><a href="#">Deep Drop Down 2</a></li>
                        <li><a href="#">Deep Drop Down 3</a></li>
                        <li><a href="#">Deep Drop Down 4</a></li>
                        <li><a href="#">Deep Drop Down 5</a></li>
                        </ul>
                    </li> -->
                    <li><a href="{{ url('/principal-desk') }}">Principal Desk</a></li>
                    <li><a href="{{ url('/vision') }}">Vision</a></li>
                    <li><a href="{{ url('/mission') }}">Mission</a></li>
                    </ul>
                </li>
                <li class="drop-down"><a href="#">School</a>
                    <ul>
                    <li><a href="{{ url('/school-information') }}">School Information</a></li>
                    <li><a href="#">General Information</a></li>
                    <li><a href="{{ url('/smc') }}">SMC Details</a></li>
                    </ul>
                </li>
                <li><a href="#">Infrastructure</a></li>
                <li><a href="#">Gallery</a></li>
                <li><a href="{{ url('/admission') }}">Admission</a></li>
                <li><a href="#">Facilities</a></li>
                <li><a href="{{ url('/contact') }}">Contact Us</a></li>

            </ul>
        </nav>
        <!-- .nav-menu -->
    </div>
</header>