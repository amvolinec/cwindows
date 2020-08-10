<div class="row">
    <!-- uncomment code for absolute positioning tweek see top comment in css -->
    <div class="absolute-wrapper"></div>
    <!-- Menu -->
    <div class="side-menu">
        <nav class="navbar navbar-default" role="navigation">
            <!-- Main Menu -->
            <div class="side-menu-container">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{ route('forms.index') }}"><i class="fa fa-tachometer"
                                                                               aria-hidden="true"></i> Dashboard</a>
                    </li>
                    <li><a href="{{ route('client.index') }}"><i class="fa fa-address-book" aria-hidden="true"></i>
                            Clients</a></li>
                    <li><a href="{{ route('architect.index') }}"><i class="fa fa-building-o" aria-hidden="true"></i>
                            Architects</a></li>
                    <li><a href="{{ route('offer.index') }}"><i class="fa fa-file-o" aria-hidden="true"></i> Offers</a></li>

                    <!-- Dropdown-->
                    <li class="panel panel-default" id="dropdown">
                        <a data-toggle="collapse" href="#dropdown-lvl1"><i class="fa fa-window-maximize"
                                                                           aria-hidden="true"></i> Windows <i
                                class="fa fa-caret-down" aria-hidden="true"></i>
                        </a>

                        <!-- Dropdown level 1 -->
                        <div id="dropdown-lvl1" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="nav navbar-nav">
                                    <li><a href="#">Create</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <!-- Dropdown level 2 -->
                    <li class="panel panel-default" id="dropdown">
                        <a data-toggle="collapse" href="#dropdown-lvl2">
                            <i class="fa fa-columns" aria-hidden="true"></i> Doors <i
                                class="fa fa-caret-down" aria-hidden="true"></i>
                        </a>
                        <div id="dropdown-lvl2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="nav navbar-nav">
                                    <li><a href="#">Create</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>


                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>

    </div>
</div>
