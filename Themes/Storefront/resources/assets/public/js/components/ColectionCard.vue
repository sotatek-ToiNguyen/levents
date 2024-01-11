<template>
    <div class="post-card post-colection">
        <div class="product-card-top">
            <a :href="route('collection.show', post.slug)" class="product-image">
                <img :src="'storage/' + post.path" alt="product image">
            </a>
        </div>

        <div class="product-card-middle">
            <a :href="route('collection.show', post.slug)" class="post-name title-post">
                <h6>{{ post.name }}</h6>
            </a>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['post'],
    };
</script>
