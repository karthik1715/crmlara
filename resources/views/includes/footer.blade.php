<script src="{{ URL::asset('public/assets/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ URL::asset('public/assets/js/core/popper.min.js') }}"></script>
<script src="{{ URL::asset('public/assets/js/core/bootstrap.min.js') }}"></script>

<!-- jQuery UI -->
<script src="{{ URL::asset('public/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ URL::asset('public/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ URL::asset('public/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<!-- Chart JS -->
<script src="{{ URL::asset('public/assets/js/plugin/chart.js/chart.min.js') }}"></script>

<!-- jQuery Sparkline -->
<script src="{{ URL::asset('public/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Chart Circle -->
<script src="{{ URL::asset('public/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

<!-- Datatables -->
<script src="{{ URL::asset('public/assets/js/plugin/datatables/datatables.min.js') }}"></script>

<!-- Bootstrap Notify -->
<script src="{{ URL::asset('public/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

<!-- jQuery Vector Maps -->
<script src="{{ URL::asset('public/assets/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ URL::asset('public/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

<!-- Sweet Alert -->
<script src="{{ URL::asset('public/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<!-- Atlantis JS -->
<script src="{{ URL::asset('public/assets/js/atlantis.min.js') }}"></script>

<!-- Atlantis DEMO methods, don't include it in your project! -->
<script src="{{ URL::asset('public/assets/js/setting-demo.js') }}"></script>
<script src="{{ URL::asset('public/assets/js/demo.js') }}"></script>
<!-- Custom js file -->
<script src="{{ URL::asset('public/assets/js/customs.js') }}"></script>

<script src="{{ URL::asset('public/assets/js/typeahead.min.js') }}"></script>

<script type="text/javascript">

$(function(){
    $('.nav-primary li a').filter(function(){return this.href==location.href}).parent().addClass('active').siblings().removeClass('active')
    $('.nav-primary li a').click(function(){
        $(this).parent().addClass('active').siblings().removeClass('active');   
    })
})

// $('.nav-item  a').click(function(){
//     alert('hi');
//     $(this).parent().addClass('active').siblings().removeClass('active');
//     var liObj = $(this).closest('li');
//     liObj.find("a").addClass("active"); 
// });

// $('.nav-item  a').click(function(){
//     alert('hi');
//     $(this).parent().addClass('active').siblings().removeClass('active');
//     var liObj = $(this).closest('li');
//     liObj.find("a").addClass("active"); 
// });
// $(function(){
//     $('.nav-item > div > ul > li ').click(function () {
//         alert('hai');
//         var clickedItem = $( this );
//         clickedItem.addClass( "active" );
//         $( ".nav-primary .nav-item" ).each( function() {
//             $( this ).removeClass( "active" );
//         });
//     });
// });
// $(document).ready(function() {
    //     $( ".nav-primary .nav-item" ).bind( "click", function(event) {
    //         event.preventDefault();
    //         var clickedItem = $( this );
    //         $( ".nav-primary .nav-item" ).each( function() {
    //             $( this ).removeClass( "active" );
    //         });
    //         clickedItem.addClass( "active" );
    //     });
    // });

$('.btnNext').click(function() {
    $('.nav-pills .active').parent().next('li').find('a').trigger('click');
});

$('.btnPrevious').click(function() {
    $('.nav-pills .active').parent().prev('li').find('a').trigger('click');
});

$(':input.orgname').typeahead({
    source: function(query, process) {
        var path = "{{url('autocomplete-search')}}";
        $.get(path, { query: query }, function (data) {
            process(data);
        });
    },
    updater: function(item) {
        $('#hiddenOrganizationId').val(item.id);
        return item;
    }
});

$(':input.categoryList').typeahead({
    source: function(query, process) {
        var path = "{{url('catg-autocomplete-search')}}";
        $.get(path, { query: query }, function (data) {
            process(data);
        });
    },
    updater: function(item) {
        $('#hiddenCategoryId').val(item.id);
        return item;
    }
});

$(':input.segmentList').typeahead({
    source: function(query, process) {
        var path = "{{url('seg-autocomplete-search')}}";
        $.get(path, { query: query }, function (data) {
            if(!data.length) {
                $("#btnNext2").addClass('disabled');
            }
            process(data);
        });
    },
    updater: function(item) {

        $("#btnNext2").removeClass('disabled');

        if (item.created_at === null) {
            var created_at = '-';
        }
        else {
            var d = new Date(item.created_at)
            var date = d.toISOString().split('T')[0];
            var time = d.toTimeString().split(' ')[0];
            var created_at = date + ' ' +time;
        }
        if( item.id != '' ) {
            $("#created_on").removeClass('d-none');
            $('#hiddenSegmentId').val(item.id);
            $('#seg_name').html(item.name);
            $('#seg_desc').html(item.description);
            $('#seg_created_at').html(created_at);
            $('#seg_count').html(item.contacts.length + "{{ __('app.segment.contact') }}");
            return item;
        }
    }
});

function checkemail(email)
{
    $('#email-error').html('');
    var url = "{{url('checkemail')}}";
    $.ajax({
    url: url,
    type: 'POST',
    data: { 
        _token : "{{ csrf_token() }}",
        email: email,
    },
    }).done(function(response) {

    if(response == "Email is available.") {
        $('#email').after('<span id="email-error" class="text-success" <strong>'+response+'<strong></span>');
        $("#contact_submit").prop("disabled", false); 
    }
    else {
        $('#email').after('<span id="email-error" class="text-danger" <strong>'+response+'<strong></span>');
        $("#contact_submit").prop("disabled", true); 
    }

    });
}

$('#addCategoryButton').on('click', function(e) {
    var name = $('#cat_name').val();
    var description = $('#cat_description').val();
    var url = "{{url('addcategory')}}";
    $.ajax({
    url: url,
    type: 'POST',
    data: { 
        _token : "{{ csrf_token() }}",
        name: name,
        description: description,
    },
    success : function(response) {
            if(response == "ok") {
                $('#addCategoryButton').before('<span id="cat_response" class="text-success" <strong>'+"{{ __('app.settings.category.create-success') }}"+'<strong></span>');
                setTimeout(function() {
                    $('.close').trigger('click');
                    $('#cat_name').val('');
                    $('#cat_description').html('');
                    $('#cat_response').html('');
                }, 2000);
            }
            else {
                $('#caterr_response').html('');
                $('#addCategoryButton').before('<div id="caterr_response" class="text-danger" <strong>'+"{{ __('app.settings.category.create-success') }}"+'<strong></div>');
            }
        },
        error: function(){
            $('#caterr_response').html('');
            $('#addCategoryButton').before('<div id="caterr_response" class="text-danger" <strong>'+"Duplicate name error"+'<strong></div>');
        }
    })
});

(function() {
      var dragged, listener;

      console.clear();

      dragged = null;

      listener = document.addEventListener;

      listener("dragstart", (event) => {
        console.log("start !");
        return dragged = event.target;
      });

      listener("dragend", (event) => {
        return console.log("end !");
      });

      listener("dragover", function(event) {
        return event.preventDefault();
      });

      listener("drop", (event) => {
        console.log("drop !");
        event.preventDefault();
        if (event.target.className === "dropzone") {
          dragged.parentNode.removeChild(dragged);
          return event.target.appendChild(dragged);
        }
      });

    }).call(this);
</script>
