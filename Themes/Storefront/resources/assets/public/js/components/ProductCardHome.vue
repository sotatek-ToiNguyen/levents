<template>
    <div class="product-card">
        <div class="product-card-top">
            <div v-if="hasMutiBaseImage === true" class="thumnail-image">
                <div  v-for="base in baseImages" :key="base.id" >
                  <img :src="base.path" :class="{ 'image-placeholder': ! hasBaseImage }" alt="product image">
                </div>
            </div>
            <div  v-else class="product-image">
              <img :src="baseImage" :class="{ 'image-placeholder': ! hasBaseImage }" alt="product image">
            </div>
            <div class="product-card-actions">
                <button
                    class="btn btn-wishlist"
                    :class="{ 'added': inWishlist }"
                    :title="$trans('storefront::product_card.wishlist')"
                    @click="syncWishlist"
                >
                    <i class="la-heart" :class="inWishlist ? 'las' : 'lar'"></i>
                </button>

                <button
                    class="btn btn-compare"
                    :class="{ 'added': inCompareList }"
                    :title="$trans('storefront::product_card.compare')"
                    @click="syncCompareList"
                >
                    <i class="las la-random"></i>
                </button>
            </div>
            <div class="product-card-actions action-sns">
              <button v-if="product.link_shopee" class="btn btn-sns btn-shopee">
                <a :href="product.link_shopee" target="_blank">
                  <img src="/themes/storefront/public/images/shopee.png">
                </a>
              </button>
              <button v-if="product.link_lazada" class="btn btn-sns btn-lazada">
                <a :href="product.link_lazada"  target="_blank">
                  <img src="/themes/storefront/public/images/lazada.webp">
                </a>
              </button>
              <button v-if="product.link_tiki" class="btn btn-sns btn-tiki">
                <a :href="product.link_tiki"  target="_blank">
                  <img src="/themes/storefront/public/images/tiki.png">
                </a>
              </button>
              <button v-if="product.link_tiktok" class="btn btn-sns btn-tiki">
                <a :href="product.link_tiktok"  target="_blank">
                  <img src="/themes/storefront/public/images/tiktok.png">
                </a>
              </button>
            </div>

            <ul class="list-inline product-badge">
                <li class="badge badge-danger" v-if="product.is_out_of_stock">
                    {{ $trans('storefront::product_card.out_of_stock') }}
                </li>

                <li class="badge badge-primary" v-else-if="product.is_new">
                    {{ $trans('storefront::product_card.new') }}
                </li>

                <li class="badge badge-success" v-if="product.has_percentage_special_price">
                    -{{ product.special_price_percent }}%
                </li>
            </ul>
        </div>

        <div class="product-card-middle">
            <ProductRating :ratingPercent="product.rating_percent" :reviewCount="product.reviews.length"/>
            <div class="option-color" v-if="hasOptionColor">
              <ul class=" list-inline form-custom-radio custom-selection">
                <li @click="chosenColor($event, index)" v-for="(option, index) of optionColor.values" class="prod-color" :key="index" :style="{'background': option.label, 'color': option.label}"></li>
              </ul>
            </div>
            <a :href="productUrl" class="product-name">
                <h6>{{ product.name }}</h6>
            </a>

            <div class="product-price product-price-clone" v-html="product.formatted_price"></div>
        </div>

        <div class="product-card-bottom">
            <div class="product-price" v-html="product.formatted_price"></div>

            <button
                v-if="hasNoOption || product.is_out_of_stock"
                class="btn btn-primary btn-add-to-cart"
                :class="{ 'btn-loading': addingToCart }"
                :disabled="product.is_out_of_stock"
                @click="addToCart"
            >
                <i class="las la-cart-arrow-down"></i>
                {{ $trans('storefront::product_card.add_to_cart') }}
            </button>

            <a
                v-else
                :href="productUrl"
                class="btn btn-primary btn-add-to-cart"
            >
                <i class="las la-eye"></i>
                {{ $trans('storefront::product_card.view_options') }}
            </a>
        </div>
    </div>
</template>

<script>
    import ProductRating from './ProductRating.vue';
    import ProductCardMixin from '../mixins/ProductCardMixin';

    export default {
        components: { ProductRating },

        mixins: [
            ProductCardMixin,
        ],
        props: ['product'],
        mounted() {
          $('.thumnail-image').slick({
            rows: 0,
            dots: true,
            arrows: true,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            rtl: window.FleetCart.rtl,
          });
        },
        methods:{
          chosenColor(event, index){
            const productCardElement = event.target.closest('.product-card');
            const allListItems = productCardElement.querySelectorAll('.option-color li');
            const slickDots = productCardElement.querySelectorAll('.slick-dots li');
            if(slickDots[index]){
              slickDots[index].dispatchEvent(new Event('click'));
            }
            allListItems.forEach((li) => {
              li.classList.remove('active');
            });
            event.target.classList.add('active');
          }
        }
    };
</script>
