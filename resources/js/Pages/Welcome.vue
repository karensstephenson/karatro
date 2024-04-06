<script setup lang="ts">
import { defineProps, ref, computed } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import cards from "@/global/cards";

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();

function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("!hidden");
    document.getElementById("docs-card")?.classList.add("!row-span-1");
    document.getElementById("docs-card-content")?.classList.add("!flex-row");
    document.getElementById("background")?.classList.add("!hidden");
}

const randomCard = ref("clubs_2");
</script>

<template>
    <Head title="Welcome" />
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <img
            id="background"
            class="absolute -left-20 top-0 max-w-[877px]"
            src="https://laravel.com/assets/img/welcome/background.svg"
            alt="Background"
        />
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <main class="mt-6 flex items-center justify-center">
                    <div class="flex flex-col items-center">
                        <img
                            :src="`cards/${randomCard}.png`"
                            :alt="randomCard"
                        />

                        <button
                            class="mt-6 px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700"
                        >
                            New Random Card - james
                        </button>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>
