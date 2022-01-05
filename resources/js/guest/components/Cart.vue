<template>
  <div class="cart-component">
    <!-- <br> Window Width: {{ windowWidth }} <br/> -->
    {{ txt }}
    <h3>Carrello</h3>
    <div v-if="cart.items.length == 0" class="empty-cart">
      Il carrello è vuoto (∩︵∩)
    </div>
    <div class="foods" v-for="item in cart.items" :key="item.food.id">
      <div class="foods-name">
        {{ item.food.name }}
      </div>
      <div class="foods-buttons">
        <button type="button" @click="modifyCart(item.food, 'add')">
          <svg
            viewBox="0 0 49.44 49.44"
            style="enable-background: new 0 0 49.44 49.44"
          >
            <path
              class="st0"
              d="M43.62,20.33H29.11V5.82c0-1.22-0.99-2.22-2.22-2.22h-4.36c-1.22,0-2.22,0.99-2.22,2.22v14.51H5.82 c-1.22,0-2.22,0.99-2.22,2.22v4.36c0,1.22,0.99,2.22,2.22,2.22h14.51v14.51c0,1.22,0.99,2.22,2.22,2.22h4.36 c1.22,0,2.22-0.99,2.22-2.22V29.11h14.51c1.22,0,2.22-0.99,2.22-2.22v-4.36C45.84,21.32,44.84,20.33,43.62,20.33z"
            />
          </svg>
        </button>
        <button type="button" @click="modifyCart(item.food, 'remove')">
          <svg viewBox="0 0 49.44 49.44">
            <path
              class="st0"
              d="M42.84,29.14H6.6c-1.66,0-3-1.34-3-3v-2.85c0-1.66,1.34-3,3-3h36.23c1.66,0,3,1.34,3,3v2.85 C45.84,27.8,44.49,29.14,42.84,29.14z"
            />
          </svg>
        </button>
      </div>
      <div class="foods-quantity">
        <span class="border"> x{{ item.quantity }} </span>
      </div>
      <div class="foods-price">
        {{ getFoodPrice(item.food.price, item.quantity) }}€
      </div>
    </div>
    <div class="total" v-if="cart.items.length > 0">
      <div>TOTALE</div>
      <div>{{ totalPrice() }}€</div>
    </div>
    <a class="btn-checkout" href="/checkout" v-if="cart.items.length > 0">
      Vai al pagamento
    </a>
  </div>
</template>

<script>
export default {
  name: "Cart",
  props: ["food"],
  props: ["cart"],
  data() {
    return {
      cartQuantity: [],
      windowWidth: window.innerWidth,
      txt: "",
    };
  },
  mounted() {
    this.$nextTick(() => {
      window.addEventListener("resize", this.onResize);
    });
  },
  beforeDestroy() {
    window.removeEventListener("resize", this.onResize);
  },
  methods: {
    modifyCart(food, action) {
      this.$parent.$emit("food", { item: food, action: action });
    },
    getFoodPrice(e, amount) {
      return (e * amount).toFixed(2).replace(".", ",");
    },
    totalPrice() {
      let total = 0;
      this.cart.items.forEach((e) => {
        total += e.food.price * e.quantity;
      });
      return total;
    },
    onResize() {
      this.windowWidth = window.innerWidth;
    }
  },
};
</script>

<style lang="scss" scoped>
@import "../../../sass/guest/front.scss";

.cart-component {
  margin: auto;
  @include box--box-shadow;
  h3 {
    font-size: $txt;
    font-weight: bold;
}
  .empty-cart {
    margin: $gt 0;
    min-width: 300px;
  }
  .foods {
    display: flex;
    align-items: center;
  justify-content: space-between;
    // grid-template-columns: repeat(4, 50% 30% 10% 10%);
    margin: $gt_md 0;
    &>*:not(:last-child):not(:first-child) {
      padding: $gt
    }
    &-name {
      font-size: $txt_sm;
    }
    &-buttons {
      display: flex;
      justify-content: flex-end;
      button {
        margin: 0 $gt_sm;
      }
    }
    &-quantity {
      text-align: center;
      @include align-justify-center;

      .border {
        width: 40px;
        border: 1px solid #000;
        padding: 0.2rem 0.3rem;
        border-radius: $br_sm;
      }
    }
    &-price {
      text-align: center;
      width: 60px;
    }
  }
  .total {
    border-top: 1px solid #cccccca2;
    padding: $gt_md 0;
    @include justify-between;
    div {
      font-size: $txt;
    }
  }
  .btn-checkout {
    color: #000;
    background-color: $mainColor;
    display: block;
    text-align: center;
    padding: $gt;
    font-size: $txt_sm;
    border-radius: $br;
    margin-top: $gt_sm;
  }
}
svg {
  height: 19px;
}
.st0 {
  fill: #fff;
  stroke: #7e7e7e;
  stroke-miterlimit: 10;
}
button:hover .st0 {
  fill: #fff;
  stroke: #000000;
  stroke-miterlimit: 10;
}

@media screen and (max-width: 1180px) {
  .cart-component .foods{
  // grid-template-columns: repeat(4, 50% 30% 10% 10%);
  }
}
@media screen and (max-width: 1113px) {
  .cart-component .foods{
  // grid-template-columns: repeat(4, 40% 30% 10% 10%);
  }
  .cart-component .foods-name{
   font-size: 16px;
  }
}

@media screen and (max-width: 964px) {
  .cart-component .foods{
  // grid-template-columns: repeat(4, 40% 30% 10% 10%);
  }
  .cart-component .foods-name{
   font-size: 16px;
  }
}
@media screen and (max-width: 500px) {
 
  .cart-component .foods-name{
   font-size: 15px;
  }
}
@media screen and (max-width: 400px) {
 
  .cart-component .foods-name{
   font-size: 14px;
  }
}


</style>