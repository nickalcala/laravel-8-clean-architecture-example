<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Product
            </h2>
        </template>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <jet-form-section @submitted="submit">
                <template #title>
                    Product Information
                </template>
                <template #description>
                    Enter the new product's information.
                </template>
                <template #form>
                    <div class="col-span-6">
                        <jet-label for="name"
                                   value="Name"/>
                        <jet-input id="name"
                                   placeholder="Name"
                                   type="text"
                                   class="mt-1 block w-full"
                                   v-model="form.name"
                                   autocomplete="name"/>
                        <jet-input-error :message="form.error('name')"
                                         class="mt-2"/>
                    </div>
                    <div class="col-span-6">
                        <jet-label for="description"
                                   value="Description"></jet-label>
                        <textarea name="description"
                                  id="description"
                                  ref="description"
                                  placeholder="Description"
                                  class="form-input rounded-md shadow-sm mt-1 block w-full"
                                  v-model="form.description"></textarea>
                        <jet-input-error :message="form.error('description')"
                                         class="mt-2"/>
                    </div>
                    <div class="col-span-6">
                        <jet-label for="price"
                                   value="Price"/>
                        <jet-input id="price"
                                   placeholder="Price"
                                   type="text"
                                   class="mt-1 block w-full"
                                   v-model="form.price"
                                   autocomplete="price"/>
                        <jet-input-error :message="form.error('price')"
                                         class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="image"
                                   value="Image"></jet-label>
                        <input type="file"
                               class="hidden"
                               ref="image"
                               @change="updatePhotoPreview">
                        <div class="mt-2"
                             v-show="imagePreview">
                            <span class="block w-40 h-40"
                                  :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + imagePreview + '\');'">
                            </span>
                        </div>
                        <jet-secondary-button class="mt-2 mr-2"
                                              type="button"
                                              @click.native.prevent="selectNewImage">
                            Select A New Image
                        </jet-secondary-button>
                        <jet-input-error :message="form.error('image')"
                                         class="mt-2"/>
                    </div>
                </template>
                <template #actions>
                    <jet-action-message :on="form.recentlySuccessful"
                                        class="mr-3">
                        Saved.
                    </jet-action-message>

                    <jet-button :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                        Save
                    </jet-button>
                </template>
            </jet-form-section>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetFormSection from "@/Jetstream/FormSection";
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetActionMessage from "@/Jetstream/ActionMessage";

export default {
    components: {
        AppLayout,
        JetFormSection,
        JetLabel,
        JetInput,
        JetInputError,
        JetButton,
        JetSecondaryButton,
        JetActionMessage,
    },

    data() {
        return {
            form: this.$inertia.form({
                '_method': 'POST',
                name: null,
                description: null,
                price: null,
                image: null,
            }, {
                bag: 'default',
                resetOnSuccess: false,
            }),
            imagePreview: null,
        }
    },

    methods: {
        updatePhotoPreview() {
            const reader = new FileReader();

            reader.onload = (e) => {
                this.imagePreview = e.target.result;
            };

            reader.readAsDataURL(this.$refs.image.files[0]);
        },

        selectNewImage() {
            this.$refs.image.click();
        },

        submit() {
            if (this.$refs.image) {
                this.form.image = this.$refs.image.files[0];
            }
            this.form.post(route('product.store'), {
                preserveScroll: true
            });
        },
    }
}
</script>

<style scoped>

</style>
