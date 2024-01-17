<script setup>

import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import Footer from './Footer.vue'
import Header from './Header.vue'



// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})

      
</script>


<template>

    <!-- Navbar -->
     <Header />
    <!-- End -->

    <!-- Main -->
      <slot />
    <!-- End -->

    <!-- Footer -->
     <Footer />
    <!-- End -->

</template>