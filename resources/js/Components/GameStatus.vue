<script setup lang="ts">
import { router } from "@inertiajs/vue3";
import { defineEmits } from "vue";
import { Head, Link } from "@inertiajs/vue3";

const emit = defineEmits(["newGame"]);
defineProps<{
    gameStatus: string;
    nextGame: string;
}>();
</script>

<template>
    <div class="flex flex-col items-center border p-10 rounded-md bg-black">
        <p class="text-red-600">{{ gameStatus }}</p>

        <div class="flex gap-3">
            <a
                @click="$emit('newGame')"
                class="mt-6 px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700"
            >
                {{ nextGame }}
            </a>
        </div>
    </div>
</template>
