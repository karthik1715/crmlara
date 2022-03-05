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
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{route('deal.list')}}">{{ __('app.deals.deal-list') }}</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form id="" role="form" method="POST" enctype="multipart/form-data" 
                    action="">
                        @csrf
                        @isset($contact)
                            @method('PUT')
                        @endisset
                        <div class="card-header">
                            <div class="card-title">{{ isset($contact) ? __('app.deals.edit-title') : __('app.deals.create-title') }}</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="name">{{ __('app.deals.deal-name') }}</label><span class="required">*</span>
                                        <input type="text" class="form-control" name="name" placeholder="{{ __('app.deals.deal-name') }}" value="{{ $contact->name ?? '' }}" autocomplete="off" required >
                                        <div id="countryList"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="conname">{{ __('app.deals.contact-people-name') }}</label>
                                        <input type="text" class="conname form-control" placeholder="{{ __('app.deals.contact-people-name') }}" value="" >
                                    </div>
                                    <div class="form-group">
                                        <label for="orgname">{{ __('app.contacts.organization.organization_name') }}</label>
                                        <input type="text" class="orgname form-control" placeholder="{{ __('app.contacts.organization.organization_name') }}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="dvalue">{{ __('app.deals.deal-value') }}</label><span class="required">*</span>
                                        <input type="text" class="form-control" name="dvalue" placeholder="{{ __('app.deals.deal-value') }}" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="cldate">{{ __('app.deals.closing-date') }}</label><span class="required">*</span>
                                        <input type="date" class="form-control" name="cldate" placeholder="{{ __('app.deals.deal-value') }}" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="dldate">{{ __('app.deals.deal-date') }}</label><span class="required">*</span>
                                        <input type="date" class="form-control" name="dldate" placeholder="{{ __('app.deals.deal-value') }}" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="email">{{ __('app.general.email') }}</label><span class="required">*</span>
                                        <input type="email" class="form-control" name="email" id="email" 
                                            placeholder="{{ __('app.general.email') }}" value="{{ $contact->email ?? '' }}" 
                                            onblur="checkemail(this.value)" autocomplete="off"  required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">{{ __('app.general.phone') }}</label><span class="required">*</span>
                                        <input type="text" class="form-control" name="phone" placeholder="{{ __('app.general.phone') }}" value="{{ $contact->phone ?? '' }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">{{ __('app.contacts.person.visiblity') }}</label>
                                        <select class="form-control" name="visiblity" id="exampleFormControlSelect1">
                                            <option>Select</option>
                                            @if( isset($contact->visiblity) && $contact->visiblity !='')         
                                                <option value='1' {{ $contact->visiblity == '1' ? 'selected="selected"' : '' }}>Private</option></td>    
                                                <option value='2' {{ $contact->visiblity == '2' ? 'selected="selected"' : '' }}>Team</option></td>    
                                                <option value='3' {{ $contact->visiblity == '3' ? 'selected="selected"' : '' }}>Everyone</option></td>    
                                            @else
                                                <option value="1">Private</option>
                                                <option value="2">Team</option>
                                                <option value="3">Everyone</option> 
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">{{ __('app.deals.select-pipeline') }}</label>
                                        <select class="form-control" name="visiblity" id="exampleFormControlSelect1">
                                            <option>Select</option>        
                                            <option value="1">Facebook Lead</option>
                                            <option value="2">Default Pipeline</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">{{ __('app.deals.select-pipeline-stage') }}</label>
                                        <select class="form-control" name="visiblity" id="exampleFormControlSelect1">
                                            <option>Select</option>       
                                            <option value="1">{{ __('app.deals.lead') }}</option>
                                            <option value="2">{{ __('app.deals.qualified-lead') }}</option>
                                            <option value="3">{{ __('app.deals.quotation') }}</option>
                                            <option value="4">{{ __('app.deals.won-stage') }}</option>
                                            <option value="5">{{ __('app.deals.lost-stage') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action text-center">
                            <button class="btn btn-success" id="contact_submit">
                                @isset($contact)
                                    <i class="fas fa-arrow-circle-up"></i>
                                    <span>{{ __('app.general.update') }}</span>
                                @else
                                    <i class="fas fa-plus-circle"></i>
                                    <span>{{ __('app.general.submit') }}</span>
                                @endisset
                            </button>
                            <a class="btn btn-danger" href = "{{ route('contact.list') }}"><i class="fa fa-window-close"></i>
                                <span>{{ __('app.general.cancel') }}</span></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop