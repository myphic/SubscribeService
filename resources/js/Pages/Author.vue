<script setup>
import {Head} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import LinkButton from "@/Components/LinkButton.vue";
</script>

<template>
    <Head title="Автор"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight ">Автор - <span class="bg-gradient-to-r from-violet-500 to-fuchsia-500">{{ $page.props.author.name }}</span></h2>
        </template>

        <div class="py-9 flex">
            <div class="max-w-7xl mx-52 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                    <div class="p-6 text-gray-900">
                        <img class="rounded w-80 h-80" :src="$page.props.author.avatar ?? '/storage/images/default/defaultavatar.jpg'"  alt="Avatar">
                        <LinkButton :href="" class="my-3 w-full text-center"> Создать пост </LinkButton>
                    </div>
                </div>
            </div>
            <div class="sm:px-6 grow w-full">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                    <div class="p-6 text-gray-900">1</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
