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
    cash: number;
    totalPoints: number;
}>();

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
                                        selected: gameStore.isSelected(element),
                                    }"
                                    @click="gameStore.toggleCard(element)"
                                >
                                    <img
                                        :src="`../card_svgs/${element.name}.svg`"
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

                        <div class="flex gap-10">
                            <HandSort
                                @sortByRank="gameStore.sortByRank"
                                @sortBySuit="gameStore.sortBySuit"
                                class="self-center"
                            />

                            <HandsAndDiscards />
                            
                            <CashAndTotalPoints
                                :cash="cash"
                                :totalPoints="totalPoints"
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
