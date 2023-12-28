<template>
    <div class="post-card">
        <div class="product-card-top">
            <a :href="post.link" class="product-image">
                <img :src="post.img" alt="product image">
            </a>
        </div>

        <div class="product-card-middle">
            <a :href="post.link" class="post-name">
                <h6>{{ post.title }}</h6>
            </a>
            <button>
              <a :href="post.link" class="post-name">
                Xem bộ phối
              </a>
            </button>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['post'],
    };
</script>
