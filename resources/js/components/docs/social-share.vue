<template>
    <div id="social-platforms">
        <div class="share">
            <h4 class="share__text">Share on</h4>
            <div class="novashare-buttons novashare-floating novashare-no-print">
                <vue-goodshare-twitter
                    :page_url="page_url"
                    :page_title="page_title"
                    :page-description="page_description"
                    has_icon
                    has_counter
                >
                </vue-goodshare-twitter>
                <vue-goodshare-facebook
                    :page_url="page_url"
                    :page_title="page_title"
                    :page-description="page_description"
                    has_icon
                    has_counter
                >
                </vue-goodshare-facebook>
                <vue-goodshare-linkedIn
                    :page_url="page_url"
                    :page_title="page_title"
                    :page-description="page_description"
                    has_icon
                    has_counter
                >
                </vue-goodshare-linkedIn>
                <vue-goodshare-pinterest
                    :page_url="page_url"
                    :page_title="page_title"
                    :page-description="page_description"
                    has_icon
                    has_counter
                >
                </vue-goodshare-pinterest>
                <vue-goodshare-reddit
                    :page_url="page_url"
                    :page_title="page_title"
                    :page-description="page_description"
                    has_icon
                    has_counter
                >
                </vue-goodshare-reddit>
            </div>
            <div class="share__action" data-interface="DownloadPostForm">
                <button class="yogurt-w1ph0e" @click="saveDocAsPDF">
                    <div class="yogurt-3xbgk5">
                        <div class="yogurt-qo1k2">Save</div>
                        <div class="yogurt-qdsa8 ml-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </div>
</template>
<script>
    import VueGoodshareFacebook from "vue-goodshare/src/providers/Facebook.vue";
    import VueGoodshareTwitter from "vue-goodshare/src/providers/Twitter.vue";
    import VueGoodshareLinkedIn from "vue-goodshare/src/providers/LinkedIn.vue";
    import VueGoodsharePinterest from "vue-goodshare/src/providers/Pinterest.vue";
    import VueGoodshareReddit from "vue-goodshare/src/providers/Reddit.vue";
    import html2pdf from "html2pdf.js";

    export default {
        props: {
            page_url: {
                type: String,
                default: window.location.href,
            },
            page_description: {
                type: String,
                default: () => "",
            },
            page_title: {
                type: String,
                default: () => "",
            },
        },
        components: {
            VueGoodshareFacebook,
            VueGoodshareTwitter,
            VueGoodshareLinkedIn,
            VueGoodsharePinterest,
            VueGoodshareReddit,
        },
        methods: {
            saveDocAsPDF() {
                let options = {
                    margin: 5,
                    enableLinks: true,
                    pagebreak: { mode: 'avoid-all', before: '#page_brak_post_content' },
                    image: { type: 'jpeg', quality: 0.98 },
                    filename: this.page_title+'-from-patienceman.com.pdf',
                };

                html2pdf(document.getElementById("downloadable"), options);
            },
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
    .button-social svg,
    .button-social i {
        line-height: 0;
        display: inline-flex;
        height: 14px;
        margin-right: 5px;
        padding: 7px;
    }
    .share {
        grid-gap: 1rem;
        align-items: center;
        background-color: white;
        border-radius: .5rem;
        color: #44414e;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        justify-content: center;
        max-width: 60rem;
        padding: 1rem 2rem;
        text-align: center;
        border: 1px solid #dbe0e4;
    }

    @media(min-width: 64em) {
        .share {
            flex-direction:row;
            justify-content: flex-start;
            text-align: left
        }
    }

    .share__text {
        color: inherit;
        flex-shrink: 1;
        font-family: "Anek Telugu", sans-serif;
        font-size: 1.4rem !important;
        font-weight: 600;
        line-height: 1.2;
        margin: 0
    }

    @media(min-width: 64em) {
        .share__text {
            font-size:1rem
        }

        .share__action {
            margin-left: auto
        }
    }

    .novashare-buttons-wrapper {
        flex-direction: row;
        flex-wrap: nowrap
    }

    .novashare-buttons-wrapper,a.novashare-button {
        align-items: center;
        display: flex;
        justify-content: center
    }

    a.novashare-button {
        grid-gap: .5rem;
        color: inherit;
        gap: .5rem;
        height: 2rem;
        padding: .5rem;
        transition: color .2s;
        width: 2rem
    }

    a.novashare-button:focus,a.novashare-button:hover {
        color: #5333ed
    }

    a.novashare-button svg {
        height: 1rem;
        width: 1rem
    }

    .novashare-hide {
        clip: rect(1px 1px 1px 1px);
        clip: rect(1px,1px,1px,1px);
        height: 1px;
        min-height: 0;
        min-width: 0;
        overflow: hidden;
        position: absolute;
        white-space: nowrap;
        width: 1px
    }

    @keyframes rotate {
        0% {
            transform: rotate(0deg)
        }

        to {
            transform: rotate(1turn)
        }
    }

    @keyframes fade-in {
        0% {
            opacity: 0
        }

        to {
            opacity: 1
        }
    }

    .yogurt-w1ph0e {
        -webkit-tap-highlight-color: transparent;
        font-family: "Anek Telugu", sans-serif;
        appearance: none;
        box-sizing: border-box;
        cursor: pointer;
        font-size: 16px;
        text-decoration: none;
        background: #c2bfca;
        border-radius: 80px;
        font-weight: 600;
        line-height: 1;
        text-align: center;
        display: inline-block;
        color: white;
        border: 2px solid transparent;
        padding: 0.3em 1em;
        height: auto;
        transition: border-color 0.2s ease 0s, background-color 0.2s ease 0s, color 0.2s ease 0s;
        box-sizing: content-box !important;
    }

    .yogurt-w1ph0e .yogurt-3xbgk5{
        display: inline-flex;
        align-items: center;
        justify-content: center;
        align-content: center;
        text-align: center;
        box-sizing: content-box !important;
    }
</style>
