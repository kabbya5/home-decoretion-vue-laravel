import { createWebHistory, createRouter } from "vue-router";

import Index from './view/Index.vue';
import Login from './view/user/Login.vue';
import Register from './view/user/Register.vue';

// Admin 

import CategoryIndex from './view/admin/category/CategoryIndex.vue';
import SubcategoryIndex from './view/admin/subcategory/SubcategoryIndex.vue';
import SliderIndex from './view/admin/silder/SliderIndex.vue';
import SliderCrate from './view/admin/silder/SliderCreate.vue';
import TrashedSubcat from './view/admin/subcategory/TrashedSubcat.vue';


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
  },

  // admin section 
  {
    path:"/admin/slider/create", name:"adminSliderCreate",
    component:SliderCrate,
  },
  {
    path:"/admin/slider/index", name:"adminSLider",
    component:SliderIndex,
  },
  {
      name:"adminCategory", path: "/admin/category/index", 
      component: CategoryIndex, 
  },
  {
    path:'/admin/subcategory/index', name:"adminSubcategory",
    component: SubcategoryIndex,
  },
  {
    path:'/admin/subcetegory/trashed', name:'adminTrashSubcat',
    component: TrashedSubcat,
  }

 
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


