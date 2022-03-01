import {createStore} from 'vuex'

export default createStore({
    state() {
        return {
            authenticated: false,
            user: null
        }
    },
    getters: {
        authenticated (state) {
            return state.authenticated
        },
        user(state) {
            return state.user
        } 
    }
})
