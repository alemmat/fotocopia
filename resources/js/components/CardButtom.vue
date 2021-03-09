<template>
  <div>

    <md-card>
      <md-card-header>
        <div class="md-title">Adicionar Archivo</div>
      </md-card-header>

      <md-card-content>
        

          <md-button class="md-icon-button md-accent">
            <md-icon>thumb_up</md-icon>
          </md-button>

      </md-card-content>


    </md-card>


  </div>
</template>

<script>

export default{

  props:["archivo"],

  methods: {

      adicionarArchivo() {

        this.$emit('adicionarArchivo');
     }
  }
}

</script>


<style lang="scss" scoped>

.hr {
  display: block;
  margin-top: 0.5em;
  margin-bottom: 0.5em;
  margin-left: auto;
  margin-right: auto;
  border-style: inset;
  border-width: 1px;
}

input[type="file"]{
  top: 0px;
  position: relative;
}

.md-card {
  width: 300px;
  margin: 4px;
  display: inline-block;
  vertical-align: top;
}

</style>
