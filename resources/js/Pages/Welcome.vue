<script setup lang="ts">
import { defineProps, ref, computed } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import cards from "@/global/cards";

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();

function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("!hidden");
    document.getElementById("docs-card")?.classList.add("!row-span-1");
    document.getElementById("docs-card-content")?.classList.add("!flex-row");
    document.getElementById("background")?.classList.add("!hidden");
}

const selectedCards = ref([]);
const selectedCardNames = ref([]);

// Choose one random card
const pickRandomCard = () => {
    const randomNumber = Math.floor(Math.random() * cards.length);
    const randomCard = cards[randomNumber];
    return randomCard;
};

// Create array of five random cards
let randomCards = ref([]);
const drawFiveCards = () => {
    randomCards.value = [];
    selectedCards.value = [];
    selectedCardNames.value = [];
    for (let i = 0; i < 5; i++) {
        randomCards.value.push(pickRandomCard());
    }
};

drawFiveCards();

const removeFirstInstanceOfCard = (index) => {
    const cardToRemove = randomCards.value[index];
    const firstIndex = selectedCardNames.value.indexOf(cardToRemove);
    selectedCardNames.value = selectedCardNames.value.filter(
        (card, index) => index !== firstIndex
    );
};

// When clicked, move a card up or down and add/remove from a list of selected card indexes and names
const isSelected = (index) => selectedCards.value.includes(index);

const toggleCard = (index) => {
    if (isSelected(index)) {
        selectedCards.value = selectedCards.value.filter(
            (cardIndex) => cardIndex !== index
        );
        removeFirstInstanceOfCard(index);
    } else {
        selectedCards.value.push(index);
        selectedCardNames.value.push(randomCards.value[index]);
    }

    console.log(selectedCardNames.value);
};
</script>

<template>
    <Head title="Welcome" />
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <img
            id="background"
            class="absolute -left-20 top-0 max-w-[877px]"
            src="https://laravel.com/assets/img/welcome/background.svg"
            alt="Background"
        />
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <main class="mt-6 flex items-center justify-center">
                    <div class="flex flex-col items-center">
                        <div class="flex flex justify-center gap-3 list-none">
                            <li
                                v-for="(card, index) in randomCards"
                                :key="index"
                                :class="{
                                    card: true,
                                    selected: isSelected(index),
                                }"
                                @click="toggleCard(index)"
                            >
                                <img :src="`cards/${card}.png`" :alt="card" />
                            </li>
                        </div>

                        <button
                            class="mt-6 px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700"
                            @click="drawFiveCards"
                        >
                            Score
                        </button>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>

<style scoped>
.selected {
    transform: translateY(-10px);
}
</style>
