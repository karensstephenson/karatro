<script setup lang="ts">
import { defineEmits } from "vue";

const emit = defineEmits(["sortByRank", "sortBySuit"]);
</script>

<template>
    <div
        class="flex flex-col items-center justify-center mt-10 border-double border-4 rounded-xl p-3"
    >
        <p class="text-white text-lg">Sort Hand</p>

        <div class="flex gap-3">
            <button
                class="mt-6 px-4 py-2 text-white bg-amber-600 rounded-md hover:bg-indigo-700"
                @click="$emit('sortByRank')"
            >
                Rank
            </button>
            <button
                class="mt-6 px-4 py-2 text-white bg-amber-600 rounded-md hover:bg-indigo-700"
                @click="$emit('sortBySuit')"
            >
                Suit
            </button>
        </div>
    </div>
</template>
