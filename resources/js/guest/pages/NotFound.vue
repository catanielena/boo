<template>
	<section>
		<div class="page__404 padding-responsive">
			<div class="body__404 container--1000">
				<h1>ERROR <span>404</span></h1>
			</div>
		</div>
	</section>
</template>

<script>
	export default {
		name: 'NotFound'
	}
</script>


<style lang="scss" scoped>

@import '../../../sass/guest/front.scss';

section {
		background-color: $secondColor;
	.page__404 {
		.body__404 {
			font-family: 'PolySans Neutral';
			padding: $gt_lg $gt_sm;
			background-image: url('../../../../public/images/deliveboo/404_boo.svg');
			background-size: contain;
			background-repeat: no-repeat;
			min-height: 90vh;
			background-position: center;
			display: flex;
			h1 {
				font-size: 40px;
				color: $lightColor;
				margin: auto;
				span {
					transform: rotate(180deg);
					display: inline-block;
				}
			}

		}
	}

}

@media screen and (max-width: 850px) {

}

@media screen and (max-width: 768px) {

}



</style>