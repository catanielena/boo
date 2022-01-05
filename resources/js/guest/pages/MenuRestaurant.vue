<template>
  <section class="menu">
    <!-- cover -->
    <div class="cover-restaurant">
      <div class="restaurant-logo">
        <img
          :src="`/storage/${menu.business_logo}`"
          :alt="`${menu.business_name} logo`"
          v-if="menu.business_logo"
          :class="{ 'hide-element': displayElement }"
        />
        <img
          src="../../../images/placeholder_giallo.jpg"
          alt=""
          v-else
          :class="{ 'hide-element': displayElement }"
        />
      </div>

      <!-- Visible only mobile -->
      <button
        type="button"
        class="btn-checkout btn-show-cart"
        :class="{ 'button-go-left': displayElement }"
        @click="showCart()"
      >
        {{ displayElement ? "&#8592; Torna indietro" : "Mostra il carrello" }}
      </button>
      <!-- /Visible only mobile -->

      <img
        :src="`/storage/${menu.business_cover}`"
        :alt="`${menu.business_name} cover`"
        v-if="menu.business_cover"
        :class="{ 'hide-element': displayElement }"
      />
      <img src="../../../images/cover_place.jpg" alt="" v-else />
    </div>
    <!-- /cover -->

    <!-- restaurant -->
    <div class="restaurant">
      <!-- logo -->
      <!-- /logo -->
      <!-- menu -->
      <div class="restaurant-menu" :class="{ 'hide-element': displayElement }">
        <h2>{{ menu.business_name }}</h2>
        <div class="info_restaurant">
        <p clas>Indirizzo: <strong> {{ menu.business_address }}</strong></p>
        <p clas>Partita iva: <strong>{{ menu.vat_numb }}</strong></p>
        </div>

        <!-- <ul class="restaurant__info">
          <li>Indirizzo: {{ menu.business_address }}</li>
          <li>Partita Iva: {{ menu.vat_numb }}</li>
        </ul> -->
        <div class="restaurants-menu-foods">
          <Food v-for="food in menu.foods" :key="food.id" :food="food" />
        </div>
      </div>
      <!-- /menu -->
      <!-- cart -->
      <div id="cart" class="cart" :class="{ 'show-element': displayElement }">
        <Cart :cart="cart" />
      </div>
      <!-- /cart -->
    </div>
    <!-- /restaurant -->

    <ModalChangeCart
      v-show="isModalVisible"
      @close="closeModal"
      @clearCart="clearCart"
    />
  </section>
</template>

<script>
import Food from "../components/Food.vue";
import Cart from "../components/Cart.vue";
import ModalChangeCart from "../components/ModalChangeCart.vue";
export default {
  name: "MenuRestaurant",
  components: {
    Food,
    Cart,
    ModalChangeCart,
  },
  props: ["cart", "isModalVisible"],
  data() {
    return {
      menu: null,
      displayElement: false,
    };
  },
  methods: {
    showCart() {
      this.displayElement = !this.displayElement;
    },
    closeModal() {
      this.isModalVisible = false;
    },
    clearCart() {
      this.$emit("clearCart");
      this.closeModal();
    },
  },
  mounted() {
    axios
      .get(`/api/restaurants/${this.$route.params.slug}`)
      .then((response) => {
        if (response.data.success) {
          this.menu = response.data.data;
        } else {
          this.$router.push({ name: "not-fount" });
        }
      })
      .catch((error) => {
        console.log(error.response.data);
      });
  },
};
</script>

<style lang="scss" scoped>
@import "../../../sass/guest/front.scss";
  .info_restaurant {
    padding-bottom: 1rem;
  }

.cover-restaurant {


  height: 300px;
  position: relative;
  img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top center;
  }

  //  Logo rest and Buttons
  .restaurant-logo,
  .btn-checkout {
    position: absolute;
    bottom: -$gt_md;
  }

  .restaurant-logo {
    left: $gt;
    width: 100px;
    height: 100px;
    img {
      width: 100%;
      border-radius: $br;
      object-fit: cover;
        -webkit-box-shadow: 0px 0px 0px 3px $mainColor; 
  box-shadow: 0px 0px 0px 3px $mainColor;
    }
  }
  .btn-checkout {
    right: $gt;
    color: #000;
    background-color: $mainColor;
    text-align: center;
    padding: $gt;
    font-size: $txt;
    border-radius: $br;
  }
  //  Logo rest and Buttons
}
.restaurant {
  margin: $gt_lg;
  display: flex;
  align-items: start;
  justify-content: space-between;

  &-menu {
    padding: 0 $gt_lg;
    width: 55%;
    h2 {
      font-size: $txt_lg;
      margin-bottom: $gt;
    }
  }
  .cart {
    padding: 0 $gt_lg;
    // width: 45%;
  }
}

//border card foods
.restaurants-menu-foods {
  max-width: 500px;
}

// responsive
@media screen and (max-width: 850px) {
  .cover-restaurant .restaurant-logo {
    width: 90px;
    height: 90px;
    img {
      width: 100%;
      height: 100%;
    }
  }
  .cart {
    display: none;
  }
  .show-element {
    display: block;
  }
  .hide-element {
    display: none;
  }

  .button-go-left {
    left: $gt;
  }

  .restaurant-menu {
    width: 100%;
    padding: 0;
  }
  .restaurant {
    .cart {
      width: 100%;
    }
  }
}

@media screen and (max-width: 1202px) {
  .restaurant-menu {
    h2 {
      font-size: $txt_xl;
    }
  }
}

@media screen and (max-width: 966px) {
  .cart {
    width: 50%;
  }
  .restaurant-menu {
    //  width: 50%;
    h2 {
      font-size: $txt_lg;
    }
  }
  .restaurant .cart{
    padding: 0;
  }
}


@media screen and (max-width:500px) {
  .restaurant{
    margin:30px 10px;
  }
  .restaurant-menu {
    h2 {
      font-size: $txt_md;
    }
  }
}
@media screen and (min-width: 851px) {
  .btn-checkout {
    display: none;
  }
}
</style>