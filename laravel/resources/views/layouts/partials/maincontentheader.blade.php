<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>@yield('cant-content-header')</h3>

                <p>@yield('title-content-header')</p>
            </div>
            <div class="icon">
                <i class="glyphicon glyphicon-plus"></i>
            </div>
            <a href="@yield('url-content-header-create')" class="small-box-footer">
                @yield('title-content-header') <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>@yield('cant-content-header')</h3>

                <p>@yield('title2-content-header')</p>
            </div>
            <div class="icon">
                <i class="glyphicon glyphicon-th-list"></i>
            </div>
            <a href="@yield('url-list-content-header')" class="small-box-footer">
               @yield('title2-content-header') <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>