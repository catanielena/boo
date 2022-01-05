<template>
  <div class="checkout">
    <div class="checkout__header padding-responsive">
      <h2 class="container--1000">Checkout</h2>
    </div>
    <div class="checkout__body container--1000">

      <form action="" @submit="validateForm" name="orderForm" >
        <div class="body__cart">
          <!-- carrello -->
          <h5 class="cart__title" v-show="formValidated == false">Carrello</h5>
          <div v-if="cart.items.length == 0" class="color--grey" v-show="formValidated == false">
            Il carrello è vuoto (๑◕︵◕๑)
          </div>
          <div
            v-for="food in cart.items"
            :key="food.food.id"
            class="cart__food-card"
            v-show="formValidated == false"
          >
            <div class="food-card__info">
              <div class="info__img">
                <img
                  v-show="food.food.image !== ''"
                  :src="`storage/${food.food.image}`"
                  :alt="food.food.name"
                />
              </div>
              <ul>
                <li>
                  <label :for="food.food.id">{{ food.food.name }}</label>
                </li>
                <li>x{{ food.quantity }}</li>
                <li>{{ getFoodPrice(food.food.price, food.quantity) }}€</li>
              </ul>
              <input
                type="text"
                :id="food.food.id"
                :value="food"
                :name="food.food.id"
                hidden
              />
            </div>
            <div class="food-card__btn">
              <button type="button" @click="modifyCart(food, 'add')">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  x="0px"
                  y="0px"
                  viewBox="0 0 49.44 49.44"
                  style="enable-background: new 0 0 49.44 49.44"
                  xml:space="preserve"
                >
                  <path
                    class="st0"
                    d="M43.62,20.33H29.11V5.82c0-1.22-0.99-2.22-2.22-2.22h-4.36c-1.22,0-2.22,0.99-2.22,2.22v14.51H5.82
                                c-1.22,0-2.22,0.99-2.22,2.22v4.36c0,1.22,0.99,2.22,2.22,2.22h14.51v14.51c0,1.22,0.99,2.22,2.22,2.22h4.36
                                c1.22,0,2.22-0.99,2.22-2.22V29.11h14.51c1.22,0,2.22-0.99,2.22-2.22v-4.36C45.84,21.32,44.84,20.33,43.62,20.33z"
                  />
                </svg>
              </button>
              <button type="button" @click="modifyCart(food, 'remove')">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  x="0px"
                  y="0px"
                  viewBox="0 0 49.44 49.44"
                  style="enable-background: new 0 0 49.44 49.44"
                  xml:space="preserve"
                >
                  <path
                    class="st0"
                    d="M42.84,29.14H6.6c-1.66,0-3-1.34-3-3v-2.85c0-1.66,1.34-3,3-3h36.23c1.66,0,3,1.34,3,3v2.85
                                C45.84,27.8,44.49,29.14,42.84,29.14z"
                  />
                </svg>
              </button>
            </div>
          </div>
          <!-- totale -->
          <div class="cart__total">
            <label for="total_price" v-show="formValidated == false"> Prezzo totale: {{ totalPrice() }}€</label>
            <input type="text" hidden name="total_price" id="total_price" :value="totalPrice()"/>
          </div>
          <!-- ui data -->
          <h5 class="cart__title" v-if="cart.items.length > 0"  v-show="formValidated == false">I tuoi dati</h5>
          <div class="ui" v-show="formValidated == false && cart.items.length > 0">
            <div class="ui__row">
              <div class="ui__data">
                <label for="ui_name">Nome*</label>
                <input type="text" name="ui_name" id="ui_name" v-model="uiName"/>
                <small class="error">{{nameError}}</small>
              </div>
              <div class="ui__data">
                <label for="ui_email">Email*</label>
                <input type="email" name="ui_email" id="ui_email" v-model="uiEmail" />
                <small class="error">{{uiEmailError}}</small>
              </div>
            </div>
            <div class="ui__row">
              <div class="ui__data">
                <label for="ui_delivery_address">Indirizzo*</label>
                <input
                  type="text"
                  name="ui_delivery_address"
                  id="ui_delivery_address"
                  v-model="uiDeliveryAddress"
                  
                />
                <small class="error">{{uiDeliveryAddressError}}</small>

              </div>
              <div class="ui__data">
                <label for="ui_phone">Numero di telefono</label>
                <input type="tel name" name="ui_phone" id="ui_phone" v-model="uiPhone" />
                <small class="error">{{uiPhoneError}}</small>
              </div>
            </div>
            <div class="ui__row">
              <div class="ui__data">
                <label for="ui_delivery_info"
                  >Informazioni per la consegna</label
                >
                <textarea
                  name="ui_delivery_info"
                  id="ui_delivery_info"
                  ui__datas="10"
                  v-model="uiDeliveryInfo"
                  
                ></textarea>
                <small class="error">{{uiDeliveryInfoError}}</small>
              </div>
            </div>
          </div>
          <button type="button" @click="formCheck()" class="btn-yellow" v-show="formValidated == false" >Procedi con il pagamento</button>
        </div>
      <transition name="slide-fade" mode="out-in">
        <div v-show="formValidated">
        <!-- pagamento -->

        <h5 class="cart__title">Pagamento</h5>
        <PaymentCard/>
        </div>
