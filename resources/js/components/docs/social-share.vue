<template>
    <div id="social-platforms">
        <vue-goodshare-twitter
            :page_url="href"
            has_icon
            has_counter>
        </vue-goodshare-twitter>
        <vue-goodshare-facebook
            :page_url="page_url"
            has_icon
            has_counter>
        </vue-goodshare-facebook>
        <vue-goodshare-linkedin
            :page_url="href"
            has_icon
            has_counter>
        </vue-goodshare-linkedin>
        <vue-goodshare-pinterest
            :page_url="href"
            has_icon
            has_counter>
        </vue-goodshare-pinterest>
        <vue-goodshare-reddit
            :page_url="href"
            has_icon
            has_counter>
        </vue-goodshare-reddit>
    </div>
</template>
<script>
    import VueGoodshareFacebook from "vue-goodshare/src/providers/Facebook.vue";
    import VueGoodshareTwitter from "vue-goodshare/src/providers/Twitter.vue";
    import VueGoodshareLinkedIn from "vue-goodshare/src/providers/LinkedIn.vue";
    import VueGoodsharePinterest from "vue-goodshare/src/providers/Pinterest.vue";
    import VueGoodshareReddit from "vue-goodshare/src/providers/Reddit.vue";

    export default {
        props: {
            page_url: {
                type: String,
                default: window.location.href
            },
            page_description: {
                type: String,
                default: () => ""
            },
            page_title: {
                type: String,
                default: () => ""
            },
            quote: {
                type: String,
                default: () => ""
            },
            hashtag: {
                type: String,
                default: () => ""
            },
        },
        components: {
            VueGoodshareFacebook,
            VueGoodshareTwitter,
            VueGoodshareLinkedIn,
            VueGoodsharePinterest,
            VueGoodshareReddit
        }
    };
</script>
<style scoped>
    #social-platforms {
        margin-top: 30px;
    }
    .button-social {
        padding: 7px 10px;
        border-radius: 10px !important;
        font-family: "Anek Telugu", sans-serif;
        font-size: 1.4rem;
        font-weight: 600;
        line-height: 1;
        display: inline-block;
        margin: 0 5px 5px 0;
        transition: background-color 0.2s ease;
        text-align: center;
        align-items: center;
    }
    .button-social svg, .button-social i {
        line-height: 0;
        display: inline-flex;
        height: 14px;
        margin-right: 5px;
        padding: 7px;
    }
</style>
