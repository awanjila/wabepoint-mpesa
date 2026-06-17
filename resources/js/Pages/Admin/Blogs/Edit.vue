<script setup>
import { ref } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({
    blog: Object,
    categories: Array,
})

const form = ref({
    name: props.blog.name || '',
    slug: props.blog.slug || '',
    description: props.blog.description || '',
    content: props.blog.content || '',
    image: props.blog.image || '',
    meta_title: props.blog.meta_title || '',
    meta_description: props.blog.meta_description || '',
    keywords: props.blog.keywords || '',
    blog_category_id: props.blog.blog_category_id || '',
    status: props.blog.status ?? true,
    send_to_subscribers: false,
})

const imageFile = ref(null)
const imagePreview = ref(null)
const processing = ref(false)
const errors = ref({})

const generateSlug = () => {
    form.value.slug = form.value.name
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-|-$/g, '')
}

const onFileSelect = (e) => {
    const file = e.target.files[0]
    if (!file) return
    imageFile.value = file
    imagePreview.value = URL.createObjectURL(file)
}

const clearFile = () => {
    imageFile.value = null
    imagePreview.value = null
}

const submit = () => {
    processing.value = true
    errors.value = {}

    if (imageFile.value) {
        const fd = new FormData()
        fd.append('_method', 'PUT')
        fd.append('image_file', imageFile.value)
        fd.append('name', form.value.name)
        fd.append('slug', form.value.slug)
        fd.append('description', form.value.description)
        fd.append('content', form.value.content)
        fd.append('meta_title', form.value.meta_title)
        fd.append('meta_description', form.value.meta_description)
        fd.append('keywords', form.value.keywords)
        fd.append('blog_category_id', form.value.blog_category_id)
        fd.append('status', form.value.status ? '1' : '0')
        fd.append('send_to_subscribers', form.value.send_to_subscribers ? '1' : '0')

        router.post(route('admin.blogs.update', props.blog.id), fd, {
            onError: (errs) => {
                errors.value = errs
                processing.value = false
            },
            onFinish: () => {
                processing.value = false
            },
        })
    } else {
        const payload = { ...form.value }
        router.put(route('admin.blogs.update', props.blog.id), payload, {
            onError: (errs) => {
                errors.value = errs
                processing.value = false
            },
            onFinish: () => {
                processing.value = false
            },
        })
    }
}
</script>

<template>
    <Head title="Edit Blog Post" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center space-x-3">
                <Link :href="route('admin.blogs.index')" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </Link>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit: {{ blog.name }}</h2>
            </div>
        </template>

        <div class="py-6">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="bg-white overflow-hidden shadow-sm sm:rounded-sm">
                    <div class="p-6 space-y-6">
                        <div v-if="Object.keys(errors).length" class="p-4 bg-red-50 border border-red-200 rounded-sm">
                            <p class="text-sm font-medium text-red-600 mb-1">Please fix the following errors:</p>
                            <ul class="list-disc list-inside text-sm text-red-500">
                                <li v-for="(msg, field) in errors" :key="field">{{ msg }}</li>
                            </ul>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Title <span class="text-red-400">*</span></label>
                                <input v-model="form.name" type="text" @input="generateSlug"
                                       class="w-full rounded-sm border-gray-300 shadow-sm focus:border-[#2596be] focus:ring focus:ring-[#2596be]/20 text-sm" />
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Slug</label>
                                <input v-model="form.slug" type="text"
                                       class="w-full rounded-sm border-gray-300 shadow-sm focus:border-[#2596be] focus:ring focus:ring-[#2596be]/20 text-sm" />
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Category</label>
                                <select v-model="form.blog_category_id"
                                        class="w-full rounded-sm border-gray-300 shadow-sm focus:border-[#2596be] focus:ring focus:ring-[#2596be]/20 text-sm">
                                    <option value="">Select category</option>
                                    <option v-for="cat in categories" :key="cat.id" :value="cat.id">
                                        {{ cat.category_name }}
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Image URL</label>
                                <input v-model="form.image" type="text" :disabled="!!imageFile"
                                       class="w-full rounded-sm border-gray-300 shadow-sm focus:border-[#2596be] focus:ring focus:ring-[#2596be]/20 text-sm" />
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Upload Image</label>
                                <input type="file" accept="image/*" @change="onFileSelect"
                                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-sm file:border-0 file:text-sm file:font-semibold file:bg-[#2596be]/10 file:text-[#2596be] hover:file:bg-[#2596be]/20 transition-colors" />
                                <div v-if="imagePreview" class="mt-2 flex items-center gap-2">
                                    <img :src="imagePreview" class="h-16 w-auto rounded-sm border" />
                                    <button type="button" @click="clearFile" class="text-xs text-red-500 hover:text-red-700">Remove</button>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                                <select v-model="form.status"
                                        class="w-full rounded-sm border-gray-300 shadow-sm focus:border-[#2596be] focus:ring focus:ring-[#2596be]/20 text-sm">
                                    <option :value="true">Published</option>
                                    <option :value="false">Draft</option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Meta Title</label>
                                <input v-model="form.meta_title" type="text" maxlength="255"
                                       class="w-full rounded-sm border-gray-300 shadow-sm focus:border-[#2596be] focus:ring focus:ring-[#2596be]/20 text-sm" />
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Meta Description</label>
                                <textarea v-model="form.meta_description" rows="2"
                                          class="w-full rounded-sm border-gray-300 shadow-sm focus:border-[#2596be] focus:ring focus:ring-[#2596be]/20 text-sm"></textarea>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Keywords</label>
                                <input v-model="form.keywords" type="text"
                                       class="w-full rounded-sm border-gray-300 shadow-sm focus:border-[#2596be] focus:ring focus:ring-[#2596be]/20 text-sm" />
                                <p class="text-xs text-gray-400 mt-1">Comma-separated keywords for SEO</p>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Description (Main Content)</label>
                                <textarea v-model="form.description" rows="16"
                                          class="w-full rounded-sm border-gray-300 shadow-sm focus:border-[#2596be] focus:ring focus:ring-[#2596be]/20 text-sm font-mono"></textarea>
                                <p class="text-xs text-gray-400 mt-1">HTML content is supported</p>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Content (Excerpt)</label>
                                <textarea v-model="form.content" rows="4"
                                          class="w-full rounded-sm border-gray-300 shadow-sm focus:border-[#2596be] focus:ring focus:ring-[#2596be]/20 text-sm"></textarea>
                            </div>

                            <div v-if="blog.image && !imagePreview" class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Current Image</label>
                                <img :src="blog.image" :alt="blog.name" class="h-32 w-auto object-cover rounded-sm border" />
                            </div>
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-wrap items-center justify-between gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input v-model="form.send_to_subscribers" type="checkbox" class="rounded border-gray-300 text-[#2596be] focus:ring-[#2596be]/20" />
                            <span class="text-sm font-medium text-gray-700">Send email notification to subscribers</span>
                        </label>
                        <div class="flex items-center space-x-3">
                            <Link :href="route('admin.blogs.index')"
                                  class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-sm hover:bg-gray-50 transition-colors">
                                Cancel
                            </Link>
                            <button type="submit" :disabled="processing"
                                    class="px-4 py-2 text-sm font-medium text-white bg-[#2596be] rounded-sm hover:bg-[#1e7a9e] transition-colors disabled:opacity-50">
                                {{ processing ? 'Updating...' : 'Update Post' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
