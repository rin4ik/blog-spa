import axios from 'axios'
import { ref } from 'vue'

export default function useAdminPosts() {  
    const posts = ref([])
    const post = ref([])
    const fetchPosts = async () => {
        let response = await axios.get('/api/admin/posts')
        posts.value = response.data.data
    }
    const fetchPost = async (slug) => {  
        let response = await axios.get(`/api/admin/posts/${slug}`)
        post.value = response.data.data 
    }
    const createPost = async () => {  
       let response = await axios.post('/api/admin/posts')
       return response.data.data
    }
    return {
        posts,
        createPost,
        post,
        fetchPost,
        fetchPosts
    }
}
