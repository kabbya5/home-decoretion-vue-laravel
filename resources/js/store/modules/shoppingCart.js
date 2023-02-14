import axios from "axios";

const state = {
    cart:null,
};

const getters = {};

const actions = {
    fatchShoppingCate({commit,state}){
        axios.get('/shopping/carts')
        .then(res => {
            this.cart = res.data['carts']
        })
    }
};

const mutations = {
    setCartItem(state,cart){
        state.cart = cart;
    }
};

export default {
    state, getters, actions, mutations,
}