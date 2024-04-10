<script setup lang="ts">
import { defineProps, ref, computed, onMounted } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import cards from "@/global/cards";
import draggable from "vuedraggable";

import { useGameStore } from "@/store/game";

const gameStore = useGameStore();

onMounted(() => {
    gameStore.cards = props.cardList;
    drawCards();
});

const props = defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
    cardList: any[];
}>();

function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("!hidden");
    document.getElementById("docs-card")?.classList.add("!row-span-1");
    document.getElementById("docs-card-content")?.classList.add("!flex-row");
    document.getElementById("background")?.classList.add("!hidden");
}

const selectedCards = ref<any[]>([]);
const selectedCardNames = ref<string[]>([]);

// Choose one random card
const pickRandomCard = () => {
    const randomNumber = Math.floor(Math.random() * gameStore.cards.length);
    const randomCard = gameStore.cards[randomNumber];
    return {
        name: randomCard.name,
        rank: randomCard.rank,
        value: randomCard.value,
        suit: randomCard.suit,
    };
};

// Create array of random cards
let randomCards = ref<any[]>([]);

const rankOrder = [
    "A",
    "K",
    "Q",
    "J",
    "10",
    "9",
    "8",
    "7",
    "6",
    "5",
    "4",
    "3",
    "2",
];

const suitOrder = ["diamonds", "clubs", "hearts", "spades"];

const drawCards = () => {
    randomCards.value = [];
    selectedCards.value = [];
    selectedCardNames.value = [];

    let card: any;

    let i = 0;
    const handSize = 10;

    while (i < handSize && gameStore.hand.length < 10) {
        card = pickRandomCard();
        gameStore.hand.push(card);

        gameStore.cards = gameStore.cards.filter((chosenCard: any) => {
            return chosenCard.name !== card.name;
        });
        i++;
    }
    gameStore.hand.sort(
        (a, b) => rankOrder.indexOf(a.rank) - rankOrder.indexOf(b.rank)
    );
};

// Sort cards by rank 
const sortByRank = () => {
    gameStore.hand.sort(
        (a, b) => rankOrder.indexOf(a.rank) - rankOrder.indexOf(b.rank)
    );
};

// Sort cards by suit
const sortBySuit = () => {
    gameStore.hand.sort(
        (a, b) => suitOrder.indexOf(a.suit) - suitOrder.indexOf(b.suit)
    );
};

const removeFirstInstanceOfCard = (index: number) => {
    const cardToRemove = randomCards.value[index];
    const firstIndex = selectedCardNames.value.indexOf(cardToRemove);
    selectedCardNames.value = selectedCardNames.value.filter(
        (card, index) => index !== firstIndex
    );
};

// When clicked, move a card up or down and add/remove from a list of selected card indexes and names
const isSelected = (index: number) => selectedCards.value.includes(index);

const toggleCard = (index: number) => {
    if (isSelected(index)) {
        selectedCards.value = selectedCards.value.filter(
            (cardIndex) => cardIndex !== index
        );
        removeFirstInstanceOfCard(index);
    } else {
        if (selectedCards.value.length < 5) {
            selectedCards.value.push(index);
            selectedCardNames.value.push(randomCards.value[index]);
        }
    }
};

const removePlayedCardsFromHand = () => {
    gameStore.hand = gameStore.hand.filter(card => !selectedCards.value.includes(card.name));
};

// Calculates the score of the selected cards when the score button is clicked and replaces cards
const showScore = () => {
    let cardValues = selectedCards.value.map((cardName) => {
        let card = props.cardList.find((card) => card.name === cardName);
        return card.value;
    });
    let totalScore = cardValues.reduce((total, value) => total + value, 0);
    console.log(totalScore);
    removePlayedCardsFromHand();
    selectedCards.value = [];
    drawCards()
};
</script>

<template>
    <Head title="Welcome" />
    <div
        class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 green-bg"
    >
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <main class="mt-6 flex items-center justify-center">
                    <div class="flex flex-col items-center">
                        <draggable
                            class="flex justify-center gap-3 list-none"
                            v-model="gameStore.hand"
                            :item-key="(item) => item.id"
                        >
                            <template #item="{ element }">
                                <li
                                    :key="element.index"
                                    class="card"
                                    :class="{
                                        selected: isSelected(element.name),
                                    }"
                                    @click="toggleCard(element.name)"
                                >
                                    <img
                                        :src="`card_svgs/${element.name}.svg`"
                                        :alt="element.name"
                                    />
                                </li>
                            </template>
                        </draggable>

                        <button
                            class="mt-6 px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700"
                            @click="showScore"
                        >
                            Score
                        </button>
                        <button
                            class="mt-6 px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700"
                            @click="drawCards"
                        >
                            Draw 10 Cards
                        </button>

                        <div
                            class="flex flex-col items-center justify-center mt-10 border-double border-4 rounded-xl p-3"
                        >
                            <p class="text-white text-lg">Sort Hand</p>

                            <div class="flex gap-3">
                                <button
                                    class="mt-6 px-4 py-2 text-white bg-amber-600 rounded-md hover:bg-indigo-700"
                                    @click="sortByRank"
                                >
                                    Rank
                                </button>
                                <button
                                    class="mt-6 px-4 py-2 text-white bg-amber-600 rounded-md hover:bg-indigo-700"
                                    @click="sortBySuit"
                                >
                                    Suit
                                </button>
                            </div>
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
