<template>
  <div class="container">
    <v-braintree 
      authorization="sandbox_w3vd56ks_83jhbmdrngdjyv8s"
      @load="onLoad"
      @loadFail="onLoadFail"
      @success="onSuccess"
      @error="onError"
    ></v-braintree>

      <!-- :paypal="{flow: 'vault'}" -->
  </div>
</template>

<script>
export default {
  name: 'PaymentCard',
  data () {
    return {
      instance: null
    }
  },
  methods: {
    onLoad (instance) {
      this.instance = instance;
    },
    onLoadFail (instance) {
      alert('load fail');
    },
    onSuccess (payload) {
      console.log("Success!", payload.nonce);
    },
    onError (error) {
      console.log("Error!", error);
    },
    clearPaymentSelection () {
      if (this.instance != null) {
        this.instance.clearSelectedPaymentMethod();
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.container[data-v-07bf0f9c], .braintree-dropin {
    font-family: 'PolySans Slim';
    z-index: -1;

}
</style>