@extends('layouts.default')
@section('title')
    {{ __('app.contacts.person.title') }}
@stop
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">{{ __('app.contacts.person.title') }}</h4>
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
                    <a href="{{route('contact.list')}}">{{ __('app.contacts.person.clist') }}</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form id="contactFrom" role="form" method="POST" enctype="multipart/form-data" 
                    action="{{ isset($contact) ? route('contact.update',$contact->id) : route('contact.create') }}">
                        @csrf
                        @isset($contact)
                            @method('PUT')
                        @endisset
                        <div class="card-header">
                            <div class="card-title">{{ isset($contact) ? __('app.contacts.person.edit-title') : __('app.contacts.person.add-title') }}</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="name">{{ __('app.contacts.person.contact_name') }}</label><span class="required">*</span>
                                        <input type="text" class="form-control" name="name" placeholder="{{ __('app.contacts.person.contact_name') }}" value="{{ $contact->name ?? '' }}" autocomplete="off" required >
                                        <div id="countryList"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="orgname">{{ __('app.contacts.organization.organization_name') }}</label>
                                        <input type="text" class="orgname form-control" placeholder="{{ __('app.contacts.organization.organization_name') }}" value="{{ $contact->organization->name ?? '' }}" >
                                        <input type="hidden" id="hiddenOrganizationId" name="hiddenOrganizationId" value="{{ $contact->organization_id ?? '' }}" >
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="exampleFormControlSelect1">Label</label>
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div> -->
                                    <div class="form-group d-none">
                                        <label for="ownername">{{ __('app.contacts.person.owner_name') }}</label>
                                        <input type="text" class="form-control" name="ownername" placeholder="{{ __('app.contacts.person.owner_name') }}" value="{{ $contact->name ?? '' }}" >
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
                                    <div class="form-group d-none">
                                        <label for="exampleFormControlFile1">{{ __('app.contacts.person.contact_image') }}</label>
                                        <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1">
                                        @if( isset($contact->image) && $contact->visiblity !='' )
                                            <img src="{{ asset('storage/app/'.$contact->directory.'/'. $contact->image) }}" style="width: 30%; height: 30%;">
                                            <input type="hidden" name="hiddenImageName" value="{{ $contact->image ?? '' }}" >
                                        @endif
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
                                    <div class="form-group d-none">
                                        <label for="subownername">{{ __('app.contacts.person.subowner_name') }}</label>
                                        <input type="text" class="form-control" name="subownername" placeholder="{{ __('app.contacts.person.subowner_name') }}" value="{{ $contact->name ?? '' }}">
                                    </div>
                                    <div class="form-group d-none">
                                        <label for="address">{{ __('app.general.address') }}</label><span class="required">*</span>
                                        <textarea class="form-control" name="address" rows="3" required>{{ $contact->address ?? '' }}
                                        </textarea>
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