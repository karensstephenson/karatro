<script setup lang="ts">
import { defineEmits } from "vue";

const emit = defineEmits(["newGame"]);
defineProps<{
    gameStatus: string;
    nextGame: string;
}>();
</script>

<template>
    <div
        class="flex justify-center border-blue-800 rounded border-8 bg-black m-2"
    >
        <div class="m-2">
            <Link
                @click="$emit('newGame')"
                class="block justify-center px-4 py-1 text-white bg-orange-600 rounded-md hover:bg-orange-700 text-center"
            >
                Select
            </Link>

            <!-- <button
                class="justify-center px-4 py-1 text-white bg-orange-600 rounded-md hover:bg-orange-700 w-full"
            >
                Select
            </button> -->
            <p
                class="mt-4 border rounded-full text-white bg-blue-900 flex justify-center w-full"
            >
                Small Blind
            </p>
            <p
                class="mt-4 mx-auto border text-white bg-blue-900 w-20 h-20 rounded-full flex justify-center items-center text-center"
            >
                SMALL BLIND
            </p>
            <div
                class="mt-4 px-4 w-full py-2 border rounded text-white text-center"
            >
                <p>Score at least</p>
                <p class="text-red-600 font-bold items-center">300</p>
                <p>Reward: <span class="text-orange-600">$$$+</span></p>
            </div>
            <p class="text-white flex justify-center pt-2">or</p>
            <div class="flex justify-content gap-2">
                <p class="w-10 border rounded mt-2"></p>
                <button
                    class="mt-2 px-4 py-1 text-white bg-red-600 rounded-md hover:bg-red-700 w-full"
                >
                    Skip Blind
                </button>
            </div>
        </div>
    </div>
</template>
