<template>
  <v-app>
    <v-main>
      <slot></slot>
    </v-main>
  </v-app>
</template>

<script>
export default {
  mounted(){
    document.querySelector("html").setAttribute("class", "light");
  }
}
</script>

<style>

</style>
