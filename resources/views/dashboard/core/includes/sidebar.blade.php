<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('/') }}" class="brand-link">
        <img src="{{asset("logo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">@lang('dashboard.Meem')</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset("img/user2-160x160.jpg")}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item  {{ in_array(request()->route()->getName(), ['/']) ? 'menu-open' : '' }}">
                    <a href="{{ url('/') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            @lang('dashboard.Home')
                        </p>
                    </a>
                </li>

                @if(auth()->user()->hasRole('super-admin'))
                <li class="nav-item  {{ in_array(request()->route()->getName(), ['roles.index' , 'roles.create' , 'roles.edit']) ? 'menu-open' : '' }}">
                    <a href="{{route('roles.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-key"></i>
                        <p>
                            @lang('dashboard.roles_and_permissions')
                        </p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->hasPermission('students-read'))
                <li class="nav-item {{ in_array(request()->route()->getName(), ['student.index', 'student.create', 'student.edit', 'student.show']) ? 'menu-open' : '' }}">
                    <a href="{{ route('student.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>
                            @lang('dashboard.Students')
                        </p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->hasPermission('payments-read'))
                    <li class="nav-item {{ in_array(request()->route()->getName(), ['courses_subscriptions.index', 'courses_subscriptions.show']) ? 'menu-open' : '' }}">
                        <a href="{{ route('courses_subscriptions.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-desktop"></i>
                            <p>
                                @lang('dashboard.courses_subscriptions')
                            </p>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('payments-read'))
                    <li class="nav-item {{ in_array(request()->route()->getName(), ['book_store.index', 'book_store.show']) ? 'menu-open' : '' }}">
                        <a href="{{ route('book_store.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-store"></i>
                            <p>
                                @lang('dashboard.store_sells')
                            </p>
                        </a>
                    </li>
                @endif


                @if(auth()->user()->hasPermission('admins-read') || auth()->user()->hasPermission('teachers-read') || auth()->user()->hasPermission('customs-read'))
                    <li class="nav-item has-treeview {{ in_array(request()->route()->getName(), ['admins.index' ,'admins.edit' ,'admins.create' , 'admins.show' , 'teachers.index' , 'teachers.edit' , 'teachers.create', 'teachers.show']) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                @lang('dashboard.Staff')
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            {{-- <li class="nav-item">
                                <a href="{{route('admins.index')}}" class="nav-link {{ in_array(request()->route()->getName(), ['admins.index', 'admins.create', 'admins.show', 'admins.edit']) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('dashboard.admins')</p>
                                </a>
                            </li> --}}

    {{--
                            <li class="nav-item">
                                <a href="{{route('teachers.index')}}" class="nav-link {{ in_array(request()->route()->getName(), ['teachers.index', 'teachers.create', 'teachers.show', 'teachers.edit']) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('dashboard.teachers')</p>
                                </a>
                            </li> --}}


                            @foreach($roles as $key => $value)
                                <li class="nav-item">
                                    <a href="{{ route('customs.index', $key) }}" class="nav-link {{ in_array(request()->route()->getName(), [$key.'.index', $key.'.create', $key.'.show', $key.'.edit']) ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ $value }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif





                @if(auth()->user()->hasPermission('fields-read'))
                    <li class="nav-item  {{ in_array(request()->route()->getName(), ['fields.index' , 'fields.create' , 'fields.edit']) ? 'menu-open' : '' }}">
                        <a href="{{route('fields.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                @lang('dashboard.fields')
                            </p>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('categories-read'))
                    <li class="nav-item  {{ in_array(request()->route()->getName(), ['categories.index' , 'categories.create' , 'categories.edit']) ? 'menu-open' : '' }}">
                        <a href="{{route('categories.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-bars"></i>
                            <p>
                                @lang('dashboard.categories')
                            </p>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('courses-read') || auth()->user()->hasPermission('standards-read') || auth()->user()->hasPermission('lectures-read'))
                    <li class="nav-item has-treeview {{ in_array(request()->route()->getName(), ['courses.index' ,'courses.edit' ,'courses.create' , 'courses.show' , 'standards.index' , 'standards.edit' , 'standards.create', 'standards.show','lectures.index' , 'lectures.edit' , 'lectures.create', 'lectures.show',]) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-school"></i>
                            <p>
                                @lang('dashboard.courses')
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('courses.index')}}" class="nav-link {{ in_array(request()->route()->getName(), ['courses.index', 'courses.create', 'courses.show', 'courses.edit']) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('dashboard.courses')</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{route('standards.index')}}" class="nav-link {{ in_array(request()->route()->getName(), ['standards.index', 'standards.create', 'standards.show', 'standards.edit']) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('dashboard.Standards')</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{route('lectures.index')}}" class="nav-link {{ in_array(request()->route()->getName(), ['lectures.index', 'lectures.create', 'lectures.show', 'lectures.edit']) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('dashboard.Lectures')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('exams-read'))
                    <li class="nav-item  {{ in_array(request()->route()->getName(), ['exams.index' , 'exams.create' , 'exams.edit','exams.show',]) ? 'menu-open' : '' }}">
                        <a href="{{route('exams.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-check-square"></i>
                            <p>
                                @lang('dashboard.Exams')
                            </p>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('books-read'))
                    <li class="nav-item  {{ in_array(request()->route()->getName(), ['books.index' , 'books.create' , 'books.edit','books.show',]) ? 'menu-open' : '' }}">
                        <a href="{{route('books.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                @lang('dashboard.book_store')
                            </p>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('coupons-read'))
                    <li class="nav-item  {{ in_array(request()->route()->getName(), ['coupons.index' , 'coupons.create' , 'coupons.edit','coupons.show',]) ? 'menu-open' : '' }}">
                        <a href="{{route('coupons.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-percent"></i>
                            <p>
                                @lang('dashboard.Coupons')
                            </p>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('payments-read'))
                    <li class="nav-item  {{ in_array(request()->route()->getName(), ['banks.index', 'banks.show', 'banks.edit' , 'banks.create']) ? 'menu-open' : '' }}">
                        <a href="{{route('banks.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-university"></i>
                            <p>
                                @lang('dashboard.banks')
                                {{--                                <span class="badge badge-danger right">{{ $bankTransfersCount }}</span>--}}
                            </p>
                        </a>
                    </li>
                @endif


                @if(auth()->user()->hasPermission('payments-read'))
                    <li class="nav-item  {{ in_array(request()->route()->getName(), ['bank_transfers.index', 'bank_transfers.show',]) ? 'menu-open' : '' }}">
                        <a href="{{route('bank_transfers.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-piggy-bank"></i>
                            <p>
                                @lang('dashboard.bank_transfers')
                                <span class="badge badge-danger right">{{ $paymentsCount }}</span>
{{--                                <span class="badge badge-danger right">{{ $bankTransfersCount }}</span>--}}
                            </p>
                        </a>
                    </li>
                @endif


                @if(auth()->user()->hasPermission('payments-read'))
                    <li class="nav-item  {{ in_array(request()->route()->getName(), ['payments.index', 'payments.show',]) ? 'menu-open' : '' }}">
                        <a href="{{route('payments.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-money-bill"></i>
                            <p>
                                @lang('dashboard.Payments')
                            </p>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('carts-read'))
                    <li class="nav-item  {{ in_array(request()->route()->getName(), ['carts.index' , 'carts.create' , 'carts.edit','carts.show',]) ? 'menu-open' : '' }}">
                        <a href="{{route('carts.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>
                                @lang('dashboard.left_carts')
                            </p>
                        </a>
                    </li>
                @endif



                @if(auth()->user()->hasPermission('inquiries-read'))
                    <li class="nav-item  {{ in_array(request()->route()->getName(), ['inquiries.index', 'inquiries.show',]) ? 'menu-open' : '' }}">
                        <a href="{{route('inquiries.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-question"></i>
                            <p>
                                @lang('dashboard.Inquiries')
                                <span class="badge badge-danger right">{{ $inquiriesCount }}</span>
                            </p>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('contacts-read'))
                    <li class="nav-item  {{ in_array(request()->route()->getName(), ['contacts.index' , 'contacts.edit','carts.show',]) ? 'menu-open' : '' }}">
                        <a href="{{route('contacts.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-address-book"></i>
                            <p>
                                @lang('dashboard.contacts')
                                <span class="badge badge-danger right">{{ $contactsCount }}</span>
                            </p>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('printRequests-read'))
                    <li class="nav-item has-treeview {{ in_array(request()->route()->getName(), ['requests.books.index' ,'requests.edit' ,'requests.certificates.index']) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-paste"></i>
                            <p>
                                @lang('dashboard.print_requests')
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('requests.books.index')}}" class="nav-link {{ in_array(request()->route()->getName(), ['requests.books.index']) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('dashboard.books')</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{route('requests.certificates.index')}}" class="nav-link {{ in_array(request()->route()->getName(), ['requests.certificates.index' ]) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('dashboard.certificates')</p>
                                </a>
                            </li>


                        </ul>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('structure-read'))
                    <li class="nav-item has-treeview {{ in_array(request()->route()->getName(), ['requests.books.index' ,'privacy.index' ,'about-us.index' , 'questions.index' , 'contact-us.index']) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-text-height"></i>
                            <p>
                                @lang('dashboard.content_pages')
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('home.index')}}" class="nav-link {{ in_array(request()->route()->getName(), ['home.index']) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('dashboard.home')</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('privacy.index')}}" class="nav-link {{ in_array(request()->route()->getName(), ['privacy.index']) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('dashboard.privacy_and_policy')</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('about-us.index')}}" class="nav-link {{ in_array(request()->route()->getName(), ['about-us.index']) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('dashboard.About Us')</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('common-questions.index')}}" class="nav-link {{ in_array(request()->route()->getName(), ['questions.index']) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('dashboard.common_questions')</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('contact-us.index')}}" class="nav-link {{ in_array(request()->route()->getName(), ['contact-us.index']) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('dashboard.Contact Us')</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{route('terms-conditions.index')}}" class="nav-link {{ in_array(request()->route()->getName(), ['terms-conditions.index']) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('dashboard.Terms_and_conditions')</p>
                                </a>
                            </li>



                        </ul>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('structure-read'))
                    <li class="nav-item  {{ in_array(request()->route()->getName(),['infos.edit'])? 'menu-open': '' }}">
                        <a href="{{ route('infos.edit') }}" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                @lang('dashboard.info_control')
                            </p>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('notifications-read'))

                <li class="nav-item ">
                        <a href="{{ route('devicetokens.edit') }}" class="nav-link">
                            <i class="nav-icon fas fa-mobile"></i>
                            <p>
                                @lang('dashboard.devicetokens')
                            </p>
                        </a>
                    </li>
                @endif

            </ul>


        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
