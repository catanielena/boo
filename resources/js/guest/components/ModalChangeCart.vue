<template>
  <div class="modal-backdrop">
    <div class="modal">
      <section class="modal-body">
        <slot name="body">
          Sei sicuro di voler eliminare il carrello corrente e <br />
          ordinare da un altro ristorante?
        </slot>
      </section>

      <footer class="modal-footer">
        <div class="buttons__container">
          <button type="button" class="btn btn-yellow" @click="clear">Procedi</button>
          <button type="button" class="btn btn-white" @click="close">Annulla</button>
        </div>
      </footer>
    </div>
  </div>
</template>

<script>
export default {
  name: "ModalChangeCart",
  methods: {
    close() {
      this.$emit("close");
    },
    clear() {
      this.$emit("clearCart");
    },
  },
};
</script>

<style lang="scss" scoped>

@import '../../../sass/guest/front.scss';

.modal-backdrop {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgba(0, 0, 0, 0.3);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal {
  background: #ffffff;
  box-shadow: 10px 6px 6px -9px rgba(0, 0, 0, 0.22);
  overflow-x: auto;
  border-radius: $br;
}

.modal-footer {
  padding: 15px;
  margin: auto;
  display: flex;
  justify-content: flex-end;
}

.modal-body {
  padding: $gt_md;
  font-size: $txt_sm;
}
.buttons__container {
  display: flex;
}
.btn {
    color:#000;
    display: inline-block;
    text-align: center;
    padding: 0.5rem 0.6rem;
    font-size: $txt_sm;
    border-radius: $br;
  }

.btn-yellow {
  background-color: $mainColor;
  margin-right: $gt;
}

.btn-white {
  border: 1px solid $mainColor;
  background-color: $lightColor;
}
</style>