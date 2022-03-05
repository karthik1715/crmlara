@extends('layouts.default')
@section('title')
    {{ __('app.contacts.organization.title') }}
@stop
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">{{ __('app.contacts.organization.title') }}</h4>
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
                    <a href="{{route('organization.list')}}">{{ __('app.contacts.organization.olist') }}</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form id="contactFrom" role="form" method="POST"
                    action="{{ isset($organization) ? route('organization.update',$organization->id) : route('organization.create') }}">
                        @csrf
                        @isset($organization)
                            @method('PUT')
                        @endisset
                        <div class="card-header">
                            <div class="card-title">{{ isset($organization) ? __('app.contacts.organization.edit-title') : __('app.contacts.organization.create-title') }}</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group" id="organaizename">
                                        <label for="orgname">{{ __('app.contacts.organization.organization_name') }}</label><span class="required">*</span>
                                        <input type="text" class="form-control" name="name" placeholder="{{ __('app.contacts.organization.organization_name') }}" value="{{ $organization->name ?? '' }}" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">{{ __('app.general.address') }}</label><span class="required">*</span>
                                        <textarea class="form-control" name="address" rows="4" required>{{ $organization->address ?? '' }}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="country"></label>
                                        <select class="form-control" name="country_id" id="exampleFormControlSelect1">
                                            <option>Select Country</option>
                                            @if( isset($organization->country_id) && $organization->country_id !='')         
                                                <option value='106' {{ $organization->country_id == '106' ? 'selected="selected"' : '' }}>India</option></td>    
                                            @else
                                                <option value='106'>India</option></td>        
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="state" placeholder="{{ __('app.general.statename') }}" value="{{ $organization->state ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="city" placeholder="{{ __('app.general.cityname') }}" value="{{ $organization->city ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="postalcode" placeholder="{{ __('app.general.postalcode') }}" value="{{ $organization->postalcode ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action text-center">
                            <button class="btn btn-success">
                                @isset($organization)
                                    <i class="fas fa-arrow-circle-up"></i>
                                    <span>{{ __('app.general.update') }}</span>
                                @else
                                    <i class="fas fa-plus-circle"></i>
                                    <span>{{ __('app.general.submit') }}</span>
                                @endisset
                            </button>
                            <a class="btn btn-danger" href = "{{ route('organization.list') }}"><i class="fa fa-window-close"></i>
                                <span>{{ __('app.general.cancel') }}</span></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
