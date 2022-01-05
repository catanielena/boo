<template>
  <section>
      <div>
        <Food v-for="food in menu.foods" :key="food.id" :food="food"/>
      </div>
      <div>
          <h3>Carrello</h3>
        <Cart :cart="cart"/>
        <button @click="cart = []"> clear cart</button>
      </div>

  </section>
</template>

<script>
import Food from '../components/Food.vue'
import Cart from '../components/Cart.vue'

export default {
    name: 'Test',
    components: {
        Food,
        Cart
    },
    props: ['cart'],
    data() {
        return {
            menu: null
        }
    },
    mounted() {
        axios.get(`/api/restaurants/${this.$route.params.slug}`)
        .then((response) => {
            // handle success
            if( response.data.success ) {
                this.menu = response.data.data;
                console.log(response);
            } else {
                // redirect 404
                this.$router.push({name: 'not-fount'});
            }
        })
        .catch( (error) => {
            // handle error
            console.log(error);
        })
    }
}

</script>

<style>
section {
    display: flex;
    justify-content: space-around;
}
</style>