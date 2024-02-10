<template>
    <AdminLayout>
        Category
        <CategoryList :categories = "categories" ></CategoryList>
    </AdminLayout>
 </template>
 
 <script setup>
 
 defineProps({
     categories: Array
 })
 
 import AdminLayout from '../Components/AdminLayout.vue'
 import CategoryList from './CategoryList.vue'
 
 
 // initialize components based on data attribute selectors
 
 </script>