<template>
    <div class="resources-page">
        <h1>Resources</h1>
        <div class="resources-container">
            <div class="resource-card">
                <h2>Resource 1</h2>
                <p>Description of resource 1</p>
            </div>
        </div>
    </div>
</template>

<script setup>
// Component logic will go here
</script>

<style scoped>
.resources-page {
    padding: 2rem;
}

.resources-container {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
}

.resource-card {
    background-color: #f0f0f0;
    padding: 1rem;
    border-radius: 0.5rem;
}


</style>
