<script setup lang="ts">
import { defineProps } from "vue";

defineProps<{
    cash: number;
    totalPoints: number;
}>();
</script>

<template>
    <div class="flex flex-col w-full">
        <!-- <div
            class="flex flex-col items-center w-28 mt-10 bg-gray-600 text-white border rounded p-3 "
        >
            
            <p>$ {{ cash }}</p>
        </div> -->

        <!-- <div
            class="flex flex-col items-center w-28 mt-5 bg-gray-600 text-white border rounded p-3"
        >
            <p>Total Points</p>
            <p>{{ totalPoints }}</p>
        </div> -->
    </div>
</template>
