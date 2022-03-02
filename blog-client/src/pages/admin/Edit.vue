<template>
    <div>
        <ResizeTextarea v-if="post.title"> 
            <template v-slot:default="{ resize, el }"> 
                <textarea @input="resize" :ref="el" v-model="post.title" class="w-full text-center text-4xl lg:text-6xl leading-10 focus:ring-0 resize-none font-extrabold border-none tracking-tight text-gray-900"></textarea> 
            </template>
        </ResizeTextarea>
    </div>
</template>
<script> 
import { onMounted, watch } from 'vue'
import usePosts from '../../api/useAdminPosts'
import ResizeTextarea from '../../components/ResizeTextarea.vue'
import {cloneDeep, debounce} from 'lodash' 
export default({ 
    components: { ResizeTextarea },
    props: {
        slug: {
            required: true,
            type: String
        }
    },
    setup(props) {   
        const { post, fetchPost, patchPost } = usePosts() 
        const updatePost = async () => {
            await patchPost(props.slug) 
        }
        onMounted(async () => {
           await fetchPost(props.slug)
           watch(() => cloneDeep(post), debounce(() => {
                updatePost()
            }, 500))
        })
        return {
            post
        }
    },
})
</script>
