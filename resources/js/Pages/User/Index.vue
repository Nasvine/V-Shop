<script setup>
import UserLayouts from './Layouts/UserLayouts.vue';
import Products from '../User/components/Products.vue';
import { Link } from '@inertiajs/vue3';
import Hero from './Layouts/Hero.vue'

defineProps({
    products: Array
})

</script>

<template>
    <UserLayouts>
        <!-- Hero Section -->
        <Hero />
        <!-- End -->
        <div class="bg-white">
            <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                <p class="text-4xl text-bold text-gray-900 dark:text-white">Liste des products</p>
                <!-- Product list Component -->
                <Products :products="products"></Products>
                <!--  -->
                <div class="flex justify-center mt-5">
                    <Link :href="route('products.index')" class="text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-teal-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">View all products</Link>
                </div>
            </div>
        </div>

    </UserLayouts>
</template>

