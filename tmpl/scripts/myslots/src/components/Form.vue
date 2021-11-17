<template>


  <div class="width-30vw item">

    <User v-if="data.user" v-bind:data="data.user" ></User>

    <div class="si-form">
      <ul>
        <li>
          <label>Einheiten</label>
          <input type="text" v-model="data.einheiten" readonly />
        </li>
        <li>
          <label>Wann habt ihr euch getroffen?</label>
          <textarea v-model="data.datum"></textarea>
        </li>
        <li>
          <label>Wie lange habt ihr zusammen gearbeitet?</label>
          <textarea v-model="data.dauer"></textarea>
        </li>
        <li>
          <label>Informationen</label>
          <textarea v-model="data.info"></textarea>
        </li>
        <li>
          <button class="si-btn" v-on:click="handlerSubmit"><i class="fas fa-plus-circle"></i> Slot bestätigen & Schließen</button>
        </li>
      </ul>
    </div>
  </div>


</template>

<script>

import User from '../mixins/User.vue'
export default {
  components: {
    User
  },
  data() {
    return {
    };
  },
  props: {
      data: Object
  },
  created: function () {

  },
  methods: {
    handlerSubmit: function () {

      this.$emit('formsubmit', 'someValue')

      EventBus.$emit('form-submit', {
        data: this.data,
      });

    }
  }

};
</script>

<style>
.item {
  display: flex;
  flex-direction: column;
}
.item .si-user {
  align-self: flex-end;
}
</style>