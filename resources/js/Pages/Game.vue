<script setup lang="ts">
import { defineProps, ref, computed, onMounted } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import cards from "@/global/cards";
import draggable from "vuedraggable";

import { useGameStore } from "@/stores/game";

import HandSort from "../Components/HandSort.vue";
import GameScore from "../Components/GameScore.vue";

const gameStore = useGameStore();

onMounted(() => {
    gameStore.cards = props.cardList;
    gameStore.drawCards();
});

const props = defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
    cardList: any[];
}>();

const multiplier = ref(1);

// Sort cards by rank
const sortByRank = () => {
    gameStore.hand.sort((a, b) => b.rank - a.rank);
};

// Sort cards by suit
const suitOrder = ["diamonds", "clubs", "hearts", "spades"];

const sortBySuit = () => {
    gameStore.hand.sort(
        (a, b) => suitOrder.indexOf(a.suit) - suitOrder.indexOf(b.suit)
    );
};

// When clicked, move a card up or down and add/remove from a list of selected card indexes and names
const isSelected = (index: number) => gameStore.selectedCards.includes(index);

const toggleCard = (index: number) => {
    if (isSelected(index)) {
        gameStore.selectedCards = gameStore.selectedCards.filter(
            (cardIndex) => cardIndex !== index
        );
    } else {
        if (gameStore.selectedCards.length < 5) {
            gameStore.selectedCards.push(index);
        }
    }
};
</script>

<template>
    <Head title="Karatro" />
    <div
        class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 green-bg"
    >
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <main class="mt-6 flex flex-col items-center justify-center">
                    <GameScore
                        :totalScore="gameStore.totalScore"
                        :multiplier="multiplier"
                    />

                    <div class="flex flex-col items-center">
                        <draggable
                            class="flex justify-center gap-3 list-none"
                            v-model="gameStore.hand"
                            :item-key="(item) => item.id"
                        >
                            <template #item="{ element }">
                                <li
                                    :key="element"
                                    class="card"
                                    :class="{
                                        selected: isSelected(element),
                                    }"
                                    @click="toggleCard(element)"
                                >
                                    <img
                                        :src="`card_svgs/${element.name}.svg`"
                                        :alt="element.name"
                                    />
                                </li>
                            </template>
                        </draggable>

                        <div class="flex gap-3">
                            <button
                                class="mt-6 px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700"
                                @click="gameStore.showScore"
                            >
                                Play Hand
                            </button>
                            <button
                                class="mt-6 px-4 py-2 text-white bg-red-600 rounded-md hover:bg-indigo-700"
                                @click="gameStore.discardCards"
                            >
                                Discard
                            </button>
                        </div>

                        <HandSort
                            @sortByRank="sortByRank"
                            @sortBySuit="sortBySuit"
                        />
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>

<style scoped>
.selected {
    transform: translateY(-20px);
}

.card:hover {
    cursor: pointer;
}

.green-bg {
    background-color: #00796b;
}
</style>
