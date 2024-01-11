<template>
  <section class="colection">
    <div class="container">
      <div class="header-session">
        <h2 class="colection-title">OUR COLLECTION</h2>
        <a class="read-more-colection" href="/collection">Xem tất cả</a>
      </div>
      <div class="tab-content landscape-post" ref="productsPlaceholder">
        <ColectionCard v-for="post in posts" :key="post.id" :post="post"/>
      </div>
    </div>
  </section>
</template>
<script>
import ColectionCard from '../ColectionCard';
import { slickPrevArrow, slickNextArrow } from '../../functions';

export default {
  components: { ColectionCard },
  data: function() {
    return {
      posts: []
    };
  },

  created() {
    $.ajax({
      method: 'GET',
      url: route('PostApi.show'),
    }).then(async(posts) => {
      this.posts = posts
      this.$nextTick(() => {
        $(this.$refs.productsPlaceholder).slick(this.slickOptions());
      });
    })
  },

  methods: {
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
      }
    }
  },



};
</script>
