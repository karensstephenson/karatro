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
import RoundSummary from "@/Components/RoundSummary.vue";

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
    roundPoints: number;
    gameUuid: string;
    hands: number;
    discards: number;
    gameStatus: string;
}>();

const winGame = computed(() => gameStore.roundPoints >= gameStore.targetScore);
console.log(gameStore.remainingHands)
let isGameOver = computed(
    () => gameStore.remainingHands <= 0 && !winGame.value
);

const newGame = () => {
    gameStore.remainingHands = 1;
    router.get(route("home"));
};

const newRound = async () => {
    try {
        const url = `/api/game/${props.gameUuid}/new-round`;

        const response = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                round: gameStore.round,
            }),
        });
        // const responseData = await response.json();
        // console.log(responseData.message);
    } catch (error) {
        console.error("Failed to start new round: ", error);
    }
    gameStore.round += 1;
    resetGame();
    showRoundOptions = false;
};

let showRoundOptions = false;
const cashOut = async () => {
    gameStore.cash += (3 + gameStore.remainingHands)
    try {
        const url = `/api/game/${props.gameUuid}/cash_out`;

        const response = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                cash: gameStore.cash,
            }),
        });
    } catch (error) {
        console.error("Failed to start new round: ", error);
    }
    showRoundOptions = true;
    gameStore.roundPoints = 0;
};

const resetGame = () => {
    gameStore.cards = props.cardList;
    gameStore.remainingHands = props.hands;
    gameStore.remainingDiscards = props.discards;
    gameStore.chips = 0;
    gameStore.roundPoints = 0;
    gameStore.targetScore = 300;
    gameStore.hand = [];
    gameStore.discards = [];
    gameStore.playedCards = [];
    gameStore.gameStatus = "in_progress";
    gameStore.drawCards();
    saveGameState();
};

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
                roundPoints: gameStore.roundPoints,
                remainingHands: gameStore.remainingHands,
                remainingDiscards: gameStore.remainingDiscards,
                playedHand: gameStore.playerHand,
                status: gameStore.gameStatus,
                round: gameStore.round,
                cash: gameStore.cash,
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
                gameStore.round = 1;
                gameStore.cash = props.cash;
                resetGame();
            } else {
                gameStore.hand = responseData.gameState.hand_cards;
                gameStore.cards = responseData.gameState.cards_left;
                gameStore.playedCards = responseData.gameState.played_cards;
                gameStore.discards = responseData.gameState.played_cards;
                gameStore.roundPoints = responseData.round_points;
                gameStore.remainingHands =
                    responseData.gameRoundState.remaining_hands;
                gameStore.remainingDiscards =
                    responseData.gameRoundState.remaining_discards;
                gameStore.gameStatus = responseData.status;
                gameStore.round = responseData.round;
                gameStore.cash = responseData.cash;
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
    if (isGameOver.value) {
        gameStore.gameStatus = "completed";
    }
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
                    class="grid grid-cols-4 relative mt-6 flex items-center gap-2"
                >
                    <!-- SCORING SECTION -->
                    <InformationArea :cash="cash" />

                    <!-- CARD SECTION -->
                    <div
                        v-if="!winGame && !showRoundOptions"
                        class="col-start-2 col-span-3"
                    >
                        <GameArea
                            @playHand="playHand()"
                            @updateDiscardCards="updateDiscardCards()"
                            @toggleCardDeck="toggleCardDeck()"
                        />
                    </div>

                    <!-- END OF GAME -->
                    <div
                        v-if="isGameOver"
                        class="col-start-1 col-end-4 row-start-1 row-end-4 flex items-center justify-center absolute inset-0 bg-black bg-opacity-75"
                    >
                        <GameStatus
                            @newGame="newGame"
                            gameStatus="GAME OVER"
                            nextGame="New Game"
                        />
                    </div>
                    <div
                        v-if="showRoundOptions"
                        class="col-start-2 col-span-3 row-start-1 row-end-4 flex items-center justify-around absolute inset-0"
                    >
                        <div class="flex">
                            <NewRound @newGame="newRound" />
                            <NewRound @newGame="newRound" />
                            <NewRound @newGame="newRound" />
                        </div>
                    </div>
                </main>

                <!-- ROUND SUMMARY -->
                <div
                    v-if="winGame && !showRoundOptions"
                    class="flex items-end justify-around absolute inset-0 grid grid-cols-3"
                >
                    <RoundSummary @cashOut="cashOut" />
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
