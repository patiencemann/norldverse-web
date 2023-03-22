<template>
    <div id="social-platforms">
        <a class="social-btn btn-icon" target="_blank" :href="'https://www.facebook.com/sharer/sharer.php?u='+sharing.url">
            <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24">
                <path d="M15.12,5.32H17V2.14A26.11,26.11,0,0,0,14.26,2C11.54,2,9.68,3.66,9.68,6.7V9.32H6.61v3.56H9.68V22h3.68V12.88h3.06l.46-3.56H13.36V7.05C13.36,6,13.64,5.32,15.12,5.32Z"/>
            </svg>
        </a>
        <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" target="_blank" class="social-btn btn-icon" data-show-count="false">
            <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24">
                <path d="M22,5.8a8.49,8.49,0,0,1-2.36.64,4.13,4.13,0,0,0,1.81-2.27,8.21,8.21,0,0,1-2.61,1,4.1,4.1,0,0,0-7,3.74A11.64,11.64,0,0,1,3.39,4.62a4.16,4.16,0,0,0-.55,2.07A4.09,4.09,0,0,0,4.66,10.1,4.05,4.05,0,0,1,2.8,9.59v.05a4.1,4.1,0,0,0,3.3,4A3.93,3.93,0,0,1,5,13.81a4.9,4.9,0,0,1-.77-.07,4.11,4.11,0,0,0,3.83,2.84A8.22,8.22,0,0,1,3,18.34a7.93,7.93,0,0,1-1-.06,11.57,11.57,0,0,0,6.29,1.85A11.59,11.59,0,0,0,20,8.45c0-.17,0-.35,0-.53A8.43,8.43,0,0,0,22,5.8Z"/>
            </svg>
        </a>
        <a class="social-btn btn-icon" target="_blank" :href="'https://www.linkedin.com/shareArticle?mini=true&url='+sharing.url">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g data-name="Brand Logos" fill="#6563ff">
                    <path d="M5.004 7h-.029a2.235 2.235 0 1 1 .057-4.457A2.235 2.235 0 1 1 5.004 7ZM3.018 10h4v12h-4zM17.518 10a4.473 4.473 0 0 0-3.5 1.703V10h-4v12h4v-5.5a2 2 0 0 1 4 0V22h4v-7.5a4.5 4.5 0 0 0-4.5-4.5Z"/>
                </g>
            </svg>
        </a>
    </div>
</template>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/zh_CN/sdk.js#xfbml=1&version=v16.0" nonce="9KFCg0GQ" ></script>
<script>
export default {
    props: {
        sharedData: { type: Object, default: { title: "title" } },
    },
    data() {
        return {
            sharing: {
                origin: `${location.origin}`,
                url: `${location.origin}${location.pathname}`,
                title: this.$attrs.shareddata.title,
                description: this.$attrs.shareddata.caption,
                quote: this.$attrs.shareddata.title,
                hashtags: "patienceman, docs, blog, news",
            },
            socials: [
                {
                    network: "twitter",
                    name: "Twitter",
                    icon: "fa fa-twitter",
                    color: "#1da1f2",
                },
                {
                    network: "facebook",
                    name: "Facebook",
                    icon: "fa fa-facebook-official ",
                    color: "#1877f2",
                },
                {
                    network: "linkedin",
                    name: "LinkedIn",
                    icon: "fa fa-linkedin-square",
                    color: "#007bb5",
                },
            ],
        };
    },
    watch: {
        sharedData: function(newVal, oldVal) { // watch it
          console.log('Prop changed: ', newVal, ' | was: ', oldVal)
        }
    }
};
</script>

<style scoped>
#social-platforms {
    text-align: center;
    display: flex;
    margin-top: 30px;
    position: relative;
    max-width: 200px;
    padding-top: 18px;
}

#social-platforms:before {
    position: absolute;
    top: -0.5rem;
    right: 0;
    content: '';
    display: block;
    width: 100%;
    height: 1px;
    background-color: rgb(72, 72, 72);
  }

#social-platforms:after {
    position: absolute;
    top: -1.2rem;
    right: 0;
    content: 'Share it to your Networks';
    padding-left: 10px;
    background-color: rgba(245, 245, 245, 1);
    font-size: 14px;
    font-weight: 600
  }

/*Pen code from this point on*/
#social-platforms .social-btn {
    font-size: 0.8em;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 5px;
    box-shadow: 0 1px 5px 0 rgba(0, 0, 0, 0.09);
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
    transition: all 0.5s;
    overflow: hidden;
    margin-right: 10px;
    background: white;
}

#social-platforms .social-btn:hover {
    box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.03);
}

#social-platforms .social-btn:focus {
    box-shadow: 0 3px 10px 0 rgba(0, 0, 0, 0.04);
}
#social-platforms .btn-icon > svg {
    padding: 15px;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
    transition: all 0.5s;
    width: 50px;
}

#social-platforms .btn-icon > .social-label {
    border-radius: 0 5px 5px 0;
}
</style>
