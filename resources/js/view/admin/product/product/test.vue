<template>
  <div>
    <input type="checkbox"  v-model="checkedNames" v-bind:id="1"> 
    <label for="1"> checkbox</label>
    <p> value: {{ checkedNames }}</p>
  </div>
  
 

 
</template>
<script>
export default{
  data(){
    return {
      checkedNames:0,
    }
  }
}
</script>