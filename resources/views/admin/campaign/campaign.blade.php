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
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div class="col-md-6">
                                <h4 class="page-title">{{ __('app.campaigns.calist') }}</h4>
                            </div>
                            <div class="col-md-6 d-flex">
                                <a class="btn btn-primary btn-round ml-auto mr-2 mb-2" href = "{{ route('campaign.create') }}"><i class="fa fa-plus"></i>
                                {{ __('app.campaigns.add-title') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            @include('includes.flash-message')
                            <table class="table table-striped table-inverse">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>{{ __('app.general.id') }}</th>
                                        <th>{{ __('app.campaigns.title-name') }}</th>
                                        <th>{{ __('app.settings.category.title') }}</th>
                                        <th>{{ __('app.general.publish-date') }}</th>
                                        <th>{{ __('app.general.status') }}</th>
                                        <th>-</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($campaigns as $item)
                                            @php
                                                $schedule_status = ( !empty( $item->campaignDetail ) ? $item->campaignDetail->schedule_status:'0' )
                                            @endphp
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ !empty( $item->category ) ? $item->category->name:'-' }}</td>
                                                <td>
                                                    @if( $schedule_status == 0  || $schedule_status == 1 )
                                                        {{ !empty( $item->campaignDetail ) ? $item->campaignDetail->schedule_datetime:'-' }}
                                                    @else
                                                        {{ '-' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @isset( $item->campaignDetail )
                                                        @if( $item->campaignDetail->campaign_status == 'draft')
                                                            <i class="icon-check text-default">&emsp;Draft</i>
                                                        @elseif( $schedule_status == 0 )
                                                            <i class="icon-clock text-success">&emsp;Sent</i>
                                                        @else
                                                            <i class="icon-clock text-warning">&emsp;Schedule</i>
                                                        @endif
                                                    @endisset
                                                </td>
                                                <td>
                                                    <p><b>2</b>/2</p>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle text-primary" data-toggle="dropdown">
                                                        <i class="text-center fa-2x mt-2 p-2 fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu">
                                                        @isset( $item->campaignDetail )
                                                            @if( $item->campaignDetail->campaign_status == 'draft')
                                                                <a class="dropdown-item text-secondary" href="{{ route('campaign.edit',$item->id) }}">
                                                                    <i class="fa fa-edit">&nbsp;Edit</i>
                                                                </a>
                                                            @elseif( $schedule_status == 0 )
                                                                <a class="dropdown-item text-warning" href="{{ route('campaign.statistics',$item->id) }}">
                                                                    <i class="fas fa-chart-line">&nbsp;Statistics</i>
                                                                </a>
                                                            @else
                                                                <a class="dropdown-item text-warning" href="#">
                                                                    <i class="icon-clock">&nbsp;Reschedule</i>
                                                                </a>
                                                            @endif
                                                        @endisset
                                                        <a class="dropdown-item text-info" href="#">
                                                            <i class="fas fa-copy">&nbsp; Clone </i>
                                                        </a>  
                                                        <a class="dropdown-item text-success" href="#">
                                                            <i class="fas fa-desktop">&nbsp; Preview </i>
                                                        </a>
                                                        <a class="dropdown-item text-danger" href="#">
                                                            <i class="fas fa-trash">&nbsp;Delete</i>
                                                        </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            </tr><td colspan='6' align="center">{{ __('app.general.norecord') }}</td></tr>
                                        @endforelse
                                    </tbody>
                            </table>
                            @if ($campaigns->links()->paginator->hasPages())
                                @php
                                    $from   = ($campaigns->perPage()*($campaigns->currentPage()-1))+1;
                                    $to     = ($campaigns->currentPage() * $campaigns ->perPage()) ;
                                    $total  = $campaigns->total();
                                    $cal = ( $to >$total )? $total : $to ;
                                    $search = isset($_GET['org_search']) ? $_GET['org_search']: '';
                                @endphp
                                <div class="mt-4 p-4 box has-text-centered">
                                    Showing {{ $from }} to {{ $cal }} of {{ $total  }} 
                                </div>
                                <div class="d-flex justify-content-center">
                                    {!! $campaigns->appends(['org_search' => $search ])->links() !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
