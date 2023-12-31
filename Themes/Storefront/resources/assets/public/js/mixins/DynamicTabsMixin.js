export default {
    data() {
        return {
            tabs: [],
            activeTab: null,
            loading: false,
            products: [],
            products2: [],
        };
    },

    mounted() {
        this.tabs = this.$children.filter((component) => {
            return component.$options.name === 'DynamicTab';
        });

        // Show the first tab by default on page load.
        this.change2(this.tabs[1]);
        this.change(this.tabs[0]);
    },

    methods: {
        classes(tab) {
            return {
                'tab-item': true,
                loading: this.activeTab === tab && this.loading,
                active: this.activeTab === tab && ! this.loading,
            };
        },

        change(activeTab) {
            if (this.activeTab === activeTab) {
                return;
            }

            this.loading = true;
            this.activeTab = activeTab;

            $.ajax({
                method: 'GET',
                url: activeTab.url,
            }).then((products) => {

                this.products = products;
                this.loading = false;

            });
        },

        change2(activeTab) {
            if (this.activeTab === activeTab) {
                return;
            }

            this.loading = true;
            this.activeTab = activeTab;

            $.ajax({
                method: 'GET',
                url: activeTab.url,
            }).then((products) => {

                this.products2 = products;
                this.loading = false;

            });
        },
    },
};
