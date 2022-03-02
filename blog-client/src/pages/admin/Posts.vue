<template>
    <div class="space-y-16">
        <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            New post
        </button>
        <div v-for="post in posts" :key="post.uuid">
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
                        <!-- :to="{ name: 'admin.edit', params: { slug: post.uuid }}" -->
                        <router-link to="/" class="text-sm font-medium">Edit</router-link>
                    </div>
                    <div>
                        <button @click.prevent="deletePost(post.uuid)" class="text-sm font-medium">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script> 
import { onMounted } from 'vue'
import useAdminPosts from '../../api/UseAdminPosts' 

export default({
    setup() {
        const { posts, fetchPosts } = useAdminPosts() 
        function deletePost(uuid) {
            console.log(uuid)
        }
        onMounted(fetchPosts)
        return {
            posts,
            deletePost
        }
    },
})
</script>
