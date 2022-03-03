<template>
    <div>
        <EditorContent :editor="editor"/>
    </div>
</template>
<script>
import StarterKit from '@tiptap/starter-kit'
import {useEditor, EditorContent} from '@tiptap/vue-3'
import {  watch } from 'vue'
export default ({
    components: {EditorContent},
    props: {
        modelValue: {
            type: String,
            default: ''
        }
    },
    setup(props, {emit}) { 
        const editor = useEditor({
            content: props.modelValue,
            extensions: [
                StarterKit
            ],
            editorProps: {
                attributes: {
                    class: 'min-w-full w-full prose prose-sm lg-prose focus:outline-none'
                }
            },
            onUpdate: (context) => {
                emit('update:modelValue', context.editor.getHTML())
            }
        }) 
        watch(() => props.modelValue, (value) => {
            if(editor.value.getHTML() === value) {
                return;
            }
            editor.value.commands.setContent(value)
        })
        
        return {
            editor
        }
    },
})
</script>
