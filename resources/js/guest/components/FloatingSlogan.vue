<template>
<section class="floatingSlogan">
    <div class="container">
        <div class="row"><h2 class="slogan stroke">Una storia di consegne</h2></div>
        <div class="row"><h2 class="slogan full">È bello prenderci gusto</h2></div>
    </div>
    <img src="../../../images/boo_bird.png" alt="logo cicogna deliveboo">
</section>
  
</template>

<script>
export default {
    name:"FloatingSlogan",
}
</script>

<style scoped lang="scss">
@import "../../../sass/guest/front.scss";

.floatingSlogan {
    height: 1500px;
    position: relative;
    display: flex;
    align-items: center;
    
    .container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        .row {
            display: flex;
        }
    }
    .slogan {
        font-size: 220px;
        text-transform: uppercase;
        flex-shrink: 0;
        font-weight: 400;
        mix-blend-mode: difference;
        line-height: 190px;
    }
    .slogan.stroke {
        -webkit-text-stroke-width: 3px;
        -webkit-text-stroke-color: $secondColor;
        // text-shadow: 2px 0 0 $secondColor, -2px 0 0 $secondColor, 0 2px 0 $secondColor, 0 -2px 0 $secondColor, 2px 2px $secondColor, -2px -2px 0 $secondColor, 2px -2px 0 $secondColor, -2px 2px 0 $secondColor;
        color: #fff;
        animation: floatTextRight 10s infinite;
        animation-timing-function: linear;
    }
    @keyframes floatTextRight {
        from {
            transform: translateX(100%);
        }
        to {
            transform: translateX(-100%);
        }
    }
    .slogan.full {
        color: $secondColor;
        animation: floatTextLeft 10s infinite;
        animation-timing-function: linear;
    }
    @keyframes floatTextLeft {
        from {
            transform: translateX(-100%);
        }
        to {
            transform: translateX(100%);
        }
    }
    img {
        @include center-absolute;
        z-index: -1;
        height: 1100px;
    }
}

</style>