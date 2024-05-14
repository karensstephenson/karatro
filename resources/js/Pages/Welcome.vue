<script setup lang="ts">
import { computed, onMounted } from "vue";
import { router } from "@inertiajs/vue3";
import { Head, Link } from "@inertiajs/vue3";
import { useGameStore } from "@/stores/game";

onMounted(() => {
    gameStore.gameStatus = props.gameStatus;
});

const props = defineProps<{
    gameStatus: string;
}>();

const gameStore = useGameStore();

const isButtonDisabled = computed(() => gameStore.gameStatus === "completed");

const newGame = () => {
    router.post(route("game.create"));
};
const resumeGame = () => {
    router.get(route("game.resume"));
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
                    <h1 class="text-white text-6xl">Karatro</h1>

                    <div class="flex flex-col items-center">
                        <div class="flex gap-3">
                            <Link
                                @click="newGame()"
                                class="mt-6 px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700"
                            >
                                New Game
                            </Link>
                            <Link
                                :disabled="isButtonDisabled"
                                :class="{
                                    'opacity-50 cursor-not-allowed':
                                        isButtonDisabled,
                                }"
                                @click="resumeGame()"
                                class="mt-6 px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700"
                            >
                                Resume Game
                            </Link>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>

<style scoped>
.green-bg {
    background-color: #00796b;
}
</style>
