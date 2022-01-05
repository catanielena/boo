<template>
    <section class="hero">
        <div class="container">
            <a class="CTA" href="/home">Trova i ristoranti!</a>
            <div class="logo-text">
                <div class="logo-letter">D</div><div class="logo-letter">e</div><div class="logo-letter">l</div><div class="logo-letter">i</div><div class="logo-letter">v</div><div class="logo-letter">e</div><div class="logo-letter">b</div><div class="logo-letter">o</div><div class="logo-letter">o</div>
            </div>
        </div>
        <img src="../../../images/chessboard.png" alt="red chess decoration" class="hero-chess-decoration">
    </section>
</template>

<script>
export default {
    name: 'Hero',
}
</script>

<style scoped lang="scss">
@import '../../../sass/guest/front.scss';
.hero{
    height: 900px;
    background-image: url("../../../images/hero_bg.jpg");
    background-size: 128%;
    padding-top: 180px;
    .container{
        text-align: center;
        height: 100%;
        @include justify-between-column;
        .CTA {
            @include btn($btnColor: $secondColor, $btnBG: $lightColor);
            padding: 13px 28px;
            display:inline-block;
            font-weight: 700;
            font-size: 30px;
            border: none;
            -webkit-box-shadow: 1px 1px 7px 0px rgba(0,0,0,0.75);
            -moz-box-shadow: 1px 1px 7px 0px rgba(0,0,0,0.75);
            box-shadow: 1px 1px 7px 0px rgba(0,0,0,0.75);
            margin: 0 auto;
        }
        .logo-text {
            color: $mainColor;
            font-size: 330px;
            font-family: 'Bogam Regular';
            transform: scale(1, 2);
            .logo-letter {
                display: inline-block;
            }
            .logo-letter:first-child {
                transform: translateY(-6%);
            }
            .logo-letter:nth-child(2) {
                transform: translateY(-36%);
                position: relative;
                z-index: 1;  
            }
            .logo-letter:nth-child(2)::after {
                content: url('../../../images/fame_sticker.svg');
                display: block;
                position:absolute;
                width: 138px;
                transform: scale(2, 1);
                top: -124px;
                left: 2px;
                z-index: -1;
            }
            .logo-letter:nth-child(3) {
                transform: translateY(-36%);
            }
            .logo-letter:nth-child(4) {
                transform: translateY(-36%);
            }
            .logo-letter:nth-child(5) {
                transform: translateY(-50%);
            }
            .logo-letter:nth-child(6) {
                transform: translate(-2%, -36%);
            }
            .logo-letter:nth-child(7) {
                transform: translateY(-36%);
            }
            .logo-letter:nth-child(8) {
                transform: translateY(-13%);
            }
            .logo-letter:nth-child(9) {
                transform: translateY(-36%);
            }
        }
    }
    .hero-chess-decoration {
        position: absolute;
        height: 460px;
        right: -18%;
        top: 5%;
    }
}

</style>