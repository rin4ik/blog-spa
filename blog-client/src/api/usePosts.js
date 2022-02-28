import axios from 'axios'
import { ref } from 'vue'

export default function usePosts() {
    const posts = ref([])
    const fetchPosts = async () => {
        let response = await axios.get('/api/posts')
        posts.value = response.data.data
    }
    return {
        posts,
        fetchPosts
    }
}
