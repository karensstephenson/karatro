<script setup lang="ts">
import { useGameStore } from "@/stores/game";

const gameStore = useGameStore();
</script>

<template>
    <div class="mb-20">
        <ul class="flex gap-3">
            <li
                v-for="(card, index) in gameStore.selectedCards"
                :key="index"
                class="flex flex-col relative"
            >
                <p
                    class="flex justify-center absolute w-full text-white"
                    v-if="
                        index === gameStore.currentCardIndex &&
                        card.inPlayedHand
                    "
                >
                    {{ card.value }}
                </p>
                <div class="pt-10">
                    <img
                        :src="`../card_svgs/${card.name}.svg`"
                        :alt="card.name"
                        class="flex h-24"
                    />
                </div>
            </li>
        </ul>
    </div>
</template>
