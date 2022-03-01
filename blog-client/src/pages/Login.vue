<template>
    <form v-on:submit.prevent="login">
        HI, {{user ? user.name : 'Guest'}} <br/>
        <button>Login</button>
    </form>
</template>
<script>
import { useStore } from 'vuex'
export default ({
    setup() {
        const store = useStore(); 
        const user = store.getters.user
        const login = () => {
            store.dispatch('login', {
                email: "m.mirakhmad@gmail.com",
                password: 'password'
            })
        } 
        return {
            login,
            user
        }
    },
})
</script>
