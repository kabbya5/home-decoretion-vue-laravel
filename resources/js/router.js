import { createWebHistory, createRouter } from "vue-router";

import Index from './view/Index.vue';
import Login from './view/user/Login.vue';
import Register from './view/user/Register.vue';
import UserProfile from './view/user/UserProfile.vue';
import ProductDetail from './view/ProductDetail.vue';
import CartProduct from './view/user/cart/Cart.vue';
import ShopPage from './view/ShopPage.vue';
import Contact from './view/Contact.vue';
import UserDashboard from './view/user/UserDashboard.vue';

// Admin 
import AdminDashboard from './view/admin/AdminDashboard.vue';
import CategoryIndex from './view/admin/category/CategoryIndex.vue';
import TrashedCategory from './view/admin/category/TrashedCategory.vue';
import SubcategoryIndex from './view/admin/subcategory/SubcategoryIndex.vue';
import SliderIndex from './view/admin/silder/SliderIndex.vue';
import TrashedSubcat from './view/admin/subcategory/TrashedSubcat.vue';
import BrandIndex from './view/admin/brand/BrandIndex.vue';

// product 
import CreateProduct from './view/admin/product/product/CreateProduct.vue';
import ProductIndex from './view/admin/product/product/ProductIndex.vue';
import PoductImage from './view/admin/product/PoductImage.vue';
import TrashedImage from './view/admin/product/TrashedImage.vue';
import Color from './view/admin/product/Color.vue';
import Tag from './view/admin/Tag/TagIndex.vue';

// Site Setting
import SiteSetting  from './view/admin/sitesetting/SiteSetting.vue';
import SocialMediaLink from './view/admin/sitesetting/SocialMedialLink.vue';
import DeliverySetting from './view/admin/sitesetting/DeliverySetting.vue';
import Test from './view/admin/product/product/test.vue';

// page setting 

import ContactPageSetting from './view/admin/pagesetting/ContactPageSetting.vue';


const routes = [
  
  {
    path: "/", name: "home", component: Index,
      meta:{title:'News Feed'}
  },
  // user 
  {
    path:'/user/:slug/profile', Component:UserProfile,
    name:'user-profile', meta:{title:'User Profile'}
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
  {
    path:'/user/cart', name:CartProduct, component:CartProduct,
  },
  {
    path:'/contact', name:'contact', component:Contact,
  },
  {
    path:'/user/:userSlug/dashboard/', name:'userDashboard',
    component:UserDashboard,
  },
  // ShopPage
  {
    path:'/tag/:tagSlug', name:'tagShopPage',
    component:ShopPage,
  },
  {
    path:'/category/:catSlug', name:'categoryShopPage',
    component:ShopPage,
  },
  {
    path:'/subcategory/:subCatSlug', name:'subCategoryShopPage',
    component:ShopPage,
  },
  {
    path:'/childcategory/:childCatSlug', name:'childCategoryShopPage',
    component:ShopPage,
  },


  // admin section 
  {
    path:'/admin/dashboard', name:'adminDashboard',
    component:AdminDashboard,
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

  //admin products 

  {
    path:'/admin/product/image/index', name:'adminProductImage',
    component:PoductImage,
  },
  {
    path:'/admin/product/image/trashed', name:'adminProductImageTrashed',
    component:TrashedImage,
  },
  {
    path:'/admin/product/index', name:'adminProductIndex', 
    component:ProductIndex,
  },
  {
    path:'/admin/product/create/form' , name:'adminPrdouctCreate',
    component:CreateProduct,
  },
  {
    path:'/admin/product/:slug', name:'adminPoductEdit',
    component:CreateProduct,
  },
  {
    path:'/admin/product/test' , name:'adminTest',
    component:Test,
  },
  {
    path:'/admin/product/color/index', name:'adminProductColor',
    component:Color,
  },
  {
    path:'/admin/tags/index', name:'adminTags',
    component:Tag,
  },
  // admin site setting 
  {
    path:'/admin/site/setting/index', name:'adminSiteSetting', 
    component:SiteSetting,
  },
  {
    path:'/admin/social-media-links/index', name:'adminSocialMediaLink',
    component:SocialMediaLink,
  },
  {
    path:'/admin/delivery/setting', name:'adminDeliverySetting',
    component:DeliverySetting,
  },

  // admin page setting 
  {
    path:'/admin/contact/page/setting' , name:'adminContactPageSetting',
    component:ContactPageSetting,
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});
router.beforeEach((to, from, next) =>{
let pageTilte = document.querySelector("meta[name='title']").getAttribute('content');
document.title =`${to.name} | ` + pageTilte; 
  next()
});

export default router;


