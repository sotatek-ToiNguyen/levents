<template>
    <section class="landscape-tab-products-wrap clearfix">
        <div class="container">
            <div class="tab-products-header clearfix">
                <ul class="tabs float-left">
                    <li class="tab-item active">
                        {{ this.label }}
                    </li>
                </ul>
            </div>
          <div class="tab-content landscape-left-tab-products">
            <ProductCard v-for="product in products" :key="product.id" :product="product"/>
          </div>
        </div>
    </section>
</template>

<script>
import ProductCard from '../ProductCard.vue';

    import { slickPrevArrow, slickNextArrow } from '../../functions';
    export default {
      components: { ProductCard },
        props: ['category', 'label', 'catid'],
        data: function (){
          return{
            products: [],
          };
        },
      methods: {
        selector() {
          return $('.landscape-left-tab-products');
        },

        slickOptions() {
          return {
            rows: 0,
            dots: false,
            arrows: true,
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4,
            rtl: window.FleetCart.rtl,
            responsive: [
              {
                breakpoint: 1761,
                settings: {
                  slidesToShow: 4,
                  slidesToScroll: 4,
                },
              },
              {
                breakpoint: 1301,
                settings: {
                  slidesToShow: 4,
                  slidesToScroll: 4,
                },
              },
              {
                breakpoint: 1051,
                settings: {
                  slidesToShow: 4,
                  slidesToScroll: 4,
                },
              },
              {
                breakpoint: 992,
                settings: {
                  slidesToShow: 4,
                  slidesToScroll: 4,
                },
              },
              {
                breakpoint: 881,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 3,
                },
              },
              {
                breakpoint: 661,
                settings: {
                  dots: true,
                  arrows: false,
                  slidesToShow: 3,
                  slidesToScroll: 3,
                },
              },
              {
                breakpoint: 641,
                settings: {
                  dots: true,
                  arrows: false,
                  slidesToShow: 2,
                  slidesToScroll: 2,
                },
              },
            ],
          };
        },
      },
      mounted() {
        this.changeCategory
        let url = 'http://localhost:8787/storefront/tab-products/sections/1/tabs/' + this.catid
        $.ajax({
            method: 'GET',
            url,
          }).then(($products) => {
            if (this.selector().hasClass('slick-initialized')) {
              this.selector().slick('unslick');
            }
            this.products = $products;
            this.$nextTick(() => {
              this.selector().slick(this.slickOptions());
            });
          });
      }
    };
</script>
