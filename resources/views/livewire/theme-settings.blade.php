<div class="ui-theme-settings" wire:ignore>
    {{-- <button type="button" id="TooltipDemo" class="btn-open-options btn btn-warning">
        <i class="fa fa-cog fa-w-16 fa-spin fa-2x"></i>
    </button> --}}
    <div class="theme-settings__inner">
        <div class="scrollbar-container">
            <div class="theme-settings__options-wrapper">
                <h3 class="themeoptions-heading">Layout Options
                </h3>
                <div class="p-3">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left mr-3">
                                        <div class="switch has-switch switch-container-class"
                                             data-class="fixed-header">
                                            <div class="switch-animate switch-on">
                                                <input type="checkbox"
                                                       {{ $headerPosition!= 0 ? 'checked' : '' }} data-toggle="toggle"
                                                       data-onstyle="success"
                                                       wire:change="changePosition('header-position')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Fixed Header
                                        </div>
                                        <div class="widget-subheading">Makes the header top fixed, always visible!
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left mr-3">
                                        <div class="switch has-switch switch-container-class"
                                             data-class="fixed-sidebar">
                                            <div class="switch-animate switch-on">
                                                <input type="checkbox"
                                                       {{ $sidebarPosition != 0 ? 'checked' : '' }} data-toggle="toggle"
                                                       data-onstyle="success"
                                                       wire:change="changePosition('sidebar-position')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Fixed Sidebar
                                        </div>
                                        <div class="widget-subheading">Makes the sidebar left fixed, always visible!
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left mr-3">
                                        <div class="switch has-switch switch-container-class"
                                             data-class="fixed-footer">
                                            <div class="switch-animate switch-off">
                                                <input type="checkbox"
                                                       {{ $footerPosition != 0 ? 'checked' : '' }} data-toggle="toggle"
                                                       data-onstyle="success"
                                                       wire:change="changePosition('footer-position')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Fixed Footer
                                        </div>
                                        <div class="widget-subheading">Makes the app footer bottom fixed, always
                                            visible!
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <h3 class="themeoptions-heading">
                    <div>
                        Header Options
                    </div>
                    <button type="button"
                            class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-header-cs-class"
                            data-class="" wire:click="changeColor('10','header-color')">
                        Restore Default
                    </button>
                </h3>
                <div class="p-3">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h5 class="pb-2">Choose Color Scheme
                            </h5>
                            <div class="theme-settings-swatches">
                                @foreach ($headerColors->slice(0,10) as $item)
                                    <div class="swatch-holder {{ $item->value }} switch-header-cs-class {{$headerColor==$item->value?'active':''}}"
                                         data-class="{{$item->value}}"
                                         wire:click="changeColor({{$item->id }},'header-color')"
                                    >
                                    </div>
                                @endforeach
                                <div class="divider">
                                </div>
                                @foreach ($headerColors->slice(10,36) as $item)
                                    <div class="swatch-holder {{ $item->value }} switch-header-cs-class {{$headerColor==$item->value?'active':''}}"
                                         data-class="{{$item->value}}"
                                         wire:click="changeColor({{$item->id }},'header-color')"
                                    >
                                    </div>
                                @endforeach
                            </div>
                        </li>
                    </ul>
                </div>
                <h3 class="themeoptions-heading">
                    <div>Sidebar Options</div>
                    <button type="button"
                            class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-sidebar-cs-class"
                            data-class="" wire:click="changeColor('46','sidebar-color')">
                        Restore Default
                    </button>
                </h3>
                <div class="p-3">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h5 class="pb-2">Choose Color Scheme
                            </h5>
                            <div class="theme-settings-swatches">
                                @foreach ($sidebarColors->slice(0,10) as $item)
                                    <div class="swatch-holder {{ $item->value }} switch-sidebar-cs-class {{$sidebarColor==$item->value?'active':''}}"
                                         data-class="{{$item->value}}"
                                         wire:click="changeColor({{ $item->id }},'sidebar-color')"
                                    >
                                    </div>
                                @endforeach
                                <div class="divider">
                                </div>
                                @foreach ($sidebarColors->slice(10,36) as $item)
                                    <div class="swatch-holder {{ $item->value }} switch-sidebar-cs-class {{$sidebarColor==$item->value?'active':''}}"
                                         data-class="{{$item->value}}"
                                         wire:click="changeColor({{ $item->id }},'sidebar-color')"
                                    >
                                    </div>
                                @endforeach
                            </div>
                        </li>
                    </ul>
                </div>
{{--                <h3 class="themeoptions-heading">--}}
{{--                    <div>Main Content Options</div>--}}
{{--                    <button type="button" class="btn-pill btn-shadow btn-wide ml-auto active btn btn-focus btn-sm">--}}
{{--                        Restore Default--}}
{{--                    </button>--}}
{{--                </h3>--}}
{{--                <div class="p-3">--}}
{{--                    <ul class="list-group">--}}
{{--                        <li class="list-group-item">--}}
{{--                            <h5 class="pb-2">Page Section Tabs--}}
{{--                            </h5>--}}
{{--                            <div class="theme-settings-swatches">--}}
{{--                                <div role="group" class="mt-2 btn-group">--}}
{{--                                    <button type="button"--}}
{{--                                            class="btn-wide btn-shadow btn-primary btn btn-secondary switch-theme-class"--}}
{{--                                            data-class="body-tabs-line">--}}
{{--                                        Line--}}
{{--                                    </button>--}}
{{--                                    <button type="button"--}}
{{--                                            class="btn-wide btn-shadow btn-primary active btn btn-secondary switch-theme-class"--}}
{{--                                            data-class="body-tabs-shadow">--}}
{{--                                        Shadow--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</div>
