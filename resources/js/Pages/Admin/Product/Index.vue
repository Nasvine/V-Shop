<template>
   <AdminLayout>

       <ProductList :products = "products" ></ProductList>
        
   </AdminLayout>
</template>

<script setup>

defineProps({
    products: Array
})

import AdminLayout from '../Components/AdminLayout.vue'
import ProductList from './ProductList.vue'


// initialize components based on data attribute selectors

</script>