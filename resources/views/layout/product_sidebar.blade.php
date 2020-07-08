<div class="col-12 col-sm-2 col-md-2 col-lg-2 nav-left small--text-center">
    <hr class="hr--border-top small-hidden"></hr>
    @include('layout.sider_nav')
    <div class="options__checkbox" data-cate-id={{$cate->id}}>
        <div class="brand__checkbox check__group clearfix" id='price-checkbox'>
            <h6>Giá</h6>
            <label class="check_label">Dưới 500.000 vnđ
                <input type="checkbox" data-price-min='0' data-price-max='499999'
                       class="item-filter price filter-price-0-499999">
                <span class="checkmark"></span>
            </label>
            <label class="check_label">Từ 500.000 đên 1.000.000 vnđ
                <input type="checkbox" data-price-min='500000' data-price-max='999999'
                       class="item-filter price filter-price-500000-999999">
                <span class="checkmark"></span>
            </label>
            <label class="check_label">Từ 1.000.000 đến 5.000.000 vnđ
                <input type="checkbox" data-price-min='1000000' data-price-max='5000000'
                       class="item-filter price filter-price-1000000-5000000">
                <span class="checkmark"></span>
            </label>
            <label class="check_label">Trên 5.000.000 vnđ
                <input type="checkbox" data-price-min='5000000' data-price-max='100000000'
                       class="item-filter price filter-price-5000000-100000000">
                <span class="checkmark"></span>
            </label>
        </div>
        <div class="brand__checkbox check__group clearfix" id='brand-checkbox'>
            <h6>Thương hiệu</h6>
            @if(count($brands) > 0)
                @foreach($brands as $brand)
                    <label class="check_label">{{$brand->name}}
                        <input type="checkbox" value="{{$brand->id}}"
                               class="item-filter brand filter-brand-{{$brand->id}}">
                        <span class="checkmark"></span>
                    </label>
                @endforeach
            @endif
        </div>
        <div class="size__checkbox check__group clearfix" id='size-checkbox'>
            <h6>Kích Cỡ</h6>
            @if(count($sizes) > 0)
                @foreach($sizes as $size)
                    <input type="checkbox" value="{{$size->id}}" id='size-{{$size->id}}'
                           class="item-filter size filter-size-{{$size->id}}">
                    <label for="size-{{$size->id}}">{{$size->name}}</label>
                @endforeach
            @endif
        </div>
    </div>
</div>