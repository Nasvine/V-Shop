<template>
    <AdminLayout>
        Brand
        <BrandList :brands = "brands" ></BrandList>
    </AdminLayout>
 </template>
 
 <script setup>
 
 defineProps({
     brands: Array
 })
 
 import AdminLayout from '../Components/AdminLayout.vue'
 import BrandList from './BrandList.vue'
 
 
 // initialize components based on data attribute selectors
 
 </script>