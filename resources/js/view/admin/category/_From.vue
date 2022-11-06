<template>
    <div>
        <div class="flex flex-col">
            <label for="name my-2 mx-4 text-gray-300"> Uniqe Category Name </label>
            <input type="text" placeholder="Category Name"
            :class="{'border-1 border-red-500':errors.categoryName}"
            class="my-2 px-4 py-2 border-2 focus:outline-none
                focus:border-gray-300" v-model="category.categoryName">

            <p v-if="errors.categoryName"> {{ errors.categoryName[0] }} </p>
        </div>
        <div class="flex flex-col">
            <label for="name my-2 mx-4 text-gray-500 font-semibold"> Category Image </label>

            <div class="flex justify-between items-center">
                <input type="file" placeholder="Category Image"
                    :class="{'border-1 border-red-500':errors.categoryName}"
                    class="my-2 px-4 py-2 border-2 focus:outline-none
                    focus:border-gray-300" 
                    @change="onFileChange">

                <img class="ml-2 w-14 h-14 rounded-full" :src="category.categoryImg" alt="">
            </div>

            <!-- hidden old image  -->
            <input type="hidden" v-model="category.oldImg">

            <p v-if="errors.categoryImg"> {{ errors.categoryImg[0] }} </p>
        </div>
        <div class="flex justify-center">
            <button type="submit" class="text-center my-4 px-4 py-2 uppercase trasition
                duration-300 text-center text-blue-800 border-2 border-blue-800
                hover:text-green-800 hover:border-green-800"> 
                {{ buttonText }}
            </button>
        </div>
    </div>
</template>
<script>
export default{
    props:['category','errors','buttonText'],
    data (){
        return{
            //
        }
    },
    methods: {
        onFileChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
        },
        createImage(file) {
            let reader = new FileReader();
            reader.onload = (e) => {
                this.category.categoryImg = e.target.result;
            };
            reader.readAsDataURL(file);
        },
    }
}
</script>