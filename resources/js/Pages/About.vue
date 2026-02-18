<template>
    <div class="about-page">
        <h1>About</h1>
        <div class="about-container">
            <div class="about-card">
                <h2>About 1</h2>
                <p>Description of about 1</p>
            </div>
            <div class="about-card">
                <h2>About 2</h2>
                <p>Description of about 2</p>
            </div>
        </div>
    </div>
</template>

<script setup>
// Component logic will go here
</script>

<style scoped>
.about-page {
    padding: 2rem;
}

.about-container {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
}

.about-card {
    background-color: #f0f0f0;
    padding: 1rem;
    border-radius: 0.5rem;
}
</style>
