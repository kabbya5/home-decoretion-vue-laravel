<template>
    <swiper class="w-full"
    
      :modules="modules"
      :slides-per-view="1"
      :space-between="50"
      navigation
      :pagination="{ clickable: true }"
      :scrollbar="{ draggable: true }"
      @swiper="onSwiper"
      @slideChange="onSlideChange"
      :autoplay ="{
        delay:300,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
    }"
    >
      <swiper-slide v-for="slider in sliders" :key="slider.id">
        <div class="relative w-full h-[400px] md:h-[600px] xl:h-[700px]">  
            <img :src="slider.sliderImg" class="object-cover h-full w-full block brightness-75"> 
            <div class="absolute flex flex-col justify-center items-center  bottom-[50%] translate-y-[50%] z-10 text-white left-[20%]">
              <div class="ql-snow">
                <p class="ql-editor" v-html="slider.sliderText"></p>
              </div>

            <button class="my-4 px-4 py-2 bg-white text-gray-600 font-bold uppercase rounded-md transition duration-300 hover:bg-gray-200 hover:scale-[1.05]"> {{ slider.buttonText }} </button>
            </div>    
        </div>
        </swiper-slide>
    </swiper>
  </template>
  <script scoped>
    // import Swiper core and required modules
    import { Navigation, Pagination, Scrollbar, A11y, Autoplay } from 'swiper';
  
    // Import Swiper Vue.js components
    import { Swiper, SwiperSlide } from 'swiper/vue';
  
    // Import Swiper styles
    import 'swiper/css';
    import 'swiper/css/navigation';
    import 'swiper/css/pagination';
  
    // Import Swiper styles
    export default {
      props:['sliders'],
      components: {
        Swiper,
        SwiperSlide,
        Autoplay,
      },
      setup() {
        const onSwiper = (swiper) => {
          
        };
        const onSlideChange = () => {
         
        };
        return {
          onSwiper,
          onSlideChange,
          modules: [Navigation, Pagination, Scrollbar, A11y],
        };
      },
      data(){
        return {
            img:'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Image_created_with_a_mobile_phone.png/640px-Image_created_with_a_mobile_phone.png',
        }
      },
    };
  </script>
<style scoped>
.swiper-button-prev {
  background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M0%2C22L22%2C0l2.1%2C2.1L4.2%2C22l19.9%2C19.9L22%2C44L0%2C22L0%2C22L0%2C22z'%20fill%3D'%234c71ae'%2F%3E%3C%2Fsvg%3E") !important;
}
.swiper-button-next {
  background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z'%20fill%3D'%234c71ae'%2F%3E%3C%2Fsvg%3E") !important;
}
.ql-editor h1{
  font-size: 30px;
  color: black;
  text-align: center;
  text-shadow: 1px 1px 1px #444;
  animation: moveInleft 1s ease-out;
}
.ql-editor h2{
  animation: moveInRignt 1s ease-out;
}
.absolute button{
  animation:moveInBottom 1s linear;
}
@keyframes moveInleft {
  0%{
      opacity: 0;
      transform: translateX(-100px);
  }
  80%{
      transform: translateX(10px);
  }
  100%{
      transform: translate(0);
      opacity: 1;
  }
}
@keyframes moveInRignt {
  0%{
    opacity: 0;
    transform: translateX( 100px);
  }
  80%{
    transform: translateX(-10px);
  }
  100%{
    opacity:1;
    transform: translate(0);
  }
}
@keyframes moveInBottom{
  0%{
    opacity: 0;
    transform: translateY(30px);
  }
  100%{
    opacity:1;
    transform: translate(0);
  }
}
</style>