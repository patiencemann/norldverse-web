<template>
    <div class="mb-6 mt-6">
        <v-md-editor
            height="600px"
            @input="$emit('update', $event.target.value)"
            v-on="$listeners"
            :value="value">
        </v-md-editor>
    </div>
</template>

<script>
    import Vue from 'vue';
    import VMdEditor from '@kangc/v-md-editor/lib/codemirror-editor';
    import enUS from '@kangc/v-md-editor/lib/lang/en-US';

    import '@kangc/v-md-editor/lib/style/codemirror-editor.css';
    import githubTheme from '@kangc/v-md-editor/lib/theme/github.js';

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

    // Resources for the codemirror editor
    import Codemirror from 'codemirror';

    // mode
    import 'codemirror/mode/markdown/markdown';
    import 'codemirror/mode/javascript/javascript';
    import 'codemirror/mode/css/css';
    import 'codemirror/mode/htmlmixed/htmlmixed';
    import 'codemirror/mode/vue/vue';

    // edit
    import 'codemirror/addon/edit/closebrackets';
    import 'codemirror/addon/edit/closetag';
    import 'codemirror/addon/edit/matchbrackets';

    // placeholder
    import 'codemirror/addon/display/placeholder';

    // active-line
    import 'codemirror/addon/selection/active-line';

    // scrollbar
    import 'codemirror/addon/scroll/simplescrollbars';
    import 'codemirror/addon/scroll/simplescrollbars.css';

    // style
    import 'codemirror/lib/codemirror.css';

    VMdEditor.lang.use('en-US', enUS);
    VMdEditor.Codemirror = Codemirror;
    VMdEditor.use(githubTheme, { Hljs: hljs, });
    VMdEditor.use(createCopyCodePlugin());
    VMdEditor.use(createLineNumbertPlugin());
    VMdEditor.use(createEmojiPlugin());

    Vue.use(VMdEditor);

    export default {
        inheritAttrs: false,
        props: ["value"],
        model: {
            prop: "value",
            event: "update",
        },
    };
</script>
