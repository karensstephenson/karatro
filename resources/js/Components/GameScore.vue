<script setup lang="ts">
import { defineProps } from "vue";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faX } from "@fortawesome/free-solid-svg-icons";

defineProps(["totalScore", "multiplier", "showPlayerHand"]);
</script>

<template>
    <div>
        <p class="h-2 text-white font-bold">{{ showPlayerHand }}</p>
    </div>

    <div class="mb-20 flex gap-5">
        <div
            class="flex justify-center w-24 mt-10 bg-indigo-600 text-white border rounded p-3"
        >
            {{ totalScore }}
        </div>
        <FontAwesomeIcon :icon="faX" class="text-white self-center mt-10" />
        <div
            class="flex justify-center w-24 mt-10 bg-red-600 text-white border rounded p-3"
        >
            {{ multiplier }}
        </div>
    </div>
</template>
