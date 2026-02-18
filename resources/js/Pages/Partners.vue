<template>
    <div class="partners-page"> 
        <h1>Partners</h1>
        <div class="partners-container">
            <div class="partner-card">
                <h2>Partner 1</h2>
                <p>Description of partner 1</p>
            </div>
        </div>
    </div>
</template>

<script setup>
// Component logic will go here
</script>

<style scoped>
.partners-page {
    padding: 2rem;
}

.partners-container {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
}

.partner-card {
    background-color: #f0f0f0;
    padding: 1rem;
    border-radius: 0.5rem;
}

</style>
