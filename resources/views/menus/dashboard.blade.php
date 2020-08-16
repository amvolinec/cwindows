<div class="row">
    <!-- uncomment code for absolute positioning tweek see top comment in css -->
    <div class="absolute-wrapper"></div>
    <!-- Menu -->
    <div class="side-menu">
        <nav class="navbar navbar-default" role="navigation">
            <!-- Main Menu -->
            <div class="side-menu-container">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{ route('forms.index') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    </li>
                    <hr>

                    <li><a href="{{ route('company.index') }}"><i class="fas fa-building"></i> Companies</a></li>
                    <li><a href="{{ route('client.index') }}"><i class="far fa-address-book"></i> Clients</a></li>
                    <li><a href="{{ route('architect.index') }}"><i class="far fa-building"></i> Architects</a></li>
                    <hr>
                    <li><a href="{{ route('offer.index') }}"><i class="fas fa-id-card-alt"></i> Deals</a></li>
                    <hr>

                    <!-- Dropdown-->
                    <li class="panel panel-default" id="dropdown">
                        <a data-toggle="collapse" href="#dropdown-lvl1"><i class="fas fa-cogs"></i> Settings <i
                                class="fa fa-caret-down" aria-hidden="true"></i>
                        </a>

                        <!-- Dropdown level 1 -->
                        <div id="dropdown-lvl1" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="nav navbar-nav">
                                    <li><a href="{{ route('site.index') }}"><i class="fas fa-sitemap"></i> Sites</a></li>
                                    <li><a href="{{ route('warehouse.index') }}"><i class="fas fa-warehouse"></i> Warehouses</a></li>
                                    <li><a href="{{ route('category.index') }}"><i class="fas fa-warehouse"></i> Categories</a></li>
                                    <li><a href="{{ route('state.index') }}"><i class="far fa-chart-bar"></i> States</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
{{--                    <!-- Dropdown level 2 -->--}}
{{--                    <li class="panel panel-default" id="dropdown">--}}
{{--                        <a data-toggle="collapse" href="#dropdown-lvl2">--}}
{{--                            <i class="fa fa-columns" aria-hidden="true"></i> Doors <i--}}
{{--                                class="fa fa-caret-down" aria-hidden="true"></i>--}}
{{--                        </a>--}}
{{--                        <div id="dropdown-lvl2" class="panel-collapse collapse">--}}
{{--                            <div class="panel-body">--}}
{{--                                <ul class="nav navbar-nav">--}}
{{--                                    <li><a href="#">Create</a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </li>--}}


                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>

    </div>
</div>
