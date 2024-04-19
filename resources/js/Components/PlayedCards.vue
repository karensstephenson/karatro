<script setup lang="ts">
import { useGameStore } from "@/stores/game";

const gameStore = useGameStore();
</script>

<template>
    <div class="mb-20 relative">
        <ul class="flex gap-3 mb-20">
            <li
                v-for="(card, index) in gameStore.selectedCards"
                :key="index"
                class="flex flex-col relative"
            >
                <p
                    class="flex justify-center mb-3"
                    v-if="index === gameStore.currentCardIndex && card.inPlayedHand"
                >
                    {{ card.value }}
                </p>
                <div class="h-20 w-20 flex items-center justify-center">
                   <img
                    :src="`../card_svgs/${card.name}.svg`"
                    :alt="card.name"
                    class="flex mt-10"
                /> 
                </div>
                
            </li>
        </ul>
    </div>
</template>
