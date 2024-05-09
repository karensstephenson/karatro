<script setup lang="ts">
import { defineProps, ref, computed, onMounted } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import cards from "@/global/cards";
import { router } from "@inertiajs/vue3";

import { useGameStore } from "@/stores/game";

import GameStatus from "@/Components/GameStatus.vue";
import Deck from "@/Components/Deck.vue";
import NewRound from "@/Components/NewRound.vue";
import GameArea from "@/Components/GameArea.vue";
import InformationArea from "@/Components/InformationArea.vue";

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

const winGame = computed(() => gameStore.roundPoints >= gameStore.targetScore);

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
                discards: gameStore.discards,
                totalPoints: gameStore.roundPoints,
                remainingHands: gameStore.remainingHands,
                remainingDiscards: gameStore.remainingDiscards,
                playedHand: gameStore.playerHand,
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
                gameStore.roundPoints = 0;
                gameStore.targetScore = 300;
                gameStore.hand = [];
                gameStore.discards = [];
                gameStore.playedCards = [];
                gameStore.drawCards();
                saveGameState();
            } else {
                gameStore.hand = responseData.gameState.hand_cards;
                gameStore.cards = responseData.gameState.cards_left;
                gameStore.playedCards = responseData.gameState.played_cards;
                gameStore.discards = responseData.gameState.played_cards;
                gameStore.roundPoints = responseData.total_points;
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

let isCardDeck = ref(false);
const toggleCardDeck = () => {
    isCardDeck.value = !isCardDeck.value;
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
                    <InformationArea :cash="cash" />

                    <!-- CARD SECTION -->
                    <GameArea
                        @playHand="playHand()"
                        @updateDiscardCards="updateDiscardCards()"
                        @toggleCardDeck="toggleCardDeck()"
                    />

                    <!-- END OF GAME -->
                    <div
                        v-if="isGameOver"
                        class="col-start-1 col-end-4 row-start-1 row-end-4 flex items-center justify-center absolute inset-0 bg-black bg-opacity-75"
                    >
                        <GameStatus @newGame="newGame" gameStatus="GAME OVER" />
                    </div>
                    <div
                        v-if="winGame"
                        class="col-start-1 col-end-4 row-start-1 row-end-4 flex items-center justify-center absolute inset-0 bg-black bg-opacity-75"
                    >
                        <GameStatus @newGame="newGame" gameStatus="YOU WIN" />
                    </div>
                </main>

                <!-- NEW ROUND OPTIONS -->
                <div class="flex">
                    <NewRound />
                    <NewRound />
                    <NewRound />
                </div>

                <!-- CARD DECK -->
                <div
                    v-if="isCardDeck"
                    class="flex items-center justify-center absolute inset-0 bg-black bg-opacity-85"
                >
                    <Deck
                        :cardList="cardList"
                        @toggleCardDeck="toggleCardDeck"
                    />
                </div>
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
