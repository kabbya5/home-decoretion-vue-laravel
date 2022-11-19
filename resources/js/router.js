import { createWebHistory, createRouter } from "vue-router";

import Index from './view/Index.vue';
import Login from './view/user/Login.vue';
import Register from './view/user/Register.vue';
import ProductDetail from './view/ProductDetail.vue';

// Admin 

import CategoryIndex from './view/admin/category/CategoryIndex.vue';
import TrashedCategory from './view/admin/category/TrashedCategory.vue';
import SubcategoryIndex from './view/admin/subcategory/SubcategoryIndex.vue';
import SliderIndex from './view/admin/silder/SliderIndex.vue';
import TrashedSubcat from './view/admin/subcategory/TrashedSubcat.vue';
import BrandIndex from './view/admin/brand/BrandIndex.vue';
import PoductImage from './view/admin/product/PoductImage.vue';
import TrashedImage from './view/admin/product/TrashedImage.vue';
import Color from './view/admin/product/Color.vue';

import CreateProduct from './view/admin/product/product/CreateProduct.vue';

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
  {
    path:'/product-detail', name:'productDetail', component:ProductDetail,
  },

  // admin section 
  {
    path:"/admin/slider/index", name:"adminSLider",
    component:SliderIndex,
  },
  {
      name:"adminCategory", path: "/admin/category/index", 
      component: CategoryIndex, 
  },
  {
    path:'/admin/category/trashed/index', name:'adminTrashedIdenx',
    component:TrashedCategory,
  },
  {
    path:'/admin/subcategory/index', name:"adminSubcategory",
    component: SubcategoryIndex,
  },
  {
    path:'/admin/subcetegory/trashed', name:'adminTrashSubcat',
    component: TrashedSubcat,
  },
  {
    path:'/admin/brand/index', name:'adminBrand',
    component:BrandIndex,
  },
  {
    path:'/admin/product/image/index', name:'adminProductImage',
    component:PoductImage,
  },
  {
    path:'/admin/product/image/trashed', name:'adminProductImageTrashed',
    component:TrashedImage,
  },
  {
    path:'/admin/product/create' , name:'adminPrdouctCreate',
    component:CreateProduct,
  },
  {
    path:'/admin/product/color/index', name:'adminProductColor',
    component:Color,
  },
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