</transition>
        <!-- <button type="submit" value="Submit">Checkout</button> -->
      </form>
    </div>
  </div>
</template>

<script>
import PaymentCard from "../components/PaymentCard.vue";
export default {
  name: "Checkout",
  props: ["cart"],
  data() {
    return {
      isModalVisible: false,
      uiName: null,
      nameError: null,
      uiEmail: null, 
      uiEmailError: null,
      uiDeliveryAddress: null,
      uiDeliveryAddressError: null,
      uiPhone: null,
      uiPhoneError: null,
      uiDeliveryInfo: null,
      uiDeliveryInfoError: null,
      formValidated: false,
      showForm: true,
    };
  },
  components: {
    PaymentCard
  },
  watch: {
      uiName : function() {
        this.validateName();
      },
      uiEmail : function() {
        this.validateEmail();
      },
      uiDeliveryAddress : function() {
        this.validateuiDeliveryAddress();
      },
      uiPhone : function() {
        this.validateuiPhone();
      },
      uiDeliveryInfo : function() {
        this.validateuiDeliveryInfo();
      },
  },
  methods: {
    formCheck() {
    if(this.validateName() == true && this.validateEmail() == true && this.validateuiDeliveryAddress()== true && this.validateuiPhone() == true) {
      this.formValidated = true;
    }
    },
    closeModal() {
      this.isModalVisible = false;
    },
    modifyCart(food, action) {
      this.$emit("food", { item: food.food, action: action });
    },
    totalPrice() {
      let total = 0;
      this.cart.items.forEach((e) => {
        total += e.food.price * e.quantity;
      });
      return total;
    },
    sendPrice() {
      axios.post(`orders/make/payment/${this.totalPrice()}`);
    },
    getFoodPrice(e, amount) {
      return (e * amount).toFixed(2).replace(".", ",");
    },
    validateName() {
      if (!this.uiName) {
      this.nameError = 'Inserire il nome';
        return false;
      } else if(this.uiName.length > 20) {
        this.nameError ='Il nome non può superare 20 caratteri';
        return false;
      } else {
        this.nameError = '';

        return true
      }
    },
    validateEmail() {
      if (!this.uiEmail) {
        this.uiEmailError='Inserire l\'email';
        return false;
      } else if(this.uiEmail.match(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) == null) {
        this.uiEmailError='La formattazione della mail non è corretta';
        return false;
      } else {
        this.uiEmailError='';
        return true;
      }
    },
    validateuiDeliveryAddress() {
      if (!this.uiDeliveryAddress) {
        this.uiDeliveryAddressError = 'Inserire l\'indirizzo di consegna';
        return false;
      } else if(this.uiDeliveryAddress.length > 1000) {
        this.uiDeliveryAddressError = 'L\'indirizzo di consegna non può superare 20 caratteri';
        return false;
      } else {
        this.uiDeliveryAddressError = '';
        return true;
      }
    },
    validateuiPhone() {
      if (!this.uiPhone) {
        this.uiPhoneError = 'Inserire il numero di telefono';
        return false;
      } else if(this.uiPhone.match(/^[+0-9()-]+$/) == null) {
        this.uiPhoneError = 'Inserire il numero di telefono';
        return false;
      } else {
        this.uiPhoneError = '';
        return true;
      }
    },
    validateuiDeliveryInfo() {
      if(this.uiDeliveryInfo.length > 255 && this.uiDeliveryInfo != null) {
        this.uiDeliveryInfoError = 'Le informazioni aggiuntive non possono superare 255 caratteri';
        return false;
      } 
        this.uiDeliveryInfoError = '';
        return true;
    },
    validateForm: function(e) {
      if(this.validateName() == true && this.validateEmail() == true && this.validateuiDeliveryAddress()== true && this.validateuiPhone() == true && this.validateuiDeliveryInfo() == true) {
        console.log('success')
        this.showForm = true;
        return true;
      }

      e.preventDefault();
    }
  },
};
</script>

