<script setup>
import { ref } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineProps({
    blogs: Object,
})

const getImageUrl = (image) => {
    if (!image) return null
    if (/^https?:\/\//.test(image)) return image
    return `https://app.wabepoint.com/${image.replace(/^\/+/, '')}`
}

const confirmDelete = ref(null)

const deleteBlog = (id) => {
    router.delete(route('admin.blogs.destroy', id), {
        preserveScroll: true,
        onSuccess: () => {
            confirmDelete.value = null
        },
    })
}
</script>

<template>
    <Head title="Manage Blogs" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Blog Posts</h2>
                <Link :href="route('admin.blogs.create')"
                      class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-[#2596be] rounded-sm hover:bg-[#1e7a9e] transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    New Post
                </Link>
            </div>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="$page.props.flash?.success" class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 text-sm rounded-sm">
                    {{ $page.props.flash.success }}
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-sm">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Category</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Author</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Date</th>
                                    <th class="px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-gray-500">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="blog in blogs.data" :key="blog.id" class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img v-if="getImageUrl(blog.image)" :src="getImageUrl(blog.image)" :alt="blog.name" class="h-10 w-10 rounded-sm object-cover mr-3" />
                                            <div v-else class="h-10 w-10 rounded-sm bg-gray-100 flex items-center justify-center mr-3">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900">{{ blog.name }}</div>
                                                <div v-if="blog.slug" class="text-xs text-gray-400">/{{ blog.slug }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ blog.category?.category_name || 'Uncategorized' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ blog.user?.name || 'Unknown' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span :class="blog.status ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500'"
                                              class="inline-flex px-2 py-0.5 text-xs font-semibold rounded-full">
                                            {{ blog.status ? 'Published' : 'Draft' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ new Date(blog.created_at).toLocaleDateString() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <Link :href="route('blogs.show', blog.slug)" target="_blank"
                                              class="text-gray-400 hover:text-gray-600 mr-3 inline-block" title="View">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </Link>
                                        <Link :href="route('admin.blogs.edit', blog.id)"
                                              class="text-indigo-500 hover:text-indigo-700 mr-3 inline-block" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </Link>
                                        <button @click="confirmDelete = blog.id"
                                                class="text-red-400 hover:text-red-600 inline-block" title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="!blogs.data?.length">
                                    <td colspan="6" class="px-6 py-12 text-center text-sm text-gray-400">
                                        No blog posts yet.
                                        <Link :href="route('admin.blogs.create')" class="text-[#2596be] hover:underline ml-1">Create one</Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div v-if="blogs.links && blogs.links.length > 3" class="px-6 py-4 border-t border-gray-200">
                        <div class="flex justify-center space-x-1">
                            <Link v-for="link in blogs.links" :key="link.label"
                                  :href="link.url || '#'"
                                  :class="{
                                      'bg-[#2596be] text-white': link.active,
                                      'text-gray-500 hover:bg-gray-100': !link.active,
                                      'opacity-50 pointer-events-none': !link.url,
                                  }"
                                  class="inline-flex items-center px-3 py-1.5 text-sm rounded-sm transition-colors"
                                  v-html="link.label" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete confirmation modal -->
        <div v-if="confirmDelete" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40" @click="confirmDelete = null">
            <div class="bg-white rounded-sm shadow-xl p-6 max-w-sm mx-4" @click.stop>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Delete Blog Post</h3>
                <p class="text-sm text-gray-500 mb-4">Are you sure you want to delete this post? This action cannot be undone.</p>
                <div class="flex justify-end space-x-3">
                    <button @click="confirmDelete = null" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-sm hover:bg-gray-200 transition-colors">Cancel</button>
                    <button @click="deleteBlog(confirmDelete)" class="px-4 py-2 text-sm font-medium text-white bg-red-500 rounded-sm hover:bg-red-600 transition-colors">Delete</button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
