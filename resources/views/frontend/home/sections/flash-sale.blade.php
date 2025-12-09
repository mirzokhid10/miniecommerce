 <!--============================
        FLASH SELL START
    ==============================-->
 <section id="wsus__flash_sell" class="wsus__flash_sell_2">
     <div class=" container">
         <div class="row">
             <div class="col-xl-12">
                 <div class="offer_time" style="background: url(images/flash_sell_bg.jpg)">
                     <div class="wsus__flash_coundown">
                         <span class=" end_text">flash sell</span>
                         <div class="simply-countdown simply-countdown-one"></div>
                         <a class="common_btn" href="#">see more <i class="fas fa-caret-right"></i></a>
                     </div>
                 </div>
             </div>
         </div>

         <div class="row flash_sell_slider">
             @php
                 $products = \App\Models\Product::with(['variant', 'category', 'productImageGallery'])->get();
             @endphp

             @foreach ($products as $product)
                 <x-product-card :product="$product" />
             @endforeach

         </div>

     </div>
 </section>
 <!--============================
        FLASH SELL END
    ==============================-->
