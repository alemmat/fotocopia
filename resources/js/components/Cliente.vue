<template>



    <md-list>

       <md-list-item>
         <md-field>
           <label>Email</label>
           <md-input name="email" @input="inputEvent" @change="inputEvent"></md-input>
           <span class="md-helper-text"></span>
         </md-field>

       </md-list-item>

       <md-list-item>

         <md-field>
           <label>Telefono</label>
           <md-input name="telefono" @input="inputEvent" @change="inputEvent"></md-input>
           <span class="md-helper-text"></span>
         </md-field>

       </md-list-item>

   </md-list>

</template>

<script>


export default{


  methods: {


      inputEvent({ type, target }) {

        this.$emit('inputEvent', 0, target.name, target.value);
     }
  }
}

</script>

<style scoped>



</style>
