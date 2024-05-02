<script setup lang="ts">
import { defineProps, defineEmits } from "vue";
import { useGameStore } from "@/stores/game";

const emit = defineEmits(["sortByRank", "sortBySuit"]);

const gameStore = useGameStore();

const props = defineProps<{
    cardList: any[];
}>();

const isInHand = (card) => {
    return gameStore.hand.some((handCard) => handCard.name === card.name);
};
const isDiscarded = (card) => {
    return gameStore.discards.some((handCard) => handCard.name === card.name);
};
const isPlayed = (card) => {
    return gameStore.playedCards.some(
        (handCard) => handCard.name === card.name
    );
};
</script>

<template>
    <ul class="grid grid-cols-13 gap-1 flex">
        <li
            v-for="(card, index) in cardList"
            :key="index"
            class="bg-gray-200 p-1 rounded"
        >
            <img
                :src="`../card_svgs/${card.name}.svg`"
                :alt="card.name"
                class="h-full"
                :class="{
                    'border-green-600 border-8': isInHand(card),
                    'opacity-25': isDiscarded(card),
                    'opacity-25': isPlayed(card),
                }"
            />
        </li>
    </ul>
    <button
        class="self-end justify-center h-12 w-12 text-white text-xs bg-white-600 rounded-md border hover:bg-neutral-500 p-2"
        @click="$emit('toggleCardDeck')"
    >
        Close
    </button>
</template>
