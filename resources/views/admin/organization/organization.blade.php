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
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div class="col-md-6">
                                <h4 class="card-title">{{ __('app.contacts.organization.olist') }}</h4>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-primary btn-round ml-auto" href = "#updatePeopleModal" data-target="#updatePeopleModal" data-toggle="modal" ><i class="fa fa-upload"></i>{{ __('app.general.import') }}</a>
                                <a class="btn btn-primary btn-round ml-auto" href="{{ route('orgexport') }}"><i class="fa fa-download"></i>{{ __('app.general.export') }}</a>
                                <a class="btn btn-primary btn-round ml-auto" href = "{{ route('organization.create') }}"><i class="fa fa-plus"></i>
                                {{ __('app.contacts.organization.create-title') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        <div class="modal fade" id="deleteOrgModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                            {{ __('app.contacts.organization.delist') }} </span> 
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="#" method="get" class="orgremove-record-model">
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

                        <div class="modal fade" id="updatePeopleModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                            {{ __('app.general.upload') }} </span> 
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12 mb-2">
                                                <label>{{ __('app.general.choose') }}</label>
                                                <input type="file" id="orgfile" class="form-control">
                                            </div>
                                            <div class="col-sm-12 mb-2">
                                                <label>{{ __('app.general.sample') }}</label>
                                                <span><a href="{{ URL::asset('public/assets/img/organization.csv') }}" >{{ __('app.general.dsample') }}</a></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0 d-flex align-items-center">
                                        <button type="submit" id="orgImport" class="btn btn-primary">{{ __('app.general.submit') }}</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('app.general.cancel') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="addContactModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                            {{ __('app.contacts.organization.create-title') }} </span> 
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <form action="{{ route('organization.list') }}" >
                                <div class="row">
                                    <div class="col-md-7">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-icon">
                                            <input type="text" name="org_search" value="{{ isset($_GET['org_search']) ? $_GET['org_search']: '' }}" placeholder="{{ __('app.general.findsearch') }}" class="form-control"/>
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
                                        <th>{{ __('app.general.name') }}</th>
                                        <th>{{ __('app.contacts.organization.person_count') }}</th>
                                        <th>{{ __('app.general.created_date') }}</th>
                                        <th>{{ __('app.general.actions') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($organizations as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->contacts->count() }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                            <a href="{{ route('organization.edit',$item->id) }}"><i class="fa fa-edit"></i></a> 
                                            |
                                            <a class="text-danger orgremove-record" data-id="{{$item->id}}" data-url="{{ route('organization.delete',$item->id) }}" data-toggle="modal" data-target="#deleteOrgModal">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            </td>
                                        </tr>
                                        @empty
                                            </tr><td colspan='5' align="center">{{ __('app.general.norecord') }}</td></tr>
                                        @endforelse
                                    </tbody>
                            </table>
                            @if ($organizations->links()->paginator->hasPages())
                                @php
                                    $from   = ($organizations->perPage()*($organizations->currentPage()-1))+1;
                                    $to     = ($organizations->currentPage() * $organizations ->perPage()) ;
                                    $total  = $organizations->total();
                                    $cal = ( $to >$total )? $total : $to ;
                                    $search = isset($_GET['org_search']) ? $_GET['org_search']: '';
                                @endphp
                                <div class="mt-4 p-4 box has-text-centered">
                                    Showing {{ $from }} to {{ $cal }} of {{ $total  }} 
                                </div>
                                <div class="d-flex justify-content-center">
                                    {!! $organizations->appends(['org_search' => $search ])->links() !!}
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
$('.orgremove-record').click(function() {
    var id = $(this).attr('data-id');
    var url = $(this).attr('data-url');
    $(".orgremove-record-model").attr("action",url);
});

$('#orgImport').on('click', function(e) {
    
    e.preventDefault();
    $("#import-error").html('');

    var extension = $('#orgfile').val().split('.').pop().toLowerCase();
    if ($.inArray(extension, ['csv', 'xls', 'xlsx']) == -1) {
        $('#orgfile').after('<span id="import-error" class="text-danger" <strong>Please Select Valid File...<strong></span>');
    } else {
        var file_data = $('#orgfile').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('_token', "{{ csrf_token() }}");

        $.ajax({
            url         : "{{ route('orgimport') }}",
            dataType    : 'text',           // what to expect back from the PHP script, if anything
            cache       : false,
            contentType : false,
            processData : false,
            data        : form_data,                         
            type        : 'post',
            success     : function(response){
                if(response == 'success') {
                    location.reload();
                }
            },
            error: function(){
                $('#orgfile').after('<span id="import-error" class="text-danger" <strong> Duplicate name error. <strong></span>');
            }
        });
    }
});
</script>
@endsection