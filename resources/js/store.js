import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        categories: [
            {id: 1, name: 'Travel', icon: '🌍'},
            {id: 2, name: 'Music', icon: '🎵'},
            {id: 3, name: 'Movie', icon: '🎦'},
            {id: 4, name: 'Reading', icon: '📖'},
            {id: 5, name: 'Gaming', icon: '🎮'}
        ]
    },
})
