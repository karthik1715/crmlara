@extends('layouts.default')
@section('title')
    {{ __('app.deals.title') }}
@stop
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">{{ __('app.deals.pipeline') }}</h4>
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
                    <div class="card-body">                    
                        <div class="items">
                            <div class="card item item1">
                                <div class="card-header bb-0">
                            	</div>
                            	<div class="mt-5 text-center">
                                    <div id="cloneDiv"><i class="mt-3 fas fa-plus-circle fa-3x text-primary p-3"></i></div>
                                    <h4 class="card-title">{{ __('app.deals.add-new-stage') }}</h4>
                            		<p>Pipeline stages represent the steps<br>in your sales process</p>
                            	</div>
                            </div>
                            <span  id="boxes">
                                <div class="card border-1 item item2">
                                    <div class="card-header p-2">
                                        <h4 class="card-title">{{ __('app.deals.new-stage') }}</h4>
                                        <p class="mb-0">0 %&emsp;<i class="fas fa-calendar-alt"></i>&nbsp;0 days</p>
                                    </div>
                                    <div class="card-body p-2">
                                        <div class="form-group p-0">
                                            <label for="name">{{ __('app.general.name') }}</label><span class="required">*</span>
                                            <input type="text" class="form-control" name="name" placeholder="Name" value=""  required="">
                                        </div>
                                        <div class="form-group p-0 pt-1">
                                            <label for="help">Help Text</label>
                                            <input type="text" class="form-control" name="help" placeholder="Help Text" value="">
                                        </div>
                                        <div class="form-group p-0 pt-1">
                                            <label for="probability">Probability</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="probability"  placeholder="Probability" value="0">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group p-0 pt-1">
                                            <label for="rottingDays">Rotting Days</label>
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control" name="rottingDays"  placeholder="rottingDays" value="0">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Days</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </span>
                            <div class="card border-1 item item3">
                                <div class="card-header p-2">
                            		<h4 class="card-title">{{ __('app.deals.won-stage') }}</h4>
                            		<p class="mb-0">100 %&emsp;<i class="fas fa-calendar-alt"></i>&nbsp;0 days</p>
                            	</div>
                            	<div class="card-body p-2">
                                    <div class="form-group p-0">
                                        <label for="name">{{ __('app.general.name') }}</label><span class="required">*</span>
                                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{ __('app.deals.won-stage') }}"  required>
                                    </div>
                                    <div class="form-group p-0 pt-1">
                                        <label for="help">Help Text</label>
                                        <input type="text" class="form-control" name="help" placeholder="Help Text" value="{{ __('app.deals.won-stage') }}" readonly>
                                    </div>
                                    <div class="form-group p-0 pt-1">
                                        <label for="probability">Probability</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="probability"  placeholder="Probability" value="100" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group p-0 pt-1">
                                        <label for="rottingDays">Rotting Days</label>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" name="rottingDays"  placeholder="rottingDays" value="0">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Days</span>
                                            </div>
                                        </div>
                                    </div>
                            	</div>
                            </div>
                            <div class="card border-1 item item4">
                                <div class="card-header p-2">
                            		<h4 class="card-title">{{ __('app.deals.lost-stage') }}</h4>
                            		<p class="mb-0">0 %&emsp;<i class="fas fa-calendar-alt"></i>&nbsp;0 days</p>
                            	</div>
                            	<div class="card-body p-2">
                                    <div class="form-group p-0">
                                        <label for="name">{{ __('app.general.name') }}</label><span class="required">*</span>
                                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{ __('app.deals.lost-stage') }}"  required>
                                    </div>
                                    <div class="form-group p-0 pt-1">
                                        <label for="help">Help Text</label>
                                        <input type="text" class="form-control" name="help" placeholder="Help Text" value="{{ __('app.deals.lost-stage') }}" readonly>
                                    </div>
                                    <div class="form-group p-0 pt-1">
                                        <label for="probability">Probability</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="probability"  placeholder="Probability" value="0" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group p-0 pt-1">
                                        <label for="rottingDays">Rotting Days</label>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" name="rottingDays"  placeholder="rottingDays" value="0">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Days</span>
                                            </div>
                                        </div>
                                    </div>
                            	</div>
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

// addMore
let addbutton = document.getElementById("cloneDiv");
addbutton.addEventListener("click", function() {
  let boxes = document.getElementById("boxes");
  let clone = boxes.firstElementChild.cloneNode(true);
  boxes.appendChild(clone);
});

</script>
@stop
