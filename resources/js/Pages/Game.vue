<script setup lang="ts">
import { defineProps, ref, computed, onMounted } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import cards from "@/global/cards";
import draggable from "vuedraggable";

import { useGameStore } from "@/stores/game";

import HandSort from "@/Components/HandSort.vue";
import GameScore from "@/Components/GameScore.vue";
import HandsAndDiscards from "@/Components/HandsAndDiscards.vue";
import CashAndTotalPoints from "@/Components/CashAndTotalPoints.vue";
import PlayedCards from "@/Components/PlayedCards.vue";

const gameStore = useGameStore();

onMounted(() => {
    loadGameState();
});

const props = defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
    cardList: any[];
    cash: number;
    totalPoints: number;
    gameUuid: string;
}>();

const isButtonDisabled = computed(() => gameStore.selectedCards.length === 0);

// fetch api/hello
const fetchHello = async () => {
    const response = await fetch("/api/hello");
    const { message } = await response.json();
    console.log(message);
};

//fetchHello();

const saveGameState = async () => {
    try {
        const url = `/api/game/${props.gameUuid}/save`;

        const response = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                hand: gameStore.hand,
                cards: gameStore.cards,
            }),
        });
        const responseData = await response.json();
        console.log(responseData.message);
    } catch (error) {
        console.error("Failed to save game state: ", error);
    }
};

const loadGameState = async () => {
    try {
        const url = `/api/game/${props.gameUuid}/load`;

        const response = await fetch(url);

        if (response.ok) {
            const responseData = await response.json();

            if (Object.keys(responseData).length === 0) {
                gameStore.cards = props.cardList;
                gameStore.drawCards();
                saveGameState();
            } else {
                gameStore.hand = responseData.hand_cards;
                gameStore.cards = responseData.cards_left;
            }
        } else {
            throw new Error("Failed to get response");
        }
    } catch (error) {
        console.error("Failed to load game state: ", error);
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
                        :multiplier="gameStore.multiplier"
                        :showPlayerHand="gameStore.showPlayerHand"
                    />

                    <div class="h-40">
                        <PlayedCards
                            class=""
                            v-if="gameStore.isPlayHandClicked"
                        />
                    </div>

                    <div class="flex flex-col items-center">
                        <draggable
                            class="flex justify-center gap-3 list-none"
                            v-model="gameStore.hand"
                            :item-key="(item) => item.id"
                        >
                            <template #item="{ element }">
                                <div>
                                    <li
                                        :key="element"
                                        class="card"
                                        :class="{
                                            selected:
                                                gameStore.isSelected(element),
                                        }"
                                        @click="gameStore.toggleCard(element)"
                                    >
                                        <img
                                            :src="`../card_svgs/${element.name}.svg`"
                                            :alt="element.name"
                                            class="flex h-24"
                                        />
                                    </li>
                                </div>
                            </template>
                        </draggable>

                        <div class="flex gap-3">
                            <button
                                :disabled="isButtonDisabled"
                                :class="{
                                    'opacity-50 cursor-not-allowed':
                                        isButtonDisabled,
                                }"
                                class="mt-6 px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700"
                                @click="gameStore.showScore"
                            >
                                Play Hand
                            </button>
                            <button
                                :disabled="isButtonDisabled"
                                :class="{
                                    'opacity-50 cursor-not-allowed':
                                        isButtonDisabled,
                                }"
                                class="mt-6 px-4 py-2 text-white bg-red-600 rounded-md hover:bg-indigo-700"
                                @click="gameStore.discardCards"
                            >
                                Discard
                            </button>
                        </div>

                        <div class="flex gap-10">
                            <HandSort
                                @sortByRank="gameStore.sortByRank"
                                @sortBySuit="gameStore.sortBySuit"
                                class="self-center"
                            />

                            <HandsAndDiscards />

                            <CashAndTotalPoints
                                :cash="cash"
                                :totalPoints="gameStore.totalPoints"
                            />
                        </div>
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
