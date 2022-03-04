<template>
    <div>
        <div class="absolute w-full left-0 top-0 flex justify-between items-center p-6">
            <div class="flex-grow flex items-center">
                <span class="mr-1">/</span> <input spellcheck="false" @click="$event.target.select()" type="text" v-model="post.slug" class="p-0 border-none focus:ring-0 w-full"> 
            </div>
            <div class="flex items-center space-x-6">
                <RelativeTime :date="lastSaved" v-if="lastSaved">
                    <template v-slot:default="{ fromNow }">
                        <span class="text-sm text-gray-500">{{fromNow}}</span>
                    </template>
                </RelativeTime>
                <button @click="post.published = !post.published" class="text-sm font-medium" :class="{'text-pink-500': post.published}">
                    {{!post.published ? 'Publish' : 'Unpublish'}}
                </button>
                <router-link v-if="post.slug" :to="{ name: 'post', params: { slug: post.uuid }}"  class="text-sm font-medium text-gray-800">Preview</router-link>
            </div>
        </div>
        <div>
            <ResizeTextarea v-if="post.title"> 
                <template v-slot:default="{ resize, el }"> 
                    <textarea @input="resize" :ref="el" v-model="post.title" class="w-full text-center text-4xl lg:text-6xl leading-10 focus:ring-0 resize-none font-extrabold border-none tracking-tight text-gray-900"></textarea> 
                </template>
            </ResizeTextarea>
        </div>
        <Editor v-model:modelValue="post.body" v-model:teaserValue="post.teaser" class="mt-16" />
    </div>
</template>
<script> 
import { onMounted, watch, watchEffect } from 'vue'
import usePosts from '../../api/useAdminPosts'
import ResizeTextarea from '../../components/ResizeTextarea.vue'
import Editor from '../../components/Editor.vue'
import RelativeTime from '../../components/RelativeTime.vue' 
import {cloneDeep, debounce} from 'lodash' 
import slugify from 'slugify'
import {ref} from 'vue'
import dayjs from 'dayjs'

export default({ 
    components: { ResizeTextarea, Editor, RelativeTime },
    props: {
        uuid: {
            required: true,
            type: String
        }
    },
    setup(props) {   
        const { post, fetchPost, patchPost } = usePosts() 
        const lastSaved = ref(null)

        const updatePost = async () => {
            await patchPost(props.uuid) 
            lastSaved.value = dayjs()
        }
        const replaceSlug = () => {
            const slug = post.value.slug
            if(slug.charAt(slug.length - 1) === ' ') {
                return
            }
            post.value.slug = slug ? slugify(slug, {strict: true}) : post.value.uuid
        }
        onMounted(async () => {
           await fetchPost(props.uuid)
           watchEffect(() => { 
               replaceSlug()
            })
           watch(() => cloneDeep(post), debounce(() => {
                updatePost()
            }, 500))
        })
        return {
            post,
            lastSaved
        }
    },
})
</script>
