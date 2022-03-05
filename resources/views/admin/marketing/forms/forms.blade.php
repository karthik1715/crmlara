@extends('layouts.default')
@section('title')
    {{ __('app.marketing.forms.title') }}
@stop
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">{{ __('app.marketing.forms.title') }}</h4>
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
                    <a href="#">
                        {{ __('app.dashboard.marketing') }}
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
                                <h4 class="page-title">{{ __('app.marketing.forms.title') }}</h4>
                            </div>
                            <div class="col-md-6 d-flex">
                                <a class="btn btn-primary btn-round ml-auto mr-2 mb-2" href = ""><i class="fa fa-plus"></i>
                                {{ __('app.marketing.forms.addforms') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            @include('includes.flash-message')
                            <table class="table table-striped table-inverse">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>{{ __('app.marketing.forms.form_name') }}</th>
                                        <th>{{ __('app.marketing.forms.view') }}</th>
                                        <th>{{ __('app.marketing.forms.submissions') }}</th>
                                        <th>{{ __('app.contacts.person.owner_name') }}</th>
                                        <th>{{ __('app.marketing.forms.lastmodified') }}</th>
                                        <th>{{ __('app.general.status') }}</th>
                                        <th>-</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Test
                                            </td>
                                            <td>
                                                0
                                            </td>
                                            <td>
                                                0
                                            </td>
                                            <td>
                                                Karthik
                                            </td>
                                            <td>
                                                22022022
                                            </td>
                                            <td>
                                                <i class="icon-clock text-success">&emsp;Published</i>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle text-primary" data-toggle="dropdown">
                                                    <i class="text-center fa-2x mt-2 p-2 fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item text-secondary" href="#">
                                                            <i class="fa fa-edit">&nbsp;Edit</i>
                                                        </a>
                                                         <a class="dropdown-item text-info" href="#">
                                                        <i class="fas fa-copy">&nbsp; Copy </i>
                                                        </a>
                                                        <a class="dropdown-item text-danger" href="#">
                                                            <i class="fas fa-trash">&nbsp;Delete</i>
                                                        </a>
                                                        <a class="dropdown-item text-warning" href="#">
                                                            <i class="fas fa-file-alt">&nbsp; Unpublish </i>
                                                        </a>
                                                        <a class="dropdown-item text-info" href="#">
                                                            <i class="fas fa-code">&nbsp; Copy Embed Code </i>
                                                        </a>
                                                        <a class="dropdown-item text-success" href="#">
                                                            <i class="fas fa-desktop">&nbsp; Preview </i>
                                                        </a>
                                                    </div>
                                                </div>
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
@stop
