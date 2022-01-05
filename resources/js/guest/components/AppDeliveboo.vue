<template>
  <section class="appDeliveboo">
    <img class="smartphone" src="../../../images/phone_test.png" alt="app Deliveboo">
    <img class="decoration" src="../../../images/app_cloud.png" alt="app Deliveboo">
    <div class="caption">Scarica l' <strong>app</strong> di Deliveboo e ordina dove vuoi qualunque cosa desideri</div>
  </section>
</template>

<script>
export default {
    name:"AppDeliveboo",

}
</script>

<style scoped lang="scss">
@import "../../../sass/guest/front.scss";
section.appDeliveboo{
    height: 1200px;
    @include align-justify-center;
    position: relative;
    .smartphone {
        height: 890px;
        transform: translateX(9%);
    }
    .decoration {
        height: 450px;
        transform: translateX(-67%);
        z-index: -1;
    }
    .caption {
        position: absolute;
        font-size: 36px;
        width: 485px;
        right: 20%;
        top: 43%;
        color: $secondColor;
    }
}
</style>