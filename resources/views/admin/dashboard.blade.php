@extends('layouts.default')
@section('title')
    {{ __('app.dashboard.title') }}
@stop
@section('content')
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">{{ __('app.dashboard.title') }}</h2>
                        <h5 class="text-white op-7 mb-2">{{ __('app.dashboard.sales') }}</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="{{url('/contact')}}" class="btn btn-white btn-border btn-round mr-2">{{ __('app.dashboard.contacts') }}</a>
                        <a href="{{url('/campaign')}}" class="btn btn-secondary btn-round">{{ __('app.dashboard.campaigns') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row mt--2">
                <div class="col-md-6">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title">{{ __('app.dashboard.statistics') }}</div>
                            <div class="card-category">This Month gtege statistics in system</div>
                            <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                                <div class="px-2 pb-2 pb-md-0 text-center">
                                    <input type="hidden" id="cont_counts" value="{{ $contacts->count() }}" />
                                    <div id="circles-1"></div>
                                    <h6 class="fw-bold mt-3 mb-0">{{ __('app.dashboard.contacts') }}</h6>
                                </div>
                                <div class="px-2 pb-2 pb-md-0 text-center">
                                    <input type="hidden" id="segment_counts" value="{{ $segments->count() }}" />
                                    <div id="circles-2"></div>
                                    <h6 class="fw-bold mt-3 mb-0">{{ __('app.dashboard.segments') }}</h6>
                                </div>
                                <div class="px-2 pb-2 pb-md-0 text-center">
                                    <input type="hidden" id="campaign_counts" value="{{ $campaigns->count() }}" />
                                    <div id="circles-3"></div>
                                    <h6 class="fw-bold mt-3 mb-0">{{ __('app.dashboard.campaigns') }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card full-height">
                        <div class="card-header">
                            <div class="card-title">{{ __('app.dashboard.campaigns') }}</div>
                        </div>
                        <div class="card-body" style="height: 10px;overflow: hidden;">
                            <marquee behavior="scroll" direction="down" scrollamount="4" onmouseover="this.stop();" onmouseleave="this.start();"><p></p>
                                @isset($campaigns)
                                    @forelse ($campaigns as $item)
                                        <p class="text-center"><strong><a href="#">{{ $item->name }}</a></strong></p>
                                    @empty
                                        <p class="text-center"><strong>{{ __('app.general.norecord') }}</strong></p>
                                    @endforelse
                                @endisset
                            <p></p></marquee>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <a href="{{url('/organization')}}">
                        <div class="card card-dark bg-primary-gradient">
                            <div class="card-body pb-0">
                                <div class="h1 fw-bold float-right"><i class="fas fa-sitemap"></i></div>
                                <h2 class="mb-2">{{ $organizations->count() }}</h2>
                                <p>{{ __('app.contacts.organization.title') }}</p>
                                <div class="pull-in sparkline-fix chart-as-background">
                                    <div id="lineChart2"><canvas width="327" height="70" style="display: inline-block; width: 327px; height: 70px; vertical-align: top;"></canvas></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{url('/contact')}}">
                        <div class="card card-dark bg-secondary-gradient">
                            <div class="card-body pb-0">
                                <div class="h1 fw-bold float-right"><i class="fas fa-user"></i></div>
                                <h2 class="mb-2">{{ $contacts->count() }}</h2>
                                <p>{{ __('app.contacts.person.title') }}</p>
                                <div class="pull-in sparkline-fix chart-as-background">
                                    <div id="lineChart2"><canvas width="327" height="70" style="display: inline-block; width: 327px; height: 70px; vertical-align: top;"></canvas></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <div class="card card-dark bg-success2">
                        <div class="card-body pb-0">
                            <div class="h1 fw-bold float-right"><i class="far fa-thumbs-up"></i></div>
                            <h2 class="mb-2">20</h2>
                            <p>{{ __('app.dashboard.deal_won') }}</p>
                            <div class="pull-in sparkline-fix chart-as-background">
                                <div id="lineChart3"><canvas width="327" height="70" style="display: inline-block; width: 327px; height: 70px; vertical-align: top;"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-dark bg-danger2">
                        <div class="card-body pb-0">
                            <div class="h1 fw-bold float-right"><i class="far fa-thumbs-down"></i></div>
                            <h2 class="mb-2">2</h2>
                            <p>{{ __('app.dashboard.deal_lost') }}</p>
                            <div class="pull-in sparkline-fix chart-as-background">
                                <div id="lineChart3"><canvas width="327" height="70" style="display: inline-block; width: 327px; height: 70px; vertical-align: top;"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Line Chart</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="lineChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Bar Chart</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">{{ __('app.dashboard.deal_statistics') }}</div>
                                <!-- <div class="card-tools">
                                    <a href="#" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                        <span class="btn-label">
                                            <i class="fa fa-pencil"></i>
                                        </span>
                                        Export
                                    </a>
                                    <a href="#" class="btn btn-info btn-border btn-round btn-sm">
                                        <span class="btn-label">
                                            <i class="fa fa-print"></i>
                                        </span>
                                        Print
                                    </a>
                                </div> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="min-height: 375px">
                                <canvas id="statisticsChart"></canvas>
                            </div>
                            <div id="myChartLegend"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title">Monthly Invoiced Amount</div>
                            <div class="card-category">March 01 - March 31</div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="mb-4 mt-2">
                                <h1>$4,578.58</h1>
                            </div>
                            <div class="pull-in">
                                <canvas id="dailySalesChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="h1 fw-bold float-right text-warning">+7%</div>
                            <h2 class="mb-2">$5,0578</h2>
                            <p class="text-muted">Redemption this month</p>
                            <div class="pull-in sparkline-fix">
                                <div id="lineChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{ __('app.general.emails') }}</div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="d-flex">
                                <!-- <div class="avatar">
                                    <img src="{{ URL::asset('public/assets/img/logoproduct.svg') }}" alt="..." class="avatar-img rounded-circle">
                                </div> -->
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">{{ __('app.dashboard.total') }}</h6>
                                    <small class="text-muted">10</small>
                                </div>
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">{{ __('app.dashboard.inbox') }}</h6>
                                    <small class="text-muted">3</small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">{{ __('app.dashboard.draft') }}</h6>
                                    <small class="text-muted">1</small>
                                </div>
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">{{ __('app.dashboard.outbox') }}</h6>
                                    <small class="text-muted">2</small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">{{ __('app.dashboard.sent') }}</h6>
                                    <small class="text-muted">2</small>
                                </div>
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">{{ __('app.dashboard.trash') }}</h6>
                                    <small class="text-muted">3</small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <!-- <div class="pull-in">
                                <canvas id="topProductsChart"></canvas>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{ __('app.dashboard.top_deal') }}</div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="d-flex">
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">First Deal</h6>
                                    <small class="text-muted">$10000</small>
                                </div>
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">22 Jan 2022 12.33</h6>
                                    <small class="text-muted">New</small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">Second Deal</h6>
                                    <small class="text-muted">$11000</small>
                                </div>
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">24 Jan 2022 12.33</h6>
                                    <small class="text-muted">Prospect</small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1 classname">Third LeaDeald</h6>
                                    <small class="text-muted">$12000</small>
                                </div>
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">26 Jan 2022 12.33</h6>
                                    <small class="text-muted">New</small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{ __('app.dashboard.activities') }}</div>
                        </div>
                        <div class="card-body">
                            <ol class="activity-feed">
                                <li class="feed-item feed-item-secondary">
                                    <span class="date text" datetime="9-25">Call - <a href="#">0/0</a></span>
                                </li>
                                <li class="feed-item feed-item-success">
                                    <span class="date text" datetime="9-25">Meeting - <a href="#">1/2</a></span>
                                </li>
                                <li class="feed-item feed-item-info">
                                    <span class="date text" datetime="9-25">Lunch - <a href="#">5/5</a></span>
                                </li>
                                <li class="feed-item feed-item-danger">
                                    <span class="date text" datetime="9-25">Email -  <a href="#">10/10</a></span>
                                </li>
                                <li class="feed-item feed-item-warning">
                                    <span class="date text" datetime="9-25">Task -  <a href="#">2/2</a></span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card full-height">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">{{ __('app.dashboard.support_tickets') }}</div>
                                <div class="card-tools">
                                    <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-today" data-toggle="pill" href="#pills-today" role="tab" aria-selected="true">Open</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-week" data-toggle="pill" href="#pills-week" role="tab" aria-selected="false">Pending</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-month" data-toggle="pill" href="#pills-month" role="tab" aria-selected="false">Closed</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="avatar avatar-online">
                                    <span class="avatar-title rounded-circle border border-white bg-info">J</span>
                                </div>
                                <div class="flex-1 ml-3 pt-1">
                                    <h6 class="text-uppercase fw-bold mb-1">User 1 <span class="text-warning pl-3">pending</span></h6>
                                    <span class="text-muted">I am facing some trouble with my viewport.</span>
                                </div>
                                <div class="float-right pt-1">
                                    <small class="text-muted">8:40 PM</small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar avatar-offline">
                                    <span class="avatar-title rounded-circle border border-white bg-secondary">P</span>
                                </div>
                                <div class="flex-1 ml-3 pt-1">
                                    <h6 class="text-uppercase fw-bold mb-1">User 2 <span class="text-success pl-3">open</span></h6>
                                    <span class="text-muted">I have some query regarding the license issue.</span>
                                </div>
                                <div class="float-right pt-1">
                                    <small class="text-muted">1 Day Ago</small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar avatar-away">
                                    <span class="avatar-title rounded-circle border border-white bg-danger">L</span>
                                </div>
                                <div class="flex-1 ml-3 pt-1">
                                    <h6 class="text-uppercase fw-bold mb-1">User 1 <span class="text-muted pl-3">closed</span></h6>
                                    <span class="text-muted">Is there any update plan for RTL version near future?</span>
                                </div>
                                <div class="float-right pt-1">
                                    <small class="text-muted">2 Days Ago</small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
<script>
// $(function(){

    var url = "{{url('getmonthchart')}}";
    $.ajax({
    url: url,
    type: 'POST',
    data: { 
        _token : "{{ csrf_token() }}",
    },
    }).done(function(response) {
        lionChartFunc(response);
    });

    var url = "{{url('getcampaignchart')}}";
    $.ajax({
    url: url,
    type: 'POST',
    data: { 
        _token : "{{ csrf_token() }}",
    },
    }).done(function(response) {
        barChartFunc(response);
    });

// });

</script>
@endsection