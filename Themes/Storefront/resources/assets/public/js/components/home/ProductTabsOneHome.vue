<template>
    <section class="landscape-tab-products-wrap clearfix home-tabb">
        <div class="container">
            <div class="tab-products-header clearfix">
                <ul class="tabs float-left">
                    <li
                        v-for="(tab, index) in tabs"
                        :data-href="index"
                        :key="index"
                        :class="classes(tab)"
                    >
                        {{ tab.label }}
                    </li>
                    <li class="tab-item read-more"><a href="" class="read-more">Xem tất cả</a></li>
                </ul>
            </div>


            <div class="tab-content landscape-left-tab-products active">
                <ProductCardHome v-for="product in products" :key="product.id" :product="product"/>
            </div>

            <div class="tab-content landscape-left-tab-products">
                <ProductCardHome v-for="product in products2" :key="product.id" :product="product"/>
            </div>

            <dynamic-tab
                v-for="(tabLabel, index) in data"
                :key="index"
                :label="tabLabel"
                :url="route('storefront.tab_products.index', { sectionNumber: 1, tabNumber: index + 1 })"
            >
            </dynamic-tab>
        </div>
    </section>
</template>

<script>
    import ProductCard from '../ProductCard.vue';
    import DynamicTabsMixin from '../../mixins/DynamicTabsMixin';
    import { slickPrevArrow, slickNextArrow } from '../../functions';
    import ProductCardHome from "../ProductCardHome";

    export default {
        components: {ProductCardHome, ProductCard },

        mixins: [
            DynamicTabsMixin,
        ],

        props: ['data'],

        methods: {
          changeData(tab){
              let href = '/categories/' + tab.label.replace(' ', '-').toLowerCase() + '/products';
              $('.read-more').attr('href', href)
              this.change(tab);
            }
        },

      mounted() {
          if(this.data){
            let href = '/categories/' + this.data[0].replace(' ', '-').toLowerCase() + '/products';
            $('.read-more').attr('href', href)
          }
      }
    };
</script>
