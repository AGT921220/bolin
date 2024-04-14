<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                        </ul>


                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-language nav-item">

                        @if(Session::get('locale') == "en"  || !Session::has('locale'))
                        <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span class="selected-language">@lang('app.lang_english')</span></a>
                        @endif

                        @if(Session::get('locale') == "hi")
                        <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-in"></i><span class="selected-language">@lang('app.lang_hindi')</span></a>
                        @endif


                        @if(Session::get('locale') == "fr")
                        <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-fr"></i><span class="selected-language">@lang('app.lang_french')</span></a>
                        @endif

                        @if(Session::get('locale') == "ae")
                        <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-ae"></i><span class="selected-language">@lang('app.lang_arebic')</span></a>
                        @endif
                        @if(Session::get('locale') == "es")
                        <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-lang_spanish"></i><span class="selected-language">@lang('app.lang_spanish')</span></a>
                        @endif

                        <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                        <a class="dropdown-item" href="{{ Asset('setLang?lang=en') }}" data-language="en"><i class="flag-icon flag-icon-us"></i> @lang('app.lang_english')</a>
                        <a class="dropdown-item" href="{{ Asset('setLang?lang=hi') }}" data-language="hi"><i class="flag-icon flag-icon-in"></i> @lang('app.lang_hindi')</a>
                        <a class="dropdown-item" href="{{ Asset('setLang?lang=fr') }}" data-language="fr"><i class="flag-icon flag-icon-fr"></i> @lang('app.lang_french')</a>
                        <a class="dropdown-item" href="{{ Asset('setLang?lang=ae') }}" data-language="ae"><i class="flag-icon flag-icon-ae"></i> @lang('app.lang_arebic')</a>
                        <a class="dropdown-item" href="{{ Asset('setLang?lang=es') }}" data-language="es"><i class="flag-icon flag-icon-es"></i> @lang('app.lang_spanish')</a>

                        </div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon feather icon-maximize"></i></a></li>


                    </ul>
                </div>
            </div>
        </div>
    </nav>

