<script setup lang="ts">
import { defineProps, ref, computed, onMounted } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import cards from "@/global/cards";
import { useGameStore } from '@/store/game';

const gameStore = useGameStore();

onMounted(() => {
    gameStore.cards = props.cardList;
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

const selectedCards = ref<number[]>([]);
const selectedCardNames = ref<string[]>([]);

// Choose one random card
const pickRandomCard = () => {
    const randomNumber = Math.floor(Math.random() * props.cardList.length);
    const randomCard = props.cardList[randomNumber];
    return {name: randomCard.name, rank: randomCard.rank, value: randomCard.value};
};

// Create array of five random cards
let randomCards = ref<any[]>([]);

const drawTenCards = () => {
    randomCards.value = [];
    selectedCards.value = [];
    selectedCardNames.value = [];

    let i = 0;
    let card;
    while (i < 10) {
        card = pickRandomCard();

        if (!randomCards.value.includes(card)) {
            randomCards.value.push(card);
            i++;
        }
    }
    const requiredOrder = ['A', 'K', 'Q', 'J', '10', '9', '8', '7', '6', '5', '4', '3', '2']
    randomCards.value.sort((a,b) => requiredOrder.indexOf(a.rank) - requiredOrder.indexOf(b.rank))
    
};

drawTenCards();

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

// Calculates the score of the selected cards when the score button is clicked
const showScore = () => {
    let cardValues = selectedCardNames.value.map((card) => card.value);
    console.log(cardValues)
    let totalScore = cardValues.reduce((total, value) => total + value, 0);
    console.log(totalScore);
    
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
                        <div class="flex justify-center gap-3 list-none">
                            <li
                                v-for="(card, index) in randomCards"
                                :key="index"
                                class="card"
                                :class="{
                                    selected: isSelected(index),
                                }"
                                @click="toggleCard(index)"
                            >
                                <img :src="`card_svgs/${card.name}.svg`" :alt="card.name" />
                            </li>
                        </div>

                        <button
                            class="mt-6 px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700"
                            @click="showScore"
                        >
                            Score
                        </button>
                        <button
                            class="mt-6 px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700"
                            @click="drawTenCards"
                        >
                            Draw 10 Cards
                        </button>
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
