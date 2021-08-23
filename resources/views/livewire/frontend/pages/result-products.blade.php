<div id="main-inner-page">
    <div class="container" wire:init="loadProducts">
        <h2 class="home-heading">{{$q?$q:$category->name??'Search Products'}}</h2>
        <div class="row main-content-wrap">
            <div class="col-lg-3">
                <button class="filter-btn d-lg-none d-block" id="menu-toggle"><i class="fa fa-filter"
                                                                                 aria-hidden="true"></i> Filter
                </button>
                <form action="{{route('search-results')}}" method="get">
                    <input class="form-control" type="hidden" placeholder="" name="categoryId"
                           value="{{$categoryId}}">
                    <div class="collection-filter-box">
                        <div class="collection-box p-0">
                            <div class="collection-collapse-block-content">
                                <!-- CONTENT -->
                                <div class="form-search-box">
                                    <div class="form-group has-search">
                                        <span class="fa fa-search form-control-feedback"></span>
                                        <input
                                            class="form-control"
                                            type="text"
                                            placeholder="Search"
                                            name="q" wire:model.lazy="q"
                                            autocomplete="off">
                                    </div>
                                </div>
                                <!-- CONTENT -->
                            </div>
                        </div>
                        <div class="collection-box">
                            <h3 class="collapse-block-title">Brand</h3>
                            <div class="collection-collapse-block-content">
                                <!-- CONTENT -->
                                <div class="collection-brand-filter">
                                    @foreach($brands as $brand)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{$brand->id}}"
                                                   name="selectedBrands[]"
                                                   @if(count($selectedBrands)>0)
                                                   @foreach($selectedBrands as $item)
                                                   {{$item==$brand->id? 'checked':''}}
                                                   @endforeach
                                                   @endif
                                                   id="defaultCheck{{$loop->iteration}}"
                                                   wire:change="selectBrand($event.target.value,{{$brand->id}})">
                                            <label class="form-check-label" for="NIKE">{{$brand->brand_name}}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- CONTENT -->
                            </div>
                        </div>

                        <div class="collection-box">
                            <h3 class="collapse-block-title">Filter By Color
                                <button type="button" class="btn btn-sm pull-right"
                                        wire:click="selectColor('0')">Clear
                                </button>
                            </h3>
                            <div class="collection-collapse-block-content">
                                <!-- CONTENT -->
                                <div class="color-selector">
                                    <ul>
                                        @foreach($colors as $color)
                                            <li class="{{$color->value}}" wire:click="selectColor({{$color->id}})"
                                                title="{{$color->name}}"></li>
                                        @endforeach
                                    </ul>
                                    <input type="hidden" name="color" wire:model="color">
                                </div>
                                <!-- CONTENT -->
                            </div>
                        </div>

                        {{-- <div class="collection-box">
                             <h3 class="collapse-block-title">Product Sizes</h3>
                             <div class="collection-collapse-block-content">
                                 <!-- CONTENT -->
                                 <!-- <div class="collection-brand-filter">
                                     <div class="form-check">
                                         <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                         <label class="form-check-label" for="xl">XL</label>
                                     </div>

                                     <div class="form-check">
                                         <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                         <label class="form-check-label" for="l">L</label>
                                     </div>

                                     <div class="form-check">
                                         <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                         <label class="form-check-label" for="m">M</label>
                                     </div>

                                     <div class="form-check">
                                         <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                         <label class="form-check-label" for="s">S</label>
                                     </div>

                                 </div> -->
                                 <div class="collection-size-filter">
                                     <ul>
                                         <li class="yellow">
                                             <a title="Extra Large" href="#">Xl</a>
                                         </li>
                                         <li class="gray">
                                             <a title="Large" href="#">L</a>
                                         </li>
                                         <li class="green">
                                             <a title="Medium" href="#">M</a>
                                         </li>
                                         <li class="orange">
                                             <a title="Small" href="#">S</a>
                                         </li>
                                     </ul>
                                 </div>
                                 <!-- CONTENT -->
                             </div>
                         </div>--}}

                        <div class="collection-box">
                            <h3 class="collapse-block-title">Filter By Price</h3>
                            <div class="collection-collapse-block-content">
                                <!-- CONTENT -->
                                <div class="input-group">
                                    <input
                                        class="form-control"
                                        type="number"
                                        placeholder="Min price"
                                        name="minPrice" wire:model.lazy="minPrice"
                                        autocomplete="off">
                                    <input
                                        class="form-control"
                                        type="number"
                                        placeholder="Max price"
                                        name="maxPrice" wire:model.lazy="maxPrice"
                                        autocomplete="off">
                                </div>
                                <!-- CONTENT -->
                            </div>
                        </div>

                        <button type="submit" class="btn">Submit</button>

                    </div>
                </form>
            </div>
            <div class="col-lg-9">
                @include('frontend.partials.result-products')
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        document.addEventListener("livewire:load", function (event) {
            window.livewire.hook('afterDomUpdate', () => {
                $(".product-item").owlCarousel({
                    loop: true,
                    nav: true,
                    autoPlay: false,
                    dots: false,
                    autoplayHoverPause: true,
                    responsive: {
                        0: {
                            items: 1,
                        },
                        600: {
                            items: 1,
                        },
                        1000: {
                            items: 1,
                        },
                    },
                });
            });
        }, 500)
    </script>
@endpush
