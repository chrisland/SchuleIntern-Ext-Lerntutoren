<template>
  <div class="item"  v-if="data.length > 0" >


    <Modal @formsubmit="handlerFormSubmit" v-bind:data="selectedItem"></Modal>


      <table class="si-table">
        <thead>
          <tr>
            <td>Status</td>
            <td>Einheiten</td>
            <td>Schueler</td>
            <td>Info</td>
            <td>Erstellt</td>
            <td></td>
          </tr>
        </thead>
        <tbody>
          <tr v-bind:key="index" v-for="(item, index) in  data"
            class="">
            <td>
              <i v-if="item.status == 'close'" class="fas fa-times-circle text-red"></i>
              <i v-if="item.status == 'reserve'" class="fas fa-check-circle text-green"></i>
            </td>
            <td>{{item.einheiten}}</td>
            <td><User v-if="item.user" v-bind:data="item.user" size="line"></User></td>
            <td>{{item.info}}</td>
            <td>{{item.timeCreated}}</td>
            <td>
              <button v-if="item.status == 'reserve'" class="si-btn" v-on:click="handlerShow(item)"><i class="fa fa-user-check"></i> Bestätigen</button>
            </td>
          </tr>
        </tbody>
      </table>

  </div>
</template>

<script>

import User from '../mixins/User.vue'
import Modal from '../mixins/Modal.vue'

export default {
  components: {
    User, Modal
  },
  data() {
    return {
      selectedItem: false
    };
  },
  props: {
      data: Object
  },
  created: function () {



  },
  methods: {

    handlerShow: function (item) {
      this.selectedItem = false; // Bugfix wegen: watch
      this.selectedItem = item;
    },
    handlerFormSubmit: function (data) {
      this.selectedItem = false;
    }

/*    handlerSubmit: function () {
      //console.log(this.data);

      EventBus.$emit('item-submit', {
        einheiten: this.formEinheiten,
        id: this.data.tutorenID
      });
    }*/

  }

};
</script>

<style>
  .item {
    max-width: 40vw;
    margin-left: 2rem;
    margin-right: 2rem;
  }
</style>