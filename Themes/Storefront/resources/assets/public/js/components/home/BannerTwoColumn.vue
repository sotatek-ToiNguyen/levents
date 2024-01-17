<template>
    <section class="banner-wrap two-column-banner colection-video">
        <div class="container banner-link">
            <div class="row">
                <div class="col-lg-9 col-sm-18">
                    <video playsinline="true" controls="controls" autoplay="autoplay" loop="loop" preload="none" muted="muted" poster="">
                      <source :src="data.banner_1.image.path" type="video/mp4">
                    </video>
                </div>
              <div class="col-lg-9 col-sm-18 content-ww">
                  <div class="tab-content">
                      <h2>
                      {{data.banner_1.title}}
                      </h2>
                    <div class="image-with-text__text rte text-2-sm body h3">
                      <p>
                        {{data.banner_1.description}}
                      </p>
                    </div>
                    <a data-prefetch="" :href="data.banner_1.call_to_action_url" class="button button--large button-lg button--primary">
                      Xem thêm
                    </a>
                  </div>
              </div>
            </div>
        </div>
        <div class="container banner-link">
            <div class="row">
                  <div class="col-lg-9 col-sm-18 content-ww">
                        <div class="tab-content tab-content-left"><h2>
                        {{data.banner_2.title}}
                        </h2> <div class="image-with-text__text rte text-2-sm body h3">
                          <p>{{data.banner_2.description}}</p>
                        </div> <a data-prefetch="" href="/collections/all" class="button button--large button-lg button--primary">
                          Xem thêm
                        </a>
                        </div>
                    </div>
                  <div class="col-lg-9 col-sm-18">
                    <img :src="data.banner_2.image.path" alt="banner">
                  </div>
          </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['data'],
    };
</script>
