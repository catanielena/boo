<template>

  <div class="food-card" v-if="food.visible" :class="show ? 'expand' : null">
    <div class="food-card-image" v-if="food.image">
      <img :src="`/storage/${food.image}`" :alt="`${food.name} logo`" />
    </div>
    <div class="food-card-image" v-else>
      <img
        src="https://citynews-triesteprima.stgy.ovh/~media/horizontal-hi/10057634608377/cibo-spazzatura-2.jpg"
        alt="food logo"
      />
    </div>
    <div class="food-card-info">
      <div class="info__header">

          <h3 class="food-card-info-name">
            {{ food.name }}
          </h3>
          <button type="button" @click="showInfo()" class="showInfo" v-if="food.description.length>0||food.allergens.length>0||food.weight.length>0" v-show="!show">Informazioni</button>
          <button type="button" @click="showInfo()" class="hideInfo" v-if="food.description.length>0||food.allergens.length>0||food.weight.length>0" v-show="show">Informazioni</button>

      </div>
      <transition name="slide-fade" mode="out-in">

        <div class="info" v-show="show">
          <div class="food-opacity">
            <small class="food-card-info-weight" v-if="food.weight">
              {{ food.weight }} gr
            </small>
            <small class="food-card-info-allergens" v-if="food.allergens">
              Allergeni: {{ food.allergens }}
            </small>

          </div>
          <p class="food-card-info-description">
            {{ food.description }}
          </p>
        </div>
      </transition>
      <div class="food-card-info-price">{{ food.price }}€</div>
    </div>
    <div class="food-card-buttons">
      <button type="button" @click="modifyCart(food, 'add')">
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
      <button type="button" @click="modifyCart(food, 'remove')">
        <svg viewBox="0 0 49.44 49.44">
          <path
            class="st0"
            d="M42.84,29.14H6.6c-1.66,0-3-1.34-3-3v-2.85c0-1.66,1.34-3,3-3h36.23c1.66,0,3,1.34,3,3v2.85 C45.84,27.8,44.49,29.14,42.84,29.14z"
          />
        </svg>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "Food",
  data() {
    return {
      show: false
    }
  },
  props: ["food"],
  methods: {
    modifyCart(food, action) {
      this.$parent.$emit("food", { item: food, action: action });
    },
    showInfo() {
      this.show = !this.show;
    }
  },
};
</script>

<style lang="scss" scoped>
@import "../../../sass/guest/front.scss";
.food-card {
  display: flex;
  margin-bottom: $gt;
  @include box--border;
  // @include box--box-shadow;
  padding: $gt;
  h3 {
    font-weight: bold;
    margin-right: $gt_md;
  }
  &-image {
    img {
      width: 70px;
      height: 70px;
      border-radius: $br;
      overflow: hidden;
      object-fit: cover;
    }
  }
  .info__header {
    display: flex;
    justify-content: start;
    align-items: center;
  }
  .expand {
    min-height: 200px;
  }

    .showInfo {
      // border: 1.5px solid $mainColor;
      padding: .2rem;
      font-size: .6rem;
      border-radius: $br_sm;
      // color: $mainColor;
      background-color: $mainColor;
    }

    .hideInfo {
            padding: .2rem;
      font-size: .6rem;
      border-radius: $br_sm;
      border: 1.5px solid $mainColor;
      color: $mainColor;
      background-color: transparent;
    }
  &-info {
    padding-left: $gt;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    &-name {
      font-size: $txt;
      margin-bottom: $gt_sm;
    }
    &-description {
            font-size: .65rem;
      
      // font-size: $txt_xs;
      margin: .3rem 0;
    }
    &-price {
      margin: auto 0 $txt_xs;
    }
    &-allergens {
      margin-bottom: $gt;
            font-size: .65rem;

      // color: rgb(170, 170, 170);
    }
.food-opacity{
  opacity: .5;
}
  .food-card-info {
    flex-grow:1;
  }
    .food-card-info-weight {
            font-size: .65rem;
      
    }
  }
  &-buttons {
    // width: 70px;
    // flex-shrink: 0;
    display: flex;
    flex-direction: column;
    // justify-content: center;
    // button {
    //   margin: 10px 0;
    // }
  }
}
svg {
  height: 2rem;
}
.st0 {
  fill: #ffffff;
  stroke: #afafaf;
  stroke-miterlimit: 10;
}
button:hover .st0 {
  fill: #ffffff;
  stroke: #000;
  stroke-miterlimit: 10;
}
@media screen and (max-width: 1367px) {
//   .food-card {
//     width: 600px;
//   }
// }
// @media screen and (max-width: 1202px) {
//   .food-card {
//     width: 500px;
//   }
// }
// @media screen and (max-width: 1124px) {
//   .food-card {
//     width: 450px;
//   }
// }

// @media screen and (max-width: 967px) {
//   .food-card {
//     width: 350px;
//   }

  .food-card-buttons {
    button {
      svg {
        height: 1.875rem;
      }
    }
  }
}

// @media screen and (max-width: 911px) {
//   .food-card {
//     width: 348px;
//   }
// }

// @media screen and (max-width: 850px) {
//   .food-card {
//     width: 700px;
//   }
// }

// @media screen and (max-width: 700px) {
//   .food-card {
//     width: 500px;
//   }
// }
@media screen and (max-width: 600px) {
  .food-card-info-description {
    display: none;
  }

  .food-card-info-allergens {
    display: none;
  }
  .food-card-info-weight {
    display: none;
  }

  h3.food-card-info-name {
    font-size: 18px;
  }
}

@media screen and (max-width: 560px) {
  // .food-card {
  //   width: 400px;
  // }
  .food-card-info-description, .showInfo {
    display: none;
  }

  .food-card-info-allergens {
    display: none;
  }
  .food-card-info-weight {
    display: none;
  }

  h3.food-card-info-name {
    font-size: 18px;
  }
}

@media screen and (max-width: 420px) {
  // .food-card {
  //   width: 350px;
  // }
}

@media screen and (max-width: 360px) {
  // .food-card {
  //   width: 300px;
  // }
  .food-card-image {
    img {
      width: 90px;
      height: 75px;
    }
    h3.food-card-info-name {
      font-size: 16px;
    }
  }
}
</style>