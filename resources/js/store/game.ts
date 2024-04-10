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
    getters: {
        remainingDeck(): Card[] {
            // return this.cards.filter(card => !this.hand.includes(card) && !this.discards.includes(card))
        }
    },
})


