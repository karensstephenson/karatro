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
                :class="{
                    'in-played-hand shadow-xl': card.inPlayedHand,
                }"
            >
                <p
                    class="flex justify-center absolute w-full text-white"
                    :class="{
                        'animate-pop':
                            index === gameStore.currentCardIndex &&
                            card.inPlayedHand,
                    }"
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
                        :class="{
                            'in-played-hand-card': card.inPlayedHand,
                            'animate-pop':
                                index === gameStore.currentCardIndex &&
                                card.inPlayedHand,
                        }"
                    />
                </div>
            </li>
        </ul>
    </div>
</template>

<style scoped>
.in-played-hand {
    transform: translateY(-15px);
}
.in-played-hand-card {
    box-shadow: 7px 5px 10px rgb(8, 8, 8);
}
</style>
