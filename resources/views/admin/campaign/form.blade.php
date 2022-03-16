@extends('layouts.default')
@section('title')
    {{ __('app.campaigns.title') }}
@stop
@section('content')

@if(isset($campaign) && isset( $campaign->campaignDetail)) 
    @if( $campaign->campaignDetail->campaign_status == 'active')
        <script>alert('Opps! You do not have access');window.location = "{{route('campaign.list')}}"</script>
    @endif
@endif

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
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{route('campaign.list')}}">{{ __('app.campaigns.title') }}</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <!-- Tab navigation -->
                    <!-- <form role="form" method="POST" enctype="multipart/form-data"> -->
                    <div class="tabControl">
                        <div class="container"  id="crumbs">
                            <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-1" role="tab">{{ __('app.campaigns.title-detail') }}</a>
                                </li>
                                <li class="nav-item disabled" id="recipien_li" >
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-2" role="tab">{{ __('app.campaigns.recipient') }}</a>
                                </li>
                                <li class="nav-item disabled" id="template_li">
                                    <a class="nav-link" id="pills-template-tab" data-toggle="pill" href="#pills-3" role="tab">{{ __('app.campaigns.select-template') }}</a>
                                </li>
                                <li class="nav-item disabled" id="schedule_li">
                                    <a class="nav-link" id="pills-schedule-tab" data-toggle="pill" href="#pills-4" role="tab">{{ __('app.campaigns.publish-details') }}</a>
                                </li>
                                <li class="nav-item disabled" id="finish_li">
                                    <a class="nav-link" id="pills-finish-tab" data-toggle="pill" href="#pills-5" role="tab">{{ __('app.campaigns.finish') }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="card-header">
                                    <div class="card-title">{{ __('app.campaigns.add-title-detail') }}</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 form-group">
                                            <label for="name">{{ __('app.campaigns.title-name') }}</label>
                                            <span class="required">*</span>
                                            <input type="hidden" id="hiddenCampaignId" value="{{ $campaign->id ?? '' }}">
                                            <input type="hidden" id="hiddenUrl" value="{{ isset($campaign) ? route('campaign.update',$campaign->id) : route('campaign.create') }}">
                                            
                                            <input type="text" class="form-control" id="campname" value="{{ $campaign->name ?? '' }}" required >
                                        </div>
                                        <div class="col-md-6 col-lg-6 form-group">
                                            <label for="subject">{{ __('app.general.subject') }}</label>
                                            <span class="required">*</span>
                                            <input type="text" class="subject form-control" id="subject" value="{{ $campaign->subject ?? '' }}" required>
                                        </div>
                                        <div class="col-md-6 col-lg-6 form-group">
                                            <label for="exampleFormControlSelect1">{{ __('app.settings.category.title')  }}</label>
                                            <button class="btn btn-xs pull-right btn-primary mb-1"data-target="#addCategoryModal" data-toggle="modal">
                                                <i class="fa fa-plus"></i>
                                                &nbsp;{{ __('app.settings.category.addcategory')  }}
                                            </button>
                                            <input type="text" class="subject form-control categoryList" id="categoryList" value="{{ $campaign->category->name ?? '' }}">
                                            <input type="hidden" id="hiddenCategoryId" value="{{ $campaign->category_id ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12" >
                                    <a class="btn btn-primary text-white" id="btnNext1">Next</a>
                                    <a class="btn btn-success text-white">Save Draft</a>
                                    <a class="btn btn-danger" href = "{{ route('campaign.list') }}"><i class="fa fa-window-close"></i>
                            <span>{{ __('app.general.cancel') }}</span></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="card-header">
                                    <div class="card-title">{{ __('app.campaigns.select-segment-campaign') }}</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 form-group">
                                            <label for="exampleFormControlSelect1">{{ __('app.campaigns.select-segment') }}</label>
                                            <span class="required">*</span>
                                            <input type="text" class="form-control segmentList" id="segmentList" value="{{ $campaign->segment->name ?? '' }}" >
                                            <input type="hidden" id="hiddenSegmentId" value="{{ $campaign->segment_id ?? '' }}">
                                        </div>
                                        <div class="col-md-6 col-lg-6 form-group">
                                            <label for="name">
                                            {{ __('app.campaigns.create-new-segment-campaign') }}</label><br>
                                            <button type="button" class="btn btn-primary">{{ __('app.segment.create-title') }}</button>
                                        </div>
                                        <div class="col-md-4 col-lg-4 form-group">
                                            <label id="seg_name"></label>
                                            <p id="seg_desc"></p>
                                        </div>
                                        <div class="col-md-4 col-lg-4 form-group">
                                            <p class="d-none" id="created_on">Created on</p>
                                            <label id="seg_created_at"></label>
                                        </div>
                                        <div class="col-md-4 col-lg-4 form-group">
                                            <label id="seg_count"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="navbuttons row text-center">
                                    <div class="col-lg-12 col-sm-12 d-flex">
                                        <div>
                                            <a class="btn btn-warning btnPrevious">Previous</a>
                                            <a class="btn btn-primary text-white" id="btnNext2">Next</a>
                                            <a class="btn btn-md btn-success text-white">Save Draft</a>
                                            <a class="btn btn-danger" href = "{{ route('campaign.list') }}"><i class="fa fa-window-close"></i>
                                                <span>{{ __('app.general.cancel') }}</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-template-tab">
                                <div class="row col-12 ">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="address">{{ __('app.general.msg') }}</label>
                                            <textarea class="form-control" name="template_content[]" id="template_content" > @isset( $campaign) {{ $campaign->campaignDetail->template_content ?? '' }} @endisset
                                            </textarea>
                                            <input type="hidden" name="selectAttribute" id="selectAttribute" />
                                        </div>
                                    </div>
                                </div>
                                <div class="navbuttons row text-center">
                                    <div class="col-lg-12 col-sm-12 d-flex">
                                        <div>
                                            <a class="btn btn-warning btnPrevious">Previous</a>
                                            <a class="btn btn-primary text-white" id="btnNext3">Next</a>
                                            <a class="btn btn-md btn-success text-white">Save Draft</a>
                                            <a class="btn btn-danger" href = "{{ route('campaign.list') }}"><i class="fa fa-window-close"></i>
                                            <span>{{ __('app.general.cancel') }}</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-4" role="tabpanel" aria-labelledby="pills-schedule-tab">
                                <div class="card-header">
                                    <div class="card-title">{{ __('app.campaigns.add-title-detail') }}</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4 form-group">
                                            <label for="exampleFormControlSelect1">{{ __('app.campaigns.sender-name') }}</label>
                                            <span class="required">*</span>
                                            <input type="text" class="form-control" id="sender_name" value="{{ $campaign->campaignDetail->sender_name ?? '' }}" >
                                        </div>
                                        <div class="col-md-4 col-lg-4 form-group">
                                            <label for="exampleFormControlSelect1">{{ __('app.campaigns.sender-email') }}</label>
                                            <span class="required">*</span>
                                            <input type="text" class="form-control" id="sender_email" value="{{ $campaign->campaignDetail->sender_email ?? '' }}" >
                                        </div>
                                        <div class="col-md-4 col-lg-4 form-group">
                                            <a class="btn btn-primary btnNext">{{ __('app.general.verify-email') }}</a>
                                            <p>{{ __('app.general.verify-email-msg') }}</p>
                                        </div>
                                        <div class="row col-md-12 col-lg-12 border-bottom">
                                            <div class="col-md-4 col-lg-4 form-group">
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="sender_reply_email_status" @if(isset($campaign) && isset( $campaign->campaignDetail)) {{ ( $campaign->campaignDetail->sender_reply_email_status == "1" )? "checked" : "" }} @endif >
                                                    <span class="form-check-sign">{{ __('app.campaigns.reply-content') }}</span>
                                                </label>
                                            </div>
                                            <div class="col-md-4 col-lg-4 form-group d-none" id="reply_email_div">
                                                <label for="exampleFormControlSelect1">{{ __('app.campaigns.reply-tomail') }}</label>
                                                <span class="required">*</span>
                                                <input type="text" class="form-control" id="sender_reply_email" value="{{ $campaign->campaignDetail->sender_reply_email ?? '' }}" >
                                            </div>
                                        </div>
                                        <div class="row col-md-12 col-lg-12 border-bottom">
                                            <div class="col-md-3 col-lg-3 form-group pl-4">
                                                <label class="form-radio-label">
                                                    <input class="form-radio-input" type="radio" name="sender_email_service_type" value="0" @if(isset($campaign) && isset( $campaign->campaignDetail)) {{ ( $campaign->campaignDetail->sender_email_service_type == "0" )? "checked" : "" }} @endif >
                                                    <span class="form-radio-sign">Coderz Email Service</span>
                                                </label>
                                            </div>
                                            <div class="col-md-3 col-lg-3 form-group">
                                                <label class="form-radio-label ml-3">
                                                    <input class="form-radio-input" type="radio" name="sender_email_service_type" value="1" @if(isset($campaign) && isset( $campaign->campaignDetail)) {{ ( $campaign->campaignDetail->sender_email_service_type == "1" )? "checked" : "" }} @endif >
                                                    <span class="form-radio-sign">Use My Own</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row col-md-12 ml-2 d-flex pl-0 p-3 border-bottom">
                                            <div class="col-md-1 col-lg-1 form-group">
                                                <label>Send Now</label>
                                            </div>
                                            <div class="col-md-1 col-lg-1 form-group">
                                                <label class="switch">
                                                    <input type="checkbox" id="schedule_status" @if(isset($campaign) && isset( $campaign->campaignDetail)) {{ ( $campaign->campaignDetail->schedule_status == "1" )? "checked" : "" }} @endif >
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-2 col-lg-2 form-group">
                                                <label>Schedule For Later</label>
                                            </div>
                                            <div class="col-md-4 col-lg-4 form-group d-none" id="schedule_datetime_div">
                                                <label for="exampleFormControlSelect1">{{ __('app.campaigns.schedule-datetime') }}</label>
                                                <!-- <span class="required">*</span> -->
                                                <input type="datetime-local" data-clear-btn = "true" 
                                                    class="form-control" id="schedule_datetime" 
                                                    @php 
                                                    $schdtime = '';
                                                    @endphp        
                                                        @if(isset($campaign) && isset( $campaign->campaignDetail))
                                                            @if($campaign->campaignDetail->schedule_datetime != null || $campaign->campaignDetail->schedule_datetime != '') 
                                                                {{ $schdtime = trim(date('Y-m-d\TH:i', strtotime($campaign->campaignDetail->schedule_datetime))) }}
                                                            @else 
                                                                {{ $schdtime }}
                                                            @endif  
                                                        @endif value="{{trim($schdtime)}}"
                                                    >
                                            </div>
                                        </div>
                                        <div class="row col-md-12 ml-3 p-2">
                                            <label class="text-primary">
                                                <i class="fas fa-envelope"></i>
                                                <b>Send Test Email</b>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="navbuttons row text-center">
                                    <div class="col-lg-12 col-sm-12 d-flex">
                                        <div>
                                            <a class="btn btn-warning btnPrevious">Previous</a>
                                            <a class="btn btn-md btn-success text-white">Save Draft</a>
                                            <a class="btn btn-primary text-white" id="btnNext4" >Send</a>
                                            <a class="btn btn-danger" id="btnCancel4" href = "{{ route('campaign.list') }}"><i class="fa fa-window-close"></i>
                                            <span>{{ __('app.general.cancel') }}</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-5" role="tabpanel" aria-labelledby="pills-finish-tab">
                                <div class="card-header pb-0">
                                    <div class="card-title" id="card-title">Campaign Scheduled</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>Publish date</label>
                                            <p id="publish_date">{{ $campaign->campaignDetail->schedule_datetime ?? '-' }}</p>
                                        </div>
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <p>Segment Name</p>
                                            <label id="camp_seg_name">{{ $campaign->segment->name ?? '' }}</label>
                                        </div>
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <p>Campaign Status</p>
                                            <label id="camp_status">{{ $campaign->campaignDetail->campaign_status ?? '' }}</label>
                                        </div>
                                        <div class="col-md-3 col-lg-3 form-group">
                                        <div id="btnNext">
                                            <a href="{{url('campaign')}}" class="btn btn-primary">Go to Campaigns</a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    {{ __('app.settings.category.title') }}</span> 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12 form-group">
                        <label for="name">{{ __('app.settings.category.cat_name') }}</label><span class="required">*</span>
                        <input type="text" class="form-control" id="cat_name" required >
                    </div>
                    <div class="col-md-12 col-lg-12 form-group">
                        <label for="description">{{ __('app.general.description') }}</label>
                        <textarea class="form-control" id="cat_description" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 d-flex align-items-center">
                <button type="button" id="addCategoryButton" class="btn btn-primary">{{ __('app.general.submit') }}</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ownTemplateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">
                    <span class="fw-mediumbold">
                    {{ __('app.campaigns.add-email') }}</span> 
                </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body border-bottom">
                <div class="row">
                    <div class="col-md-6 col-lg-6 form-group">
                        <label for="name">{{ __('app.campaigns.sender-name') }}</label><span class="required">*</span>
                        <input type="text" class="form-control" id="send_name" name="name" required >
                    </div>
                    <div class="col-md-6 col-lg-6 form-group">
                        <label for="name">{{ __('app.campaigns.email-address') }}</label><span class="required">*</span>
                        <input type="text" class="form-control" id="mailAdd" name="mailAdd" required >
                    </div>
                    <div class="col-md-6 col-lg-6 form-group">
                        <label for="name">{{ __('app.campaigns.user-name') }}</label><span class="required">*</span>
                        <input type="text" class="form-control" id="user_name" name="name" required >
                    </div>
                    <div class="col-md-6 col-lg-6 form-group">
                        <label for="name">{{ __('app.campaigns.password') }}</label><span class="required">*</span>
                        <input type="text" class="form-control" id="password" name="mailAdd" required >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 pl-2">
                        <h3 class="">{{ __('app.campaigns.outgoingMail') }} (Smtp)</h3>
                    </div>
                    <div class="col-md-6 col-lg-6 form-group">
                        <label for="name">{{ __('app.campaigns.server') }}</label><span class="required">*</span>
                        <input type="text" class="form-control" id="server" name="name" required >
                    </div>
                    <div class="col-md-6 col-lg-6 form-group">
                        <label for="name">{{ __('app.campaigns.port') }}</label><span class="required">*</span>
                        <input type="text" class="form-control" id="port" name="mailAdd" required >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 pl-2">
                        <h3 class="">{{ __('app.campaigns.serverSecurity') }}</h3>
                    </div>
                    <div class="col-md-6 col-lg-6 form-group">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" value="">
                            <span class="form-check-sign">{{ __('app.campaigns.allow-non-sec-cert') }}</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="text-center pt-2 pb-2">
                <button type="button" class="btn btn-primary">{{ __('app.general.save') }}</button>
                <button type="button" class="btn btn-danger">{{ __('app.general.cancel') }}</button>
            </div>
        </div>
    </div>
</div>

@stop

@section('script')

<!-- <link href="https://www.tiny.cloud/css/codepen.min.css" rel="stylesheet"> -->
<link  href="{{ URL::asset('public/assets/css/codepen.min.css') }}" rel="stylesheet">
<!-- <script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/4/tinymce.min.js"></script> -->
<script src="https://cdn.tiny.cloud/1/pkp3n4ts67rrsdc1suga58o81bf27rdet3h6x3jjrr7pdqcv/tinymce/4/tinymce.min.js"></script>
<!-- <script src="{{ URL::asset('public/assets/js/tinymce.min.js') }}"></script> -->

 <!-- <script src="https://cdn.tiny.cloud/1/pkp3n4ts67rrsdc1suga58o81bf27rdet3h6x3jjrr7pdqcv/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
 <!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>   -->
 
<script>
var myResponse;

$(function(){ 
    var template = 'template'
    var url = "{{url('attributevalue')}}";
    $.ajax({
        url: url,
        type: 'POST',
        dataType    :"json",
        data: { 
            _token   : "{{ csrf_token() }}",
            template : template,
        },
        success: function (response) {
            console.log(response);
            myResponse = response;
        },
        error: function (ex) {
            alert(ex.responseText);
        }
    });
});

var editor_config = {
    selector        : "#template_content",
    menubar         : true,
    height          : 300,
    plugins         : [
                        ' advlist autolink lists link image charmap print preview anchor',
                        ' searchreplace visualblocks code fullscreen',
                        ' insertdatetime media table paste code help wordcount',
                        ' emoticons template paste textpattern '
                     ],
    // toolbar         :   ' addcomment showcomments casechange checklist  export formatpainter pageembed permanentpen insertfile |' +
    //                     ' undo redo | mybutton | styleselect | ' +
    //                     ' bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | ' + 
    //                     ' bullist numlist outdent indent | link image | media | fullscreen fontsizeselect removeformat help ',

    toolbar: ' addcomment showcomments casechange checklist  export formatpainter pageembed permanentpen insertfile |' +
             ' undo redo | mybutton styleselect | fontselect fontsizeselect  | ' +
             ' bold italic underline strikethrough | alignleft aligncenter alignright alignjustify outdent indent | ' + 
             ' forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | ' + 
             ' bullist numlist | link image | media | pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment | fullscreen removeformat help ',

    toolbar_mode    : 'floating',    
    tinycomments_mode: 'embedded',
    path_absolute   :"/",
    tinycomments_author: 'Author name',
        content_css : [
        "//fonts.googleapis.com/css?family=Lato:300,300i,400,400i",
        "{{ URL::asset('public/assets/css/codepen.min.css') }}"],
    
    /* without images_upload_url set, Upload tab won't show up*/
    images_upload_url: "{{url('upload')}}",
    /* we override default upload handler to simulate successful upload*/
    images_upload_handler: function (blobInfo, success, failure) {
        // setTimeout(function () {
        // /* no matter what you upload, we will turn it into TinyMCE logo :)*/
        // success('http://moxiecode.cachefly.net/tinymce/v9/images/logo.png');
        // }, 1000);

        var xhr, formData;
           xhr = new XMLHttpRequest();
           xhr.withCredentials = false;
           xhr.open('POST', "{{url('upload')}}");
           var token = '{{ csrf_token() }}';
           xhr.setRequestHeader("X-CSRF-Token", token);
           xhr.onload = function() {
               var json;
               if (xhr.status != 200) {
                   failure('HTTP Error: ' + xhr.status);
                   return;
               }
               json = JSON.parse(xhr.responseText);

               if (!json || typeof json.location != 'string') {
                   failure('Invalid JSON: ' + xhr.responseText);
                   return;
               }
               // console.log(json.location);
               success('http://coderzvisiontech.com/crm/storage/app/' + json.location);
            //    success(json.location);
           };
           formData = new FormData();
           formData.append('file', blobInfo.blob(), blobInfo.filename());
           xhr.send(formData);
    },
    
    setup: function(editor) {
        
        function intialize( data, editor ) {
            var uniqueArray = [];
            for (var i = 0; i < data.length; i++){
                
                if(data[i].count == undefined || data[i].count == 1 ) {
                    data[i].onclick = function (index) {
                        return function() { 
                            if(uniqueArray.indexOf(index) === -1) {
                                uniqueArray.push(index);
                                $("#selectAttribute").val(uniqueArray);
                            }
                            editor.insertContent('&nbsp;<em>{% '+ data[index].value +' %}</em>');
                        }
                    }(i); 
                } else {
                    var count = data[i].count;
                    if(count > 0) {
                        for (var j = 0; j < count; j++){
                            
                            data[i].menu[j].onclick = function (index1) {
                                return function() { 
                                    editor.insertContent('&nbsp;<em>{% '+ this.settings.value +' %}</em>');
                                }
                            }(j); 

                        }
                    }
                }
            }
            return data;
        }

        editor.addButton('mybutton', {
            type        : 'splitbutton',
            text        : 'Placeholders',
            icon        : false,
            onclick: function() {
                // editor.insertContent('&nbsp;<strong>You clicked the button!</strong>');
            },
            menu:intialize( myResponse, editor ),
        });
    },
};

setTimeout(function() { 
    tinymce.init(editor_config);
}, 1000);

var id  = $("#hiddenCampaignId").val();
if( id != '') {
    $('#crumbs > ul > li').removeClass('disabled');
}

var schedulecheck = (document.getElementById('schedule_status').checked ? 1: 0);
if(schedulecheck == 1) {
    $("#schedule_datetime_div").removeClass('d-none'); 
} else {
    $("#schedule_datetime_div").addClass('d-none'); 
}

$('#btnNext1').on('click', function(e) {
    
    var name = $("#campname").val();
    var subject = $("#subject").val();

    if( name =='' ){
        $('#campname').css("border","2px solid red");
        // $('#campname').css("box-shadow","0 0 3px red");
        return false;
    }
    if( subject =='' ){
        $('#subject').css("border","2px solid red");
        return false;
    }
    else {
        $('#campname').css("border","");
        $('#subject').css("border","");
        $('#pills-profile-tab').trigger('click');
        $("#recipien_li").removeClass('disabled'); 
    }
});

$('#btnNext2').on('click', function(e) {
    
    var segmentList = $("#segmentList").val();

    if( segmentList =='' ){
        $('#segmentList').css("border","2px solid red");
        return false;
    }
    else {
        $('#segmentList').css("border","");
        $('#pills-template-tab').trigger('click');
        $("#template_li").removeClass('disabled'); 
    }
    
});

$('#btnNext3').on('click', function(e) {
  
    $('#pills-schedule-tab').trigger('click');
    $("#schedule_li").removeClass('disabled'); 
    
});

$('#sender_reply_email_status').on('click', function(e) {
    $replycheck = (this.checked)? 1 : 0;
    if($replycheck == 1) {
        $("#reply_email_div").removeClass('d-none'); 
    } else {
        $("#reply_email_div").addClass('d-none'); 
    }
});

$('#schedule_status').on('click', function(e) {
    $schedulecheck = (this.checked)? 1 : 0;
    if($schedulecheck == 1) {
        $("#schedule_datetime_div").removeClass('d-none'); 
        $("#btnNext4").html("{{ __('app.general.schedule') }}"); 
    } else {
        $("#schedule_datetime_div").addClass('d-none'); 
        $("#btnNext4").html("{{ __('app.general.send') }}");
    }
});

$('#btnNext4').on('click', function(e) {

    var id  = $("#hiddenCampaignId").val();

    if( id != '') {
        var _method = "POST"; // instead of PUT method.
    }
    else {
        var _method = "POST";
    }
    
    var name                        = $("#campname").val();
    var subject                     = $("#subject").val();
    var category_id                 = $("#hiddenCategoryId").val();
    var segment_id                  = $("#hiddenSegmentId").val();
    var template_content            = tinyMCE.get('template_content').getContent();
    
    var sender_name                 = $("#sender_name").val();
    var sender_email                = $("#sender_email").val();
    var sender_reply_email          = $("#sender_reply_email").val();
    var schedule_datetime           = $("#schedule_datetime").val();
    var sender_reply_email_status   = (document.getElementById('sender_reply_email_status').checked)? 1 : 0;
    var schedule_status             = (document.getElementById('schedule_status').checked)? 1: 0;
    var sender_email_service_type   = $("input[type=radio][name=sender_email_service_type]:checked").val()? 1 : 0;
    
    if( sender_name =='' ){
        $('#sender_name').css("border","2px solid red");
        return false;
    }
    if( sender_email =='' ){
        $('#sender_email').css("border","2px solid red");
        return false;
    }
    if( (sender_reply_email_status == 1) && (($("#sender_reply_email").val()) == '') ){
        $('#sender_reply_email').css("border","2px solid red");
        return false;
    } 

    var schedule_at                 = '';
    if(schedule_datetime != '') {
        var d = new Date(schedule_datetime)
        var date = d.toISOString().split('T')[0];
        var time = d.toTimeString().split(' ')[0];
        var schedule_at = date + ' ' +time;
    }

    var campaign_data   = new FormData();
    campaign_data.append('name', name);
    campaign_data.append('subject', subject);
    campaign_data.append('category_id', category_id);
    campaign_data.append('segment_id', segment_id);
    campaign_data.append('template_content', template_content);
    campaign_data.append('sender_name', sender_name);
    campaign_data.append('sender_email', sender_email);
    campaign_data.append('sender_reply_email_status', sender_reply_email_status);
    campaign_data.append('sender_reply_email', sender_reply_email);
    campaign_data.append('sender_email_service_type', sender_email_service_type);
    campaign_data.append('schedule_status', schedule_status);
    campaign_data.append('schedule_datetime', schedule_at);
    var segmentList = $('#segmentList').val();
    var url         = $("#hiddenUrl").val();
    $("#cat_response").html(''); 

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
    url         : url,
    dataType    :"json",
    cache       : false,
    contentType : false,
    processData : false,
    type        : _method,
    data        : campaign_data, 
    success     : function(response) {

            $("#err_response").html(''); 
            
            if(response) {
                
                $("#cat_response").html(''); 
                $('#sender_name').css("border","");
                $('#sender_email').css("border","");
                $('#sender_reply_email').css("border","");
                
                $('#pills-finish-tab').trigger('click');
                $("#finish_li").removeClass('disabled'); 

                if(response.campaign_status == 'draft') {
                    $('#card-title').before('<p id="cat_response" class="text-danger" <strong>'+ name +', '+ response.success + "{{ __('app.general.draft-msg') }}" +'<strong></p>');
                } else {
                    $('#card-title').before('<p id="cat_response" class="text-success" <strong>'+ name +', '+ response.success +'<strong></p>');
                }
                
                if( response.campaign_datetime == null || response.campaign_datetime == '' ) {
                    var scheduled_at = '-';
                }
                else {
                    var cd = new Date(response.campaign_datetime)
                    var date = cd.toISOString().split('T')[0];
                    var time = cd.toTimeString().split(' ')[0];
                    var scheduled_at = date + ' ' +time;
                }

                $("#publish_date").html(scheduled_at); 
                $("#camp_seg_name").html(segmentList); 
                $("#camp_status").html(response.campaign_status); 

                setTimeout(function() {
                    $('#card-title').hide();
                }, 3000);
            }
        },
        error: function(){
            $("#err_response").html(''); 
            $('#btnCancel4').after('<span>&nbsp</span><span id="err_response" class="text-danger" <strong>'+"Duplicate name error."+'<strong></span>');
        }
    })
});

$('input[name="sender_email_service_type"]').change(function() {
   if($(this).is(':checked') && $(this).val() == '1') {
        $('#ownTemplateModal').modal('show');
   }
});

</script>
@endsection