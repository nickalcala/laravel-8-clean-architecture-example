<template>
    <div class="md:h-60 flex flex-col bg-white shadow-xl sm:rounded-lg"
         style="height: 300px;">
        <div class="mx-auto flex-grow bg-cover bg-no-repeat bg-center w-full"
             :style="`background-image: url(${imageUrl}); height: 70%;`"></div>
        <div style="height: 30%;">
            <slot name="content"></slot>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        image: null,
    },

    computed: {
        imageUrl() {
            if (this.image.indexOf('http') >= 0) {
                return this.image;
            }
            return '/' + encodeURIComponent(this.image);
        }
    }
}
</script>

<style scoped>
</style>
