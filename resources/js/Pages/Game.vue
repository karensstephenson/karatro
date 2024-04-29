<script setup lang="ts">
import { defineProps, ref, computed, onMounted } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import cards from "@/global/cards";
import draggable from "vuedraggable";
import { router } from "@inertiajs/vue3";

import { useGameStore } from "@/stores/game";

import HandSort from "@/Components/HandSort.vue";
import GameScore from "@/Components/GameScore.vue";
import HandsAndDiscards from "@/Components/HandsAndDiscards.vue";
import CashAndTotalPoints from "@/Components/CashAndTotalPoints.vue";
import PlayedCards from "@/Components/PlayedCards.vue";
import GameOver from "@/Components/GameOver.vue";

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
    hands: number;
    discards: number;
}>();

const isButtonDisabled = computed(() => gameStore.selectedCards.length === 0);

let isGameOver = computed(() => gameStore.remainingHands <= 0);

const newGame = () => {
    router.get(route("home"));
};

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
                playedCards: gameStore.playedCards,
                totalPoints: gameStore.totalPoints,
                remainingHands: gameStore.remainingHands,
                remainingDiscards: gameStore.remainingDiscards,
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
            console.log(responseData);
            if (Object.keys(responseData).length === 0) {
                gameStore.cards = props.cardList;
                gameStore.remainingHands = props.hands;
                gameStore.remainingDiscards = props.discards;
                gameStore.totalPoints = 0;
                gameStore.drawCards();
                saveGameState();
            } else {
                gameStore.hand = responseData.gameState.hand_cards;
                gameStore.cards = responseData.gameState.cards_left;
                gameStore.playedCards = responseData.gameState.played_cards;
                gameStore.totalPoints = responseData.total_points;
                gameStore.remainingHands =
                    responseData.gameRoundState.remaining_hands;
                gameStore.remainingDiscards =
                    responseData.gameRoundState.remaining_discards;
            }
        } else {
            throw new Error("Failed to get response");
        }
    } catch (error) {
        console.error("Failed to load game state: ", error);
    }
};

const playHand = async () => {
    await gameStore.showScore();
    saveGameState();
};

const updateDiscardCards = async () => {
    await gameStore.discardCards();
    saveGameState();
};
</script>

<template>
    <Head title="Karatro" />
    <div
        class="min-h-screen bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        :class="{ 'bg-black': isGameOver, 'green-bg': !isGameOver }"
    >
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <main
                    class="grid grid-cols-3 relative mt-6 flex items-center gap-3"
                >
                    <!-- SCORING SECTION -->
                    <div class="mt-6 text-sm h-full">
                        <div
                            class="flex items-center w-28 mt-5 bg-gray-600 text-white border rounded p-3 mb-2 w-full justify-around"
                        >
                            <p>Round Score</p>
                            <p>{{ gameStore.totalPoints }}</p>
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
                                class="flex flex-col items-center bg-gray-600 text-white border rounded p-3 col-start-2 row-span-2"
                            >
                                <p>Hands</p>
                                <p>{{ gameStore.remainingHands }}</p>
                            </div>

                            <div
                                class="flex flex-col items-center bg-gray-600 text-white border rounded p-3 col-start-3 row-span-2"
                            >
                                <p>Discards</p>
                                <p>{{ gameStore.remainingDiscards }}</p>
                            </div>

                            <div
                                class="flex flex-col row-start-4 row-span-3 items-center h-full bg-gray-600 text-white border rounded p-3"
                            >
                                <p>Options</p>
                            </div>
                            <div
                                class="flex flex-col items-center justify-center bg-gray-600 text-white border rounded p-3 col-start-2 row-start-3 row-span-2 col-span-2 text-xl"
                            >
                                <p>$ {{ cash }}</p>
                            </div>
                            <!-- <div
                                class="col-start-2 row-start-3 row-span-2 h-full"
                            >
                                <CashAndTotalPoints
                                    :cash="cash"
                                    :totalPoints="gameStore.totalPoints"
                                />
                            </div> -->
                            <div
                                class="flex flex-col row-start-5 row-span-2 items-center w-18 h-full bg-gray-600 text-white border rounded p-3"
                            >
                                Ante
                            </div>
                            <div
                                class="flex flex-col row-start-5 row-span-2 items-center w-18 h-full bg-gray-600 text-white border rounded p-3"
                            >
                                Round
                            </div>
                        </div>
                    </div>

                    <!-- CARD SECTION -->
                    <div
                        class="col-start-2 col-span-2 mt-6 flex flex-col items-center w-full"
                    >
                        <div class="h-40 flex flex-col">
                            <PlayedCards
                                class="flex flex-col h-24"
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
                                                    gameStore.isSelected(
                                                        element
                                                    ),
                                            }"
                                            @click="
                                                gameStore.toggleCard(element)
                                            "
                                        >
                                            <img
                                                :src="`../card_svgs/${element.name}.svg`"
                                                :alt="element.name"
                                                class="h-24"
                                            />
                                        </li>
                                    </div>
                                </template>
                            </draggable>
                        </div>
                        <div class="flex gap-3">
                            <button
                                :disabled="isButtonDisabled"
                                :class="{
                                    'opacity-50 cursor-not-allowed':
                                        isButtonDisabled,
                                }"
                                class="mt-6 px-4 py-6 w-20 text-white bg-indigo-600 rounded-md border hover:bg-indigo-700"
                                @click="playHand"
                            >
                                Play Hand
                            </button>

                            <HandSort
                                @sortByRank="gameStore.sortByRank"
                                @sortBySuit="gameStore.sortBySuit"
                                class="self-center"
                            />

                            <button
                                :disabled="isButtonDisabled"
                                :class="{
                                    'opacity-50 cursor-not-allowed':
                                        isButtonDisabled,
                                }"
                                class="mt-6 px-4 py-6 w-20 text-white bg-red-600 rounded-md border hover:bg-indigo-700"
                                @click="updateDiscardCards"
                            >
                                Discard
                            </button>
                        </div>
                    </div>

                    <!-- GAME OVER -->
                    <div
                        v-if="isGameOver"
                        class="col-start-1 col-end-4 row-start-1 row-end-4 flex items-center justify-center absolute inset-0 bg-black bg-opacity-85"
                    >
                        <GameOver @newGame="newGame" />
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
