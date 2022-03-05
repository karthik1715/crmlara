<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ URL::asset('public/assets/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            Admin
                            <span class="user-level">Administrator</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a href="{{url('/dashboard')}}">
                        <i class="flaticon-analytics"></i>
                            <p>{{ __('app.dashboard.title') }}</p>
                    </a>
                </li>
                <!-- <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">{{ __('app.dashboard.component') }}</h4>
                </li> -->
                <li class="nav-item">
                    <a data-toggle="collapse" href="#contacts">
                        <i class="fas fa-address-book"></i>
                        <p>{{ __('app.dashboard.contacts') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="contacts">
                        <ul class="nav nav-primary nav-collapse">
                            <li>
                                <a href="{{url('/contact')}}">
                                    <i class="fas fa-user"></i>
                                    <span class="sub-item">{{ __('app.contacts.person.title') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/organization')}}">
                                    <i class="fas fa-building"></i>
                                    <span class="sub-item">{{ __('app.contacts.organization.title') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#maps">
                        <i class="fas fa-briefcase"></i>
                        <p>{{ __('app.dashboard.marketing') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="maps">
                        <ul class="nav nav-primary nav-collapse">
                            <li>
                                <a href="{{url('segment')}}">
                                    <i class="icon-target"></i>
                                    <span class="sub-item">{{ __('app.dashboard.segments') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fas fa-envelope"></i>
                                    <span class="sub-item">{{ __('app.general.emails') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/marketing/forms')}}">
                                    <i class="flaticon-interface-6"></i>
                                    <span class="sub-item">{{ __('app.dashboard.forms') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{url('campaign')}}">
                        <i class="fas fa-bullhorn"></i>
                        <p>{{ __('app.dashboard.campaigns') }}</p></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('deal')}}">
                        <i class="flaticon-price-tag"></i>
                        <p>{{ __('app.dashboard.deals') }}</p></span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#">
                    <i class="fas fa-calendar-alt"></i>
                        <p>{{ __('app.dashboard.activities') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#submenu">
                        <i class="fas fa-cog"></i>
                        <p>{{ __('app.dashboard.settings') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="submenu">
                        <ul class="nav nav-primary nav-collapse">
                            <li>
                                <a data-toggle="collapse" href="#subnav1">
                                    <i class="fas fa-user-cog"></i>
                                    <span class="sub-item">{{ __('app.dashboard.user_settings') }}</span>
                                </a>
                                <a data-toggle="collapse" href="#subnav1">
                                    <i class="fas fa-users-cog"></i>
                                    <span class="sub-item">{{ __('app.dashboard.team_settings') }}</span>
                                </a>
                                <a data-toggle="collapse" href="#subnav1">
                                    <i class="fas fa-draw-polygon"></i>
                                    <span class="sub-item">{{ __('app.dashboard.pipeline') }}</span>
                                </a>
                                <a data-toggle="collapse" href="#subnav1">
                                    <i class="fas fa-ticket-alt"></i>
                                    <span class="sub-item">{{ __('app.dashboard.ticket') }}</span>
                                </a>
                                <a data-toggle="collapse" href="#subnav1">
                                    <i class="fas fa-cubes"></i>
                                    <span class="sub-item">{{ __('app.dashboard.audit_trail') }}</span>
                                </a>
                                <!-- <div class="collapse" id="subnav1">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div> -->
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>