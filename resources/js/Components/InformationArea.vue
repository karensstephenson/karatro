<script setup lang="ts">
import { useGameStore } from "@/stores/game";
import { defineProps } from "vue";
import GameScore from "@/Components/GameScore.vue";

const gameStore = useGameStore();

const props = defineProps<{
    cash: number;
}>();
</script>

<template>
    <div class="mt-6 text-sm h-full">
        <div
            class="flex items-center w-28 mt-5 bg-gray-600 text-white border rounded p-3 mb-2 w-full justify-around"
        >
            <p>Target Score</p>
            <p>{{ gameStore.targetScore }}</p>
        </div>
        <div
            class="flex items-center w-28 mt-5 bg-gray-600 text-white border rounded p-3 mb-2 w-full justify-around"
        >
            <p>Round Score</p>
            <p>{{ gameStore.roundPoints }}</p>
        </div>
        <GameScore
            :chips="gameStore.chips"
            :multiplier="gameStore.multiplier"
            :showPlayerHand="gameStore.showPlayerHand"
        />

        <div class="grid grid-cols-3 grid-rows-6 gap-1">
            <div
                class="flex flex-col row-start-1 row-span-3 items-center h-full bg-gray-600 text-white border rounded p-3"
            >
                <p>Info</p>
            </div>

            <div
                class="flex flex-col items-center bg-gray-600 text-white border rounded p-3 col-start-2 row-span-2 text-xs"
            >
                <p>Hands</p>
                <p class="text-base">{{ gameStore.remainingHands }}</p>
            </div>

            <div
                class="flex flex-col items-center bg-gray-600 text-white border rounded p-3 col-start-3 row-span-2 text-xs"
            >
                <p >Discards</p>
                <p class="text-base">{{ gameStore.remainingDiscards }}</p>
            </div>

            <div
                class="flex flex-col row-start-4 row-span-3 items-center h-full bg-gray-600 text-white border rounded p-3 text-xs"
            >
                <p>Options</p>
            </div>
            <div
                class="flex flex-col items-center justify-center bg-gray-600 text-white border rounded p-3 col-start-2 row-start-3 row-span-2 col-span-2 text-xl"
            >
                <p>$ {{ gameStore.cash }}</p>
            </div>
            <div
                class="flex flex-col row-start-5 row-span-2 items-center w-18 h-full bg-gray-600 text-white border rounded p-3"
            >
                Ante
            </div>
            <div
                class="flex flex-col row-start-5 row-span-2 items-center w-18 h-full bg-gray-600 text-white border rounded p-3"
            >
                <p>Round</p>
                <p>{{ gameStore.round }}</p>
            </div>
        </div>
    </div>
</template>
