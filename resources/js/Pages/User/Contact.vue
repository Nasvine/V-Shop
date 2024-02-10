<script setup>
import UserLayouts from './Layouts/UserLayouts.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const name = ref("");
const email = ref("");
const object = ref("");
const message = ref("");

// add brand method 
const SendContact = async () => {

    const formData = new FormData();
    formData.append('name', name.value);
    formData.append('email', email.value);
    formData.append('object', object.value);
    formData.append('message', message.value);

    try {
        await router.post('/contact/store', formData, {
            onSuccess: page => {
                Swal.fire({
                    toast: true,
                    timer: 2000,
                    icon: 'success',
                    position: 'top-end',
                    showConfirmButton: false,
                    title: page.props.flash.success
                })
                // dialogVisible.value = false;
                // resetFormData();
            },
        })

    } catch (err) {
        console.log(err)
    }

}




</script>

<template>
    <UserLayouts>

        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Contact Us
                </h2>
                <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">
                    Vous avez un problème technique ? Vous souhaitez envoyer des commentaires sur une fonctionnalité bêta ? Besoin de détails sur notre plan Business ? Faites le nous savoir.
                </p>
                <form @submit.prevent = "SendContact()" class="space-y-8">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your name</label>
                        <input type="text" id="email" v-model="name"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                            placeholder="Enter your name" required>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Votre
                            email</label>
                        <input type="email" id="email" v-model="email"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                            placeholder="Enter your email" required>
                    </div>
                    <div>
                        <label for="object"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Objet</label>
                        <input type="text" id="object" v-model="object"
                            class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                            placeholder="Enter your object" required>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Votre
                            message</label>
                        <textarea id="message" rows="6" v-model="message"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Leave a comment..."></textarea>
                </div>

                <div class="pb-5 text-end" >

                    <button 
                        class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-blue-700 sm:w-fit hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Send
                        message
                    </button>
                </div>
            </form>
        </div>
    </section>

</UserLayouts></template>

