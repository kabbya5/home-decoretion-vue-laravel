import { createWebHistory, createRouter } from "vue-router";

import Index from './view/Index.vue';
import Login from './view/user/Login.vue';
import Register from './view/user/Register.vue';


const routes = [
  {
    path: "/", name: "home", component: Index,
      // meta:{title:'News Feed'}
  },
  {
    path:"/login", name:'login', component: Login,
  },
  {
    path:"/register", name:'register', component: Register,
  }
  // {
  //     name:"userProfle", path: "/profile/:userId", 
  //     component: UserProflie, 
  //     meta:{title:'Profile'}
  // },
  // {
  //   name:"UserLogin", path:"/login",
  //   component:Login,
  //   meta:{title:"Login"}
  // },
  // {
  //   name:'userRegister', path:'/register',
  //   component:Register,
  //   meta:{title:'Register'}
  // }

];

const router = createRouter({
  history: createWebHistory(),
  routes,
});
// router.beforeEach((to, from, next) =>{
// document.title =`Facebok/${to.name}` 
//   next()
// });

export default router;


