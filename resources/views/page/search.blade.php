@extends('layout.master')
@section('content')
    <div id='wrapper'>
        <div class="row">
            {{-- Sidebar --}}
            @include('layout.product_sidebar')

            <div class="col-12 col-sm-12 col-md-10 col-lg-10 block-main-content">
                <div class='main-content'>
                    <hr class="hr--border-top small-hidden"></hr>
                    <nav class="breadcrumb-nav small--text-center" aria-label="You are here">
			  	<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
			    	<a href="{{ route('trang-chu') }}" itemprop="url" title="Back to the homepage">
			      	<span>Home</span>
			    </a>
				@if(!empty($cate_parent))
                        <span class="breadcrumb-nav__separator" aria-hidden="true">›</span>
			  	</span>
                        {{ $cate_parent->name }}
                        @endif
                    </nav>
                    <div class="grid">
                        <div class='row'>
                            <div class='col-12 col-sm-12 col-md-6 col-lg-6  small--text-center grid__item'>
                                <h5>dsdsadsa</h5>
                            </div>
                            <div class='col-12 col-sm-12 col-md-6 col-lg-6  small--text-center collection-sorting grid__item medium-up--two-thirds'>
                                <div class="collection-sorting__dropdown">
                                    <label for="SortBy" class="label--hidden">Sort by</label>
                                    <select name="SortBy" id="SortBy" data-cate-id='{{$cate_id}}'>
                                        <option value="price-ascending">Giá tăng dần</option>
                                        <option value="price-descending">Giá giảm dần</option>
                                        <option value="created-descending">Mới nhất</option>
                                        <option value="created-ascending">Cũ nhất</option>
                                    </select>
                                </div>
                                <div class="collection-sorting__dropdown">
                                    <label for="itemsOnPage" class="label--hidden">Hiển thị</label>
                                    <select name="itemsOnPage" id="itemsOnPage">
                                        <option value="8">8 sản phẩm</option>
                                        <option value="12">12 sản phẩm</option>
                                        <option value="16">16 sản phẩm</option>
                                        <option value="25">25 sản phẩm</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end-grid-->
                    <div class='block_wrap row' id="pd">
                        <div class="row filter-tag">
                        </div>
                        <div class="page_info">
                            <p class="p__total_item">
                                Total
                                {{--@if(count($products) > 0) Hiển thị:
                                <span>{{ $products->firstItem() }}</span> - <span>{{ $products->lastItem() }}</span>
                                trong @endif <span>{{ $products->total()}}</span> sản phẩm--}}
                            </p>
                        </div>

                        @if(count($products) > 0 )
                            <div class="row clearfix" style="width: 100%;" id="list_product">

                            </div>
                            {{--<div class="block_center block_paginate">
                                {{$products->links()}}
                            </div>--}}

                        @else
                            <p class="text-center messages">Không có sản phẩm phù hợp!</p>
                        @endif

                    </div>
                    <!--block_wrap-->
                </div>
                <!--end-main-content-->
            </div>
            <!--block-main-content-->
        </div>
        <!--end-row-->
    </div>
    <!--end-wrapper-->
@endsection
@section('title', 'Tìm kiếm')
@section('script')
    <script type="text/javascript">

        $(document).ready(function () {
            var cate_id = $(".options__checkbox").attr('data-cate-id');
            var data = {
                cate_id: cate_id,
                brand_list: [],
                size_list: [],
                sortby: "",
                itemsOnPage: 8,
                page: 1
            }
            //filter check
            $(".item-filter").change(function () {
                var brand_list = new Array();
                var size_list = new Array();
                brand_list = multi_checkbox("brand"); //call multi_checkbox, get list id
                size_list = multi_checkbox('size');
                price_list = multi_checkbox('price');
                data.page = 1; 			//khi check thi luon gửi page 1, tránh lỗi khi số page bé hơn page đang gửi hiện tại
                data.brand_list = brand_list;  	//list_brand for ajax send
                data.size_list = size_list;	//get size_list
                data.price_list = price_list;
                // console.log(price_list);
                ajax();
            });
            //khi click remove tag

            $(".block_wrap").delegate(".remove-tag", "click", function (e) {
                e.preventDefault();
                var tag_id = $(this).attr('data-tag'); //lay id cua filter-item
                $("." + tag_id).prop('checked', false); 	//Chuyển checkbox có data-tag thành false
                console.log(tag_id);
                var brand_list = new Array();
                var size_list = new Array();
                var price_list = new Array();
                brand_list = multi_checkbox('brand');
                size_list = multi_checkbox('size');
                price_list = multi_checkbox('price');
                data.page = 1;
                data.brand_list = brand_list;
                data.size_list = size_list;
                data.price_list = price_list;
                ajax();
            });

            //lấy giá trị sort by
            $("#SortBy").change(function () {
                var val = $(this).val();
                data.sortby = val;
                ajax();
            });
            // lấy số item on page
            $("#itemsOnPage").change(function () {
                var val = $(this).val();
                data.itemsOnPage = val;
                ajax();
            });

            $(".block_wrap").on('click', '#pagination a', function (event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                data.page = page; //để có thể phân trang bên page phải gửi data.page qua ajax
                ajax();
            });

            function ajax() {
                $.ajax({
                    url: "ajax/filter",
                    type: "post",
                    data: data,
                    async: true,
                    beforeSend: function () {
                        $(".loading-icon").fadeIn('fast');
                    },
                    success: function (data) {
                        $(".loading-icon").fadeOut('fast');
                        $('.block_wrap').html(data);
                    },
                    errors: function () {
                        alert('fasle');
                    }
                });
            }

            //lấy danh sach checkbox
            function multi_checkbox(class_check) {
                var val = new Array();
                if (class_check === 'price') {
                    $(".price:checked").each(function () {
                        var price_check = {
                            price_min: $(this).attr('data-price-min'),
                            price_max: $(this).attr('data-price-max')
                        }
                        val.push(price_check);
                    });
                } else {
                    $("." + class_check + ":checked").each(function () {
                        val.push($(this).val());
                    });
                }
                return val;
            };
        });
    </script>
@endsection