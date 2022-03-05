@extends('layouts.default')
@section('title')
    {{ __('app.campaigns.title') }}
@stop
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">{{ __('app.campaigns.title') }}</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{url('/dashboard')}}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{route('campaign.list')}}">{{ __('app.campaigns.title') }}</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div class="col-md-8">
                                <h4 class="page-title">{{ __('app.statistics.statistics') }}</h4>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group d-flex">
                                <label for="filterSelect">
                                  <i class="fas fa-calendar-alt"></i>
                                </label>&emsp;
                                <select class="form-control form-control-sm" id="filterSelect">
                                  <option>This Week</option>
                                  <option>This Month</option>
                                  <option>Custom Date Range</option>
                                </select>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                      @include('includes.flash-message')
                      <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                          <div class="row pl-3">
                            <div class="col-6 p-0 mb-3  mt-2">
                              <h2 class="m-0 text-dark"> 116 </h2>
                              <h5 class="m-0 text-dark"> Total Emails </h5>
                              <small> Total Emails Sent </small>
                            </div>
                            <div class="col-6 p-0 mb-3 mt-2">
                              <h2 class="m-0 text-dark"> 15 </h2>
                              <h5 class="m-0 text-dark"> Opened </h5>
                              <small> Contacts that opened the email </small>
                            </div>
                            <div class="col-6 p-0 mb-3">
                              <h2 class="m-0 text-dark"> 0 </h2>
                              <h5 class="m-0 text-dark"> Bounced </h5>
                              <small>Emails that couldn't be delivered </small>
                            </div>
                            <div class="col-6 p-0 mb-3">
                              <h2 class="m-0 text-dark"> 1 </h2>
                              <h5 class="m-0 text-dark"> Clicked</h5>
                              <small> Contacts that clicked on the links </small>
                            </div>
                            <div class="col-6 p-0 mb-3">
                              <h2 class="m-0 text-dark"> 2 </h2>
                              <h5 class="m-0 text-dark"> Unsubscribed </h5>
                              <small> Contacts that have unsubscribed </small>
                            </div>
                            <div class="col-6 p-0 mb-3">
                              <h2 class="m-0 text-dark"> 26 </h2>
                              <h5 class="m-0 text-dark"> Total Open </h5>
                              <small> Total open the campaign </small>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                          <div class="chart-container">
                              <canvas id="barChart"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-7">
                  </div>
                  <div class="col-md-3">
                      <div class="input-icon">
                          <input type="text" value="" placeholder="Find or Search...!" class="form-control">
                          <span class="input-icon-addon">
                              <i class="fa fa-search"></i>
                          </span>
                      </div>
                  </div>
                  <div class="col-md-2">
                      <input type="submit" class="btn btn-primary" value="Search">
                  </div>
                </div>
              </div>
              <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">{{ __('app.statistics.overview') }}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">{{ __('app.statistics.clickPerformance') }}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">{{ __('app.statistics.detailView') }}</a>
                  </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                  <div id="home" class="container tab-pane active"><br>
                    <div class="table-responsive">
                      <table class="table table-striped table-inverse">
                          <thead class="thead-inverse">
                              <tr>
                                  <th>
                                      <input type="checkbox" value="">
                                  </th>
                                  <th>{{ __('app.dashboard.contacts') }}</th>
                                  <th>{{ __('app.statistics.opened') }}</th>
                                  <th>{{ __('app.statistics.clicked') }}</th>
                                  <th>{{ __('app.statistics.bounced') }}</th>
                                  <th>{{ __('app.general.unsubscribed') }}</th>
                                  <th>{{ __('app.statistics.lastopened') }}</th>
                                  <th>{{ __('app.statistics.totalopen') }}</th>
                              </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>
                                          <input type="checkbox" value="">
                                      </td>
                                      <td>Sri Tech<br><span>info@sritech.com</span></td>
                                      <td>Yes</td>
                                      <td>No</td>
                                      <td>No</td>
                                      <td>No</td>
                                      <td>
                                          12-01-2022 06:58
                                      </td>
                                      <td>
                                          2
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <input type="checkbox" value="">
                                      </td>
                                      <td>Hari Tech<br><span>info@haritech.com</span></td>
                                      <td>Yes</td>
                                      <td>No</td>
                                      <td>No</td>
                                      <td>No</td>
                                      <td>
                                          05-01-2022 06:56
                                      </td>
                                      <td>
                                          5
                                      </td>
                                  </tr>
                              </tbody>
                      </table>
                    </div>
                  </div>
                  <div id="menu1" class="container tab-pane fade"><br>
                    <div class="table-responsive">
                      <table class="table table-striped table-inverse">
                          <thead class="thead-inverse">
                            <tr>
                                <th>{{ __('app.statistics.link') }}</th>
                                <th>{{ __('app.statistics.totalopen') }}</th>
                                <th>{{ __('app.statistics.uniqueClicks') }}</th>
                            </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>
                                      https://sritech.com
                                  </td>
                                  <td>
                                      0
                                  </td>
                                  <td>
                                      0
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                    </div>
                  </div>
                  <div id="menu2" class="container tab-pane fade"><br>
                    <div class="table-responsive">
                      <table class="table table-striped table-inverse">
                          <thead class="thead-inverse">
                            <tr>
                                <th>{{ __('app.statistics.link') }}</th>
                                <th>{{ __('app.statistics.contacts') }}</th>
                                <th>{{ __('app.statistics.lastclicked') }}</th>
                                <th>{{ __('app.statistics.totalclicked') }}</th>
                            </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>
                                      https://sritech.com
                                  </td>
                                  <td>
                                    Sri Tech
                                    <br><span>info@sritech.com</span>
                                  </td>
                                  <td>-</td>
                                  <td>
                                      0
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      https://sritech.com
                                  </td>
                                  <td>
                                    Sri Tech
                                    <br><span>info@sritech.com</span>
                                  </td>
                                  <td>-</td>
                                  <td>
                                      0
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript">

$(document).ready(function(){
  var barChart = document.getElementById('barChart').getContext('2d');

  var myBarChart = new Chart(barChart, {
      type: 'bar',
      data: {
          labels: ["Opened", "Clicked", "Bounced", "Unsubscribed", "Total Open"],
          datasets : [{
              label: "Emails",
              backgroundColor: 'rgb(23, 125, 255)',
              borderColor: 'rgb(23, 125, 255)',
              data: [53, 12, 93, 55, 40],
          }],
      },
      options: {
          responsive: true, 
          maintainAspectRatio: false,
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero:true
                  }
              }]
          },
      }
  });
});


  
</script>
@endsection

