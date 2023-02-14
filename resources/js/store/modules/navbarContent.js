const state = {
    currentUser:'',
    wishlistCount:'',
    cart:'',
    siteSetting:'',
    notifications:'',
};

const getters = {
    currentUser: state => {
        return state.currentUser;
    },
    cart: state =>{
        return state.cart;
    },
    siteSetting: state =>{
        return state.siteSetting;
    },
    wishlistCount: state =>{
        return state.wishlistCount;
    },
    notifications: state =>{
        return state.notifications;
    }
};

const actions = {
    fetchNavbarContent({commit,state}){
        axios.get('/get/navbar/content')
        .then(res =>{
            commit('setCartItem', res.data['cart']);
            commit('setSiteSetting', res.data['siteSetting']);
            commit('setWishlist', res.data['wishlistCount']);
            commit('setUser', res.data['user']);
            commit('setNotifications', res.data['notification']);
        });
    }
};

const mutations = {
    setCartItem(state,cart){
        state.cart = cart;
    },
    setSiteSetting(state,setting){
        state.siteSetting = setting;
    },
    setUser(state,user){
        state.currentUser = user;        
    },
    setWishlist(state,wishlist){
        state.wishlistCount = wishlist;
    },
    setNotifications(state,notifications){
        state.notifications = notifications;
    }
    
};

export default {
    state, getters, actions, mutations,
}