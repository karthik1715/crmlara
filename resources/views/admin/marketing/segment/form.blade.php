@extends('layouts.default')
@section('title')
    {{ __('app.segment.title') }}
@stop
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">{{ __('app.dashboard.marketing') }}</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{url('/dashboard')}}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="nav-home">
                    &emsp;<i class="flaticon-right-arrow-1"></i>&emsp;
                </li>
                <li class="nav-home">
                    <a href="{{route('segment.list')}}">{{ __('app.segment.selist') }}</a>
                </li>
            </ul>
        </div>
        <form id="contactFrom" role="form" method="POST" 
                action="{{ isset($segment) ? route('segment.update',$segment->id) : route('segment.create') }}">
                @csrf
                @isset($segment)
                    @method('PUT')
                @endisset

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{ isset($segment) ? __('app.segment.edit-title') : __('app.segment.create-title') }}</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">{{ __('app.general.name') }}</label>
                                            <input type="text" name="name" class="form-control" placeholder="{{ __('app.general.name') }}" value="{{ $segment->name ?? '' }}" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="name">{{ __('app.general.description') }}</label>
                                            <input type="text" name="description" class="form-control" placeholder="{{ __('app.general.description') }}" value="{{ $segment->description ?? '' }}" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <h5><b>{{ __('app.segment.select-note') }}</b>
                                            <span><span id="contact_count"> 
                                                @if(isset($segment))
                                                    {{ (count($segment->contacts->pluck('id'))>0) ? count($segment->contacts->pluck('id')) : 0; }}
                                                @else
                                                    {{ 0 }}
                                                @endif
                                            </span>{{ __('app.segment.default-note') }}</span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action text-center">
                                @isset($segment)
                                    <button class="btn btn-success" id="submit_button"
                                            @if(count($segment->contacts->pluck('id'))<1) disabled=disabled @endif >
                                        <i class="fas fa-arrow-circle-up"></i>
                                        <span>{{ __('app.general.update') }}</span>
                                    </button>
                                @else
                                    <button class="btn btn-success" id="submit_button" disabled >
                                        <i class="fas fa-plus-circle"></i>
                                        <span>{{ __('app.general.submit') }}</span>
                                    </button>
                                @endisset 
                                <a class="btn btn-danger" href = "{{ route('segment.list') }}"><i class="fa fa-window-close"></i>
                                    <span>{{ __('app.general.cancel') }}</span>
                                </a>
                            </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6 d-flex">
                                    <a class="btn btn-primary btn-round ml-auto mr-2 mb-2" href = "#"><i class="fas fa-file-export"></i>
                                    {{ __('app.general.export') }}</a>
                                    <input type="search" class="form-control form-control-sm" placeholder="Search">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                @include('includes.flash-message')
                                <table class="table table-striped table-inverse">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>
                                                <input class="myCheckBox" id="checkedAll" type="checkbox" value="">
                                            </th>
                                            <th>{{ __('app.general.email') }}</th>
                                            <th>{{ __('app.general.phone') }}</th>
                                            <th>{{ __('app.segment.deals-open') }}</th>
                                            <th>{{ __('app.contacts.person.visiblity') }}</th>
                                            <th>{{ __('app.general.label') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($contacts as $contact)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="checkSingle" value="{{ $contact->id }}" name="contact_id[]"
                                                value="{{ $contact->id }}" 
                                                @isset($segment) 
                                                    @if($segment->contacts->contains($contact->id)) checked=checked @endif
                                                @endisset >
                                            </td>
                                            <td>
                                                <div class="avatar-group">
                                                    <div class="avatar mt-2">
                                                        <i class="far fa-user-circle fa-2x avatar-img rounded-circle"></i>
                                                    </div>
                                                    <p>
                                                        <b>{{ $contact->name }}</b><br>
                                                        {{ $contact->email }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td>{{ $contact->phone }}</td>
                                            <td>0</td>
                                            <td>
                                                <span class="badge badge-pill badge-info">
                                                    <i class="fas fa-lock"></i>
                                                    {{ __('app.general.private') }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-info">
                                                    <i class="fas fa-circle"></i>
                                                    OCT TN
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                                @if ($contacts->links()->paginator->hasPages())
                                    <div class="mt-4 p-4 box has-text-centered">
                                        {!! $contacts->appends(['sort' => 'created_at'])->links() !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@stop