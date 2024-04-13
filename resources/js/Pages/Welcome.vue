<script setup lang="ts">
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Karatro" />
    <div
        class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 green-bg"
    >
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <main class="mt-6 flex flex-col items-center justify-center">
                    <h1 class="text-white text-6xl">Karatro</h1>

                    <div class="flex flex-col items-center">
                        <div class="flex gap-3">
                            <Link
                                :href="route('game', 'gameId')"
                                class="mt-6 px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700"
                                >New Game</Link
                            >
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>

<style scoped>
.green-bg {
    background-color: #00796b;
}
</style>
