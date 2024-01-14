import store from '../store';

export default {
    data() {
        return {
            addingToCart: false,
        };
    },

    computed: {
        productUrl() {
            return route('products.show', this.product.slug);
        },

        hasAnyOption() {
            return this.product.options_count > 0;
        },

        hasNoOption() {
            return ! this.hasAnyOption;
        },
        optionColor() {
            for(const i of this.product.options){
                if(i.name.toLowerCase() === "color"){
                    return i
                }
            }
            return null;
        },

        hasOptionColor() {
            let options = this.product.options;
            for(const i of options){
                if(i.name.toLowerCase() === "color"){
                    return true;
                }
            }
            return false;
        },

        hasBaseImage() {
            return this.product.base_image.length !== 0;
        },

        hasMutiBaseImage() {
            return this.product.additional_images.length !== 0;
        },

        baseImage() {
            if (this.hasBaseImage) {
                return this.product.base_image.path;
            }

            return `${window.FleetCart.baseUrl}/themes/storefront/public/images/image-placeholder.png`;
        },

        baseImages() {
            if (this.hasMutiBaseImage) {
                let baseImage = [this.product.base_image];
                let baseImages = this.product.additional_images;
                for(const i in baseImages){
                    let obj = {
                        "filename" :baseImages[i]['filename'],
                        "path" : baseImages[i]['path'],
                        "id" :baseImages[i]['id'],
                    }
                    baseImage.push(obj)
                }
                return baseImage;
            }
        },

        inWishlist() {
            return store.inWishlist(this.product.id);
        },

        inCompareList() {
            return store.inCompareList(this.product.id);
        },
    },

    methods: {
        syncWishlist() {
            store.syncWishlist(this.product.id);
        },

        syncCompareList() {
            store.syncCompareList(this.product.id);
        },

        addToCart() {
            this.addingToCart = true;

            $.ajax({
                method: 'POST',
                url: route('cart.items.store', { product_id: this.product.id, qty: 1 }),
            }).then((cart) => {
                store.updateCart(cart);

                if (document.location.href !== route('cart.index').url()) {
                    $('.header-cart').trigger('click');
                }
            }).catch((xhr) => {
                this.$notify(xhr.responseJSON.message);
            }).always(() => {
                this.addingToCart = false;
            });
        },
    },
};
