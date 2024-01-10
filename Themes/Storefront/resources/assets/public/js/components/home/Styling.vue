<template>
  <section class="colection">
    <div class="container">
      <div class="header-session">
        <h2 class="colection-title">Styling</h2>
        <a class="read-more-colection" href="/blogs/outfit">Xem tất cả</a>
      </div>
      <div class="tab-content landscape-styling" ref="productsPlaceholder">
        <StylingCard v-for="post in posts" :key="post.id" :post="post"/>
      </div>
    </div>
  </section>
</template>
<script>
import StylingCard from '../StylingCard';
import { slickPrevArrow, slickNextArrow } from '../../functions';

export default {
  components: { StylingCard },
  data: function() {
    return {
      posts: [
      ]
    };
  },

  created() {
    $.ajax({
      method: 'GET',
      url: route('productsStylingApi.show'),
    }).then(async(stylings) => {
      this.posts = stylings
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
