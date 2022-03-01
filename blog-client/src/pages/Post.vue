<template> 
    <h1 class="block text-center text-3xl sm:text-4xl leading-10 font-extrabold tracking-tight text-gray-900">{{post.title}}</h1>
    <div class="mt-16 text-gray-500 prose prose-sm lg:prose" v-html="post.body"></div>     
</template>
<script> 
import { onMounted } from 'vue'
import usePosts from '../api/usePosts' 

export default({
    props: {
        slug: {
            required: true,
            type: String
        }
    },
    setup(props) { 
        const { post, fetchPost } = usePosts() 
        onMounted(fetchPost(props.slug))
        return {
            post
        }
    },
})
</script>
