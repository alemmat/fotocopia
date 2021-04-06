<template>



    <md-list>

       <md-list-item>
         <md-field>
           <label>Email</label>
           <md-input name="email"  v-model="email"></md-input>
           <span class="md-helper-text"></span>
         </md-field>

       </md-list-item>

       <md-list-item>

         <md-field>
           <label>Telefono</label>
           <md-input name="telefono" v-model="telefono"></md-input>
           <span class="md-helper-text"></span>
         </md-field>

       </md-list-item>

   </md-list>

</template>

<script>


export default{

  data(){

    return{

      email:null,

      telefono:null,
    }
  },


  methods: {

  },

  watch: {

    email:function(){

      this.$emit('inputEvent', 0, 'email', this.email);
    },

    telefono:function(){

      this.$emit('inputEvent', 0, 'telefono', this.telefono);
    },

  }
}

</script>

<style scoped>



</style>
