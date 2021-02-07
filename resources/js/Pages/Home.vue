<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Home
            </h2>
        </template>
        <h1 class="text-4xl text-center mt-10"
            v-if="pagination.data.length === 0">
            No images uploaded yet
        </h1>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-4"
             v-if="pagination.data.length > 0">
            <paginate
                v-model="pagination.current_page"
                :page-count="pagination.last_page"
                :click-handler="onPageChanged"
                prev-text="Prev"
                next-text="Next"
                container-class="pagination">
            </paginate>
        </div>
        <div class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-1 gap-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <thumbnail v-if="pagination.data.length > 0"
                       v-for="product in pagination.data"
                       :key="product.id"
                       :image="product.image">
                <template #content>
                    <div class="px-2 pt-2 grid grid-cols-8">
                        <div class="font-bold col-span-6">
                            {{ product.name }}
                        </div>
                        <div class="font-bold col-span-2 text-yellow-400">
                            {{ product.price | currency }}
                        </div>
                    </div>
                    <div class="px-2 ellipsis">
                        {{ product.description }}
                    </div>
                    <div class="px-2 pb-2 ellipsis">
                        <small>{{ product.moment }}</small>
                    </div>
                </template>
            </thumbnail>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-4"
             v-if="pagination.data.length > 0">
            <paginate
                v-model="pagination.current_page"
                :page-count="pagination.last_page"
                :click-handler="onPageChanged"
                prev-text="Prev"
                next-text="Next"
                container-class="pagination">
            </paginate>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import Paginate from 'vuejs-paginate';
import Thumbnail from '../Components/Thumbnail';

export default {

    components: {
        AppLayout,
        Paginate,
        Thumbnail,
    },

    props: [
        'pagination'
    ],

    methods: {

        onPageChanged(p) {
            this.$inertia.visit('/home?page=' + p);
        }
    },

    filters: {
        currency(value, currency = 'USD') {
            let formatter = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: currency,
            });
            return formatter.format(value);
        }
    }
}
</script>

<style lang="scss">
.pagination {
    @apply inline-block;
    li {
        @apply inline-block border border-blue-400 bg-white;
        a {
            @apply inline-block py-1.5 px-2.5 outline-none font-bold text-gray-600;
            &:focus, &:hover {
                @apply text-black;
            }
        }

        &:first-child {
            @apply rounded-l rounded-bl;
        }

        &:last-child {
            @apply rounded-r rounded-br;
        }

        &.active {
            @apply bg-blue-500;
            a {
                @apply text-white;
            }
        }
    }
}
</style>
