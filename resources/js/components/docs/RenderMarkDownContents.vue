<template>
    <v-md-preview :text="contents"></v-md-preview>
</template>
<script>
    import VMdPreview from '@kangc/v-md-editor/lib/preview';
    import '@kangc/v-md-editor/lib/style/preview.css';

    // Introduce the theme you use. Take the github theme as an example here
    import githubTheme from '@kangc/v-md-editor/lib/theme/github';
    import '@kangc/v-md-editor/lib/theme/style/github.css';

    // Support Code copier
    import '@kangc/v-md-editor/lib/theme/style/github.css';
    import createCopyCodePlugin from '@kangc/v-md-editor/lib/plugins/copy-code/index';

    // Suport line number
    import '@kangc/v-md-editor/lib/plugins/copy-code/copy-code.css';
    import createLineNumbertPlugin from '@kangc/v-md-editor/lib/plugins/line-number/index';

    // Support Emoji
    import createEmojiPlugin from '@kangc/v-md-editor/lib/plugins/emoji/index';
    import '@kangc/v-md-editor/lib/plugins/emoji/emoji.css';

    // highlightjs
    import hljs from 'highlight.js';

    VMdPreview.use(githubTheme, { Hljs: hljs, codeHighlightExtensionMap: { vue: 'xml' }, });
    VMdPreview.use(createCopyCodePlugin());
    VMdPreview.use(createLineNumbertPlugin());
    VMdPreview.use(createEmojiPlugin());

    Vue.use(VMdPreview);

    export default {
        props: {
            contents: {
                type: String,
                default: '### Norldverse shared content loading',
            },
            doc_id: {
                type: String,
            }
        },
        mounted() {
            axios.post(`/api/doc/views/${this.doc_id}`);
        }
    };
</script>
