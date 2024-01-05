<template>
  <section class="colection">
    <div class="container">
      <div class="header-session">
        <h2 class="colection-title">OUR COLLECTION</h2>
        <a class="read-more-colection" href="">Xem tất cả</a>
      </div>
      <div class="tab-content landscape-post">
        <PostCard v-for="post in posts" :key="post.id" :post="post"/>
      </div>
    </div>
  </section>
</template>
<script>
import PostCard from '../PostCard';
import { slickPrevArrow, slickNextArrow } from '../../functions';

export default {
  components: { PostCard },
  data: function() {
    return {
      posts: [
        {
          id:1,
          img: 'https://levents.asia/cdn/shop/collections/LEVENTS_MY_ANIMALS_SERIES_COLLECTION_2022.png?v=1694160118&width=1500',
          title: "LEVENTS® 3RD ANNIVERSARY “ONE WORLD ONE LOVE”",
          link: 'aaaa',
        },
        {
          id:2,
          img: 'https://levents.asia/cdn/shop/collections/LEVENTS_MY_ANIMALS_SERIES_COLLECTION_2022.png?v=1694160118&width=1500',
          title: "LEVENTS® 3RD ANNIVERSARY “ONE WORLD ONE LOVE”",
          link: 'aaaa',
        },
        {
          id:3,
          img: 'https://levents.asia/cdn/shop/collections/LEVENTS_MY_ANIMALS_SERIES_COLLECTION_2022.png?v=1694160118&width=1500',
          title: "LEVENTS® 3RD ANNIVERSARY “ONE WORLD ONE LOVE”",
          link: 'aaaa',
        },
        {
          id:4,
          img: 'https://levents.asia/cdn/shop/collections/LEVENTS_MY_ANIMALS_SERIES_COLLECTION_2022.png?v=1694160118&width=1500',
          title: "LEVENTS® 3RD ANNIVERSARY “ONE WORLD ONE LOVE”",
          link: 'aaaa',
        },
        {
          id:5,
          img: 'https://levents.asia/cdn/shop/collections/LEVENTS_MY_ANIMALS_SERIES_COLLECTION_2022.png?v=1694160118&width=1500',
          title: "LEVENTS® 3RD ANNIVERSARY “ONE WORLD ONE LOVE”",
          link: 'aaaa',
        },

      ]
    };
  },

  mounted() {
    $('.landscape-post').slick({
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
    })
  },


};
</script>
