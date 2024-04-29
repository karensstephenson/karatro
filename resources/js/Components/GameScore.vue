<script setup lang="ts">
import { defineProps } from "vue";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faX } from "@fortawesome/free-solid-svg-icons";

defineProps(["chips", "multiplier", "showPlayerHand"]);
</script>

<template>
    <div
        class="flex justify-center mt-2 bg-gray-600 text-white border rounded p-3 w-full"
    >
        <p class="flex items-center h-5 text-white font-bold">
            {{ showPlayerHand }}
        </p>
    </div>

    <div class="mb-5 flex gap-5 w-full">
        <div
            class="flex justify-center w-full mt-5 bg-indigo-600 text-white border rounded p-3"
        >
            {{ chips }}
        </div>
        <FontAwesomeIcon :icon="faX" class="text-white self-center mt-5" />
        <div
            class="flex justify-center w-full mt-5 bg-red-600 text-white border rounded p-3"
        >
            {{ multiplier }}
        </div>
    </div>
</template>
