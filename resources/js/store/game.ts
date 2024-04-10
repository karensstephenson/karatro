import { defineStore } from 'pinia'

export const useGameStore = defineStore({
    id: 'game',
    state: () => ({
        cards: [] as Card[],
        hand: [] as Card[],
        discards: [] as Card[],
        playedHands: [],
        totalPoints: 0,
    }),
})


