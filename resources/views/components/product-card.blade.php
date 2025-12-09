@props(['product'])
<div class="col-xl-3 col-sm-6 col-lg-4 {{ @$key }}">
    <div class="wsus__product_item">
        <span class="wsus__new">{{ productType($product->product_type) }}</span>
        @if (checkDiscount($product))
            <span class="wsus__minus">-{{ calculateDiscountPercent($product->price, $product->offer_price) }}%</span>
        @endif
        <a class="wsus__pro_link" href="{{ route('product-detail', $product->slug) }}">
            <img src="{{ asset($product->thumb_image) }}" alt="product" class="img-fluid w-100 img_1" />
            <img src="
            @if (isset($product->productImageGalleries[0]->image)) {{ asset($product->productImageGalleries[0]->image) }}
            @else
                {{ asset($product->thumb_image) }} @endif
            "
                alt="product" class="img-fluid w-100 img_2" />
        </a>
        <ul class="wsus__single_pro_icon">
            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $product->id }}"
                    class="show_product_modal" data-id="{{ $product->id }}"><i class="far fa-eye"></i></a></li>
            <li><a href="" class="add_to_wishlist" data-id="{{ $product->id }}"><i class="far fa-heart"></i></a>
            </li>
            <li><a href="#"><i class="far fa-random"></i></a>
        </ul>
        <div class="wsus__product_details">
            <a class="wsus__category" href="#">{{ $product->category->name }} </a>
            <p class="wsus__pro_rating">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="fas fa-star"></i>
                @endfor
                <span>100 review</span>
            </p>
            <a class="wsus__pro_name"
                href="{{ route('product-detail', $product->slug) }}">{{ limitText($product->name, 52) }}</a>
            @if (checkDiscount($product))
                <p class="wsus__price">${{ $product->offer_price }}
                    <del> ${{ $product->price }}</del>
                </p>
            @else
                <p class="wsus__price">${{ $product->price }}</p>
            @endif
            <form class="shopping-cart-form" method="POST" action="{{ route('add-to-cart') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="qty" value="1">
                @foreach ($product->variant as $variant)
                    @if ($variant->status != 0)
                        <select class="d-none" name="variants_items[]">
                            @foreach ($variant->items as $item)
                                @if ($item->status != 0)
                                    <option value="{{ $item->id }}"
                                        {{ $item->is_default == 1 ? 'selected' : '' }}>
                                        {{ $item->name }} (${{ $item->price }})
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    @endif
                @endforeach
                <input class="" name="qty" type="hidden" min="1" max="100" value="1" />
                <button class="add_cart" type="submit">add to cart</button>
            </form>
        </div>
    </div>
</div>
