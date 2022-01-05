<template>
  <div>
    <Hero/>
    <Slider :cuisines="cuisines"
    />
    <AppDeliveboo/>
    <!-- <ul>
        <li v-for="cuisin in cuisines" :key="cuisin.id">
            <h3> {{cuisin.name}}</h3>
        </li>
    </ul> -->
  </div>
</template>

<script>
import Hero from "../components/Hero.vue";
import Slider from "../components/Slider.vue";
import AppDeliveboo from "../components/AppDeliveboo.vue";

export default {
  name: "Home",
  components: {
    Hero,
    AppDeliveboo,
    Slider,
  },
  
};
</script>

<style>
</style>