<style lang="scss" scoped>
@import "../../../sass/guest/front.scss";
.error {
  // text-decoration: $secondColor underline;
  color: $secondColor;
  font-size: $txt_xs;
  ul {
    list-style: none;
  display: flex;
  }
}

.btn-yellow {
  background-color: $mainColor;
    padding: $gt;
    border-radius: $br;
}

.checkout {
  .checkout__header {
    background-color: $secondColor;
    color: $lightColor;
    font-family: "PolySans Neutral";
  }
  h2 {
      font-size: 3rem;
  }

  .checkout__body {
    padding: $gt_lg $gt_sm;
  }

  .body__cart {
    & > div {
      margin-bottom: $gt;
    }
  }

  .cart__title {
    padding: $gt 0;
  }

  .cart__food-card {
    @include align-center-between;
  }

  form {
    font-size: $txt_sm;
  }

  .food-card__info {
    @include align-center;
    @include box--border;
    flex-grow: 1;

    & > *:not(.info__img) {
      padding: $gt_sm;
    }

    ul {
      flex-grow: 1;
      @include list-style-none;
      @include align-center-between;
    }

    label {
      font-family: "PolySans Neutral";
    }
  }

  .info__img {
    border-radius: $br_sm;
    height: 3rem;
    width: 3rem;
    overflow: hidden;
    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
    }
  }

  .food-card__btn {
    display: flex;
    button {
      margin: $gt_sm;
      overflow-x: inherit;
      svg {
        height: 2rem;
        fill: $lightColor;
  stroke: #afafaf;
        stroke-miterlimit: 10;

        &:hover {
          stroke: #000;
        }
      }
    }
  }

  .ui__row {
    margin-bottom: $gt_sm;

    .ui__data {
      display: flex;
      flex-direction: column;
      label {
        padding-bottom: 0.5rem;
      }
    }

    input,
    textarea {
      @include box--border;
    }

    .ui__data:not(:last-child) {
      margin-right: $gt_sm;
    }
  }

  .ui__row:not(:last-child) {
    display: flex;
    & > * {
      flex-grow: 1;
    }
  }

  .ui__row:last-child .ui__data {
    display: flex;
    flex-direction: column;
  }
}

.checkout__header {
  padding-top: 100px;
}


@media screen and (max-width: 768px) {
  .checkout__header {
    padding-top: 200px;
  }
    h2 {
      font-size: 1.5rem;
  }
}

@media screen and (max-width: 425px) {
  .checkout {

  .ui__row {
      display: flex;
      flex-direction: column;

    .ui__data:not(:last-child) {
      margin-right: 0;
    }
  }
    .checkout__header {
      padding-top: 150px;
    }
  }
}
</style>