<template>
    <div class="loop-subtitle relative">
        <div class="absolute inset-0 z-10 mx-0 -top-16 max-w-none overflow-hidden ">
            <div class="absolute left-1/2 top-0 ml-[-38rem] h-[25rem] w-[81.25rem] dark:[mask-image:linear-gradient(white,transparent)]">
              <div class="absolute inset-0 bg-gradient-to-r from-[#50217b] to-[#c4ee51] opacity-40 [mask-image:radial-gradient(farthest-side_at_top,white,transparent)] dark:from-[#36b49f]/30 dark:to-[#DBFF75]/30 dark:opacity-100">
                <svg aria-hidden="true" class="absolute inset-x-0 inset-y-[-50%] h-[200%] w-full skew-y-[-18deg] fill-black/40 stroke-black/50 mix-blend-overlay dark:fill-white/2.5 dark:stroke-white/5">
                  <defs>
                    <pattern id=":ro:" width="72" height="56" patternUnits="userSpaceOnUse" x="-12" y="4">
                      <path d="M.5 56V.5H72" fill="none"></path>
                    </pattern>
                  </defs>
                  <rect width="100%" height="100%" stroke-width="0" fill="url(#:ro:)"></rect>
                  <svg x="-12" y="4" class="overflow-visible">
                    <rect stroke-width="0" width="73" height="57" x="288" y="168"></rect>
                    <rect stroke-width="0" width="73" height="57" x="144" y="56"></rect>
                    <rect stroke-width="0" width="73" height="57" x="504" y="168"></rect>
                    <rect stroke-width="0" width="73" height="57" x="720" y="336"></rect>
                  </svg>
                </svg>
              </div>
              <svg viewBox="0 0 1113 440" aria-hidden="true" class="absolute left-1/2 top-0 ml-[-19rem] w-[69.5625rem] fill-[#f8fafc] blur-[26px] dark:hidden">
                <path d="M.016 439.5s-9.5-300 434-300S882.516 20 882.516 20V0h230.004v439.5H.016Z"></path>
              </svg>
            </div>
        </div>
        <small class="loop-subtitle-title global-title text-gray-700 dark:text-gray-200">
            See what has been<br />
            <span class="text-[#50217b]/90 dark:text-[#7123bb]">Written Lately</span>
        </small>
        <div class="global-authors" v-if="Object.keys(uniqueUser).length > 3">
            <div>
                <div class="global-item-author is-image global-image"
                    v-for="user in uniqueUser.slice(0, limit)"
                    :key="user.id">
                    <a
                        href="/author/breana/"
                        class="global-link"
                        title="Breana Flatley"
                    ></a>
                    <img :src="user.avatar" loading="lazy" :alt="user.name" />
                </div>
            </div>
            <small class="dark:text-gray-200">Meet our top Vistors</small>
        </div>
    </div>
</template>
<script>
export default {
    name: "title-section",
    data() {
        return {
            uniqueUser: [],
            isLoading: false,
            limit: 4,
        };
    },
    methods: {
        async getFrequentUsers() {
            this.isLoading = true;
            let commentResponse = await axios.get(`/api/vistors`);
            this.uniqueUser = commentResponse.data.data;
        },
    },
    mounted() {
        this.getFrequentUsers();
    },
};
</script>
