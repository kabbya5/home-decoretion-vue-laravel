import { createWebHistory, createRouter } from "vue-router";

import Index from './view/Index.vue';
import Login from './view/user/Login.vue';
import Register from './view/user/Register.vue';
import ProductDetail from './view/ProductDetail.vue';
import ShopPage from './view/ShopPage.vue';
import Contact from './view/Contact.vue';
import UserDashboard from './view/user/UserDashboard.vue';
import UserOrders from './view/user/Orders.vue';
import UserOrderDetails from './view/user/OrderDetails.vue';
import UserCartContent from  './view/CartContent.vue';
import Checkout from './view/Checkout.vue';
import TeamAndCondition from './view/TeamAndCondition.vue';
import ResentViewProducts from './view/user/ResentViewProducts.vue';
import WishlistIndex from './view/WishlistIndex.vue';
// page details like abouts us , contact for user and admin

import PageDetails from './view/admin/pages/PageDetails.vue'; 

// Admin 

// slider and category 

import AdminDashboard from './view/admin/AdminDashboard.vue';
import CategoryIndex from './view/admin/category/CategoryIndex.vue';
import TrashedCategory from './view/admin/category/TrashedCategory.vue';
import SubcategoryIndex from './view/admin/subcategory/SubcategoryIndex.vue';
import ChildCategory from './view/admin/childcategory/childCategory.vue';
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
import ProductSize from './view/admin/product/SizeIndex.vue';

// Site Setting
import SiteSetting  from './view/admin/sitesetting/SiteSetting.vue';
import SocialMediaLink from './view/admin/sitesetting/SocialMedialLink.vue';
import DeliverySetting from './view/admin/sitesetting/DeliverySetting.vue';

//order 
import OrderIndex from './view/admin/order/OrderIndex.vue';
import OrderDetails from './view/admin/order/OrderDetails.vue';
import CouponIndex from './view/admin/coupon/CouponIndex.vue';

// page setting 
import HomepageEntry from './view/admin/pagesetting/homePage/HomepageEntry.vue';
import ContactPageSetting from './view/admin/pagesetting/ContactPageSetting.vue';
import PagesIndex from "./view/admin/pages/Index.vue";
import DevelopmentPageTitle from "./view/admin/pagesetting/developmentPage/Title.vue";
import DevelopmentPageSlider from "./view/admin/pagesetting/developmentPage/Slider.vue";
import DevelopmentPageImage from "./view/admin/pagesetting/developmentPage/Image.vue";
import DevelopmentPageCategory from "./view/admin/pagesetting/developmentPage/Category.vue";
import DevelopmentPageValue from './view/admin/pagesetting/developmentPage/OurValue.vue';
import DevelopmentPageProject from './view/admin/pagesetting/developmentPage/Project.vue';

//UserDetails 
import UserIndex from './view/admin/users/UsersIndex.vue';
import AdminUserDetails from './view/admin/users/UserDetails.vue';

// Message 
import MessageIndex from './view/admin/Message/Index.vue';

// extra page 
import CompanyPage from './view/companyPage/index.vue';
const routes = [
  
  {
    path: "/", name: "home", component: Index,
  },
  {
    path:'/:slug', name:'other-page',
    component:CompanyPage,
  },
  {
    path:'/:slug/details', name:'page-details',
    component:PageDetails,
  },
  // user 
  {
    path:'/users/orders',component:UserOrders,
    name:'user-orders'
  },
  {
    path:'/order/:slug', component:UserOrderDetails,
    name:'user-order-details',
  },
  {
    path:"/login", name:'login', component: Login,
  },
  {
    path:"/register", name:'register', component: Register,
  },
  {
    path:'/product-detail/:slug', name:'product-detail', component:ProductDetail,
  },
  {
    path:'/contact', name:'contact', component:Contact,
  },
  {
    path:'/user/:userSlug/dashboard/', name:'user-dashboard',
    component:UserDashboard,
  },
  // ShopPage
  {
    path:'/shop/page/:status/products', name:'shop-page',
    component:ShopPage
  },
  {
    path:'/:sliderSlug', name:'sliderShopPage',
    component:ShopPage,
  },
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
  {
      path:'/resent/view/prdouct/:slug', name:'resent-view-product',
      component:ResentViewProducts,
  },
 

  // cart and checkout 

  {
    path:'/carts/content', name:'cart-content',
    component:UserCartContent,
  },
  {
    path:'/checkout', name:'checkout', component:Checkout,
  },
  {
    path:'/team-and-condition', name:"team_and_condition", component:TeamAndCondition,
  },
  {
    path:'/user/wishlist/product', name:'wishlist',component:WishlistIndex,
  },


  // admin section 
  {
    path:'/admin/system/dashboard/', name:'adminDashboard',
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
    path:'/admin/childcategory/index', name:'admin-childcategory',
    component:ChildCategory,
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
    path:'/admin/product/images/trashed', name:'adminTrashedIamge',
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
    path:'/admin/product/size/index', name:'product-size',
    component:ProductSize,
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
    path:'/admin/home/page/entry', name:'homepage-entry',
    component:HomepageEntry,
  },
  {
    path:'/admin/contact/page/setting' , name:'adminContactPageSetting',
    component:ContactPageSetting,
  },
  {
    path:'/admin/pages/index', name:'adminPageIndex',
    component:PagesIndex,
  },
  {
    path:'/admin/development/page/setting/title', name:'development-page-title',
    component:DevelopmentPageTitle,
  },
  {
    path:'/admin/development/page/slider', name:'development-page-slider',
    component:DevelopmentPageSlider,
  },
  {
    path:'/admin/development/page/image', name:'development-page-image',
    component:DevelopmentPageImage,
  },

  {
    path:'/admin/development/page/catgory', name:'development-page-category',
    component:DevelopmentPageCategory,
  },
  {
    path:'/admin/development/page/value', name:'development-page-value',
    component:DevelopmentPageValue,
  },
  {
    path:'/admin/development/page/project', name:'development-page-project',
    component:DevelopmentPageProject,
  },
  
  // coupon 

  {
    path:'/admin/coupons', name:'adminCoupon',
    component:CouponIndex,
  },

  //Order 
  {
    path:'/admin/orders/index', name:'adminOrders',
    component:OrderIndex,
  },
  {
    path:'/admin/orders/details/:slug', name:'adminOrderDetails',
    component:OrderDetails,
  },

  // users manage 

  {
    path:'/admin/all/users/index', name:'adminUsers',
    component:UserIndex,
  },
  {
    path:'/admin/user/details/:slug', name:'adminUserDetails',
    component:AdminUserDetails,
  },

  // message 
  {
    path:'/admin/message', name:'adminMessage',
    component:MessageIndex,
  },

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


