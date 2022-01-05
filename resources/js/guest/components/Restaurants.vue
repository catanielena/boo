<template>
<div>
      <div class="btn_row">
        <div class="search_title">Cerca per nome</div>
        <input type="text" v-model="searchRestaurant" class="filter_btn">
        <button @click="sortByName()" class="btn-filter">Cerca</button>
      </div>
      <transition name="slide-fade" mode="out-in">
      <div class="grid_restaurants" :key="restaurants.length">
        <CardRestaurant
          v-for="restaurant in restaurants"
          :key="restaurant.id"
          :data="restaurant"
          :cuisineList="cuisineList"
        />
      </div>
      </transition>
</div>

</template>

<script>
import CardRestaurant from "./CardRestaurant.vue";

export default {
  name: "Restaurants",
  components: {
    CardRestaurant,
  },
  props: ["cuisine", "cuisineList"],
  data() {
    return {
      restaurants: [],
      count: 0,
      searchRestaurant: ''
    };
  },
  methods: {
    sortByName() {
      // this.getAll()
      if(this.searchRestaurant=="") {
        this.getAll()

      } else {

        this.restaurants =this.restaurants.filter(e=> e.business_name.toLowerCase().includes(this.searchRestaurant.toLowerCase()))
      }
    },
    getAll() {
          axios
      .get(`/api/restaurants`)
      .then((response) => {
        this.restaurants = response.data.data;
        this.count = this.restaurants.length;
        this.$emit('countRestaurant', this.count)
        
      })
      .catch((error) => {
        console.log(error);
      });
    },
    getFiltered() {
      axios
        .get(`/api/filter-by/${this.cuisine}`)
        .then((response) => {
          this.restaurants = response.data.data;
        this.count = this.restaurants.length;
        this.$emit('countRestaurant', this.count);

        })
        .catch((error) => {
          console.log(error);
        });
      }
  },
  watch: {
    cuisine: function() {
      if(this.cuisine == 'all') {
        this.getAll()
      } else {
        this.getFiltered();
        }
    },
    searchRestaurant: function() {
      this.sortByName();
    }
  },
  created() {
        this.getAll()

  }
}
</script>

<style scoped lang="scss">
@import "../../../sass/guest/front.scss";

//Restaurant
.grid_restaurants{
  grid-template-columns: repeat(5, 1fr);
  display: grid;
  column-gap: 15px;
  row-gap: 15px;
  padding: $gt_md;
}

.btn_row {
  padding: .5rem $gt_md;
  
  input {
    padding: .5rem;
    border-radius: $br_sm;
    border: 1.5px solid lightgray;
    // width: 80%;
  }

  .search_title {
    font-size: .8rem;
    padding: .3rem 0;
  }

  .btn-filter {
    background-color: $mainColor;
        padding: .5rem;

    border-radius: $br_sm;

  }
}

//Mediaqueri
@media screen and (max-width: 850px) {
  .grid_restaurants {
    grid-template-columns: repeat(4, 1fr);
  }
}

@media screen and (max-width: 768px) {
  .grid_restaurants {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media screen and (max-width: 425px) {
  .grid_restaurants {
    grid-template-columns: repeat(2, 1fr);
  }
}

</style>
