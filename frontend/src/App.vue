<template>
<component :is="layout">
  <router-view/>
 </component>
</template>
<script>
  import AuthLayout from "@/components/layouts/AuthLayout.vue";
  import DefaultLayout from "@/components/layouts/DefaultLayout.vue";
  export default {
    components: {
      AuthLayout,
      DefaultLayout
    },
    computed: {
      layout() {
        return (this.$route.meta.layout)
      }
    }
  }
</script>

