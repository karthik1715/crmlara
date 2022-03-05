@extends('layouts.default')
@section('title')
    {{ __('app.deals.title') }}
@stop
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">{{ __('app.deals.title') }}</h4>
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
                        <div class="col-md-6 d-flex">
                            <!-- <h4 class="card-title br-1">{{ __('app.deals.title') }}</h4>&emsp; -->
                            <select class="col-md-5 form-control-sm" id="pipeline">
								<option>{{ __('app.deals.default-pipeline') }}</option>
							</select>
                            <span class="col-md-2">
                                <a class="btn btn-primary btn-round ml-auto" href = "{{ url('/deals/pipeline') }}"><i class="fa fa-plus"></i>{{ __('app.deals.add-pipeline') }}</a>&emsp;
                            </span>
                        </div>
                        <div class="col-md-6 d-flex row">
                            <span class="col-md-4">
                                <a class="btn btn-primary btn-round ml-auto" href = "{{ url('/deal/create') }}"><i class="fa fa-plus"></i>{{ __('app.deals.create-title') }}</a>&emsp;
                            </span>
                            <span class="col-md-6">
                                <input type="search" class="form-control" placeholder="{{ __('app.general.search') }}" >
                            </span>
                        </div>
                    </div>
                    <div class="card-body">                  
                        <div class="drag">
                            <div class="wrapper">
                                <ul class="dropzone">
                                    <div class="card-header p-0">
                                        <h4 class="card-title">{{ __('app.deals.appointment-schedule') }}</h4>
                                        <b><span class="text-success">1</span> - {{ __('app.deals.no-deal') }}</b>
                                    </div>
                                    <div class="card-body text-center p-2">
                                        <a href = "{{ url('/deal/create') }}">
                                            <i class="fas fa-plus-circle fa-3x text-primary p-3"></i>
                                        </a>
                                    </div>
                                    <li draggable="true">
                                        <div class="text-left">
                                            <div class="card-header pl-2 pr-2">
                                                <h4 class="card-title">Oxigreen</h4>
                                                <b><span class="text-muted">{{ __('app.general.inr') }} 0</span></b>
                                            </div>
                                            <div class="card-body text-muted">
                                                <b><i class="fas fa-clock"></i> 0 {{ __('app.general.activities') }}</b>
                                                <b class="pull-right"><i class="fas fa-chevron-right"></i></b>
                                            </div>
                                        </div>
                                    </li>
                                    <div style="clear:both"></div>
                                </ul>
                                <ul class="dropzone">
                                    <div class="card-header p-0">
                                        <h4 class="card-title">{{ __('app.deals.qualified-buy') }}</h4>
                                        <b><span class="text-success">1</span> - {{ __('app.deals.no-deal') }}</b>
                                    </div>
                                    <div class="card-body text-center p-2">
                                        <a href = "{{ url('/deal/create') }}">
                                            <i class="fas fa-plus-circle fa-3x text-primary p-3"></i>
                                        </a>
                                    </div>
                                    <li draggable="true">
                                        <div class="text-left">
                                            <div class="card-header pl-2 pr-2">
                                                <h4 class="card-title">Oxigreen</h4>
                                                <b><span class="text-muted">{{ __('app.general.inr') }} 0</span></b>
                                            </div>
                                            <div class="card-body text-muted">
                                                <b><i class="fas fa-clock"></i> 0 {{ __('app.general.activities') }}</b>
                                                <b class="pull-right"><i class="fas fa-chevron-right"></i></b>
                                            </div>
                                        </div>
                                    </li>
                                    <div style="clear:both"></div>
                                </ul>
                                <ul class="dropzone">
                                    <div class="card-header p-0">
                                        <h4 class="card-title">{{ __('app.deals.presentation-scheduled') }}</h4>
                                        <b><span class="text-success">0</span> - {{ __('app.deals.no-deal') }}</b>
                                    </div>
                                    <div class="card-body text-center p-2">
                                        <a href = "{{ url('/deal/create') }}">
                                            <i class="fas fa-plus-circle fa-3x text-primary p-3"></i>
                                        </a>
                                    </div>
                                    <div style="clear:both"></div>
                                </ul>
                                <ul class="dropzone">
                                    <div class="card-header p-0">
                                        <h4 class="card-title">{{ __('app.deals.decisionMaker-buyin') }}</h4>
                                        <b><span class="text-success">0</span> - {{ __('app.deals.no-deal') }}</b>
                                    </div>
                                    <div class="card-body text-center p-2">
                                        <a href = "{{ url('/deal/create') }}">
                                            <i class="fas fa-plus-circle fa-3x text-primary p-3"></i>
                                        </a>
                                    </div>
                                    <div style="clear:both"></div>
                                </ul>
                                <ul class="dropzone">
                                    <div class="card-header p-0">
                                        <h4 class="card-title">{{ __('app.deals.contract-sent') }}</h4>
                                        <b><span class="text-success">0</span> - {{ __('app.deals.no-deal') }}</b>
                                    </div>
                                    <div class="card-body text-center p-2">
                                        <a href = "{{ url('/deal/create') }}">
                                            <i class="fas fa-plus-circle fa-3x text-primary p-3"></i>
                                        </a>
                                    </div>
                                    <div style="clear:both"></div>
                                </ul>
                                <ul class="dropzone">
                                    <div class="card-header p-0">
                                        <h4 class="card-title">{{ __('app.deals.closed-won') }}</h4>
                                        <b><span class="text-success">0</span> - 1 {{ __('app.deals.title') }}</b>
                                    </div>
                                    <div class="card-body text-center p-2">
                                        <a href = "{{ url('/deal/create') }}">
                                            <i class="fas fa-plus-circle fa-3x text-primary p-3"></i>
                                        </a>
                                    </div>
                                    <li draggable="true">
                                        <div class="text-left">
                                            <div class="card-header pl-2 pr-2">
                                                <h4 class="card-title">Oxigreen</h4>
                                                <b><span class="text-muted">{{ __('app.general.inr') }} 0</span></b>
                                            </div>
                                            <div class="card-body text-muted">
                                                <b><i class="fas fa-clock"></i> 0 {{ __('app.general.activities') }}</b>
                                                <b class="pull-right"><i class="fas fa-chevron-right"></i></b>
                                            </div>
                                        </div>
                                    </li>
                                    <div style="clear:both"></div>
                                </ul>
                                <ul class="dropzone">
                                    <div class="card-header p-0">
                                        <h4 class="card-title">{{ __('app.deals.closed-lost') }}</h4>
                                        <b><span class="text-success">0</span> - {{ __('app.deals.no-deal') }}</b>
                                    </div>
                                    <div class="card-body text-center p-2">
                                        <a href = "{{ url('/deal/create') }}">
                                            <i class="fas fa-plus-circle fa-3x text-primary p-3"></i>
                                        </a>
                                    </div>
                                    <div style="clear:both"></div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	const slider = document.querySelector('.items');
  let isDown = false;
  let startX;
  let scrollLeft;

  slider.addEventListener('mousedown', (e) => {
    isDown = true;
    slider.classList.add('active');
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
  });

  slider.addEventListener('mouseleave', () => {
    isDown = false;
    slider.classList.remove('active');
  });

  slider.addEventListener('mouseup', () => {
    isDown = false;
    slider.classList.remove('active');
  });

  slider.addEventListener('mousemove', (e) => {
    if (!isDown) return;  // stop the fn from running
    e.preventDefault();
    const x = e.pageX - slider.offsetLeft;
    const walk = (x - startX) * 3;
    slider.scrollLeft = scrollLeft - walk;
  });

</script>
@stop
