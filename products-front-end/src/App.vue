<template>
  <LayoutNavbar />
  <LayoutMain />
  <LayoutFooter />
</template>

<script>
import LayoutNavbar from './components/LayoutNavbar.vue';
import LayoutMain from './components/LayoutMain.vue';
import LayoutFooter from './components/LayoutFooter.vue';

export default {
  components: {
    LayoutNavbar,
    LayoutMain,
    LayoutFooter
  }
}
</script>
