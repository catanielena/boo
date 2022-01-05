<template>
<section class="container">
    <vue-horizontal responsive>
        <div class="item" v-for="cuisine in cuisines" :key="cuisine.id">
            <div class="card">
                <!-- <img :src="cuisine.image" :alt="cuisine.name"> -->
                <img src="" alt="">
            </div>
            <a href="#"><h3>{{cuisine.name}}</h3></a>
        </div>
      </vue-horizontal>
</section>
  
</template>

<script>
import VueHorizontal from 'vue-horizontal';
export default {
    name:"Slider",
    components: 
    {VueHorizontal},
    data() {
    return {
     
    };
  },
   props: ['cuisines'],
}
</script>

<style scoped lang="scss">
@import '../../../sass/guest/front.scss';
.container{
     @include container-90;
}

div.item{
    margin: 10px 5px;
    text-align: center;
    border-radius: 10px;
    overflow: hidden;
    -webkit-box-shadow: 0px 3px 11px -3px #000000; 
    box-shadow: 0px 3px 11px -3px #000000;
    a{
        color:$darkColor;
    }
}

.card{
    img{
        width: 100%;
        object-fit:cover;
        object-position:center;
    }
}


</style>