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
                    <div class="card-header row">
                        <div class="col-md-9">
                            <h4 class="card-title">{{ __('app.campaigns.calist') }}</h4>
                        </div>
                        <div class="col-md-3">
                            <!-- <a class="btn btn-primary btn-round ml-auto" href = "#updatePeopleModal" data-target="#updatePeopleModal" data-toggle="modal" ><i class="fa fa-upload"></i>{{ __('app.general.import') }}</a>
                            <a class="btn btn-primary btn-round ml-auto" href="{{ route('contactexport') }}"><i class="fa fa-download"></i>{{ __('app.general.export') }}</a> -->
                            <a class="btn btn-primary btn-round ml-auto mr-2 mb-2" href = "{{ route('campaign.create') }}"><i class="fa fa-plus"></i>
                                {{ __('app.campaigns.add-title') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="modal fade" id="deleteCampaignModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                            {{ __('app.campaigns.delcamp') }} </span> 
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="#" method="get" class="campremove-record-model">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>{{ __('app.general.deleteMessage') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 text-center">
                                        <a href="#">
                                            <button type="submit" id="addRowButton" class="btn btn-primary">{{ __('app.general.delete') }}</button>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('app.general.cancel') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="copyModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                            {{ __('app.campaigns.copycamp') }} </span> 
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="#" method="get" class="copy-campaign-model">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>{{ __('app.general.copyMessage') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 text-center">
                                        <a href="#">
                                            <button type="submit" id="addRowButton" class="btn btn-primary">{{ __('app.general.clone') }}</button>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('app.general.cancel') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm" style="max-width: 600px;" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                            {{ __('app.general.preview') }} </span> 
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12" id="previewDiv">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <form action="{{ route('campaign.list') }}" >
                                <div class="row">
                                    <div class="col-md-7">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-icon">
                                            <input type="text" name="q" value="{{ isset($_GET['q']) ? $_GET['q']: '' }}" placeholder="{{ __('app.general.findsearch') }}" class="form-control"/>
                                            <span class="input-icon-addon">
                                                <i class="fa fa-search"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="submit" class="btn btn-primary" value="{{ __('app.general.search') }}"/>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
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
                                                        {{ ( !empty( $item->campaignDetail ) && !empty( $item->campaignDetail->schedule_datetime ) ) ? $item->campaignDetail->schedule_datetime:'-' }}
                                                    @else
                                                        {{ '-' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset( $item->campaignDetail ))
                                                        @if( $item->campaignDetail->campaign_status == 'draft')
                                                            <i class="icon-check text-default">&emsp;Draft</i>
                                                        @elseif( $schedule_status == 0 )
                                                            <i class="icon-clock text-success">&emsp;Sent</i>
                                                        @else
                                                            <i class="icon-clock text-warning">&emsp;Schedule</i>
                                                        @endif

                                                        <input type="hidden" id="hidden_content_{{ $item->id }}" value="{{ $item->campaignDetail->template_content }}" />
                                                    @endif
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

                                                            @if(isset($item->campaignDetail))
                                                                @if( $item->campaignDetail->campaign_status == 'draft')
                                                                    <a class="dropdown-item text-secondary" href="{{ route('campaign.edit',$item->id) }}">
                                                                        <i class="fa fa-edit">&nbsp;{{ __('app.general.edit') }}</i>
                                                                    </a>
                                                                @elseif( $schedule_status == 0 )
                                                                    <a class="dropdown-item text-warning" href="{{ route('campaign.statistics',$item->id) }}">
                                                                        <i class="fas fa-chart-line">&nbsp;{{ __('app.statistics.statistics') }}</i>
                                                                    </a>
                                                                @else
                                                                    <a class="dropdown-item text-warning" href="#">
                                                                        <i class="icon-clock">&nbsp;{{ __('app.general.reschedule') }}</i>
                                                                    </a>
                                                                @endif
                                                            @else 
                                                                <a class="dropdown-item text-secondary" href="{{ route('campaign.edit',$item->id) }}">
                                                                    <i class="fa fa-edit">&nbsp;{{ __('app.general.edit') }}</i>
                                                                </a>
                                                            @endif
                                                        
                                                            @if(isset($item->campaignDetail))
                                                                @if( $item->campaignDetail->campaign_status == 'active')
                                                                    <a class="dropdown-item text-info campaign-copy" data-id="{{$item->id}}" 
                                                                        data-url="{{ route('campaign.copy',$item->id) }}" data-toggle="modal" 
                                                                        data-target="#copyModal">
                                                                        <i class="fa fa-copy">&nbsp;{{ __('app.general.clone') }}</i>
                                                                    </a>
                                                                    <a class="dropdown-item text-success campaign-preview" data-id="{{$item->id}}"  data-toggle="modal" 
                                                                        data-target="#previewModal">
                                                                        <i class="fa fa-desktop">&nbsp;{{ __('app.general.preview') }}</i>
                                                                    </a>
                                                                @endif
                                                            @endif

                                                            <a class="dropdown-item text-danger campremove-record" data-id="{{$item->id}}" 
                                                                data-url="{{ route('campaign.delete',$item->id) }}" data-toggle="modal" 
                                                                data-target="#deleteCampaignModal">
                                                                <i class="fa fa-trash">&nbsp;{{ __('app.general.delete') }}</i>
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
                                    $search = isset($_GET['q']) ? $_GET['q']: '';
                                @endphp
                                <div class="mt-4 p-4 box has-text-centered">
                                    Showing {{ $from }} to {{ $cal }} of {{ $total  }} 
                                </div>
                                <div class="d-flex justify-content-center">
                                    {!! $campaigns->appends(['q' => $search ])->links() !!}
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
@section('script')
<script> 
$('.campremove-record').click(function() {
    var id = $(this).attr('data-id');
    var url = $(this).attr('data-url');
    $(".campremove-record-model").attr("action",url);
});

$('.campaign-copy').click(function() {
    var id = $(this).attr('data-id');
    var url = $(this).attr('data-url');
    $(".copy-campaign-model").attr("action",url);
});

$('.campaign-preview').click(function() {
    var id = $(this).attr('data-id');
    var content = $("#hidden_content_"+id).val();
    $("#previewDiv").html(content);
});
</script>
@endsection