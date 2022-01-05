<template>
  <div class="logo_box_restaurant">
       <router-link class="link_restaurant" :to="{ name: 'menu-restaurant', params: { slug: data.slug } }">
          
    <div class="logo_restaurant" v-if="data.business_logo!= null">
      <img
        :src="`/storage/${data.business_logo}`"
        alt="logo"
      />
    </div>
    <div class="card_restaurant">
      <div class="box_img_restaurant">
      <img  
        :src="`/storage/${data.business_cover}`"
          alt="restaurant"
          v-if="data.business_cover"

        />
              <img
          src="../../../images/cover_place.jpg"
          alt="restaurant"
          v-else
          :class="{ 'hide-element': displayElement }"
        />
      </div>
      <div class="description_restaurant">
        <h4>{{ data.business_name }}</h4>
        <ul>
          <li v-for="(cuisine, i) in data.cuisines" :key="`cuisine_${i}`" class="cuisine_category">
            <small>{{ cuisine.name }}</small>
          </li>
        </ul>
      </div>
    </div>
     </router-link>
  </div>
</template>

      <!-- @click="$parent.$emit('user_id', data.id)" -->
<script>
export default {
  name: "CardRestaurant",
  props: {
    data: Object,
    cuisineList: Array,
  },
};
</script>

<style scoped lang="scss">
@import "../../../sass/guest/front.scss";
.card_restaurant {
  background-color: white;
  width: 100%;
  box-shadow: 10px 6px 6px -9px rgba(0, 0, 0, 0.22);
  border-radius: $br_sm;
  overflow: hidden;
  transition: all 0.3s ease;
  ul {
    @include inline-block-list;
  }
  
}

h4 {
  font-weight: bold;
  font-size: 1rem;
}
.card_restaurant:hover {
  transform: scale(1.02);
}
.box_img_restaurant {
  width: 100%;
  border-radius: $br_sm $br_sm 0px 0px;
  height: 130px;
  img {
    overflow: hidden;
    object-fit: cover;
    width: 100%;
    height: 100%;
  }
}
.description_restaurant {
  padding: $gt_sm;
  color:black;
}
.logo_box_restaurant {
  position: relative;
}
.logo_restaurant {
  z-index: 1;
  right: 1rem;
  position: absolute;
    top: -$gt_sm;
  width: 60px;
  height: 60px;
  border-radius: $gt_sm;
  -webkit-box-shadow: 0px 0px 0px 3px $mainColor; 
  box-shadow: 0px 0px 0px 3px $mainColor;
  overflow: hidden;
  img {
    height: 100%;
    width: 100%;
    object-fit: cover;
    display: inline-block;
  }
}
.cuisine_category {
  font-size: $txt_xs;
}
.cuisine_category:not(:last-child):after {
  content: '\2022';
  margin: $gt_sm;
}

@media screen and (max-width:768px) {
  .box_img_restaurant {
  height: 150px;
  }
}

@media screen and (max-width:600px) {
  .box_img_restaurant {
  height: 120px;
  }
}

@media screen and (max-width:500px) {
  .box_img_restaurant {
  height: 110px;
  }
}
</style>