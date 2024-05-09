<script setup lang="ts">
import { defineProps, ref, computed, onMounted } from "vue";
import { defineEmits } from "vue";
import draggable from "vuedraggable";
import { useGameStore } from "@/stores/game";

import HandSort from "@/Components/HandSort.vue";
import PlayedCards from "@/Components/PlayedCards.vue";

const gameStore = useGameStore();

const emit = defineEmits(["playHand", "updateDiscardCards", "toggleCardDeck"]);

const isButtonDisabled = computed(() => gameStore.selectedCards.length === 0);

let isDiscardsZero = computed(
    () =>
        gameStore.remainingDiscards <= 0 || gameStore.selectedCards.length === 0
);
</script>

<template>
    <div class="col-start-2 col-span-2 mt-6 flex flex-col items-center w-full">
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
                                selected: gameStore.isSelected(element),
                            }"
                            @click="gameStore.toggleCard(element)"
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
                    'opacity-50 cursor-not-allowed': isButtonDisabled,
                }"
                class="mt-6 px-4 py-6 w-20 text-white bg-indigo-600 rounded-md border hover:bg-indigo-700"
                @click="$emit('playHand')"
            >
                Play Hand
            </button>

            <HandSort
                @sortByRank="gameStore.sortByRank"
                @sortBySuit="gameStore.sortBySuit"
                class="self-center"
            />

            <button
                :disabled="isDiscardsZero"
                :class="{
                    'opacity-50 cursor-not-allowed': isDiscardsZero,
                }"
                class="mt-6 px-4 py-6 w-20 text-white bg-red-600 rounded-md border hover:bg-red-700"
                @click="$emit('updateDiscardCards')"
            >
                Discard
            </button>
            <button
                class="self-end h-10 w-10 text-white text-xs bg-white-600 rounded-md border hover:bg-neutral-500"
                @click="$emit('toggleCardDeck')"
            >
                Deck
            </button>
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
