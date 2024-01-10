<template>
    <div class="post-card">
        <div class="product-card-top">
            <a :href="route('styling.index', post.slug)" class="product-image">
                <img :src="'storage/' + post.path" alt="product image">
            </a>
        </div>

        <div class="product-card-middle">
            <a :href="route('styling.index', post.slug)" class="post-name">
                <h6>{{ post.name }}</h6>
            </a>
            <button>
              <a :href="route('styling.index', post.slug)" class="post-name">
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
