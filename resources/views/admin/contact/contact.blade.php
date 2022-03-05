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
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header row">
                        <div class="col-md-7">
                            <h4 class="card-title">{{ __('app.contacts.person.clist') }}</h4>
                        </div>
                        <div class="col-md-5">
                            <a class="btn btn-primary btn-round ml-auto" href = "#updatePeopleModal" data-target="#updatePeopleModal" data-toggle="modal" ><i class="fa fa-upload"></i>{{ __('app.general.import') }}</a>
                            <a class="btn btn-primary btn-round ml-auto" href="{{ route('contactexport') }}"><i class="fa fa-download"></i>{{ __('app.general.export') }}</a>
                            <a class="btn btn-primary btn-round ml-auto" href = "{{ route('contact.create') }}"><i class="fa fa-plus"></i>{{ __('app.contacts.person.add-title') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        <div class="modal fade" id="deleteConfModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                            {{ __('app.contacts.person.dlist') }} </span> 
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="#" method="get" class="remove-record-model">
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
                                            {{ __('app.contacts.person.upload-title') }} </span> 
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12 mb-2">
                                                <label>{{ __('app.general.choose') }}</label>
                                                <input type="file" id="contactfile" class="form-control">
                                            </div>
                                            <div class="col-sm-12 mb-2">
                                                <label>{{ __('app.general.sample') }}</label>
                                                <span><a href="{{ URL::asset('public/assets/img/contact.csv') }}" >{{ __('app.general.dsample') }}</a></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0 d-flex align-items-center">
                                        <button type="submit" id="contactImport" class="btn btn-primary">{{ __('app.general.submit') }}</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('app.general.cancel') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <form action="{{ route('contact.list') }}" >
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
                            <table class="display table table-striped table-hover">
                                @include('includes.flash-message')
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>{{ __('app.general.id') }}</th>
                                        <th>{{ __('app.contacts.organization.organization_name') }}</th>
                                        <th>{{ __('app.general.name') }}</th>
                                        <th>{{ __('app.general.email') }}</th>
                                        <th>{{ __('app.general.phone') }}</th>
                                        <th>{{ __('app.contacts.person.visiblity') }}</th>
                                        <th>{{ __('app.general.actions') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($contacts as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->organization->name??'-' }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>-</td>
                                            <td>
                                            <a href="{{ route('contact.edit',$item->id) }}">
                                                <i class="fa fa-edit"></i>
                                            </a> 
                                            |
                                            <a class="text-danger remove-record" data-id="{{$item->id}}" data-url="{{ route('contact.delete',$item->id) }}" data-toggle="modal" data-target="#deleteConfModal">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            </td>
                                        </tr>
                                        @empty
                                            </tr><td colspan='7' align="center">{{ __('app.general.norecord') }}</td></tr>
                                        @endforelse
                                    </tbody>
                            </table>
                            @if ($contacts->links()->paginator->hasPages())
                                @php
                                    $from   = ($contacts->perPage()*($contacts->currentPage()-1))+1;
                                    $to     = ($contacts->currentPage() * $contacts ->perPage()) ;
                                    $total  = $contacts->total();
                                    $cal = ( $to >$total )? $total : $to ;
                                    $search = isset($_GET['q']) ? $_GET['q']: '';
                                @endphp
                                <div class="mt-4 p-4 box has-text-centered">
                                    Showing {{ $from }} to {{ $cal }} of {{ $total  }} 
                                </div>
                                <div class="d-flex justify-content-center">
                                    {!! $contacts->appends(['q' => $search ])->links() !!}
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
$('.remove-record').click(function() {
    var id = $(this).attr('data-id');
    var url = $(this).attr('data-url');
    $(".remove-record-model").attr("action",url);
});

$('#contactImport').on('click', function(e) {
    
    e.preventDefault();
    $("#import-error").html('');

    var extension = $('#contactfile').val().split('.').pop().toLowerCase();
    if ($.inArray(extension, ['csv', 'xls', 'xlsx']) == -1) {
        $('#contactfile').after('<span id="import-error" class="text-danger" <strong>Please Select Valid File...<strong></span>');
    } else {
        var file_data = $('#contactfile').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('_token', "{{ csrf_token() }}");

        $.ajax({
            url         : "{{ route('contactimport') }}",
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
                $('#contactfile').after('<span id="import-error" class="text-danger" <strong> Duplicate email error. <strong></span>');
            }
        });
    }
});
</script>
@endsection
