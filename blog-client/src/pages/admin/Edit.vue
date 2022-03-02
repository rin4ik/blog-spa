<template>
     <div class="flex items-baseline sm:justify-between flex-wrap sm:flex-nowrap space-x-0 sm:space-x-6 space-y-3 sm:space-y-0">
        <p class="text-xl font-bold tracking-tight text-gray-900">
            {{post.title}}
        </p>
        <div class="flex items-center space-x-6">
            <p class="text-base text-gray-500">
                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium"
                :class="{'bg-green-100 text-green-800': post.published, 'bg-gray-100 text-gray-800': !post.published}"
                >
                    {{post.published ? 'Published' : 'Unpublished'}}
                </span> 
            </p>
            <div> 
                <router-link :to="{ name: 'admin.posts.edit', params: { slug: post.uuid }}" class="text-sm font-medium">Edit</router-link>
            </div>
            <div>
                <button @click.prevent="deletePost(post.uuid)" class="text-sm font-medium">Delete</button>
            </div>
        </div>
    </div>
</template>
<script> 
import { onMounted } from 'vue'
import usePosts from '../../api/usePosts' 
import { useRoute } from 'vue-router'
export default({ 
    setup() {  
         const route = useRoute() 
        const { post, fetchPost } = usePosts() 
        onMounted(fetchPost(route.params.slug ))
        return {
            post
        }
    },
})
</script>
