<template>
<div  :class="isActive ? 'active' : 'not-active'">

  <div @click="isActive ? $emit('cuisine_id', 'all') : $emit('cuisine_id', cuisine.id);" class="cuisine_card" >
    <div class="card__img"><img :src="`./images/red_cuisines/${cuisine.name.toLowerCase()}.jpg`" alt=""></div>
    <p :class="isActive ? 'active' : 'not-active'">
      {{ cuisine.name }}
    </p>
  </div>
</div>

  <!-- <button @click="$emit('cuisine_id', cuisine.id)">
        {{cuisine.name}}
        <img src="cuisine.image" alt="">
  </button> -->

</template>

<script>
export default {
  name: "Cuisine",
  props: ["cuisine", "cuisineActive", "isActive"],
  data() {
    return {
      active: 'active'
    }
  }
};
</script>

<style scoped lang="scss">
@import "../../../sass/guest/front.scss";

.cuisine_card {
    font-family: 'PolySans Neutral';

  text-align: center;
  cursor: pointer;
  transition: all 0.3s ease;
  .card__img {
    width: 100%;
    height: 150px;
    border-radius: $br;
    overflow: hidden;
  
  }
    img {
      width: 100%;
      height: 100%;
      transform: scale(1.2);
      object-fit: contain;
    transition: transform 0.3s ease-out;
    }
  &:hover {
    img {
        transform: scale(1.3);
    }
  }
}




.active {
  opacity: 1;
  transform: scale(1.2);
  transition: transform .3s;
}


.not-active {
  opacity: .75;
    transform: scale(1);
  transition: transform .3s;

}

@media screen and (max-width: 850px) {
    .cuisine_card {
          img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      transform: scale(1.3);
    }

    .card__img {
      height: 100%;
    }
    }
}
</style>


